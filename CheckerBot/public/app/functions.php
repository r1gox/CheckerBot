<?php

// Definir la URL base del bot de Telegram
$GLOBALS["website"] = "https://api.telegram.org/bot" . $token;

/**
 * Envía un mensaje a un chat de Telegram
 *
 * @param int|string $chatID ID del chat de Telegram
 * @param string $respuesta Mensaje a enviar
 * @param int|null $message_id ID del mensaje al que responder (opcional)
 */
$admin = "<a href='t.me/rigo_jz'>ʀɪɢᴏ ᴊɪᴍᴇɴᴇᴢ</a>";
$logo = "<a href='http://t.me/XNazunaBot'>[↯]</a>";

function capture($string, $start, $end) {
    $str = explode($start, $string);
    if (isset($str[1])) {
        $str = explode($end, $str[1]);
        return trim($str[0]);
    }
    return false;
}

function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];
}

function array_in_string($string, $array) {
    foreach ($array as $item) {
        if (strpos($string, $item) !== false) {
            return true;
        }
    }
    return false;
}


///Verifica las repeticiones de una cc///
$archivo_contadores = "contadores.txt";
function handleComando($dato) {
  global $archivo_contadores;
  if (file_exists($archivo_contadores)) {
    $contadores = @unserialize(file_get_contents($archivo_contadores));
    if ($contadores === false) {
      $contadores = array();
    }
  } else {
    $contadores = array();
  }

  if (isset($contadores[$dato])) {
    $contadores[$dato]++;
  } else {
    $contadores[$dato] = 1;
  }

  if (@file_put_contents($archivo_contadores, serialize($contadores)) === false) {
    return "Error!";
  }
  return $contadores[$dato];
}


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
    'Your contribution has been submitted to Credit Card for processing',
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




function sendMessage($chatId, $respuesta, $message_id = null) {
    $url = $GLOBALS["website"] . "/sendMessage?disable_web_page_preview=true&chat_id=" . $chatId . "&parse_mode=HTML&text=" . urlencode($respuesta);

    // Agregar el mensaje de respuesta si se proporciona un message_id
    if ($message_id) {
        $url .= "&reply_to_message_id=" . $message_id;
    }

    // Enviar la solicitud y capturar la respuesta
    $cap_message_id = file_get_contents($url);

    // Extraer el ID del mensaje enviado
    if ($cap_message_id) {
        $id_cap = capture($cap_message_id, '"message_id":', ',');
        file_put_contents("ID", $id_cap);
    }
}


function editMessage($chatId, $respuesta, $id_text){
$url = $GLOBALS["website"]."/editMessageText?disable_web_page_preview=true&chat_id=".$chatId."&message_id=".$id_text."&parse_mode=HTML&text=".urlencode($respuesta);
file_get_contents($url);
}

/**
 * Extrae una cadena entre dos delimitadores
 *
 * @param string $string Texto de entrada
 * @param string $start Delimitador de inicio
 * @param string $end Delimitador de fin
 * @return string|false Devuelve la cadena capturada o false si no se encuentra
 */

?>
