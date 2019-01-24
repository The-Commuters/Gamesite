<!-- Denne siden kommer til å innholde en liste over brukerne og en søkemotor for dem. -->

<?php include("includes/header.php"); ?>

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

				</tr>

				<!-- Ends the foreach loop here.-->
			<?php endforeach; ?>

		</tbody>
	</table>

</div>  


<?php include("includes/footer.php"); ?>