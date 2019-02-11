<!-- This will show all the messages that a user have,
	 Friend-request is the only one for now.           -->

<?php include("init.php"); ?>

<?php 

$genres = array();
	
// Uses GET to collect all of the variables that the user searches for.

$requests = Friendship::find_friend_requests($session->user_id);

?>

	<table>
		<!-- For each loop that runs trough all the elements in the $games array. -->
		<?php 


			// Places here in the number of users that you decide at the end of this foreach.
			$i= 0;
			foreach ($requests as $request) { ?>

				<tr>

					<td><a href="profile.php?id=<?php echo $user->id; ?>"><?php echo $request->id; ?> Wants to become your friend!</a></td>

					<td>
						<!-- Here the button for the friend request is placed, and the message when it is sent. -->
						<div id="handle_friend_request">
							<button onclick="handle_friend_request(<?php echo $session->user_id ?>, <?php echo $request->user_1 ?>, <?php echo $request->id ?>, 1)">Accept</button>
							<!--<button onclick="handle_friend_request(<?php echo $session->user_id ?>, <?php echo $request->user_1 ?>, 0)">Decline</button>-->
						</div>
					</td>

				</tr>
				
			<?php 
			$i++;
			if($i == 5) break;

		} ?>
	</table>