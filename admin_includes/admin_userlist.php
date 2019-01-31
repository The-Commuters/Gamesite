				
				<!--
				This is the list of users that will be shown to the Admin is he/she is signed in.
				The standard user will be shown the userlist-include instead and not this.
				This list is can be more simple than the list that users see, but with buttons for manageing them.
				-->



			<!-- For each loop that runs trough all the elements in the $games array. -->
			<?php foreach ($users as $user) : ?>

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
					<td><a href="admin_includes/delete_user.php?id=<?php echo $user->id; ?>" 
						onclick="return confirm('Are you sure you want to delete <?php echo $user->username ?>?')">Delete</a></td>
					<td><a href="settings.php?id=<?php echo $user->id; ?>">Edit</a></td>
					<td><a href="profile.php?id=<?php echo $user->id; ?>">View</a></td>

				</tr>

			<?php endforeach; ?>
