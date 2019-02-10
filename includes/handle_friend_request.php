<!-- 
This accepts or deletes a friend-request depending on the last _get.
-->

<?php 

include("init.php"); 

if (!User::is_friend($_GET['i'], $_GET['o'])) {
	$user = User::add_friend($_GET['i'], $_GET['o']);
}


echo "Friend Request Sent!";

?>
