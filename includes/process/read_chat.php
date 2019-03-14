<?php
	
	/**
	 * Reads messages that belong to the current chat and places them into it.
	 */

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 

	$game_id  = substr($_GET["chatId"], 0, 20);

	$messages = Message::find_messages($game_id);

	foreach ($messages as $message) : 

        $username=$message->username;
        $text=$message->text;
        $time=date('G:i', strtotime($message->time));

        echo "<p>$time | $username: $text</p>\n";

    endforeach; 

?>