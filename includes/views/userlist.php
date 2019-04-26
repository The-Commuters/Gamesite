



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
			$email = strtolower($user->email);
			$first_name = strtolower($user->first_name);
			$middle_name = strtolower($user->middle_name);
			$last_name = strtolower($user->last_name);
			$full_name = $first_name . " " . $middle_name . " " . $last_name;

		?>

		<tr>
			<td><div class="avatar -s" style="background-image: url(<?php echo $user->get_user_image(); ?>)"></div></td>
			<td><?php echo str_replace($search, '<span class="friend-highlight">' . $search . '</span>', $username); ?></td>
			<td class="user-list-hide-laptop"><?php echo str_replace($search, '<span class="friend-highlight">' . $search . '</span>', $full_name); ?></td>
			<td class="user-list-hide-tablet"><?php echo str_replace($search, '<span class="friend-highlight">' . $search . '</span>', $email); ?></td>
			<td>
				<div class="user-list-actions">
					<a href="profile.php?id=<?php echo $user->id ?>" data-tooltip="Profile" class="user-list-action tooltip"><i class="fas fa-user"></i></a>

					<!-- Legg till en sjekk for om de virkelig vil slette denne brukeren -->
					<button data-tooltip="Delete" class="user-list-action -delete tooltip" 
						onclick="return confirm('Are you sure you want to delete user <?php echo $username; ?>?')?delete_user(<?php echo $user->id; ?>):'';"><i class="fas fa-user-times"></i></button>

					<!-- Legg till en sjekk for om de virkelig vil promote denne brukeren -->
					<button data-tooltip="Promote" class="user-list-action -promote tooltip"><i class="fas fa-user-tie"></i></button>
				</div>
			</td>
		</tr>

		<?php endforeach; ?>

		</tbody>
	</table>