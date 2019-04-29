<?php 

/* 
 * This deletes the user when the admin clicks on it un the admin_userlist.
 * And then it sends them back to the same list after it is done.  
 */

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 

$user_id = $_GET["user_id"];
$friend_id = $_GET["friend_id"];

// Deletes the user with the id from the database.
$friendship = new Friendship();
$friendship = Friendship::get_friendship($user_id, $friend_id);
$friendship = array_shift($friendship);
$friendship->delete();

?>