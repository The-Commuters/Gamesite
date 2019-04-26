<?php 

/**
 * This is the page where teh friend-list is placed
 * All of the friends of the signed in users is listed
 * here.
 */

include("includes/views/header.php");

if (!$session->is_signed_in()) {redirect("login.php");} 

?>


<main class="friendlist">
    <h1 class="friendlist-title">Friends</h1>


    <!----------------------------------- Friend search---------------------------------------->

    <!-- Add friend stuff starts here -->
		<div class="friendlist-container friendlist-search">

            <!-- The search bar for users to send friend request to. -->
            <input type="text" onkeyup="find_friend()" id="search" value="" class="search-input" placeholder="Find new friends">

            <!-- This is where the friend list is sent in the AJAX-function -->
		    <div class="new-friends-container">
                <div id="friend_search" class="new-friends"></div>
		    </div>
    </div>

	<!----------------------------------- /Friend search---------------------------------------->

    <!-- Div that is used to update friendlist with ajax -->
    <div id="friendlist_content-ajax">
        <div class="friendlist-container">
            <?php 
            /**
             * Includes the view that holds the list of recieved
             * friend-requests and the list of friends under it.
             */
            include("includes/views/friendlist_content.php"); 
            ?>
        </div>
    </div>
 
</main>

<!-- Used for running the process files in for start chatroom and delete user ajax-functions. -->
<div id="friendlist-ajax"></div>


<?php include("includes/views/footer.php"); ?>