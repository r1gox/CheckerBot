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
    $chatId = $update['message']['chat']['id'];
    $messageText = $update['message']['text'];

    try {
        // Verificar si el mensaje es el comando /start
        if ($messageText === '/start') {
            // Responder al usuario con un mensaje de bienvenida
            $response = "¡Bienvenido! Soy tu bot. ¿Cómo puedo ayudarte?";
            sendMessage($chatId, $response);
        } else {
            // Si no es el comando /start, guardar el mensaje en la base de datos
            $query = "INSERT INTO mensajes (chat_id, mensaje) VALUES ($1, $2)";
            $result = pg_query_params($conn, $query, array($chatId, $messageText));

            if (!$result) {
                throw new Exception("Error al insertar el mensaje: " . pg_last_error());
            }

            // Responder al usuario confirmando que el mensaje fue recibido
            $response = "Mensaje recibido y guardado en la base de datos.";
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
