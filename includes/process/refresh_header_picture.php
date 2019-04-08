<?php 

/**
 * This updates the profile picture in the header,
 * is used when the profile-picture is updated on 
 * the settings page, is placed in the id 'profile'.
 */

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 

$user = User::find_by_id($session->user_id);

echo '<div style="background-image: url(' . $user->get_user_image() . ')" class="avatar"></div>';
echo '<div class="icon-buffer"><i class="fas fa-angle-down icon"></i></div>';
?>

