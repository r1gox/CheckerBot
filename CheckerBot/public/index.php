<?php

// Obtener el token del bot de Telegram desde las variables de entorno
$token = getenv('TELEGRAM_BOT_TOKEN');
if (empty($token)) {
    die("❌ Error: No se encontró el token del bot.");
}
include 'chk/functions.php';
include 'chk/bot.php';
include 'chk/chds/go.php';
include 'chk/gts/ats.php';

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache");

//------TOKEN DEL BOT MIKASA ACKERMAN--------//
$website = "https://api.telegram.org/bot".$token;
$data = file_get_contents("php://input");
$json = json_decode($data, true);
$update = $json["message"];


// Obtener credenciales de PostgreSQL
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');

// Conectar a PostgreSQL
$connectionString = "host=$host port=$port dbname=$database user=$user password=$password";
$conn = pg_connect($connectionString);

if (!$conn) {
    die("❌ Error al conectar a la base de datos: " . pg_last_error());
}


// Función para obtener la hora actual en México
function getCurrentTimeMexico() {
    $now = new DateTime('now', new DateTimeZone('America/Mexico_City'));
    return $now->format('Y-m-d H:i:s');
}

/*
// Función para enviar un mensaje
function sendMessage($chatID, $respuesta, $message_id = null) {
    global $token;
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id' => $chatID,
        'text' => $respuesta,
        'parse_mode' => 'HTML',
        'disable_web_page_preview' => true,
    ];
    if ($message_id) {
        $data['reply_to_message_id'] = $message_id;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}
*/
// Limpiar claves y usuarios expirados
function cleanExpiredData($conn) {
    $now = getCurrentTimeMexico();

    // Eliminar claves no reclamadas que hayan expirado
    $deleteKeys = pg_query_params($conn, "DELETE FROM keys WHERE claimed = FALSE AND expiration < $1", array($now));

    // Eliminar usuarios premium cuya membresía haya expirado
    $deleteUsers = pg_query_params($conn, "DELETE FROM premium_users WHERE expiration < $1", array($now));

    if (!$deleteKeys || !$deleteUsers) {
        error_log("Error al eliminar datos expirados: " . pg_last_error($conn));
    }
}


// Eliminar todas las claves y reiniciar el ID
function deleteAllKeys($conn) {
    pg_query($conn, "DELETE FROM keys"); // Eliminar todas las filas
    pg_query($conn, "ALTER SEQUENCE keys_id_seq RESTART WITH 1"); // Reiniciar el ID a 1
}

// Obtener mensaje de Telegram
$update = json_decode(file_get_contents("php://input"), true);



