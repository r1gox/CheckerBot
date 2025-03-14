<?php

function handleCommands($chatId, $message, $message_id) {
	 global $user, $admin, $logo, $userType;
 
$tipo = $userType;
if((strpos($message, "!") === 0)||(strpos($message, "/") === 0)||(strpos($message, ".") === 0)){

$timeout = 60; // Tiempo de espera en segundos
$maxMessages = 3; // Máximo de mensajes permitidos
$file = 'users.txt';
$userId = $id; // Reemplaza con la lógica para obtener el ID del usuario actual

try {
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
    } else {
        $data = array();
    }

    if (!isset($data[$userId])) {
        $data[$userId] = array('lastSend' => 0, 'count' => 0);
    }

    $lastSend = $data[$userId]['lastSend'];
    $count = $data[$userId]['count'];
    $diff = time() - $lastSend;

    if ($diff >= $timeout) {
        $count = 0; // Resetear contador después del timeout
    }

    if ($count >= $maxMessages) {
	    $response = '[ANTI SPAM] Please try again after ' . ($timeout - $diff) . ' seconds.';
	    sendMessage($chatId, $response, $message_id, "HTML");  // Enviar el mensaje
	    die();
    }

    // Envía el mensaje...
    $count++;
    $data[$userId] = array('lastSend' => time(), 'count' => $count);
    file_put_contents($file, json_encode($data));
//    echo "Mensaje enviado con éxito.\n";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit;
}
}


if (preg_match('/^(!|\/|\.)cmds$/', $message)) {
   return "🔹 <b>CHECKER COMMANDS</b> 🔹\n━━━━━━━━━━━━━━━━━━━━━\n"
               . "➩ <b>Check User Info</b> ✔\n   └ 💠 /me\n"
               . "➩ <b>Check ID chat</b> ✔\n   └ 💠 /id\n"
               . "➩ <b>List Command Gates</b> ✔\n   └ 💠 /gts\n\n"
               . "🌟 <b>EXTRAS</b> 🌟\n━━━━━━━━━━━━━━━━━━━━━\n"
               . "⌦ <b>Bin Check</b> ✔\n   └ 💠 /bin xxxxxx\n"
               . "⌦ <b>Checker IBAN</b> ✔\n   └ 💠 /iban xxxxxx\n"
               . "⌦ <b>SK Key Check</b> ✔\n   └ 💠 /sk sk_live_xxxx\n"
               . "⌦ <b>Gen ccs</b> ✔\n   └ 💠 /gen xxxxxx\n\n"
               . "📩 <b>Contacto</b> ➜ <a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n"
               . "🤖 <b>Bot by</b> ➜ <a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";  
	
    //sendMessage($chatId, $respuesta, $update['message']['message_id'], "HTML");
}

if (preg_match('/^(!|\/|\.)gts$/', $message)) {
       return "🚀 <b>Command Gates</b> 🚀\n\n"
               . "💠 <b>Gates Chargeds</b> ✔\n"
               . "└ 💎 <code>/chds</code>\n\n"
               . "💠 <b>Gates Auth</b> ✔\n"
               . "└ 🔐 <code>/ats</code>\n\n"
               . "💠 <b>Gates PayPal</b> ✔\n"
               . "└ 💳 <code>/pys</code>\n\n"
               . "📩 <b>Contacto:</b> <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n"
               . "🤖 <b>Bot by:</b> <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";

    //sendMessage($chat_id, $respuesta, $message_id, "HTML");
}


if (preg_match('/^(!|\/|\.)chds$/', $message)) {
    return "💠 <b>Gates Chargeds</b> 💠\n"
               . "--------------------------------------\n"
               . "🔥 <b>Braintree Charged</b> ($50) ✔\n"
               . "└ 💻 <code>/stp</code>\n"
               . "⁕ <i>Status:</i> OFF!❌\n\n"
               . "🔥 <b>Braintree Charged</b> ($5) ✔\n"
               . "└ 💻 <code>/go</code>\n"
               . "⁕ <i>Status:</i> OFF!❌\n\n"
               . "🔥 <b>Charged</b> (€1) ✔\n"
               . "└ 💻 <code>/cb</code>\n"
               . "⁕ <i>Status:</i> ON!✅\n\n"
               . "🔥 <b>Charged</b> ($5) ✔\n"
               . "└ 💻 <code>/en</code>\n"
               . "⁕ <i>Status:</i> ON!✅\n\n"
               . "🔥 <b>Charged</b> ($5) ✔\n"
               . "└ 💻 <code>/br</code>\n"
               . "⁕ <i>Status:</i> ON!✅\n\n"
               . "📩 <b>Contacto:</b> <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n"
               . "🤖 <b>Bot by:</b> <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";

 //   sendMessage($chat_id, $respuesta, $message_id, "HTML");
}

