<!-- 
This accepts or deletes a friend-request depending on the last _get.
-->

<?php include("init.php"); ?>

<?php 
	$user_1 = $_GET['ui'];
	$user_2 = $_GET['oi'];
	$status = $_GET['a'];
	$id = $_GET['id'];

	Friendship::friend_request_handler($user_1, $user_2, $status, $id);
?>
