<?php

$botToken = "6685591801:AAFFyqPoXJFH50rew1DvlmREoQw4NX-Ix9Y";  //bot token
$website = "https://api.telegram.org/bot".$botToken;
error_reporting(0);
$update = json_decode(file_get_contents('php://input'), true);
$print = print_r($update);
$chatId = $update["message"]["chat"]["id"];
$gId = $update["message"]["from"]["id"];
$userId = $update["message"]["from"]["id"];
$firstname = $update["message"]["from"]["first_name"];
$lastname = $update["message"]["from"]["last_name"];
$username = $update["message"]["from"]["username"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];





////=================[ GLOBAL VARIABLES ]=================////
$owner = "@raven_ccs";
$channel = "@raven_ccs";
$chat = "@raven_ccs";








////=================[ AUTHORISATION ]=================////

$prv_unauth_msg = urlencode ("<b>Hello there!! <a href='tg://user?id=$userId'>$firstname</a>\nUserId: <code>$userId</code> \n\nSorry, But You are not allowed to use this Bot! \nContact @raven_ccs to get Access..!!</b>\n");

$vip_unauth_msg = urlencode ("<b>Hello there!! <a href='tg://user?id=$userId'>$firstname</a>\nUserId: <code>$userId</code> \n\nSorry, But You are not a VIP user! \nYou Need to be VIP to use this gates.!</b>\n");

$premium_unauth_msg = urlencode ("<b>Hello there!! <a href='tg://user?id=$userId'>$firstname</a>\nUserId: <code>$userId</code> \n\nSorry, But You are not a Premium user! \nYou Need to be Premium to use this gates.!</b>\n");

$spam_unauth_msg = urlencode ("<b>Hello there!! <a href='tg://user?id=$userId'>$firstname</a>\nUserId: <code>$userId</code> \n\nSorry, But You are trying to access UnAuthorise Content! \nThis will leads to Spam and you may got baned.!</b>\n");

//$unk_msg = urlencode ("<b>Hello there!! <a href='tg://user?id=$userId'>$firstname</a>\nUserId: <code>$userId</code>\n Responce:</b> Unknown Command or Command not Found!! <b>\n\nMultipal requests will leads to Spam and you may got baned automaticly.!</b>\n");



////==================[ ALLOW USERS ]==================////

$prv_users = file_get_contents('Others/Users/private.txt');
$prv_users = explode("\n", $prv_users);                  //Alowed Users.

$vip_users = file_get_contents('Others/Users/vip.txt');
$vip_users = explode("\n", $vip_users);                  //VIP Users.

$premium_users = file_get_contents('Others/Users/prim.txt');
$premium_users = explode("\n", $premium_users);          //Premium Users.

$ban_users = file_get_contents('Others/Users/ban.txt');
$ban_users = explode("\n", $ban_users);                  //Ban Users.








////=================[ GLOBAL COMMANDS ]=================////