if (preg_match('/^(!|\/|\.)ats$/', $message)) {
     return "💠 <b>Gates Auth</b> 💠\n"
               . "--------------------------------------\n"
               . "🔥 <b>Braintree Auth</b> ✔\n"
               . "└ 💻 <code>/chk</code>\n"
               . "⁕ <i>Status:</i> OFF!❌\n\n"
               . "🔥 <b>Braintree Auth (Wa)</b> ✔\n"
               . "└ 💻 <code>/tr</code>\n"
               . "⁕ <i>Status:</i> ON!✅\n\n"
	       . "🔥 <b>Stripe Auth</b> ✔\n"
               . "└ 💻 <code>/st</code>\n"
               . "⁕ <i>Status:</i> ON!✅\n\n"
               . "🔥 <b>Stripe 3D</b> ✔\n"
               . "└ 💻 <code>/ta</code>\n"
               . "⁕ <i>Status:</i> ON!✅\n\n"
               . "🔥 <b>Woo Stripe</b> ✔\n"
               . "└ 💻 <code>/wo</code>\n"
               . "⁕ <i>Status:</i> ON!✅\n\n"
               . "🔥 <b>Braintree CCN</b> ✔\n"
               . "└ 💻 <code>/ho</code>\n"
               . "⁕ <i>Status:</i> ON!✅\n\n"
               . "📩 <b>Contacto:</b> <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n"
               . "🤖 <b>Bot by:</b> <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";

   // sendMessage($chat_id, $respuesta, $message_id, "HTML");
}

	

if (preg_match('/^(!|\/|\.)me$/', $message)) {
    return "     [ ↯ ] ᴍʏ ᴀʙᴏᴜᴛ [ ↯ ]\n\n"
           . "‣ ᴜsᴇʀ ɪᴅ: <code>" . $id . "</code>\n"
           . "‣ ғᴜʟʟ ɴᴀᴍᴇ: " . $Name . " " . $last . "\n"
           . "‣ ᴜsᴇʀɴᴀᴍᴇ: @" . $user . "\n"
           . "‣ ᴜsᴇʀ ᴛʏᴘᴇ: " . $tipo . "\n";
}




if (preg_match('/^(!|\/|\.)bin/', $message)) {

$tr = explode(" ", $message);
$comando = ltrim($tr[0], "/.!");

if ($comando == "bin" && count($tr) > 1) {
    $numero = $tr[1];
    $primeros6 = substr($numero, 0, 6);
    if (strlen($primeros6) == 6 && ctype_digit($primeros6)) {
        $bin = $primeros6;
        // Código a ejecutar cuando se proporcione un número de 6 dígitos

    } else {
//        echo "Error: Debes proporcionar un número de 6 dígitos después del comando /bin";
	    $respuesta = "🚫 Oops!\nUse this format: /bin xxxxxx\n";
	    sendMessage($chatId, $respuesta, $message_id);
	    die();
    }
} else {
     $respuesta = "🚫 Oops!\nUse this format: /bin xxxxxx\n";
     sendMessage($chatId, $respuesta, $message_id);
     die();
    //echo "Error: Comando no válido o no se proporcionó un número de 6 dígitos";
}

//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chatId, $respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//
$startTime = microtime(true); //TIEMPO DE INICIO
//Extrae la información del bin///
$bin_info = Bininfo($bin);
$respuesta = "".$bin_info."—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n➭ 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n➭ 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦ 么◦✧——————\n";
editMessage($chatId, $respuesta, $id_text);
}
//----------------------END CHECK BIN-----------------------//



