<?php 
	
	/**
	 * This will send a friend-request to the user that the 
	 * signed-in user have pressed the 'send friend request'
	 * button on.
	 */

	$path = __DIR__ ."\..\init.php";
	require_once($path); 


	if (!User::is_friend($_GET['i'], $_GET['o'])) {
		$user = User::add_friend($_GET['i'], $_GET['o']);
	}

// Posts the alert that the friend request is sent.
?>
<div id="alert" class="alert -warning -active">
	<div>Friend Request Sent!</div>
</div>
