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
  $friends = Friendship::find_friends($user->id);
}
?>


<main class="friendlist">
    <h1 class="friendlist-title">Friends</h1>


    <!----------------------------------- Friend search---------------------------------------->

    <!-- Add friend stuff starts here -->
		<div class="friendlist-container friendlist-search">
            <input type="text" onkeyup="find_friend()" id="search" value="" class="search-input">
            


            <!-- This is where the friend list is called -->
		    <div class="new-friends-container">
                <div id="friend_search" class="new-friends"></div>
		    </div>
        </div>


        <?php include("includes/views/friend_request_list.php"); ?>
		<!----------------------------------- Friend search---------------------------------------->

    <?php include("includes/views/friendlist_content.php"); ?>

</main>

<!-- Used for running the process files in for start chatroom and delete user. -->
<div id="chat"></div>






<?php include("includes/views/footer.php"); ?>