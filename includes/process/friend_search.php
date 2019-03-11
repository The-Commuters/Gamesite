<?php 

/* 
 * This page will be called on at the page where the search for friends is done.
 * It will go trough all of the users that the search could find and list them.
*/

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 

?>

<?php 

$genres = array();

// hvis det har blitt søkt på noe.
if (isset($_GET['s'])) {

	// Is placed here by the javascript function.
	$search  = $_GET['s'];

	// Collects all the users with the friend_search function, that fits with the search.
    $users = User::find_friend($search);

} else {

  $search = "";

}

?>

	<table>
		<!-- For each loop that runs trough all the elements in the $games array. -->
		<?php 
		if (isset($users)) {

			// Places here in the number of users that you decide at the end of this foreach.
			$i= 0;
			foreach ($users as $user) { ?>

				<tr>
					<td>
						<!-- Places the image of the user here, with a link to the users profile page. -->
						<a href="profile.php?id=<?php echo $user->id; ?>">
							<img src="<?php echo $user->get_user_image();?>" style="height: 50px; width: 50px;">
						</a>
					</td>

					<td><a href="profile.php?id=<?php echo $user->id; ?>">

						<?php 

						// Gets the username and then makes the letters lowercase.
						$username = strtolower($user->username);

						// Switches out what is searched with the same with marks around it.
						echo str_replace($search, '<mark>' . $search . '</mark>', $username); 

						?>
							
					</a></td>

					<!-- If the user is not a friend with this uder, hten show the send friend-request button -->
					<?php if (!User::is_friend($session->user_id, $user->id)) { ?>
										
					<td>
						<!-- Here the button for the friend request is placed, and the message when it is sent. -->
						<div id="send_friend_request">
							<button onclick="send_friend_request(<?php echo $session->user_id ?>, <?php echo $user->id ?>)">Add Friend</button>
						</div>
					</td>

					<?php } ?>
				</tr>
				
			<?php 
			$i++;
			if($i == 5) break;
			} 
		} ?>
	</table>