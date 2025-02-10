<?php
// Obtener el token del bot de Telegram desde las variables de entorno
$token = getenv('TELEGRAM_BOT_TOKEN');
if (empty($token)) {
    die("❌ Error: No se encontró el token del bot.");
}

// Obtener las credenciales de la base de datos PostgreSQL desde las variables de entorno
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');

// Conectar a la base de datos PostgreSQL
$connectionString = "host=$host port=$port dbname=$database user=$user password=$password";
$conn = pg_connect($connectionString);

if (!$conn) {
    die("❌ Error al conectar a la base de datos: " . pg_last_error());
}

// Obtener el contenido del mensaje recibido desde Telegram
$update = file_get_contents("php://input");
$update = json_decode($update, true);

// Verificar si el mensaje es válido
if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];  // Capturamos el ID de chat del usuario
    $messageText = $update['message']['text'];   // Capturamos el texto del mensaje enviado por el usuario

    try {
        // Verificar si el mensaje es el comando /start
        if ($messageText === '/start') {
            if ($chatId == 1292171163) {
                // Comando /start: Solo el admin ve todos los comandos
                $response = "¡Bienvenido! Soy tu bot. Los comandos disponibles son:\n\n";
                $response .= "/genkey [duración] (para generar una clave)\n";
                $response .= "/claim (para reclamar tu clave)\n";
                $response .= "/premium (para ver los usuarios premium)\n";
                sendMessage($chatId, $response);
            } else {
                // Para los usuarios no admin, solo se les muestra el comando /claim
                $response = "¡Bienvenido! Soy tu bot. Puedes usar el siguiente comando:\n\n";
                $response .= "/claim (para reclamar tu clave)";
                sendMessage($chatId, $response);
            }
        }

        // Verificar si el mensaje es el comando /genkey
        elseif (preg_match('/^\/genkey (\d+)(m|h|d)$/', $messageText, $matches)) {
            $keyDuration = $matches[1];  // 1
            $unit = $matches[2];  // m/h/d

            // Convertir la duración a minutos, horas o días
            if ($unit === 'm') {
                $duration = "$keyDuration minutes";
            } elseif ($unit === 'h') {
                $duration = "$keyDuration hours";
            } elseif ($unit === 'd') {
                $duration = "$keyDuration days";
            }

            // Verificar si el usuario es el administrador
            if ($chatId == 1292171163) {  // Admin user ID
                // El admin siempre puede generar claves ilimitadas
                $key = bin2hex(random_bytes(16));  // Generamos una clave aleatoria de 32 caracteres

                // Guardar la clave ilimitada en la base de datos (sin expiración)
                $insertKeyQuery = "INSERT INTO keys (chat_id, key, expiration, claimed) VALUES ($1, $2, NULL, FALSE)";
                $insertKeyResult = pg_query_params($conn, $insertKeyQuery, array($chatId, $key));

                if (!$insertKeyResult) {
                    throw new Exception("Error al generar la clave ilimitada: " . pg_last_error());
                }

                $response = "La clave ilimitada es: $key.";
                sendMessage($chatId, $response);
            } else {
                // Verificar si el usuario ya tiene una clave activa
                $checkKeyQuery = "SELECT * FROM keys WHERE chat_id = $1 AND claimed = TRUE AND expiration > NOW()";
                $checkKeyResult = pg_query_params($conn, $checkKeyQuery, array($chatId));

                if (pg_num_rows($checkKeyResult) > 0) {
                    $response = "Ya tienes una clave activa. No puedes reclamar otra hasta que caduque.";
                    sendMessage($chatId, $response);
                } else {
                    // Generar una clave con fecha de expiración
                    $key = bin2hex(random_bytes(16));  // Generamos una clave aleatoria de 32 caracteres

                    // Guardar la clave en la base de datos
                    $insertKeyQuery = "INSERT INTO keys (chat_id, key, expiration, claimed) VALUES ($1, $2, NOW() + INTERVAL '$duration', FALSE)";
                    $insertKeyResult = pg_query_params($conn, $insertKeyQuery, array($chatId, $key));

                    if (!$insertKeyResult) {
                        throw new Exception("Error al generar la clave: " . pg_last_error());
                    }

                    $response = "Tu clave es: $key. Esta clave será válida por $keyDuration $unit.";
                    sendMessage($chatId, $response);
                }
            }
        }

        // Verificar si el mensaje es el comando /claim
        elseif (preg_match('/^\/claim$/', $messageText)) {
            // Verificar si el usuario tiene una clave activa
            $checkKeyQuery = "SELECT * FROM keys WHERE chat_id = $1 AND claimed = TRUE AND expiration > NOW()";
            $checkKeyResult = pg_query_params($conn, $checkKeyQuery, array($chatId));

            if (pg_num_rows($checkKeyResult) > 0) {
                $response = "Ya tienes una clave activa. No puedes reclamar otra hasta que caduque.";
                sendMessage($chatId, $response);
            } else {
                $response = "No tienes ninguna clave activa. Usa el comando /genkey para obtener una clave.";
                sendMessage($chatId, $response);
            }
        }

        // Verificar si el mensaje es el comando /premium
        elseif ($messageText === '/premium' && $chatId == 1292171163) { // Solo el admin puede usar /premium
            // Obtener todos los usuarios premium
            $premiumUsersQuery = "SELECT chat_id FROM keys WHERE claimed = TRUE AND expiration > NOW()";
            $premiumUsersResult = pg_query($conn, $premiumUsersQuery);

            if (pg_num_rows($premiumUsersResult) > 0) {
                $premiumList = "Usuarios premium activos:\n";
                while ($row = pg_fetch_assoc($premiumUsersResult)) {
                    $premiumList .= "Chat ID: " . $row['chat_id'] . "\n";
                }
                sendMessage($chatId, $premiumList);
            } else {
                $response = "No hay usuarios premium activos.";
                sendMessage($chatId, $response);
            }
        }

    } catch (Exception $e) {
        // Registrar el error en los logs
        error_log("Error en el bot: " . $e->getMessage());

        // Enviar un mensaje de error al usuario
        $response = "Lo siento, ha ocurrido un error. Por favor, inténtalo de nuevo más tarde.";
        sendMessage($chatId, $response);
    }
}

// Función para enviar mensajes
function sendMessage($chatID, $respuesta, $message_id = null) {
    global $token; // Asegúrate de que el token sea accesible dentro de la función
    $url = "https://api.telegram.org/bot$token/sendMessage?disable_web_page_preview=true&chat_id=".$chatID."&parse_mode=HTML&text=".urlencode($respuesta);
    if ($message_id) {
        $url .= "&reply_to_message_id=".$message_id;
    }
    $response = file_get_contents($url);
    if ($response === FALSE) {
        error_log("Error al enviar mensaje a Telegram: " . print_r(error_get_last(), true));
    }
}
?>
