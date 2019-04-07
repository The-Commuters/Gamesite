<?php

	/**
	 * This page is called whenever someone writes something in the chat.
	 * It makes a new message and sends it into the database.
	 */

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 

	$user = User::find_by_id($session->user_id);						// Collects the signed_in user in $user.
	
	$message           = new Message();									// Creates a new message-object.
	$message->username = $user->username;								// Places the signed_in username into $message.
	$message->room_id  = substr($_GET["chatId"], 0, 23);    			// Does the same with the room_id.
	$message->user_id  = $session->user_id;								// And the user_id
	$message->text     = strip_tags(substr($_GET["text"], 0, 1000)) ;	// And the 1000 first characters in the text.
	$message->time     = date("Y-m-d H:i:s");							// And the date.

	if ($message->room_id != 0) {										// If the room id is 0, stops the message.
		$message->save();												// Then stores it into the database.
	}
	

?>