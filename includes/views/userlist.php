



<?php 
/* This is where the users is shown to the admin and the admin can delete, view and update them. */

$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
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



<table class="user-list-list">
	<thead>
		<tr>
			<th>Avatar</th>
			<th>Username</th>
			<th class="user-list-hide-laptop">Name</th>
			<th class="user-list-hide-tablet">Email</th>
			<th>Actions</th>
		</tr>
	</thead>

	<tbody>


		<!-- For each loop that runs trough all the elements in the $games array. -->
		<?php foreach ($users as $user) : 

			// Gets the username and then makes the letters lowercase.
			$username = strtolower($user->username);
			$first_name = strtolower($user->first_name);
			$middle_name = strtolower($user->middle_name);
			$last_name = strtolower($user->last_name);
			$full_name = $first_name . " " . $middle_name . " " . $last_name;

		?>



		<tr>
			<td><div class="avatar -s" style="background-image: url(<?php echo $user->get_user_image(); ?>)"></div></td>
			<td><?php echo str_replace($search, '<mark>' . $search . '</mark>', $username); ?></td>
			<td class="user-list-hide-laptop"><?php echo $full_name; ?></td>
			<td class="user-list-hide-tablet"><?php echo str_replace($search, '<mark>' . $search . '</mark>', $user->email); ?></td>
			<td>
				<div class="user-list-actions">
					<a href="profile.php?id=<?php echo $user->id ?>" data-tooltip="Profile" class="user-list-action tooltip"><i class="fas fa-user"></i></a>

					<!-- Legg till en sjekk for om de virkelig vil slette denne brukeren -->
					<button data-tooltip="Delete" class="user-list-action -delete tooltip" 
						onclick="return confirm('Are you sure?')?delete_user(<?php echo $user->id; ?>):'';"><i class="fas fa-user-times"></i></button>

					<!-- Legg till en sjekk for om de virkelig vil promote denne brukeren -->
					<button data-tooltip="Promote" class="user-list-action -promote tooltip"><i class="fas fa-user-tie"></i></button>
				</div>
			</td>
		</tr>

<!--
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
				<td><a href="includes/process/delete_user.php?id=<?php echo $user->id; ?>" onclick="return confirm('Are you sure you want to delete <?php echo $user->username ?>?')">Delete</a></td>
					<td><a href="profile.php?id=<?php echo $user->id; ?>">View</a></td>

				</tr>

-->

			<?php endforeach; ?>

		</tbody>
	</table>