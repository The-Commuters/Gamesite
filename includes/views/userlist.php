<?php 
/* This is where the users is shown to the admin and the admin can delete, view and update them. */

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 
?> 

<?php 

$genres = array();

if (isset($_GET['s'])) {

	// Uses GET to collect all of the variables that the user searches for.
	$search  = $_GET['s'];
	$category = $_GET['c'];

    $users = User::find_user($search, $category);

} else {

  $search = "";
  $users = User::find_all();

}

?>

	<table>
		<thead>

			<tr>
				<th>Image</th>
				<th>Username</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Joined</th>
			</tr>

		</thead>
		<tbody>

		<!-- For each loop that runs trough all the elements in the $games array. -->
		<?php foreach ($users as $user) : ?>

			<tr>

				<td>
					<a href="profile.php?id=<?php echo $user->id; ?>">
						<img src="<?php echo $user->get_user_image();?>" style="height: 100px; width: 100px;">
					</a>
				</td>

				<td>
					<a href="profile.php?id=<?php echo $user->id; ?>">
						
					<?php 

						// Gets the username and then makes the letters lowercase.
						$username = strtolower($user->username);

						// Switches out what is searched with the same with marks around it.
						echo str_replace($search, '<mark>' . $search . '</mark>', $username); 

					?>
					
					</a>
				</td>

				<td>
					<?php 
						// Gets the username and then makes the letters lowercase.
						$first_name = strtolower($user->first_name);
						// Switches out what is searched with the same with marks around it.
						echo str_replace($search, '<mark>' . $search . '</mark>', $first_name); 
					?>
				</td>

				<td>
					<?php 
					// Gets the username and then makes the letters lowercase.
					$last_name = strtolower($user->last_name);
					// Switches out what is searched with the same with marks around it.
					echo str_replace($search, '<mark>' . $search . '</mark>', $last_name); 
					?>
				</td>

				<td><?php echo $user->joined; ?></td>
				<td><a href="includes/process/delete_user.php?id=<?php echo $user->id; ?>" 
					onclick="return confirm('Are you sure you want to delete <?php echo $user->username ?>?')">Delete</a></td>
				<td><a href="profile.php?id=<?php echo $user->id; ?>">View</a></td>

			</tr>

		<?php endforeach; ?>
		</tbody>
	</table>