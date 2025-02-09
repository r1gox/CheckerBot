<?php

// Obtener las credenciales del bot y la base de datos desde las variables de entorno
$token = getenv('TELEGRAM_BOT_TOKEN');
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');

// Verificar si las credenciales están configuradas correctamente
if (empty($token) || empty($host) || empty($port) || empty($user) || empty($password) || empty($database)) {
    die("❌ Error: No se encontraron las credenciales.");
}

// Conectar a la base de datos PostgreSQL
try {
    $connectionString = "host=$host port=$port dbname=$database user=$user password=$password";
    $conn = pg_connect($connectionString);
} catch (Exception $e) {
    die("❌ Error al conectar a la base de datos: " . $e->getMessage());
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
            pg_query_params($conn, $query, array($chatId, $messageText));

            if (pg_last_error()) {
                throw new Exception("Error al insertar el mensaje: " . pg_last_error());
            }

            $response = "Mensaje recibido y guardado en la base de datos.";
        }

        // Responder al usuario
        sendResponseTelegramApi(
            'sendMessage',
            [
                'chat_id' => strval(intval(0+$chatId)),
                'text' => strval(trim(strip_tags(html_entity_decode(stripslashes(stripcslashes(addslashes(trim(strip_tags(html_entity_decode(stripslashes(stripcslashes(addslashes(str_replace(["\n", "\r"], '', trim(addslashes(str_replace(["\n", "\r"], '', trim(strip_tags(html_entity_decode(stripslashes(stripcslashes(addslashes(trim(strip_tags(html_entity_decode(stripslashes(stripcslashes(addslashes(str_replace(["\n", "\r"], '', trim(addslashes(str_replace(["\n", "\r"], '', trim(strip_tags(html_entity_decode(stripslashes(stripclasses))
                                            )
                                            )))))))))))))))))))), response)))))), 
                    ]
                        )      
                        );

function sendResponseTelegramApi(string $_apiMethod,string|bool $_params=false):string|false|null{
$url='https://api.telegram.org/bot'.$GLOBALS['token'].'/'.$_apiMethod;
$data=[
'http'=>[
'method'=>$_params?'POST':'GET',
'header'=>$_params?"Content-type: application/x-www-form-urlencoded\r\n":null,
'content'=>$_params?http_build_query($_params):null,
],
];
stream_context_set_default(stream_context_create(['ssl'=>['verify_peer'=>false,'verify_peer_name'=>false]]));
return @file_get_contents(
$url,false,
stream_context_create(['http'=>$data])
);

}
