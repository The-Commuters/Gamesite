<?php 
	
/**
 * This process-file starts a new chatroom by making it
 * active by changing the chatroom-status to 1. This will
 * make it show in the chat.
 */

$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
require_once($path);

// Gathers the id needed to find the friend_list row.

$user_1 = $_GET["u1"];
$user_2 = $_GET["u2"];

$friendship = new Friendship();
$friendship = Friendship::get_friendship($user_1, $user_2);

// Turns this into a Friendship object.
$friendship = array_shift($friendship);

// Changes it so that the chatroom is not active, and will not be shown besides the chat.
$friendship->chatroom_status = 1;

// Update the friendship with a the new status.
$friendship->update();

?>
