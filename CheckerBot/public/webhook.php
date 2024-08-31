<?php
//
error_reporting(0);
set_time_limit(0);
//error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');
//flush();

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache");

include("config.php");
include("CRH.php");
//------TOKEN DEL BOT MIKASA ACKERMAN--------//
//$token = "5405339405:AAG0kGkeN-8VueVsI2JCLQbHI3wYSnfoG7Y";

$website = "https://api.telegram.org/bot".$token;
$data = file_get_contents("php://input");
$json = json_decode($data, true);
$update = $json["message"];
//---------PERSONAL---------//
$id = $update["from"]["id"];
$name = $update["from"]["first_name"];
$last = $update["from"]["last_name"];
$message_id = $update["message_id"];
$message = $update["text"];
//----------GRUPOS----------//
$chat_id = $update["chat"]["id"];
$id_new = $update["new_chat_member"]["id"];
$grupo = $update["chat"]["title"];
$nuevo = $update["new_chat_member"]["first_name"]. ' '.$update["new_chat_member"]["last_name"];
//----------------------END VARIABLES----------------------//
$user = $update["from"]["username"];
//------------seguridad-------------//
// ID de tu usuario (para permitir mensajes personales solo para ti)
$myid = "1292171163"; // Reemplaza con tu ID de usuario


//4915110191768499-4915110176928790
//4915110176928790-4915110191768499
//-------------------FUNCIONES------------------//

$curlHandler = new CurlRequestHandler();
$i = $curlHandler->GenerateCorreo();


$nombres = array("Juan", "María", "Pedro", "Ana", "Carlos", "Luisa", "Jorge", "Sofía");
$nombre = $nombres[rand(0, count($nombres) - 1)];

$fn = array("@gmail.com", "@yahoo.com", "@hotmail.com", "@outlook.com", "@icloud.com", "@mail.com", "@aol.com");
$fin = $fn[rand(0, count($fn) - 1)];
$num = rand(1, 100);
$correo = "$nombre$num$fin";

function capture($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);
 return $str[0];
}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];
};

function array_in_string($str, array $arr) {
    foreach($arr as $arr_value) {
        if (stripos($str,$arr_value) !== false)
    return true;
    }
    return false;
}

function Calculate($ccnumber, $length)
    {
        $sum = 0;
        $pos = 0;
        $reversedCCnumber = strrev($ccnumber);

        while ($pos < $length - 1) {
            $odd = $reversedCCnumber[$pos] * 2;
            if ($odd > 9) {
                $odd -= 9;
            }
            $sum += $odd;

            if ($pos != ($length - 2)) {

                $sum += $reversedCCnumber[$pos + 1];
            }
            $pos += 2;
        }

     //   # Calculate check digit
        $checkdigit = ((floor($sum / 10) + 1) * 10 - $sum) % 10;
        $ccnumber .= $checkdigit;
        return $ccnumber;
    }


