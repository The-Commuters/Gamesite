<?php 
	
/**
 * This will send a friend-request to the user that the 
 * signed-in user have pressed the 'send friend request'
 * button on.
 */

$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
require_once($path); 

// Creates a friendship-row between this and another user in the database.
if (!User::is_friend($_GET['i'], $_GET['o'])) {
	$user = User::add_friend($_GET['i'], $_GET['o']);
}

// Posts the alert that the friend request is sent.
?>

<div id="alert" class="alert -warning -active">
	<div>Friend Request Sent!</div>
</div>
