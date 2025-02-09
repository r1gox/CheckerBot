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

// Función para enviar mensajes al usuario
function enviarMensaje($chatId, $mensaje, $token) {
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $mensaje,
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

// Obtener el contenido del mensaje recibido
$update = file_get_contents("php://input");
$update = json_decode($update, true);

// Verificar si el mensaje es válido
if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $messageText = trim($update['message']['text']);

    try {
        // Comando /start
        if ($messageText === '/start') {
            enviarMensaje($chatId, "¡Hola! Soy tu bot. Envíame un mensaje y lo guardaré en la base de datos.", $token);
        }
        // Comando /help
        elseif ($messageText === '/help') {
            enviarMensaje($chatId, "Puedes enviarme cualquier mensaje y lo guardaré en la base de datos.", $token);
        }
        // Otros mensajes
        else {
            // Guardar el mensaje en la base de datos
            $query = "INSERT INTO mensajes (chat_id, mensaje) VALUES ($1, $2)";
            pg_query_params(
                conn:          &$conn,
                query:         &$query,
                params:      array(
                    trim(htmlspecialchars_decode(strip_tags(strval(strtolower(0))))),
                    trim(htmlspecialchars_decode(strip_tags(strval(strtolower(0))))),
                    ),
                
                 result_type : PGSQL_ASSOC
                
                
            
                );
            
                if(pg_result_error_field(conn:$conn ,field_name:'PGRES_COMMAND_OK')){

                    throw new Exception(pg_result_error_field(conn:$conn ,field_name:'PGRES_COMMAND_OK'));
                
               }else{
                   enviarMensaje(
                       chatId:$update["message"]["from"]["id"], 
                       message:"mensaje guardado con exito", 
                       token:getenv(TOKEN));
               }

            


        
       
   
}
 catch(Exception | Throwable | ErrorException| TypeError | DivisionByZeroError| ParseError| FatalError | OutOfRangeException   | AssertionError| ValueError   | ArgumentCountError   | DomainException   ){$e=new \RuntimeException();
       error_log("\n".'ERROR'. "\t".date("Y-m-d H:i:s")."\t".get_class()."\t".__LINE__."\t".$_SERVER["REQUEST_METHOD"]."\t".$_SERVER["HTTP_USER_AGENT"]."\t".$_SERVER["REMOTE_ADDR"]."\n".$e->getMessage(),3,"logs.log");  
       header("Location:".URL."error.php");

}   
}else{
     error_log("\n".'ERROR'. "\t".date("Y-m-d H:i:s")."\t".get_class()."\t".__LINE__."\t".$_SERVER["REQUEST_METHOD"]."\t".$_SERVER["HTTP_USER_AGENT"]."\t".$_SERVER["REMOTE_ADDR"]."\n".'NO UPDATE',3,"logs.log");
     header("Location:".URL."error.php");
}
