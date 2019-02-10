<!-- This will show all the messages that a user have,
	 Friend-request is the only one for now.           -->

<?php include("init.php"); ?>

<?php 

$genres = array();

if (isset($_GET['s'])) {

	// Uses GET to collect all of the variables that the user searches for.
	$search  = $_GET['s'];

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
						<a href="profile.php?id=<?php echo $user->id; ?>">
							<img src="<?php echo $user->get_user_image();?>" style="height: 100px; width: 100px;">
						</a>
					</td>

					<td><a href="profile.php?id=<?php echo $user->id; ?>"><?php echo $user->username; ?> Wants to become your friend!</a></td>

					<?php if (!User::is_friend($session->user_id, $user->id)) { ?>
										
					<td>
						<!-- Here the button for the friend request is placed, and the message when it is sent. -->
						<div id="handle_friend_request">
							<button onclick="handle_friend_request(<?php echo $session->user_id ?>, <?php echo $user->id ?>, 1)">Accept</button><br>
							<button onclick="handle_friend_request(<?php echo $session->user_id ?>, <?php echo $user->id ?>, 0)">Decline</button>

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