<!-- 
This sends a friend request into the database.
-->

<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 
?> 

<?php 

	if (!User::is_friend($_GET['i'], $_GET['o'])) {
		$user = User::add_friend($_GET['i'], $_GET['o']);
	}

	echo "Friend Request Sent!";

?>
