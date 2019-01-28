
				<tr>

					<td>
						<a href="profile.php?id=<?php echo $user->id; ?>">
							<img src="<?php echo $user->get_user_image();?>" style="height: 100px; width: 100px;">
						</a>
					</td>

					<td><a href="profile.php?id=<?php echo $user->id; ?>"><?php echo $user->username; ?></a></td>

					<td><?php echo $user->first_name; ?></a></td>
					<td><?php echo $user->last_name; ?></td>
					<td><?php echo $user->joined; ?></td>

					<?php if (!User::is_friend($session->user_id, $user->id) && $session->user_id != $user->id) { ?>
	
					<td><a href="includes/add_friend.php?id=<?php echo $user->id; ?>">Send friend request!</a></td>

					<?php } ?>

				</tr>
