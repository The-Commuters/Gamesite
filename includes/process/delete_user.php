<?php 

	/* 
	 * This deletes the user when the admin clicks on it un the admin_userlist.
	 * And then it sends them back to the same list after it is done.  
	 */

	$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
	require_once($path); 

	// Sends the user back if there is no id in the _GET
	if (empty($_GET['id'])) {
		redirect("../../users.php");
	}

	// Deletes the user with the id from the database.
	$user = User::find_by_id($_GET['id']);
	$user->delete();
?>