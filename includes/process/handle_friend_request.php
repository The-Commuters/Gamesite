<?php 

	/**
 	* This accepts or deletes a friend-request depending 
 	* on the last _get. Will send a message back that is 
 	* either positive or negative.
 	*/

	$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
    require_once($path); 
	
	$user_1 = $_GET['ui']; 												// The id of the user that is logged in.
	$user_2 = $_GET['oi']; 												// The id of the user that sent the request.
	$status = $_GET['a'];  												// 0 if the signed in user refused, 1 if not.
	$id     = $_GET['id']; 												// The id of the friend request.
	Friendship::friend_request_handler($user_1, $user_2, $status, $id); // The method that handles the friendship object.

	if ($status == 1) {													// Echo positive or negative depending on on $status.	
    ?>

	<div id="alert" class="alert -warning -active">
		<div>Friendship accepted!</div>
	</div>

    <?php
	} else {
	?>

    <div id="alert" class="alert -warning -active">
		<div>Friendship rejected!</div>
    </div>

    <?php
	}
?>
