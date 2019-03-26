<?php 

/**
 * This is the profile of users othen than the user that is signed in to the site.
 * On this page the signed in user
 */

if (empty($_GET['id'])) {
	redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

echo "This is the profile of the user " . $user->first_name . " " . 
		$user->middle_name . " " . $user->last_name . 
			", which is not you.";

?>


<?php 
// Chat with if friend
if (User::is_friend($session->user_id, $user->id)) {
?>

<div>
<input id="chat" type="button" value="Chat?" onclick="start_chat(<?php echo $session->user_id . ", " . $user->id ?>)">
</div>

<?php
}
?>