//===============[ Start CMDS ]===============//
if (strpos($message, "/start") === 0){
  $respo = urlencode ("<b>Hello there!! @$username \nUserId: <code>$userId</code>\n
Type /cmds to know all my commands!!</b>\n\n\n<i>Please Contact @raven_ccs To get free access to the Bot.</i>\n\n<b>Bot Made by:</b><a> [raven_ccs]</a>");
  
// User data to store or update
  $userData = [
      'user_id' => $userId, 
      'username' => $username,  
      'first_name' => $firstname, 
      'last_name' => $lastname, 
  ];

  $filePath = 'Others/Users/allusers.txt';
  $storedUserData = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  
  $updatedUserData = [];
  foreach ($storedUserData as $line) {
      $user = json_decode($line, true);
      if ($user) {
          if ($user['user_id'] === $userData['user_id']) {
              $updatedUserData[] = json_encode($userData); }
          else { $updatedUserData[] = json_encode($user); }
      }  }

  if (!in_array(json_encode($userData), $updatedUserData)) {
      $updatedUserData[] = json_encode($userData); }
  file_put_contents($filePath, implode(PHP_EOL, $updatedUserData));

  sendMessage($chatId, $respo , $message_id);
  return;
}


////===============[ INFO COMMAND ]===============////
elseif (strpos($message, "/info") === 0){
  $respo = urlencode ("<b>✦ User Name:</b> @$username <b>
✦ User ID:</b> <code>".$userId."</code> <b>
✦ Chat ID:</b> <code>".$chatId."</code> <b>
✦ User:</b> <a href='tg://user?id=$userId'>$firstname</a> <b>
✦ Status:</b> <i>Free User</i> \n
═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
  sendMessage($chatId, $respo , $message_id);
  return;
}

  
////===============[ CMDS List ]===============////
elseif (strpos($message, "/cmds") === 0){
  $respo = urlencode ("<b>ALL COMMANDS LIST :     ✅</b>\n<b>
 ✦<i> Auth Gates      </i>- </b>           <i>/auth</i><b>\n
 ✦<i> Charge Gates  </i>- </b>           <i>/charge</i><b>\n
 ✦<i> CCN Charge     </i>- </b>           <i>/ccn</i><b>\n
 ✦<i> Special Gates  </i>- </b>           <i>/special</i><b>\n
 ✦<i> Tools                </i>- </b>           <i>/tools</i><b>\n
 ✦<i> User Info          </i>- </b>           <i>/info</i><b>\n
 ✦<i> Admin Area     </i>- </b>           <i>/admin</i>\n
\n═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
   sendMessage($chatId, $respo , $message_id); 
  return;
}


elseif (strpos($message, "/auth") === 0){
  $respo = urlencode ("<b>AUTH GATES :     ✅</b>\n<b>
 ✦<i> Stripe Auth 1 </i></b>                 
  <code> ↳ ON ♻️ | [FREE] -</code>        <i>/sa</i>\n <b>
 ✦<i> Stripe Auth 2 </i></b>                
  <code> ↳ OFF ⚠️ | [FREE] -</code>      <i>/ss</i>\n <b>
 ✦<i> Braintree Auth </i></b>             
  <code> ↳ OFF ⚠️ | [FREE] -</code>        <i>/ba</i>\n <b>
 ✦<i> Unknown Auth </i></b>            
  <code> ↳ OFF ⚠️ | [VIP] -</code>        <i>/ua</i>\n 
  \n═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
   sendMessage($chatId, $respo , $message_id); return; }


elseif (strpos($message, "/ccn") === 0){
  $respo = urlencode ("<b>CCN CHARGE GATES :     ✅</b>\n<b>
 ✦<i> Stripe CCN </i></b>                 
  <code> ↳ OFF ⚠️ | [FREE] -</code>        <i>/scn</i>\n <b>
 ✦<i> Braintree CCN </i></b>             
  <code> ↳ OFF ♻️ | [FREE] -</code>        <i>/bcn</i>\n <b>
 ✦<i> Unknown CCN </i></b>            
  <code> ↳ OFF⚠️  | [VIP]  -</code>        <i>/cnc</i>\n 
    \n═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
     sendMessage($chatId, $respo , $message_id); return; }


  
elseif (strpos($message, "/charge") === 0){
  $respo = urlencode ("<b>CHARGE GATES :     ✅</b>\n<b>
 ✦<i> Stripe Charge </i></b>                 
  <code> ↳ OFF ⚠️ | [FREE] -</code>        <i>/sc</i>\n <b>
 ✦<i> Stripe Inline </i></b>                
  <code> ↳ OFF ⚠️ | [VIP] -</code>        <i>/si</i>\n <b>
 ✦<i> Freemus Charge</i></b>             
  <code> ↳ OFF ⚠️ | [FREE] -</code>        <i>/fr</i>\n <b>
 ✦<i> Braintree Charge </i></b>             
  <code> ↳ OFF ⚠️ | [FREE]-</code>        <i>/b3</i>\n <b>
 ✦<i> B3 Auth+Charge </i></b>             
  <code> ↳ OFF ⚠️ | [PRIM] -</code>        <i>/bc</i>\n <b>
 ✦<i> Recurly Charge </i></b>             
  <code> ↳ OFF ⚠️ | [FREE] -</code>        <i>/rcc</i>\n <b>
 ✦<i> Recurly Low  [$0.82]</i></b>             
  <code> ↳OFF ⚠️ | [PRIM] -</code>        <i>/rcl</i>\n <b>
 ✦<i> Authorise Net </i></b>             
  <code> ↳ ON ♻️ | [FREE] -</code>        <i>/an2</i>\n <b>
 ✦<i> CyberSource </i></b>             
  <code> ↳ OFF ⚠️ | [VIP] -</code>        <i>/cy</i>\n <b>
 ✦<i> USA E-Pay </i></b>             
  <code> ↳ OFF ⚠️ | [PRIM] -</code>        <i>/epay</i>\n <b>
 ✦<i> PayPal Guest </i></b>             
  <code> ↳ ON ♻️ | [VIP]  -</code>        <i>/pp</i>\n <b>
 ✦<i> Unknown Charge </i></b>            
  <code> ↳ OFF ⚠️ | [PRIM] -</code>        <i>/unk</i>\n 
  \n═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
   sendMessage($chatId, $respo , $message_id); return; }


elseif (strpos($message, "/special") === 0){
  $respo = urlencode ("<b>SPECIAL GATES :     ✅</b>\n<b>
 ✦<i> CVV LookUp </i></b>                 
  <code> ↳ ON ♻️ | [PRIM] -</code>        <i>/cvv</i>\n <b>
 ✦<i> AVS LookUp </i></b>                
  <code> ↳ ON ♻️ | [PRIM] -</code>        <i>/avs</i>\n <b>
 ✦<i> VBV LookUp </i></b>             
  <code> ↳ OFF ⚠️ | [PRIM] -</code>        <i>/vbv</i>\n <b>
 ✦<i> CVV AVS LookUp </i></b>             
  <code> ↳ ON ♻️ | [PRIM] -</code>        <i>/acc</i>\n <b>
 ✦<i> All In One LookUp </i></b>             
  <code> ↳ ON ♻️ | [PRIM] -</code>        <i>/ccc</i>\n <b>
 ✦<i> Private Gate </i></b>            
  <code> ↳ OFF ⚠️ | [PRIM]-</code>        <i>/private</i>\n 
  \n═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
   sendMessage($chatId, $respo , $message_id); return; }


elseif (strpos($message, "/tools") === 0){
  $respo = urlencode ("<b>All TOOLS :     ✅</b>\n<b>
 ✦<i> Bin LookUp </i></b>                 
  <code> ↳ ON ♻️ | [FREE] -</code>        <i>/bin</i>\n <b>
 ✦<i> SK Key </i></b>                
  <code> ↳ ON ♻️ | [VIP]  -</code>        <i>/sk</i>\n <b>
 ✦<i> CC Generate </i></b>             
  <code> ↳ OFF ⚠️ | [FREE]-</code>        <i>/gen</i>\n <b>
 ✦<i> Stripe Merchant </i></b>             
  <code> ↳ ON ♻️ | [FREE] -</code>        <i>/sm</i>\n <b>
 ✦<i> 3D LookUp </i></b>             
  <code> ↳ ON ♻️ | [FREE] -</code>        <i>/3d</i>\n <b>
 ✦<i> Mobile TopUp </i></b>            
  <code> ↳ OFF ⚠️ | [PRIM]-</code>        <i>/topup</i>\n 
  \n═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
   sendMessage($chatId, $respo , $message_id); return; }



/*
if (in_array($userId, $prv_users) === false){
  sendMessage($chatId, $prv_unauth_msg, $message_id);
return; 
}
*/

////=================[ INCLUDE GATES ]=================////

#-------[ FUNCTIONS ]--------#
include "./Tools/functions/flagsgen.php";            //NA

#-------[ AUTH GATES ]-------#
include "./Gates/Auth/Stripe_auth.php";            //sa
include "./Gates/Auth/Stripe_auth2.php";           //sa2
//include "./Gates/Auth/B3_auth.php";                //au
//include "./Gates/Auth/Recurly_auth.php";		       //ra

#-------[ CCN GATES ]--------#
include "./Gates/CCN/Stripe_ccn.php";	             //ccn
//include "./Gates/CCN/B3_ccn.php";		               //bcn
include "./Gates/CCN/Unk_ccn.php";		             //cnc

#-------[ CHARGE GATES ]-------#
include "./Gates/Charge/Stripe_inline.php";	        //si
//include "./Gates/Charge/Stripe_charge.php";	        //sc
include "./Gates/Charge/b3_auth_charge.php";        //bc
include "./Gates/Charge/Recurly.php";		            //rcc
include "./Gates/Charge/Recurly_low.php";           //rcl
//include "./Gates/Charge/Freemus.php";		            //fr
include "./Gates/Charge/Authnet_1req.php";		      //anc
include "./Gates/Charge/Authnet_3req.php";		      //an2
include "./Gates/Charge/CyberSchage.php";		        //cyb
//include "./Gates/Charge/Squareup.php";              //sq
include "./Gates/Charge/Epay_4req.php";             //epay
include "./Gates/Charge/Paypal_comm.php";  	        //pp
include "./Gates/Charge/Unknown4Req.php";		        //unk (Bad respo)

#-------[ SPECIAL GATES ]------#
include "./Gates/Special/tracepay.php";             //prv
include "./Gates/Special/cvv_lookup.php";           //cvv
include "./Gates/Special/avs_lookup.php";           //avs
include "./Gates/Special/vbv_lookup.php";           //vbv
include "./Gates/Special/cvv_avs_lookup.php";       //acc
//include "./Gates/Special/cvv_avs_vbv_lookup.php";   //ccc

#-------[ USEFULL TOOLS ]------#
include "./Tools/Admin.php";                        //admin
include "./Tools/Antispam.php";                     //spam 
include "./Tools/bin_lookup.php";                   //bin 
include "./Tools/bin_lookup2.php";                  //cbin
include "./Tools/sk_check.php";                     //sk
include "./Tools/ccgen.php";                        //ccgen
include "./Tools/vbv_lookup2.php";                  //3d
//include "./Tools/vbv_lookup3.php";                  //msc
include "./Tools/Stripe_merchant.php";              //sm









////=================[ GLOBAL FUNCTIONS ]=================////

//================ [ Bot Methods ] ===============//
function sendMessage ($chatId, $message, $message_id){
$url = $GLOBALS['website']."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML";
  file_get_contents($url); }

function sendMsg ($chatId, $message){
$url = $GLOBALS['website']."/sendMessage?chat_id=".$chatId."&text=".$message."&parse_mode=HTML";
  file_get_contents($url); }

function reply($chatId, $message, $message_id) {
$url = $GLOBALS['website']."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML";
  return file_get_contents($url); }

function editMessage($chatId, $message, $message_id) {
  $url = $GLOBALS['website']."/editMessageText?chat_id=".$chatId."&text=".$message."&message_id=".$message_id."&parse_mode=HTML";
  file_get_contents($url); }

function deleteM ($chatId,$message_id) {
$url = $GLOBALS['website']."/deleteMessage?chat_id=".$chatId."&message_id=".$message_id."";
  file_get_contents($url); 
}

function sendaction ($chatId, $action) {
$url = $GLOBALS['website']."/sendchataction?chat_id=".$chatId."&action=".$action."";
  file_get_contents($url); 
}



//================ [ Explode Function ] ===============//
function GetStr($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return trim(strip_tags(substr($string, $ini, $len)));
}

function multiexplode($seperator, $string){
    $one = str_replace($seperator, $seperator[0], $string);
    $two = explode($seperator[0], $one);
    return $two;
};



//================ [ SID & GUID GEN ] ===============//
/*
function SID(){
    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
};*/

function GUID(){
  if (function_exists('com_create_guid') === true){
    return trim(com_create_guid(), '{}');}
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)); }

function MUID(){
if (function_exists('com_create_muid') === true){
  return trim(com_create_muid(), '{}');  }
  return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)); }

function SID(){
if (function_exists('com_create_sid') === true){
  return trim(com_create_sid(), '{}'); }
  return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)); }



//================ [ Save Data ] ===============//
function charged($lista){
    $user = file_get_contents('Other/data/charged.txt');
    $members = explode("\n", $user);
    if (!in_array($lista, $members)) {
        $add_user = file_get_contents('Other/data/charged.txt');
        $add_user .= $lista . "\n";
        file_put_contents('Other/data/charged.txt', $add_user);  }
}

function cvv($lista){
    $user = file_get_contents('Other/data/cvv.txt');
    $members = explode("\n", $user);
    if (!in_array($lista, $members)) {
        $add_user = file_get_contents('Other/data/cvv.txt');
        $add_user .= $lista . "\n";
        file_put_contents('Other/data/cvv.txt', $add_user);  }
}

function ccn($lista){
    $user = file_get_contents('Other/data/ccn.txt');
    $members = explode("\n", $user);
    if (!in_array($lista, $members)) {
        $add_user = file_get_contents('Other/data/ccn.txt');
        $add_user .= $lista . "\n";
        file_put_contents('Other/data/ccn.txt', $add_user);  }
}

function rest($lista){
    $user = file_get_contents('Other/data/rest.txt');
    $members = explode("\n", $user);
    if (!in_array($lista, $members)) {
        $add_user = file_get_contents('Other/data/rest.txt');
        $add_user .= $lista . "\n";
        file_put_contents('Other/data/rest.txt', $add_user);  }
}


//=============== [ Get Data ] ==============//
function getUserDataByUserId($userId) {
$filePath = 'Others/Users/allusers.txt';
$storedUserData = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($storedUserData as $line) {
    $user = json_decode($line, true);
    if ($user && $user['user_id'] === $userId) { return $user; }  
    }
return null; }


//================ [ ANTI SPAM ] ===============//
function checkAntispam($userId, $limit) {
$rateLimitData = json_decode(file_get_contents("Others/Users/rate_limit.json"), true);

  if (!isset($rateLimitData[$userId])) {
    $rateLimitData[$userId] = time(); } 
    else {
      $lastMessageTime = $rateLimitData[$userId];
      $remainingTime = time() - $lastMessageTime;
      $timeleft = $limit-$remainingTime;

    if ($remainingTime < $limit) { return [true, $timeleft]; } 
      $rateLimitData[$userId] = time(); }

file_put_contents("Others/Users/rate_limit.json", json_encode($rateLimitData));
return [false, 0]; 
}








////////===========[ Checker Mead By @Avin_Knigh ]===========////////

?>