if (isset($update['message'])) {
    cleanExpiredData($conn); // Limpia los datos expirados antes de procesar cualquier comando

    
$group_id = $update['message']['chat']['id'];
$user = $update["message"]["from"]["username"];
$private_id = $update['message']['from']['id'];
$private_title = $update['message']['from']['first_name'];
$group_title = $update['message']['chat']['title'];
$chat_type = $update['message']['chat']['type'];


$chatId = $update['message']['chat']['id'];
$message_id = $update["message"]["message_id"];
$messageText = trim($update['message']['text']);
$message = $messageText;
//$adminId = 1292171163;
$adminIds = [1292171163, 1087968824]; // Agregamos ambos IDs de admin

$logo = "<a href='http://t.me/XNazunaBot'>[↯]</a>";
$admin = "<a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";

//$nose = "chat id: $chatId - Private ID: $private_id - group id: $group_id";
 // sendMessage($chatId, $nose);

// Asumimos que $private_id es el chat_id del usuario
$query = "SELECT * FROM premium_users WHERE chat_id = $private_id";
$result = pg_query($conn, $query);

// Verificamos si el usuario es premium
if (pg_num_rows($result) > 0) {
    $isPremium = true; // Si el chat_id está en la tabla premium_users, es premium
} else {
    $isPremium = false; // Si no está en la tabla, no es premium
}
    
// Determinar el tipo de usuario
if (in_array($private_id, $adminIds)) {
    $userType = "ᴀᴅᴍɪɴ";
} elseif ($isAdmin) {
    $userType = "ᴀᴅᴍɪɴ";
} elseif ($isPremium) {
    $userType = "ᴘʀᴇᴍɪᴜᴍ ᴜsᴇʀ";
} else {
    $userType = "ғʀᴇᴇ ᴜsᴇʀ";
    $TypeUser = "Free";
}

if (in_array($private_id, $adminIds)) {
    // El código se ejecutará si $private_id está en el array de administradores
} elseif ($chatId == "-1002452370727") {
    if ($userType == "ғʀᴇᴇ ᴜsᴇʀ" && preg_match('/^(!|\/|\.)claim/', $message)) {

    } else {
    // Si no es un administrador, pero el chatId coincide con el grupo específico
        die(); // Termina la ejecución del script
    }
}
 

// Si el usuario NO es premium y el comando es una variante de "start"
if ($userType == "ғʀᴇᴇ ᴜsᴇʀ" && preg_match('/^(!|\/|\.)start$/', $message)) {
    $response = "🚀 <b>Acceso Restringido</b> 🚀\n\n";
    $response .= "🔒 Este bot es <b>Premium</b>. Para acceder a sus funciones, necesitas una clave de acceso.\n";
    $response .= "🔑 Usa /claim [key] para activarlo.\n\n";
    $response .= "🆓 También puedes usarlo gratis uniéndote a nuestro grupo: @checker_bins\n\n";
    $response .= "📩 Contacta con <a href='http://t.me/rigo_jz'>@rigo_jz</a> para más información.";
    sendMessage($chatId, $response, $update['message']['message_id'], "HTML");
    exit();
}
    


    // Comando /claim [key]
// Comando /claim [key]
//if (preg_match('/^(!|\/|\.)claim/', $message)) {
if ($userType == "ғʀᴇᴇ ᴜsᴇʀ" && preg_match('/^(!|\/|\.)claim/', $message)) {
    $parts = explode(" ", $messageText);
    if (count($parts) < 2) {
        sendMessage($chatId, "❌ Debes proporcionar una clave. Ejemplo: /claim 123456", $message_id);
        return;
    }

    $key = trim($parts[1]);

    // Verificar si la clave existe y está disponible
    $result = pg_query_params($conn, "SELECT expiration FROM keys WHERE \"key\" = $1 AND claimed = FALSE", array($key));

    if (!$result || pg_num_rows($result) === 0) {
        sendMessage($chatId, "❌ Clave inválida o ya ha sido reclamada.", $message_id);
        return;
    }

    $row = pg_fetch_assoc($result);
    $expirationDate = $row['expiration'];

    // Marcar la clave como reclamada
    pg_query_params($conn, "UPDATE keys SET claimed = TRUE WHERE \"key\" = $1", array($key));

    // Obtener el username del usuario
    $username = $update['message']['from']['username'] ?? 'Desconocido';

    // Agregar al usuario a la tabla de usuarios premium con fecha de expiración
    pg_query_params($conn, "INSERT INTO premium_users (chat_id, username, expiration) 
                            VALUES ($1, $2, $3) 
                            ON CONFLICT (chat_id) 
                            DO UPDATE SET expiration = $3", 
                    array($chatId, $username, $expirationDate));

    sendMessage($chatId, "✅ ¡Felicidades! Ahora eres usuario premium hasta el $expirationDate.", $message_id);
    die();
}

    
// Si es el comando /start, todos pueden usarlo
$ComandosAutorizados = ['/start', '/id', '/vip', '/claim'];
$command = explode(' ', $message)[0];

//if (in_array($command, $ComandosAutorizados)) {
    // Procesar comandos permitidos aquí
//    if ($command == '/start') {
//        sendMessage($chatId, "👋 Bienvenido. Usa este bot para interactuar.");
 //   }
    
//} else {
    // Verificar si el usuario es el creador
if (in_array($private_id, $adminIds)) {
    ///AQUI SE PROCESAN LOS MENSAJES PARA EL ADMIN//
        // El creador siempre puede enviar mensajes
//        sendMessage($chatId, "✨ Eres el creador, puedes enviar mensajes.");
    } else {
        // Comprobar si el usuario es premium
        $result = pg_query_params($conn, "SELECT expiration FROM premium_users WHERE chat_id = $1", array($private_id));

        if ($result && pg_num_rows($result) > 0) {
            $row = pg_fetch_assoc($result);
            $expirationDate = new DateTime($row['expiration'], new DateTimeZone('America/Mexico_City'));
            $now = new DateTime(getCurrentTimeMexico());

            if ($expirationDate > $now) {
                // El usuario es premium, puede enviar mensajes
//                sendMessage($chatId, "✨ Eres usuario premium. Puedes enviar mensajes.", $message_id);
            } else {
                // Si la membresía ha expirado, eliminamos al usuario de la lista premium
                pg_query_params($conn, "DELETE FROM premium_users WHERE chat_id = $1", array($private_id));
                sendMessage($chatId, "⚠️ Tu membresía premium ha expirado.", $message_id);
                 die();
            }
        } else {
            // Si el usuario no es premium, bloquear mensajes
            sendMessage($chatId, "❌ Solo los usuarios premium pueden enviar mensajes.", $message_id);
            die();
        }
    }
//}
    
    

if (preg_match('/^(!|\/|\.)start$/', $message)) {
    $respuesta = "─ Checker Panel ─\n\n⁕ Registered as ➞ ".$admin."\n⁕ Use ➞ ".$update["chat"]["type"]." | ".$message1["chat"]["type"]." /cmds to show available commands.\n⁕ Bot by: $admin\n";
    sendMessage($chatId, $respuesta, $message_id);
    die();
}
    //    $chatId = $update['message']['chat']['id'];
//    $messageText = trim($update['message']['text']);
 //   $adminId = 1292171163;


/*
$comandosReconocidos = ['/start', '/vip', '/id', '/gts', '/bin', '/iban', '/sk', '/gen', '/extb', '/claim', '/keys', '/deleteallkeys', '/mypremium', '/clean', '/genkey'];

// Comprobar si el mensaje es un comando reconocido
if (in_array($messageText, $comandosReconocidos)) {

    // Manejo de comandos
} else {
    // Si no es un comando reconocido, ejecuta handleCommands()
    handleCommands($chatId, $messageText);
}
*/

////PARTE PARA COMANDOS//


    
    // Comando /start
//    if ($messageText === '/vip') {
  //  if (strpos($message, '/vip') && $private_id == $adminId) {
    if (preg_match('/^([\/|!|\.])vip$/', $message) && in_array($private_id, $adminIds)) {
    // Código aquí

        $response = "🎉 <b>¡Bienvenido!</b> 🎉\n\n";
        $response .= "📌 <b>Comandos disponibles:</b>\n";
        $response .= "━━━━━━━━━━━━━━━━━━━━\n";
        $response .= "🔑 <b>Generar Clave (Admin)</b>\n";
        $response .= "   ➜ /genkey <code>[cantidad][m/h/d]</code>\n\n";
        $response .= "📂 <b>Ver Claves (Admin)</b>\n";
        $response .= "   ➜ /keys\n\n";
        $response .= "🗑 <b>Eliminar Todas las Claves (Admin)</b>\n";
        $response .= "   ➜ /deleteallkeys\n\n";
        $response .= "🌟 <b>Estado Premium</b>\n";
        $response .= "   ➜ /id\n\n";
        $response .= "🎟 <b>Reclamar Clave Premium</b>\n";
        $response .= "   ➜ /claim [key]\n\n";
        $response .= "🧹 <b>Limpiar Expirados (Admin)</b>\n";
        $response .= "   ➜ /clean\n";
        $response .= "━━━━━━━━━━━━━━━━━━━━\n";
        sendMessage($chatId, $response, $message_id, "HTML");
         die();

        //sendMessage($chatId, $response);
    }


// Comando /keys (admin) 
//if ($messageText === '/keys' && in_array($private_id, $adminIds)) {
if (preg_match('/^(!|\/|\.)keys$/', $messageText) && in_array($private_id, $adminIds)) {

    $now = getCurrentTimeMexico(); // Obtener la hora actual

    // Consultar todas las claves, incluyendo las expiradas
    $result = pg_query($conn, "SELECT \"key\", expiration, claimed FROM keys");

    if (pg_num_rows($result) === 0) {
        sendMessage($chatId, "🔑 No hay claves activas.");
    } else {
        $keysList = "🔑 Claves activas:\n";
        while ($row = pg_fetch_assoc($result)) {
            $expirationDate = new DateTime($row['expiration'], new DateTimeZone('America/Mexico_City'));
            $nowDate = new DateTime($now);

            // Determinar el estado de la clave
            if ($expirationDate < $nowDate) {
                $estado = "⚫ Expirado";
            } elseif ($row['claimed'] === 't') {
                $estado = "🔴 Reclamado";
            } else {
                $estado = "🟢 Disponible";
            }

            // Agregar a la lista
            $keysList .= "Clave: <code>{$row['key']}</code>\nExpira: {$row['expiration']}\nEstado: {$estado}\n\n";
        }
        sendMessage($chatId, $keysList, $message_id);
    }

    // Eliminar claves expiradas después de mostrarlas
    pg_query_params($conn, "DELETE FROM keys WHERE expiration < $1", array($now));
         die();
}






// Comando /mypremium
if (preg_match('/^(!|\/|\.)id$/', $message)) {
    $adminId = 1292171163; // ID del creador del bot
    $result = pg_query_params($conn, "SELECT expiration FROM premium_users WHERE chat_id = $1", array($chatId));
    
    $now = new DateTime(getCurrentTimeMexico());
    $tipoUsuario = "👤 Usuario Free"; // Por defecto es usuario normal
    
    if ($chatId == $adminId) {
        $tipoUsuario = "👑 Creador del bot";
    } elseif ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        $expirationDate = new DateTime($row['expiration'], new DateTimeZone('America/Mexico_City'));

        if ($expirationDate > $now) {
            $tipoUsuario = "🌟 Usuario Premium\nExpira el: " . $expirationDate->format('Y-m-d H:i:s');
        } else {
            // Si la fecha ya pasó, eliminamos al usuario de premium
            pg_query_params($conn, "DELETE FROM premium_users WHERE chat_id = $1", array($chatId));
        }
    }

    
    if ($private_title == "Channel"){
            $name_title = $group_title;
            $ID = $group_id;
    }else{
            $name_title = $private_title;
            $ID = $private_id;
    }
    $respuesta = "🔹 <b>Información de Usuario</b> 🔹\n\n" .
             "📛 <b>Nombre:</b> {$name_title}\n" .
             "💬 <b>Tipo de Chat:</b> {$chat_type}\n" .
             "🆔 <b>Tu ID:</b> <code>{$ID}</code>\n" .
             "✨ <b>Estado Actual:</b> {$tipoUsuario}\n";

    sendMessage($chatId, $respuesta, $message_id);
   die();
}





    // Comando /genkey (admin)
