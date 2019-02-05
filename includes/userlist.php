<?php include("init.php"); ?>

<?php 

$genres = array();

if (isset($_GET['f'])) {

	// Uses GET to collect all of the variables that the user searches for.
	$first_name  = $_GET['f'];
	$middle_name = $_GET['m'];
	$last_name   = $_GET['l'];
	$id          = $_GET['u'];

  $users = User::find_user($first_name, $middle_name, $last_name, $id);

} else {

  $last_name = "";
  $middle_name = "";
  $first_name = "";
  $id = "";
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
		</tbody>
	</table>