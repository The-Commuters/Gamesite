<!-- 
This sends a friend request into the database.
-->

<?php include("init.php"); ?>

<?php 

	if (!User::is_friend($_GET['i'], $_GET['o'])) {
		$user = User::add_friend($_GET['i'], $_GET['o']);
	}

	echo "Friend Request Sent!";

?>
