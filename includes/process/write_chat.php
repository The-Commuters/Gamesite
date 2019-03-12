<?php

	/**
	 * This page is called whenever someone writes something in the chat.
	 * It makes a new message and sends it into the database.
	 */

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 

	$user = User::find_by_id($session->user_id);
	
	$message           = new Message();

	$message->username = $user->username;
	$message->game_id  = substr($_GET["chatId"], 0, 20);
	$message->text     = substr($_GET["text"], 0, 128);
	$message->time     = date("Y-m-d H:i:s");

	$message->save();

?>