<!-- 
This deletes the user when the admin clicks on it un the admin_userlist.
And then it sends them back to the same list after it is done.  
-->

<?php 

include("init.php"); 

if (!User::is_friend($_GET['i'], $_GET['o'])) {
	$user = User::add_friend($_GET['i'], $_GET['o']);
}


echo "Friend Request Sent!";

echo "<script>find_friend();</script>";


?>