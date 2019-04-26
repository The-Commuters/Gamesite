<?php

	/**
	 * Reads messages that belong to the current chat and 
	 * places them into it for the users to read.
	 */

	$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
	require_once($path); 

	$room_id  = substr($_GET["chatId"], 0, 20);   		// Collects the room_id from the input where its placed.
	$messages = Message::find_messages($room_id);		// Finds all the messages that belong to this room.
	$day_check = 0;										// Used when checking where the date-lines should be placed.
	$minute_check = 0;									// Used when checking wheter the messages should be lumped together.
	$user_check = 0; 									// Used when checking if the user was the one that posted the last message.

	foreach ($messages as $message) : 					// Does this for each of the messages that belong to the room.
		
		// Collects the information of the user that sent the message.
		$user = new User;
		$user = User::find_by_id($message->user_id);

		// Decides if the message belongs to signed in user or not.
		$other = null;
		if ($message->user_id == $session->user_id) {
			$other = "-user";
		}
		
		$avatar = $user->get_user_image();				// Gather's the profile picture from the message.
		$username=$message->username;					// Gather's the username from the message.
		$text=$message->text;							// Gather's the text from the message.
		$time=date('G:i', strtotime($message->time));	// Gather's the time from the message and cuts it down.
		$date=date('d/m/Y', strtotime($message->time)); // Gather's the date used when seperating messages by day.
		$minute=date('i', strtotime($message->time));   // Gather's the minute that the message was sent.

		// Will here check if the message is viewed or not.
		if ($session->user_id != $message->user_id) {
			$message->viewed = 1;
			$message->update();
		}


		// Here the message is echo'ed out.
		// This 'if' checks  how long it was since the last message was posted
		// And decides if the text should be placed inside of the content div
		// of the previoulsy read message.
		if (!($minute == $minute_check) || $user_check != $message->user_id) {
			
			echo '</div>';
			echo '</div>';

			// This part controls wheter or not the day-seperator will be placed.
			$day=date('d', strtotime($message->time));
			if ($day !== $day_check) {
				echo '<hr data-content="' . $date . '">';
				$day_check = $day;
			}

			echo '<div class="message ' . $other . '">';
			echo '<div><div class="avatar" style="background-image: url(' . $avatar . ')"></div></div>';
			echo '<div class="content">';
			echo '<div class="info"><a href="profile.php?id=' . $user->id . '" class="name">' . $username . '</a><span class="time">' . $time . '</span></div>';
			echo '<p class="text">' . $text . '</p>';
			$minute_check = $minute;
		} else {

			echo '<p class="text">' . $text . '</p>';
		}

		// Sets the $user_check to become the id of the user that sent this message.
		$user_check = $message->user_id;

	endforeach; 										// Ends the foreach.

	echo '</div>';
	echo '</div>';

?>