//    if (strpos($messageText, '/genkey') === 0 && in_array($private_id, $adminIds)) {
    if (preg_match('/^(!|\/|\.)genkey/', $messageText) && in_array($private_id, $adminIds)) {
        if (!preg_match('/(\d+)([mdh])/', $messageText, $matches)) {
            sendMessage($chatId, "❌ Uso incorrecto. Ejemplo: /genkey 5m", $message_id);
            return;
        }

        $duration = (int)$matches[1];
        $unit = $matches[2];
        $now = new DateTime(getCurrentTimeMexico());

        switch ($unit) {
            case 'm': $now->modify("+{$duration} minutes"); break;
            case 'h': $now->modify("+{$duration} hours"); break;
            case 'd': $now->modify("+{$duration} days"); break;
        }

        $expirationDate = $now->format('Y-m-d H:i:s');
        $key = bin2hex(random_bytes(8));
        $key = "Alya-".$key."-KEY";
        pg_query_params($conn, "INSERT INTO keys (chat_id, \"key\", expiration, claimed) VALUES ($1, $2, $3, FALSE)", array($chatId, $key, $expirationDate));

//        sendMessage($chatId, "✅ Clave generada: <code>$key</code>\nExpira: $expirationDate.", $message_id);
        $response = "🟡 𝗞𝗘𝗬 𝗚𝗘𝗡𝗘𝗥𝗔𝗗𝗔\n"
           . "━━━━━━━━━━━━━━━━━━━━━━\n"
           . "🔑 𝗞𝗲𝘆: <code>$key</code>\n"
           . "🌟 𝗣𝗹𝗮𝗻: Premium\n"
           . "⏳ 𝗗𝘂𝗿𝗮𝗰𝗶𝗼𝗻: $expirationDate\n"
           . "━━━━━━━━━━━━━━━━━━━━━━\n"
           . "📄 𝗙𝗼𝗿𝗺𝗮𝘁: /claim [key]\n"
           . "━━━━━━━━━━━━━━━━━━━━━━\n"
           . "🤖 𝗕𝗼𝘁: @Alya_Chk_BOT\n";
    // Enviar mensaje con el formato adecuado (usando HTML)//
    sendMessage($chatId, $response, $message_id, "HTML");
        die();
    }

    
    // Comando /deleteallkeys (admin)
  //  if ($messageText === '/deleteallkeys' && in_array($private_id, $adminIds)) {
    if (preg_match('/^(!|\/|\.)deleteallkeys$/', $messageText) && in_array($private_id, $adminIds)) {

        deleteAllKeys($conn);
        sendMessage($chatId, "🗑 Todas las claves han sido eliminadas.", $message_id);
        die();
    }

    // Comando /clean (admin)
    //if ($messageText === '/clean' && $chatId == $adminId) {
    if (preg_match('/^(!|\/|\.)clean$/', $messageText) && in_array($private_id, $adminIds)) {

        cleanExpiredData($conn);
        sendMessage($chatId, "🗑 Claves y usuarios expirados eliminados.", $message_id);
         die();
    }


// Manejar el comando
$response = handleCommands($chatId, $messageText, $message_id);  // Llama a la función que genera la respuesta
// Enviar el mensaje de espera con el reply_to_message_id
sendMessage($chatId, $response, $message_id, "HTML");  // Enviar el mensaje

$response1 = chkgo($chatId, $messageText, $message_id);  // Llama a la función que genera la respuesta
// Enviar el mensaje de espera con el reply_to_message_id
sendMessage($chatId, $response1, $message_id, "HTML");  // Enviar el mensaje

$response2 = ats($chatId, $messageText, $message_id);  // Llama a la función que genera la respuesta
// Enviar el mensaje de espera con el reply_to_message_id
sendMessage($chatId, $response2, $message_id, "HTML");  // Enviar el mensaje

}

   
?>
