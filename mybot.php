<?php

$token = "1453713083:AAFhjDLKUaoTV33Xr0F99ve8mHwu3QTgNe8";

$json = file_get_contents('php://input');
$telegram = urldecode ($json);
$results = json_decode($telegram); 


$message = $results->message;
$text = $message->text;
$chat = $message->chat;
$user_id = $chat->id;



function inlinekeyboardmessage ($user_id,$message,$token,$keyboard) {
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
	$replyMarkup = array(
				'inline_keyboard' => $keyboard
			);
	$encodedMarkup = json_encode($replyMarkup);
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id.'&text='.$message.'&reply_markup='.$encodedMarkup;
	$update = file_get_contents($url);
}


//Send Text Message With Inline Keyboard
// function bot_keyboardmessage ($user_id,$message,$token,$keyboard) {
	// $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
	// $replyMarkup = array(
				// 'keyboard' => $keyboard,
				// 'resize_keyboard' => true);
				// $encodedMarkup = json_encode($replyMarkup);
				// $message = urlencode($message);
				// $url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id.'&text='.$message.'&reply_markup='.$encodedMarkup;
				// $update = file_get_contents($url);
			
// }
if ($text == '/start'){
	$message = "سلام !"."\r\n"."به پنهان چت خوشومدی\xF0\x9F\x98\x89"."\r\n"."چه کاری می تونم برات انجام بدم؟🥰";
	$keyboard = array(	
					array(
						array( 'امتیاز من',"امتیاز های برتر"),
						array( 'شارژ رایگان' , "راهنما"),
						)
				);

	inlinekeyboardmessage ($user_id,$message,$token,$keyboard);

}
else {
	$message = "ورودی درست نیس!";
	bot_sendmessage ($user_id,$message,$token);
}

function bot_sendmessage ($user_id,$message,$token) {
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id.'&text='.$message;
	$update = file_get_contents($url);
}


?>
