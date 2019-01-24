
	<!-- 
	This deletes the user when the admin clicks on it un the admin_userlist.
	And then it sends them back to the same list after it is done.  
	-->


<?php require_once("../includes/header.php") ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

if (empty($_GET['id'])) {
	redirect("../users.php");
}

$user = User::find_by_id($_GET['id']);

$user->delete();

redirect("../users.php");

?>