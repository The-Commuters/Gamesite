<!-- Denne siden kommer til å innholde en liste over brukerne og en søkemotor for dem. -->

<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

$users = User::find_all();

?>

<div >  

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

				<?php 
				// Checks if the logged in user is an admin or not.
				if (User::is_admin($session->user_id)) {
					include("admin_includes/admin_userlist.php");
				} else {
					include("includes/userlist.php");
				}
				?>

			<?php endforeach; ?>

		</tbody>
	</table>

</div>  


<?php include("includes/footer.php"); ?>