if (preg_match('/^(!|\/|\.)sk/', $message)) {
	$si = substr($message, 4);
	$key = substr($message, 4);

	if(preg_match_all("/sk_(test|live)_[A-Za-z0-9]+/", $key, $matches)) {
		$sk = $matches[0][0];
	}


	if ($si != '' && $sk != '' ){
		
	}else{
		$respuesta = "🚫 Oops!\nUse this format: /sk sk_live_xxxxxx\n";
		sendMessage($chatId,$respuesta,$message_id);
		die();
	}

//----------------MENSAGE DE ESPERA-------------------//
	$respuesta = "<b>🕒 Wait for Result...</b>";
	sendMessage($chatId,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
	$id_text = file_get_contents("ID");
//----------------------------------------------------//


// Bonus: SK Key Checker
$skhiden = substr_replace($sk, '',12).preg_replace("/(?!^).(?!$)/", "*", substr($sk, 12));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=5278540001668044&card[exp_month]=10&card[exp_year]=2027&card[cvc]=252");
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);

$message = trim(strip_tags(getStr($result,'"message":"','.')));
if (empty($message)) {
$message = 'Charge Found';
}

if (strpos($result, 'api_key_expired')){
$respuesta = "━━━━━━•⟮sᴋ ᴋᴇʏ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━\n➭ 𝙺𝙴𝚈: ".$skhiden."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: SK EXPIRED ❌\n➭ 𝙼𝙴𝚂𝚂𝙰𝙶𝙴: Expired API key Provided.\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chatId,$respuesta,$id_text);
}
elseif (strpos($result, 'Invalid API Key provided')){
$respuesta = "━━━━━━•⟮sᴋ ᴋᴇʏ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━\n➭ 𝙺𝙴𝚈: ".$skhiden."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: SK INVALID ❌\n➭ 𝙼𝙴𝚂𝚂𝙰𝙶𝙴: Invalid API Key Provided.\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chatId,$respuesta,$id_text);
}
elseif ((strpos($result, 'You did not provide an API key.')) || (strpos($result, 'You need to provide your API key in the Authorization header,'))){
$respuesta = "━━━━━━•⟮sᴋ ᴋᴇʏ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━\n➭ 𝙺𝙴𝚈: ".$skhiden."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: SK DEAD ❌\n➭ 𝙼𝙴𝚂𝚂𝙰𝙶𝙴: You did not provide an API key.\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chatId,$respuesta,$id_text);
}
elseif ((strpos($result, 'testmode_charges_only')) || (strpos($result, 'test_mode_live_card'))){
$respuesta = "━━━━━━•⟮sᴋ ᴋᴇʏ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━\n➭ 𝙺𝙴𝚈: ".$skhiden."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: SK DEAD ❌\n➭ 𝙼𝙴𝚂𝚂𝙰𝙶𝙴: Your account cannot currently make live charges.\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chatId,$respuesta,$id_text);
}else{
$respuesta = "━━━━━━•⟮sᴋ ᴋᴇʏ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━\n➭ 𝙺𝙴𝚈: ".$skhiden."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: SK LIVE ✅\n➭ 𝙼𝙴𝚂𝚂𝙰𝙶𝙴: ".$message.".\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chatId,$respuesta,$id_text);
}
}

	

	
if (preg_match('/^(!|\/|\.)gen/', $message)) {
$si = substr($message, 5);

if($si != ''){
}else{
//$respuesta = "━━━━━━━•⟮ɢᴇɴ ᴄᴄs⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /gen xxxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !gen xxxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .gen xxxxxxx\n";
return "🚫 Oops!\nUse this format: /gen xxxxxx\n";
//sendMessage($chatId,$respuesta,$message_id);
die();
}
//----------------MENSAGE DE ESPERA-------------------//
$response = "<b>🕒 Wait for Result...</b>";
sendMessage($chatId, $response, $message_id, "HTML");  // Enviar el mensaje

//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
//$id_text = $update['message']['message_id'];  // Guardamos el message_id
//file_put_contents("ID", $id_text);  

$id_text = file_get_contents("ID");
//----------------------------------------------------//
//sendMessage($chatId, $id_text, "HTML");  // Enviar el mensaje


$lista = substr($message, 5);
$target = substr($lista, 0,2);

$bin = explode("|", $lista)[0];
$mes1 = explode("|", $lista)[1];
$ano1 = explode("|", $lista)[2];
$cvv1 = explode("|", $lista)[3];
if (strlen($ano1) == 2) {
    $ano1 = '20' . $ano1;
}
$d4 = "".$bin."xxxxxxxxxxxxxxxxx";

if ($target == "37" || $target == "34"){
        $bin = substr($d4, 0, 14);
        $cant = "15";

}else{
        $bin = substr($d4, 0, 15);
        $cant = "16";
}
	
$Bin = substr($bin, 0, 6);
$amount = "10";

if (empty($mes1)){
$mes1="rnd";
}
if (empty($ano1)){
$ano1="rnd";
}
if (empty($cvv1)){
$cvv1="rnd";
}
sleep(1);


for ($i=$amount;$i>-0;$i--){

//-------GERADOR DE MES - AÑO - CCV -------//
        $randMonth = rand(1, 12);
        $randYears = rand(25, 30);
if ($target == "37" || $target == "34"){
        $randCvv = rand(1000, 9999);
}else{
        $randCvv = rand(100, 999);
}
        $randMonth < 10 ? $randMonth = "0" . $randMonth : $randMonth = $randMonth;
        $randCvv < 100 ? $randCvv = "0" . $randCvv : $randCvv = $randCvv;
        $fecha = "|".$randMonth."|20".$randYears."|".$randCvv;

//-----GENERADOR DE CC------//
if(is_numeric($mes1)){
$mes = $mes1;
}else{
$mes = $randMonth;
}
if(is_numeric($ano1)){
$ano = $ano1;
}else{
$ano = "20$randYears";
}
if(is_numeric($cvv1)){
$cvv = $cvv1;
}else{
$cvv = $randCvv;
}
$data = "|$mes|$ano|$cvv";
            $ccNumber = $bin;
            while (strlen($ccNumber) < ($cant - 1)) {
                $ccNumber .= rand(0, 9);
            }
            $ccNumber = str_split($ccNumber);
            $replace = "";
            foreach ($ccNumber as $cc => $key) {
            $replace .= str_replace("x", rand(0, 9), $key);
            }

$ccs = Calculate($replace, $cant);
$cards = $ccs.$data;
$data = "<code>".$cards."</code>";

$da = "".$data."\n";
        $archivo = fopen("cc-gen","a");
        fwrite($archivo,$da);
        fclose($archivo);
        }

        $ccs = file_get_contents("cc-gen");

$Bin_Gen = Bin_Gen_Info($Bin); //
$Bin = "<code>$Bin</code>";

// Recuperar el message_id desde el archivo donde lo guardamos
//$id_text = file_get_contents("ID");  // Recuperamos el message_id
// Aquí va tu código que genera el resultado (por ejemplo, el BIN y la cuenta generada)
$respuesta = "➭ 𝙱𝙸𝙽: $Bin\n➭ 𝙰𝙼𝙾𝚄𝙽𝚃: 10\n\n$ccs\n".$Bin_Gen."";
// Editar el mensaje de espera con el resultado final
editMessage($chatId, $respuesta, $id_text);  // Editar el mensaje con el resultado generado

unlink("cc-gen");
die();
}






	
/*
    function sendMessage($chatID, $respuesta, $message_id) {
    $url = $GLOBALS["website"]."/sendMessage?disable_web_page_preview=true&chat_id=".$chatID."&reply_to_message_id=".$message_id."&parse_mode=HTML&text=".urlencode($respuesta);
//$url = $GLOBALS["website"]."/sendMessage?disable_web_page_preview=true&chat_id=".$chatID."&parse_mode=HTML&text=".urlencode($respuesta);
    $cap_message_id = file_get_contents($url);
//------------EXTRAE EL ID DEL MENSAGE----------//
    $id_cap = capture($cap_message_id, '"message_id":', ',');
    file_put_contents("ID", $id_cap);
    }*/

	 return null; // Si el mensaje no es un comando válido, devuelve null
}
?>
