<?php

/**
 * Reads messages that belong to the current chat and 
 * places them into it for the users to read.
 */

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 

$room_id  = substr($_GET["chatId"], 0, 20);   		// Collects the room_id from the input where its placed.
$messages = Message::find_messages($room_id);		// Finds all the messages that belong to this room.

foreach ($messages as $message) : 					// Does this for each of the messages that belong to the room.
	$username=$message->username;					// Gather's the username from the message.
	$text=$message->text;							// Gather's the text from the message.
	$time=date('G:i', strtotime($message->time));	// Gather's the time from the message and cuts it down.
	echo "<p>$time | $username: $text</p>\n";		// Echo's all of the information into the chat.
endforeach; 										// Ends the foreach.

?>