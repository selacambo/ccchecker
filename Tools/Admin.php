<?php

#----------------------------------------------------------------------#
#   CODED BY: Avin-Knight                                              #
#   GATE: ADMIN PANAL                                                  #
#   SITE: AvinChk                                                      #
#----------------------------------------------------------------------#


////=================[ OWNERS COMMAND AREA ]=================////

//================[ CHECK CMDS ]================//
if ((strpos($message, "/admin") === 0) || (strpos($message, "!admin") === 0)){

  if (($userId == "2132400150") === false){
    sendMessage($chatId , $spam_unauth_msg , $message_id); return; }

    $respo = urlencode ("<b>ADMIN COMMANDS LIST :   ✅</b>\n<b>
✦ Check Users List -</b>             <i>/users</i><b>\n
✦ Ban Any User -</b>                   <i>/ban</i><b>\n
✦ UnBan Any User -</b>              <i>/unban</i><b>\n
✦ Add Private User -</b>             <i>/adduser</i><b>\n
✦ Add Vip User -</b>                    <i>/addvip</i><b>\n
✦ Add Premium User -</b>         <i>/addprim</i><b>\n
✦ Remove Private User -</b>     <i>/deluser</i><b>\n
✦ Remove Vip User -</b>            <i>/delvip</i><b>\n
✦ Remove Premium User -</b> <i>/delprim</i>\n
  \n═══════════════════ \n<b>Request Made by:</b><a> @$username</a>");
      sendMessage($chatId, $respo , $message_id); 
  return;
}



//==============[ CHECKS USER LIST ]==============//
if ((strpos($message, "/users") === 0) || (strpos($message, "!users") === 0)){

  if (($userId == "2132400150") === false){
    sendMessage($chatId , $spam_unauth_msg , $message_id); return; }

  $prvu = (file_get_contents('Others/Users/private.txt'));
  $prv_no = count (file('Others/Users/private.txt'));

  $vipu = (file_get_contents('Others/Users/vip.txt'));
  $vip_no = count (file('Others/Users/vip.txt'));

  $primu = (file_get_contents('Others/Users/prim.txt'));
  $prim_no = count (file('Others/Users/prim.txt'));

  $banu = (file_get_contents('Others/Users/ban.txt'));
  $ban_no = count (file('Others/Users/ban.txt'));

  $respo = urlencode ("<b>Owner Command: All User List ✅</b>\n<b>
✦ Premium Users - </b> $prim_no \n<code>$primu</code><b>
✦ Private Users - </b> $prv_no \n<code>$prvu</code><b>
✦ VIP Users - </b> $vip_no \n<code>$vipu</code><b>
✦ Ban Users - </b> $ban_no \n<code>$banu</code><b>\nRequest Made by:</b> <a>@$username</a>");
  sendMessage($chatId, $respo , $message_id); 
  return; 
}



//==============[ BAN USER ID ]==============//
if ((strpos($message, "/ban") === 0) || (strpos($message, "!ban") === 0)){

  if (($userId == "2132400150") === false){
    sendMessage($chatId , $spam_unauth_msg , $message_id); return; }

    $ban_user = substr($message, 4);
    $ban_user = preg_replace('/[^0-9]+/', '', $ban_user);
    file_put_contents('Others/Users/ban.txt', $ban_user.PHP_EOL , FILE_APPEND | LOCK_EX);

$respo = urlencode ("<b>Owner Command: Ban User ✅</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>".$ban_user."</code> \n<b>✦ Responce:</b> <i>User Successfully Added to Ban user list.</i>\n\n <b>Request Made by:</b> @$username");
sendMessage($chatId, $respo , $message_id); 
  return; 
}


//==============[ REMOVE BAN USER ]==============//
if ((strpos($message, "/unban") === 0) || (strpos($message, "!removeban") === 0)){

  if (($userId == "2132400150") === false){
    sendMessage($chatId , $spam_unauth_msg , $message_id); return; }

    $remove_ban = substr($message, 6);
    $remove_ban = preg_replace('/[^0-9]+/', '', $remove_ban);

  if (empty($remove_ban)) {
  $respo = urlencode ("<b>Owner Command: Un-Ban User ❌</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>NA</code> \n<b>✦ Responce:</b> <i>Invalid User ID, Please Provide a valid user ID.</i>\n\n <b>Request Made by:</b> @$username");
  sendMessage($chatId, $respo , $message_id); 
  return;  }

  $contents = file_get_contents('Others/Users/ban.txt');
  $contents = str_replace($remove_ban.PHP_EOL, '', $contents);
  file_put_contents('Others/Users/ban.txt', $contents);

$respo = urlencode ("<b>Owner Command: Ban User ✅</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>".$remove_ban."</code> \n<b>✦ Responce:</b> <i>User Successfully Remove from Baned user list.</i>\n\n <b>Request Made by:</b> @$username");
sendMessage($chatId, $respo , $message_id); 
  return; 
}


//==============[ ADD PRIVATE USER ]==============//
if ((strpos($message, "/adduser") === 0) || (strpos($message, "!adduser") === 0)){

  if (($userId == "2132400150") === false){
    sendMessage($chatId , $spam_unauth_msg , $message_id); return; }

    $auth_user = substr($message, 8);
    $auth_user = preg_replace('/[^0-9]+/', '', $auth_user);
    file_put_contents('Others/Users/private.txt', $auth_user.PHP_EOL , FILE_APPEND);

  $userData = getUserDataByUserId($auth_user);
    //$userId1 = $userData['user_id'];
    //$username1 = $userData['username'];

$respo = urlencode ("<b>Owner Command: Add Private User ✅</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>".$auth_user."</code> \n<b>✦ Responce:</b> <i>User Successfully Added to Private user list.</i>\n\n <b>Request Made by:</b> $owner");
sendMessage($chatId, $respo , $message_id); 
  return; 
}


//================[ ADD VIP USER ]================//
if ((strpos($message, "/addvip") === 0) || (strpos($message, "!addvip") === 0)){

  if (($userId == "2132400150") === false){
    sendMessage($chatId , $spam_unauth_msg , $message_id); return; }

    $vip = substr($message, 7);
    $vip = preg_replace('/[^0-9]+/', '', $vip);
    file_put_contents('Others/Users/vip.txt', $vip.PHP_EOL , FILE_APPEND | LOCK_EX);

$respo = urlencode ("<b>Owner Command: Add VIP User ✅</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>".$vip."</code> \n<b>✦ Responce:</b> <i>User Successfully Added to VIP user list.</i>\n\n <b>Request Made by:</b> @$username");
sendMessage($chatId, $respo , $message_id); 
  return;
}


//==============[ ADD PREMIUM USER ]==============//
if ((strpos($message, "/addprim") === 0) || (strpos($message, "!addprim") === 0)){

  if (($userId == "2132400150") === false){
    sendMessage($chatId , $spam_unauth_msg , $message_id); return; }

    $prim_user = substr($message, 8);
    $prim_user = preg_replace('/[^0-9]+/', '', $prim_user);
    file_put_contents('Others/Users/prim.txt', $prim_user.PHP_EOL , FILE_APPEND | LOCK_EX);

$respo = urlencode ("<b>Owner Command: Add Premium User ✅</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>".$prim_user."</code> \n<b>✦ Responce:</b> <i>User Successfully Added to Premium user list.</i>\n\n <b>Request Made by:</b> @$username");
sendMessage($chatId, $respo , $message_id); 
  return;
}



//==============[ REMOVE PRIVATE USER ]==============//
if ((strpos($message, "/deluser") === 0) || (strpos($message, "!deluser") === 0)){

  if (($userId == "2132400150") === false){
    sendMessage($chatId , $spam_unauth_msg , $message_id); return; }

    $remove_user = substr($message, 8);
    $remove_user = preg_replace('/[^0-9]+/', '', $remove_user);

    if (empty($remove_user)) {
    $respo = urlencode ("<b>Owner Command: Remove Private User ❌</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>NA</code> \n<b>✦ Responce:</b> <i>Invalid User ID, Please Provide a valid user ID.</i>\n\n <b>Request Made by:</b> @$username");
    sendMessage($chatId, $respo , $message_id); 
    return;  }

  $contents = file_get_contents('Others/Users/private.txt');
  $contents = str_replace($remove_user.PHP_EOL, '', $contents);
  file_put_contents('Others/Users/private.txt', $contents);

$respo = urlencode ("<b>Owner Command: Remove Private User ✅</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>".$remove_user."</code> \n<b>✦ Responce:</b> <i>User Successfully Removed from Allowed user list.</i>\n\n <b>Request Made by:</b> @$username");
sendMessage($chatId, $respo , $message_id); 
  return;
}


//==============[ REMOVE VIP USER ]==============//
if ((strpos($message, "/delvip") === 0) || (strpos($message, "!delvip") === 0)){

  if (($userId == "2132400150") === false){
    sendMessage($chatId , $spam_unauth_msg , $message_id); return; }

    $remove_vip = substr($message, 7);
    $remove_vip = preg_replace('/[^0-9]+/', '', $remove_vip);

  if (empty($remove_vip)) {
  $respo = urlencode ("<b>Owner Command: Remove VIP User ❌</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>NA</code> \n<b>✦ Responce:</b> <i>Invalid User ID, Please Provide a valid user ID.</i>\n\n <b>Request Made by:</b> @$username");
  sendMessage($chatId, $respo , $message_id); 
  return;  }

  $contents = file_get_contents('Others/Users/vip.txt');
  $contents = str_replace($remove_vip.PHP_EOL, '', $contents);
  file_put_contents('Others/Users/vip.txt', $contents);

$respo = urlencode ("<b>Owner Command: Remove Private User ✅</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>".$remove_vip."</code> \n<b>✦ Responce:</b> <i>User Successfully Removed from Allowed user list.</i>\n\n <b>Request Made by:</b> @$username");
sendMessage($chatId, $respo , $message_id); 
  return;
}


//==============[ REMOVE PREMIUM USER ]==============//
if ((strpos($message, "/delprim") === 0) || (strpos($message, "!delprim") === 0)){

  if (($userId == "2132400150") === false){
    sendMessage($chatId , $spam_unauth_msg , $message_id); return; }

    $remove_prim = substr($message, 8);
    $remove_prim = preg_replace('/[^0-9]+/', '', $remove_prim);

  if (empty($remove_prim)) {
  $respo = urlencode ("<b>Owner Command: Remove Premium User ❌</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>NA</code> \n<b>✦ Responce:</b> <i>Invalid User ID, Please Provide a valid user ID.</i>\n\n <b>Request Made by:</b> @$username");
  sendMessage($chatId, $respo , $message_id); 
  return;  }

  $contents = file_get_contents('Others/Users/prim.txt');
  $contents = str_replace($remove_prim.PHP_EOL, '', $contents);
  file_put_contents('Others/Users/prim.txt', $contents);

$respo = urlencode ("<b>Owner Command: Remove Private User ✅</b>\n\n<b>✦ [User Name]:</b> NA \n<b>✦ [User ID]:</b> <code>".$remove_prim."</code> \n<b>✦ Responce:</b> <i>User Successfully Removed from Allowed user list.</i>\n\n <b>Request Made by:</b> @$username");
sendMessage($chatId, $respo , $message_id);
  return;
}


?>