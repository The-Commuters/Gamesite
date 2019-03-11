<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 

	/**
	 * This page is called whenever
	 *
	 *
	 */
	$user = User::find_by_id($session->user_id);
	
	$message = new Message();
	$message->username = $user->username;
	$message->text = substr($_GET["text"], 0, 128);
	$message->time = date("Y-m-d H:i:s");

	$message->save();

?>