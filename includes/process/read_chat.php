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
	$user = new User;
	$user->find_by_id($message->user_id);

	// Decides if the message belongs to signed in user or not.
	$other = null;
	if ($message->user_id != $session->user_id) {
		$other = "-user";
	}
	
	$avatar = $user->get_user_image();
	$username=$message->username;					// Gather's the username from the message.
	$text=$message->text;							// Gather's the text from the message.
	$time=date('G:i', strtotime($message->time));	// Gather's the time from the message and cuts it down.
	$date=date('l jS \of F Y', strtotime($message->time));

	echo '<hr data-content="' . $date . '">';
	
	echo '<div class="message ' . $other . '">';
	echo '<div><div class="avatar" style="background-image: url(' . $avatar . ')"></div></div>';
	echo '<div class="content">';
	echo '<div class="info"><a href="#" class="name">' . $username . '</a><span class="time">' . $time . '</span></div>';
	echo '<p class="text">' . $text . '</p>';
	echo '</div>';
	echo '</div>';

endforeach; 										// Ends the foreach.

?>