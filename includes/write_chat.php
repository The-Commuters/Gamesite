<?php
	include("init.php");

	/**
	 * This page is called whenever
	 *
	 *
	 */
	$user = User::find_by_id($session->user_id);
	
	$message = new Message();
	$message->username = $user->username;
	$message->text = substr($_GET["text"], 0, 128);

	$message->save();

?>