<!-- Denne siden kommer til å innholde en liste over brukerne og en søkemotor for dem. -->

<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in() || !User::is_admin($session->user_id)) {redirect("login.php");} ?>

<?php
//Sjekker om brukeren er logget inn, kommer ikke nødvendigvis til å være nødvendig i prosjektet.
//Sender dem til login ved hjelp av funksjonen redirect i "functions.php".

$genres = array();

if (isset($_POST['submit'])) {

  $last_name = trim($_POST['last_name']); 
  $middle_name = trim($_POST['middle_name']);
  $first_name = trim($_POST['first_name']);
  $id = trim($_POST['id']);

  $users = User::find_user($first_name, $middle_name, $last_name, $id);

} else {

  $last_name = "";
  $middle_name = "";
  $first_name = "";
  $id = "";
  $users = User::find_all();

}
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


				<?php 
					include("admin_includes/admin_userlist.php");
				?>

		</tbody>
	</table>

<form id="user_search" action="" method="post">
<div class="">

  <div>
  <label>First Name</label>
  <input type="text" name="first_name" value="<?php echo htmlentities($first_name); ?>">
  </div>

  <div>
  <label>Middle Name</label>
  <input type="text" name="middle_name" value="<?php echo htmlentities($middle_name); ?>">
  </div>

  <div>
  <label>Last Name</label>
  <input type="text" name="last_name" value="<?php echo htmlentities($last_name); ?>">
  </div>

  <div>
  <label>ID</label>
  <input type="text" name="id" value="<?php echo htmlentities($id); ?>">
  </div>

</div>
<input type="submit" name="submit" value="Submit">

</form>

</div>  


<?php include("includes/footer.php"); ?>