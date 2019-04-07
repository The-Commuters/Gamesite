<?php 

/**
 * This is the page where teh friend-list is placed
 * All of the friends of the signed in users is listed
 * here.
 */

include("includes/views/header.php");

if (!$session->is_signed_in()) {redirect("login.php");} 

if (!isset($_GET['f'])) {
  $search = "";
  $friend = Friendship::find_friends($user->id);
}

?>







<?php include("includes/views/footer.php"); ?>