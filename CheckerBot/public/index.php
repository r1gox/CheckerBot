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
        // Verificar si el chat_id ya está registrado en la base de datos
        $checkQuery = "SELECT * FROM usuarios WHERE chat_id = $1";
        $result = pg_query_params($conn, $checkQuery, array($chatId));

        // Verificar si hubo un error en la consulta
        if ($result === false) {
            throw new Exception("Error al verificar el chat_id: " . pg_last_error());
        }

        // Continuamos solo si la consulta fue exitosa
        if (pg_num_rows($result) == 0) {
            // Si el chat_id no está registrado, lo insertamos en la base de datos
            $insertQuery = "INSERT INTO usuarios (chat_id) VALUES ($1)";
            $insertResult = pg_query_params($conn, $insertQuery, array($chatId));

            if (!$insertResult) {
                throw new Exception("Error al insertar el chat_id: " . pg_last_error());
            }
        }

        // Verificar si el mensaje es el comando /start
        if ($messageText === '/start') {
            // Verificar si el usuario tiene una clave activa
            $premiumCheckQuery = "SELECT * FROM keys WHERE chat_id = $1 AND claimed = TRUE AND expiration > NOW()";
            $premiumResult = pg_query_params($conn, $premiumCheckQuery, array($chatId));

            if (pg_num_rows($premiumResult) > 0) {
                // El usuario es premium
                $response = "¡Bienvenido! Eres un usuario premium. ¿Cómo puedo ayudarte?";
            } else {
                // El usuario no es premium
                $response = "¡Bienvenido! No eres un usuario premium. Por favor, obtén una clave con el comando /genkey.";
            }

            sendMessage($chatId, $response);

        } elseif (preg_match('/^\/genkey (\d+)(m|h|d)$/', $messageText, $matches)) {
            // Comando /genkey para generar una clave

            $keyDuration = $matches[1];  // 1
            $unit = $matches[2];  // m/h/d

            // Convertir la duración a minutos
            if ($unit === 'm') {
                $duration = "$keyDuration minutes";
            } elseif ($unit === 'h') {
                $duration = "$keyDuration hours";
            } elseif ($unit === 'd') {
                $duration = "$keyDuration days";
            }

            // Verificar si el usuario ya tiene una clave activa
            $checkKeyQuery = "SELECT * FROM keys WHERE chat_id = $1 AND claimed = TRUE AND expiration > NOW()";
            $checkKeyResult = pg_query_params($conn, $checkKeyQuery, array($chatId));

            if (pg_num_rows($checkKeyResult) > 0) {
                $response = "Ya tienes una clave activa. No puedes reclamar otra hasta que caduque.";
                sendMessage($chatId, $response);
            } else {
                // Generar una clave única
                $key = bin2hex(random_bytes(16));  // Generamos una clave aleatoria de 32 caracteres

                // Guardar la clave en la base de datos
                $expirationTime = "NOW() + INTERVAL '$duration'";
                $insertKeyQuery = "INSERT INTO keys (chat_id, key, expiration) VALUES ($1, $2, $3)";
                $insertKeyResult = pg_query_params($conn, $insertKeyQuery, array($chatId, $key, $expirationTime));

                if (!$insertKeyResult) {
                    throw new Exception("Error al generar la clave: " . pg_last_error());
                }

                $response = "Tu clave es: $key. Esta clave será válida por $duration.";
                sendMessage($chatId, $response);
            }

        } elseif (preg_match('/^\/claim (\w+)$/', $messageText, $matches)) {
            // Comando /claim para reclamar la clave

            $keyClaimed = $matches[1];  // Clave proporcionada por el usuario

            // Verificar si la clave es válida
            $checkClaimQuery = "SELECT * FROM keys WHERE key = $1 AND claimed = FALSE AND expiration > NOW()";
            $checkClaimResult = pg_query_params($conn, $checkClaimQuery, array($keyClaimed));

            if (pg_num_rows($checkClaimResult) == 0) {
                $response = "La clave no es válida o ya ha expirado.";
                sendMessage($chatId, $response);
            } else {
                // Marcar la clave como reclamada
                $updateClaimQuery = "UPDATE keys SET claimed = TRUE WHERE key = $1";
                $updateClaimResult = pg_query_params($conn, $updateClaimQuery, array($keyClaimed));

                if (!$updateClaimResult) {
                    throw new Exception("Error al reclamar la clave: " . pg_last_error());
                }

                $response = "¡Clave reclamada exitosamente! Ahora eres un usuario premium.";
                sendMessage($chatId, $response);
            }

        } else {
            // Responder si el mensaje no es ninguno de los anteriores
            $response = "Comando no reconocido. Usa /start para comenzar.";
            sendMessage($chatId, $response);
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
    global $token;
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
