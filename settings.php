<?php require_once("includes/header.php") ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php  
// The forms where signed in user can change their information.
// Should be placed in a popup of some kind or another page.
// Currently only here to place the users form they use to update their infomration.

if (empty($_GET['id'])) {
	$user = User::find_by_id($session->user_id);
} elseif (User::is_admin($session->user_id) && isset($_GET['id'])) {
	$user = User::find_by_id($_GET['id']);
} else {
	redirect("users.php");
}

if (isset($_POST['submit'])) {
	 
	$first_name = trim($_POST['first_name']);
	$middle_name = trim($_POST['middle_name']);
	$last_name = trim($_POST['last_name']);

	// Verify_update lies in User and check what is sent in, more parameters to be added.
	$error_array = User::verify_update($first_name, $middle_name, $last_name);

	if (empty($error_array)) {

		$user->first_name = $first_name;
		$user->middle_name = $middle_name;
		$user->last_name = $last_name;

		// Updates the user-row in the database.
		$user->update();
		echo "Updated!";
	} else {
		echo "Not updated!";
	}
} 

?>


<div>
	
<form id="login-id" action="" method="post">
	
<div class="">
	<label>First Name</label>
	<input type="text" name="first_name" value="<?php echo $user->first_name ?>" >
</div>

<div class="">
	<label>Middle Name</label>
	<input type="text" name="middle_name" value="<?php echo $user->middle_name; ?>" >
</div>

<div class="">
	<label>Last Name</label>
	<input type="text" name="last_name" value="<?php echo $user->last_name; ?>" >
</div>

<div class="">
<input type="submit" name="submit" value="Submit">

</div>

</form>

</div>
