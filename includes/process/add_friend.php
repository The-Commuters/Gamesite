<?php 
	
	/**
	 * This will send a friend-request to the user that the 
	 * signed-in user have pressed the 'send friend request'
	 * button on.
	 */

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 


	if (!User::is_friend($_GET['i'], $_GET['o'])) {
		$user = User::add_friend($_GET['i'], $_GET['o']);
	}

	echo "Friend Request Sent!";

?>
