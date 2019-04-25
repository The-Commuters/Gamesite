<?php 

/* 
 * This page will be called on at the page where the search for friends is done.
 * It will go trough all of the users that the search could find and list them.
*/

$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
require_once($path);  

$genres = array();

// If something have been placed in the search-bar.
if (isset($_GET['s'])) {

	// Is placed here by the javascript function.
	$search  = $_GET['s'];

	// Collects all the users with the friend_search function, that fits with the search.
    $users = User::find_friend($search);

} else {
  $search = "";

}

?>
	<!-- For each loop that runs trough all the elements in the $games array. -->
	<?php

	if (isset($users)) {

	// Places here in the number of users that you decide at the end of this foreach.
	foreach ($users as $user) { 

		// Stops the user from encountering themselves in when searching for users.
		if ($user->id !== $session->user_id) {

		    if ($user->signed_in == 1) {
		        $signed_in = "-active";
		        $status = "Online";
		    } else {
		        $signed_in = "";
		        $status = "Offline";
		    }

		?>

		<div class="friend">
            <div class="friend-info">
				<div style="background-image: url(<?php echo $user->get_user_image(); ?>" class="avatar -s"></div>
				
                <div href="profile.php?id=<?php echo $user->id; ?>" class="username"><?php

				// Gets the username and then makes the letters lowercase.
				$username = strtolower($user->username);

				// Switches out what is searched with the same with marks around it.
				echo str_replace($search, '<mark>' . $search . '</mark>', $username); 

				?></div>
			</div>

            <div class="friend-status">
                <div class="status <?php echo $signed_in ?>"></div>
                <div class="description"><?php echo $status ?></div>
            </div>

            <div class="friend-actions">
				<a href="profile.php?id=<?php echo $user->id; ?>" class="action">
                    <i class="fas fa-user"></i>
				</a>

				<!-- Here the button for the friend request is placed, and the message when it is sent. -->
				
					<!-- If the user is not a friend with this uder, hten show the send friend-request button -->
				<?php if (!User::is_friend($session->user_id, $user->id)) { ?>
				<button class="action -add" onclick="send_friend_request(<?php echo $session->user_id ?>, <?php echo $user->id ?>)">
					<i class="fas fa-fw fa-user-plus"></i>
				</button>
				<?php } ?>
				
			</div>
        </div>


				

				
			<?php


		}

			}
		} ?>
