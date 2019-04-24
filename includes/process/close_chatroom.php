<?php 
	
	/**
	 * This will send a friend-request to the user that the 
	 * signed-in user have pressed the 'send friend request'
	 * button on.
	 */

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 

	// Gathers the id needed to find the friend_list row.
	$friendship_id = $_GET["fsId"];
	$friendship = new Friendship();
	$friendship = Friendship::find_by_id($friendship_id);

	// Changes it so that the chatroom is not active, and will not be shown besides the chat.
	$friendship->chatroom_status = 0;
	$friendship->update();

?>