function BinData($bin){
$curl = curl_init('https://lookup.binlist.net/'.$bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);
//---------------------------------------------//
$bank = capture($result, '"bank": {"name": "', '"');
$emoji = capture($result, '"emoji":"', '"');
$alpha = strtoupper(capture($result, '"alpha2":"', '"'));
$scheme = strtoupper(capture($result, '"scheme":"', '"'));
$type = strtoupper(capture($result, '"type":"', '"'));
$currency = capture($result, '"currency":"', '"');
//---------------------------------------------//
if (empty($bank)) {
$bank = "Unavailable";
}
if (empty($emoji)) {
$emoji = "Unavailable";
}
if (empty($alpha)) {
$alpha = "Unavailable";
}
if (empty($scheme)) {
$scheme = "Unavailable";
}
if (empty($type)) {
$type = "Unavailable";
}
if (empty($currency)) {
$currency = "Unavailable";
}
$curl = curl_init('https://binlist.io/lookup/'.$bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($curl);
curl_close($curl);
$binna = json_decode($content,true);
//---------------------------------------------//
$level = $binna['category'];
$brand = $binna['scheme'];
$country = $binna['country']['name'];
$type = $binna['type'];
$bank = $binna['bank']['name'];
$count = "".$country." - ".$alpha." ".$emoji."";
if (empty($level)) {
$level = "Unavailable";
}
if (empty($brand)) {
$brand = "Unavailable";
}
if (empty($country)) {
$country = "Unavailable";
}
if (empty($type)) {
$type = "Unavailable";
}
if (empty($bank)) {
$bank = "Unavailable";
}
if (empty($currency)) {
$count = "Unavailable";
}
$in = "<code>".$bin."</code>";
$bindata = "━━━━━━━━•⟮ʙɪɴ ᴅᴀᴛᴀ⟯•━━━━━━━\n➭ 𝙱𝙸𝙽: ".$in."\n➭ 𝙱𝚁𝙰𝙽𝙳: ".$brand."\n➭ 𝚃𝚈𝙿𝙴: ".$type."\n➭ 𝙻𝙴𝚅𝙴𝙻: ".$level."\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: ".$count."\n➭ 𝙱𝙰𝙽𝙺: ".$bank."\n";
return $bindata;
}


//-----------------------VARIABLES-------------------------//

$live_array = array(
    'incorrect_cvc',
    'Your card zip code is incorrect.',
    'The zip code you supplied failed validation.',
    '"cvc_check":"pass"',
    'Thank You.',
    '"status": "succeeded"',
    'Thank You For Donation.',
    'Success',
    'SUCCEEDED',
    '"cvc_check": "fail"',
    '"cvc_check": "pass"',
    '"status": "succeeded"',
    'Your payment has already been processed',
    'Nice! New payment method added',
    'ApprovedApproved',
    'Approved',
    'insufficient_funds',
    'Your card has insufficient funds.',
    "Your card's security code is invalid.",
    "Your card's security code is incorrect.",
    "The card's security code is incorrect.",
    'transaction_not_allowed',
    'CVV INVALID',
    'incorrect_zip',
    'pickup_card',
    'lost_card',
    'stolen_card',
    '"seller_message": "Payment complete."'
);

$autorizados = array("1292171163");
$grupos_autorizados = array("-4274242125");

$admin = "<a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";


//-----DATOS DE PRUEBA LOCAL--------//
/*
$chat_id = "1292171163";
$id = "1292171163";

echo "TU CCS: ";
$data = trim(fgets(STDIN));
$message = "!".$data."";
*/
///----+------------------------



if ($myid == $id) {
  $tipo = "ᴀᴅᴍɪɴ";
} elseif (in_array($id, $autorizados)) {
  $tipo = "ᴘʀᴇᴍɪᴜᴍ ᴜsᴇʀ";
} else {
	$tipo = "ғʀᴇᴇ ᴜsᴇʀ";
}

/*
if ($tipo == "ᴘʀᴇᴍɪᴜᴍ ᴜsᴇʀ") {
// PERMITE QUE UN USUARIO PREMIUM ENVIE MENSAJES AL PV DEL BOT :V
}elseif($id == "1292171163"){
// PERMITE QUE EL DUEÑO ENVIE MENSAJES AL PV DEL BOT :V
}elseif($chat_id == '4274242125'){
// PERMITE QUE ENVIAR MENSAJES A UN GRUPO :v
            }else{
//------MENSAJE AL USUARIO------//
$contact = "<a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";
$respuesta = "━━━━━━━•⟮𝑁𝑎𝑧𝑢𝑛𝑎 𝑁𝑎𝑛𝑎𝑘𝑢𝑠𝑎⟯•━━━━━━━\nHola ".$name." este bot es premium y para poder acceder a el necesitas una key de autorización.\n\nAdquiérelo yaa!.\n\n".
'Telegram ➜ '.$contact.'';
sendMessage($id,$respuesta,$message_id);
//------MENSAJE PERSONAL-------//
$personal = "Hola Rigo Jimenez, ".$name." Intento Acceder a tu Bot";
sendMessage("1292171163",$personal);
die();
}
//}
*/


// Verificamos si el mensaje es personal o de grupo
if ($update["chat"]["type"] == "private") {
  if (in_array($update["from"]["id"], $autorizados)) {
    // Procesar mensaje
  } else {
    // Enviar mensaje de error
$contact = "<a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";
$respuesta = "━━━━━━━•⟮𝑁𝑎𝑧𝑢𝑛𝑎 𝑁𝑎𝑛𝑎𝑘𝑢𝑠𝑎⟯•━━━━━━━\nHola ".$name." este bot es premium y para poder acceder a el necesitas autorización.\n\nAdquiérelo yaa!.\n\n".
'Telegram ➜ '.$contact.'';
sendMessage($id,$respuesta,$message_id);
//------MENSAJE PERSONAL-------//
$personal = "Hola Rigo Jimenez, ".$name." Intento Acceder a tu Bot";
sendPv($myid, $personal);
die();

  }
} elseif ($update["chat"]["type"] == "group") {
  if (in_array($update["chat"]["id"], $grupos_autorizados)) {
    // Procesar mensaje
  } else {
    // Enviar mensaje de error
$contact = "<a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";
$respuesta = "━━━━━━━•⟮𝑁𝑎𝑧𝑢𝑛𝑎 𝑁𝑎𝑛𝑎𝑘𝑢𝑠𝑎⟯•━━━━━━━\nHola ".$name." este bot es premium y para poder acceder a el necesitas una key de autorización.\n\nAdquiérelo yaa!.\n\n".
'Telegram ➜ '.$contact.'';
sendMessage($id,$respuesta,$message_id);
//------MENSAJE PERSONAL-------//
$personal = "Hola Rigo Jimenez, ".$name." Intento Acceder a tu Bot";
sendPv($myid, $personal);
die();

  }
}


//-------EXTRAE EL SK_LIVE----//
$sk = $config['sk_keys'];
shuffle($sk);
$sec = $sk[0];



unlink("cookie.txt");



$date = time();
$fn = "Admins.json";
$fp = fopen($fn, 'r+');

/*
if($id == '1292171163'){

if((strpos($message, "!vip") === 0)||(strpos($message, "/vip") === 0)||(strpos($message, ".vip") === 0))
{

$ban = substr($message, 5);
//$ban = "8383838386";
if (is_numeric($ban) && ($ban != '')){
	// Lee el contenido actual del archivo
        $content = fread($fp, filesize($fn));
        $users = json_decode($content, true); // Decodifica el JSON

   $users[$ban] = array('user' => $ban, 'premium' => true);
   $ban = "<code>".$ban."</code>";
   $respuesta = "El usuario (".$ban.") ahora es premium!♕\n";
   sendMessage($chat_id,$respuesta,$message_id);

	  // Vuelve al inicio del archivo y guarda los cambios
        ftruncate($fp, 0); // Limpia el archivo
        rewind($fp); // Vuelve al inicio
	fwrite($fp, json_encode($users, JSON_PRETTY_PRINT)); // Escribe el nuevo contenido
	fclose($fp); // Cierra el archivo
	die();
}else{
$respuesta = "━━━━━━━•⟮ʙaɴ ɪɴғᴏ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /ban xxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !ban xxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .ban xxxxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();

}
}


if((strpos($message, "!free") === 0)||(strpos($message, "/free") === 0)||(strpos($message, ".free") === 0)){

//$unban = "838383838";
$unban = substr($message, 6);
if (is_numeric($unban) && ($unban != '')){

   $users[$unban] = array('user' => $unban, 'premium' => false);
   $unban = "<code>".$unban."</code>";
   $respuesta = "El usuario (".$unban.") a sido bloqueado de la versión premium!\n";
   sendMessage($chat_id,$respuesta,$message_id);
   $users = json_encode($users);
   file_put_contents($fn, $users);
   fclose($fp);
die();
}else{
$respuesta = "━━━━━━━•⟮ʙaɴ ɪɴғᴏ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /ban xxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !ban xxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .ban xxxxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}
}

}else{
$respuesta = "❌ (free: ($chat_id) ($id) Función no disponible para usuarios Free!\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}






$date = time();
$fn = "users.json";
$fp = fopen($fn, 'r+');
$users = file_get_contents($fn);
$users = json_decode($users, true);


if($id == '1292171163'){


if((strpos($message, "!ban") === 0)||(strpos($message, "/ban") === 0)||(strpos($message, ".ban") === 0))
{
$ban = substr($message, 5);
if (is_numeric($ban) && ($ban != '')){
   $users[$ban] = array('registered' => true, 'msgs' => 0, 'date' => 0, 'banned' => true);
   $ban = "<code>".$ban."</code>";
   $respuesta = "🔒 El usuario (".$ban.") a sido baneado\n";
   sendMessage($chat_id,$respuesta,$message_id);
   $users = json_encode($users);
   file_put_contents($fn, $users);
   fclose($fp);

}else{
$respuesta = "━━━━━━━•⟮ʙaɴ ɪɴғᴏ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /ban xxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !ban xxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .ban xxxxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}
}




if((strpos($message, "!unban") === 0)||(strpos($message, "/unban") === 0)||(strpos($message, ".unban") === 0)){

$unban = substr($message, 7);
if (is_numeric($unban) && ($unban != '')){

   $users[$unban] = array('registered' => true, 'msgs' => 0, 'date' => $date, 'banned' => false);
   $unban = "<code>".$unban."</code>";
   $respuesta = "🚫 El usuario (".$unban.") a sido desbaneado\n";
   sendMessage($chat_id,$respuesta,$message_id);
   $users = json_encode($users);
   file_put_contents($fn, $users);
   fclose($fp);
//die();
}else{
$respuesta = "━━━━━━━•⟮ʙɪɴ ɪɴғᴏ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /bin xxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !ban xxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .ban xxxxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}
}

}else{
$respuesta = "❌ Unban: $chat_id) ($id) Función no disponible para usuarios Free!\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}


if($users[$id]['registered'] != true){
        $users[$id] = array('registered' => true, 'msgs' => 0, 'date' => $date, 'banned' => false);
    $users = json_encode($users);
    file_put_contents($fn, $users);
    $users = json_decode($users, true);
}

if($users[$id]['banned'] == true){
$respuesta = "❌ Estas baneado!\n";
sendMessage($chat_id,$respuesta,$message_id);
    fclose($fp);
    exit();
}
*/

$users[$id]['msgs'] = $users[$id]['msgs'] + 1;
$users = json_encode($users);
file_put_contents($fn, $users);
$users = json_decode($users, true);

if($date <= $users[$id]['date'] + 30 and $users[$id]['msgs'] >= 3){
$respuesta = "[ANTI SPAM] Try again after 30s\n";
//echo "$respuesta";
sendMessage($chat_id,$respuesta,$message_id);
    exit();
}
if($date > $users[$id]['date'] + 30){
        $users[$id]['date'] = $date;
    $users[$id]['msgs'] = 0;
    $users = json_encode($users);
        file_put_contents($fn, $users);
    $users = json_decode($users, true);
}

//echo "Puedes enviar mensajes\n";
//sendMessage($id, "Ciao!");
fclose($fp);


















//-----BIENVENIDA NUEVO INTEGRANTE------//
if(trim($nuevo) != '')
{
$respuesta = "━━━━━━━━━━ × ━━━━━━━━━━\n⁕ Nazuna Nanakusa 『ﾑ』⁕\n\n     ⚠️ 𝙱𝙸𝙴𝙽𝚅𝙴𝙽𝙸𝙳𝙾 ⚠️\n\n➭ 𝚄𝚂𝙴𝚁 𝙸𝙳: ".$id_new."  ✔\n➭ 𝙽𝙾𝙼𝙱𝚁𝙴: ".$nuevo."  ✔\n➭ 𝚄𝚂𝚄𝙰𝚁𝙸𝙾: ".$user."  ✔\n\n凸-.-凸 ".$grupo." 凸-.-凸\n━━━━━━━━━━ × ━━━━━━━━━━\n";
sendMessageNew($chat_id,$respuesta);
}

// Start Commands
//if((strpos($message, "!start") === 0)||(strpos($message, "/start") === 0)||(strpos($message, ".start") === 0)) {
if (strpos($message, ".start") === 0 || strpos($message, "!start") === 0 || strpos($message, "/start") === 0) {
$respuesta = "─ Checker Panel ─\n\n⁕ Registered as ➞ ".$admin."\n⁕ Use ➞ ".$update["chat"]["type"]." | ".$message1["chat"]["type"]." /cmds to show available commands.\n⁕ Bot by: $admin\n";
sendMessage($chat_id,$respuesta,$message_id);
}
// Cmds Commands
elseif((strpos($message, "!cmds") === 0)||(strpos($message, "/cmds") === 0)||(strpos($message, ".cmds") === 0))
{
$respuesta = "━━━━•⟮ ᴄʜᴇᴄᴋᴇʀ ᴄᴏᴍᴍᴀɴᴅs ⟯•━━━━\n\n➩ Check User Info ✔\n⁕ Usage: /me\n➩ Check ID chat ✔\n⁕ Usage: /id\n\n◤━━━━━ ☆. 𝙶𝙰𝚃𝙴𝚂 .☆ ━━━━━◥\n\n🔥 Stripe Auth ✔\n➣ Checker ➟ !stp\n⁕ Usage: !stp ccs|month|year|cvv\n\n🔥 Stripe Auth 0.5$ ✔\n➣ Checker ➟ !ch\n⁕ Usage: !ch ccs|month|year|cvv\n\n🔥 Stripe Auth 1$ ✔\n➣ Checker ➟ !ck\n⁕ Usage: !chk ccs|month|year|cvv\n\n🔥 Charged 1$ ✔\n➣ Checker ➟ !stc\n⁕ Usage: !stc ccs|month|year|cvv\n\n🔥 Merchant ✔\n➣ Checker ➟ !stm\n⁕ Usage: !stm ccs|month|year|cvv\n\n🔥 Charged Refunded ✔\n➣ Checker ➟ !str\n⁕ Usage: !str ccs|month|year|cvv\n\n◤━━━━━ ☆. 𝙴𝚇𝚃𝚁𝙰𝚂 .☆ ━━━━━◥\n\n⌦ Bin Check ➟ !bin ✔\n⁕ Usage: !bin xxxxxx\n⌦ Checker IBAN ➟ !iban ✔\n⁕ Usage: !iban xxxxxx\n⌦ SK Key Check ➟ !ks ✔\n⁕ Usage: !ks ks_live_xxxx\n⌦ GEN ➟ !gen ✔\n⁕ Usage: !gen xxxxxx\n\n◤━━ ☆. 𝙴𝚇𝚃𝚁𝙰𝙿𝙾𝙻𝙰𝙲𝙸𝙾𝙽 .☆ ━━◥\n\n° ᭄ Basica ➟ /extb ✔\n⁕ Usage: !extb ᴄᴄs1\n° ᭄ Similitud ➟ /exts ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n° ᭄ Avanzada ➟ /exta ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n° ᭄ Indentacion ➟ /exti ✔\n⁕ Usage: !extb ᴄᴄs1\n ᭄ Sophia ➟ /extm ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
sendMessage($chat_id,$respuesta,$message_id);
}

elseif((strpos($message, "!me") === 0)||(strpos($message, "/me") === 0)||(strpos($message, ".me") === 0))
{
$respuesta = "⁕ ─ 𝑈𝑆𝐸𝑅 𝐼𝑁𝐹𝑂 ─ ⁕\n➩ 𝚄𝚂𝙴𝚁 𝙸𝙳: <code>".$id."</code>\n➩ 𝙵𝚄𝙻𝙻 𝙽𝙰𝙼𝙴: ".$name." ".$last."\n➩ 𝚄𝚂𝙴𝚁𝙽𝙰𝙼𝙴: @".$user."\n➩ 𝚄𝚂𝙴𝚁 𝚃𝚈𝙿𝙴: ".$tipo."\n";
sendMessage($chat_id,$respuesta,$message_id);
}
/*
//--------------------------END INFO-------------------------//
elseif((strpos($message, "!info") === 0)||(strpos($message, "/info") === 0)||(strpos($message, ".id") === 0))
{
$respuesta = "➩ Chat ID: $chat_id";
echo "$respuesta";
sendMessage($chat_id,$respuesta,$message_id);
}
*/

//--------------------------END ID--------------------------//


elseif((strpos($message, "!gen") === 0)||(strpos($message, "/gen") === 0)||(strpos($message, ".gen") === 0)){
$si = substr($message, 5);

if($si != ''){
}else{
$respuesta = "━━━━━━━•⟮ɢᴇɴ ᴄᴄs⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /gen xxxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !gen xxxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .gen xxxxxxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}
//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


$lista = substr($message, 5);
$bin = explode("|", $lista)[0];
$mes1 = explode("|", $lista)[1];
$ano1 = explode("|", $lista)[2];
$cvv1 = explode("|", $lista)[3];
$d4 = "".$bin."xxxxxxxxxxxxxxxxx";
$bin = substr($d4, 0, 15);
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
        $randYears = rand(23, 29);
        $randCvv = rand(100, 999);
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
            while (strlen($ccNumber) < (16 - 1)) {
                $ccNumber .= rand(0, 9);
            }
            $ccNumber = str_split($ccNumber);
            $replace = "";
            foreach ($ccNumber as $cc => $key) {
            $replace .= str_replace("x", rand(0, 9), $key);
            }

$ccs = Calculate($replace, 16);
$cards = $ccs.$data;
$data = "<code>".$cards."</code>";

$da = "".$data."\n";
        $archivo = fopen("cc-gen","a");
        fwrite($archivo,$da);
        fclose($archivo);
        }

        $ccs = file_get_contents("cc-gen");
$curl = curl_init('https://lookup.binlist.net/'.$Bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);
//---------------------------------------------//
$bank = capture($result, '"bank": {"name": "', '"');
$emoji = capture($result, '"emoji":"', '"');
$alpha = strtoupper(capture($result, '"alpha2":"', '"'));
$scheme = strtoupper(capture($result, '"scheme":"', '"'));
$type = strtoupper(capture($result, '"type":"', '"'));
$currency = capture($result, '"currency":"', '"');
//---------------------------------------------//
if (empty($bank)) {
$bank = "Unavailable";
}
if (empty($emoji)) {
$emoji = "Unavailable";
}
if (empty($alpha)) {
$alpha = "Unavailable";
}
if (empty($scheme)) {
$scheme = "Unavailable";
}
if (empty($type)) {
$type = "Unavailable";
}
if (empty($currency)) {
$currency = "Unavailable";
}
$curl = curl_init('https://binlist.io/lookup/'.$Bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($curl);
curl_close($curl);
$binna = json_decode($content,true);
//---------------------------------------------//
$level = $binna['category'];
$brand = $binna['scheme'];
$country = $binna['country']['name'];
$type = $binna['type'];
$bank = $binna['bank']['name'];
$count = "".$country." - ".$alpha." ".$emoji."";
if (empty($level)) {
$level = "Unavailable";
}
if (empty($brand)) {
$brand = "Unavailable";
}
if (empty($country)) {
$country = "Unavaila
