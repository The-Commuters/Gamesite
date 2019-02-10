<?php require_once("includes/header.php") ?>

<?php 
if (empty($_GET['id'])) {
  redirect("users.php");
}

$user = User::find_by_id($session->user_id);
?>

<?php 
echo "This is your profile page " . $user->username . ", but there is little for you to do here at the moment.";
?>


<!-- Add friend stuff starts here -->
<div>
<label>Add Friend Function</label>
<input type="text" onkeyup="find_friend()" id="search" value="">
</div>

<!-- This is where the friend list is called -->
<div id="friend_search">
  <?php 
    include("includes/friend_search.php");
  ?>
</div>

<p>------------------------------------------------------------------------------------</p>

<div id="find_messages">
  <?php 
    include("includes/message_list.php");
  ?>
</div>

<script src="js/functions.js"></script>