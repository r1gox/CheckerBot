<?php

// Obtener el token del bot de Telegram desde las variables de entorno
$token = getenv('TELEGRAM_BOT_TOKEN');
if (empty($token)) {
    die("❌ Error: No se encontró el token del bot.");
}
include 'app/functions.php';
include 'app/bot.php';
include 'chds/chds.php';
include 'ats/ats.php';

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache");

//------TOKEN DEL BOT MIKASA ACKERMAN--------//
$website = "https://api.telegram.org/bot".$token;
//$data = file_get_contents("php://input");
//$json = json_decode($data, true);
//$update = $json["message"];



// Función para obtener la hora actual en México
function getCurrentTimeMexico() {
    $now = new DateTime('now', new DateTimeZone('America/Mexico_City'));
    return $now->format('Y-m-d H:i:s');
}




// Obtener mensaje de Telegram
$update = json_decode(file_get_contents("php://input"), true);


if (isset($update['message'])) {
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
    $adminIds = [1292171163, 1087968824]; // Agregamos ambos IDs de admin

    $logo = "<a href='http://t.me/XNazunaBot'>[↯]</a>";
    $admin = "<a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";


    
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
    



    if (preg_match('/^(!|\/|\.)start$/', $message)) {
        $respuesta = "─ Checker Panel ─\n\n⁕ Registered as ➞ ".$admin."\n⁕ Use ➞ ".$update["chat"]["type"]." | ".$message1["chat"]["type"]." /cmds to show available commands.\n⁕ Bot by: $admin\n";
        sendMessage($chatId, $respuesta, $message_id);
        die();
    }

    
    ////PARTE PARA COMANDOS//



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
