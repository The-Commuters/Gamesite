<?php 

/**
 * This is the profile page that keeps the profiles of other users or
 * the user that is logged in depending on the $session id. 
 */

include("includes/views/header.php"); 

if (!$session->is_signed_in()) {redirect("login.php");}


/*
 * Decides wheter or not the profile is the one of the logged in user.
 * Will load in the profile_conent for either the signed in user or a 
 * other user.
*/

if ($session->user_id == $_GET['id']) {
  include("includes/views/self_profile_content.php"); 
} elseif (isset($_GET['id'])) {
  include("includes/views/other_profile_content.php"); 
} else {
	redirect("logout.php");
}

 
include("includes/views/footer.php"); 

?>