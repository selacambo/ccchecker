<?php

#----------------------------------------------------------------------#
#   CODED BY: Avin-Knight                                              #
#   GATE: B3 3D LOOKUP (AMOUNT = $4)                                   #
#   SITE: https://www.ivpn.net/account/                                #
#----------------------------------------------------------------------#
$gate = "ANTI SPAM";


if ((strpos($message, "/spam") === 0) || (strpos($message, "!spam") === 0)){

list($spam, $timeleft) = checkAntispam($userId, 10);
if ($spam) {
  $respo = urlencode ("<b>ANTI SPAM </b>❌\n<a>Try after $timeleft seconds</a>\n");
  sendMessage($chatId, $respo , $message_id);
  exit();
} 


error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set('America/Buenos_Aires');


if ($_SERVER['REQUEST_METHOD'] == "POST")   { extract($_POST); }
elseif ($_SERVER['REQUEST_METHOD'] == "GET") { extract($_GET); }

  

  
////============[MAIN CODE]============////
  
$lista = substr($message, 4);  
$lista = preg_replace('/[^0-9]+/', ' ', $lista);
$lista = ltrim($lista);

  
/*
$rateLimit = 10;
$rateLimitData = json_decode(file_get_contents("Others/Users/rate_limit.json"), true);

  if (isset($rateLimitData[$userId])) {
      $lastMessageTime = $rateLimitData[$userId];
      $remainingTime = time() - $lastMessageTime;
      $timeleft = $rateLimit-$remainingTime;
    
      if ($remainingTime < $rateLimit) {
          $respo = urlencode ("<b>Hello there!! @$username \nUserId: <code>$userId</code>\n</b>\n<i>User sent messages too quickly. Time remaining: $timeleft seconds</i>\n\n<b>Bot Made by: @AvinK_night</b>");
          sendMessage($chatId, $respo , $message_id);
          return; } 
      $rateLimitData[$userId] = time();
    }
  else { $rateLimitData[$userId] = time(); }

  file_put_contents("Others/Users/rate_limit.json", json_encode($rateLimitData));

  $respo = urlencode ("<b>Hello there!! @$username \nUserId: <code>$userId</code>\n</b>\n<i>You are here, Pass the Anti-Spam.</i>\n\n<b>Bot Made by: @AvinK night</b>");
  sendMessage($chatId, $respo , $message_id);




error_log("Current Time: ".time()." ");
error_log("Last Message Time: $lastMessageTime");
error_log("Remaining Time: $remainingTime");
*/
  
}



?>