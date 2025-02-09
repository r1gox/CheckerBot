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

// Obtener el contenido del mensaje recibido
$update = file_get_contents("php://input");
$update = json_decode($update, true);

// Verificar si el mensaje es válido
if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $messageText = $update['message']['text'];

    try {
        // Comando /start
        if ($messageText == '/start') {
            $response = "¡Hola! Soy tu bot. Envíame un mensaje y lo guardaré en la base de datos.";
        }
        // Comando /help
        elseif ($messageText == '/help') {
            $response = "Puedes enviarme cualquier mensaje y lo guardaré en la base de datos.";
        }
        // Otros mensajes
        else {
            // Guardar el mensaje en la base de datos
            $query = "INSERT INTO mensajes (chat_id, mensaje) VALUES ($1, $2)";
            $result = pg_query_params($conn, $query, array($chatId, $messageText));

            if (!$result) {
                throw new Exception("Error al insertar el mensaje: " . pg_last_error());
            }

            $response = "Mensaje recibido y guardado en la base de datos.";
        }

        // Responder al usuario
        $url = "https://api.telegram.org/bot$token/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $response,
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context  = stream_context_create($options);
        file_get_contents($url, false, $context);

    } catch (Exception $e) {
        // Registrar el error en los logs
        error_log("Error en el bot: " . $e->getMessage());

        // Enviar un mensaje de error al usuario
        $response = "Lo siento, ha ocurrido un error. Por favor, inténtalo de nuevo más tarde.";
        $data = [
            'chat_id' => $chatId,
            'text' => $response,
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context  = stream_context_create($options);
        file_get_contents($url, false, $context);
    }
}
?>
