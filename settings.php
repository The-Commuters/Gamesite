<?php 

/**
 * This is the page where the users can change their data,
 * Can only be reached by admins with the access to the
 * userlist or the users themself.
 */

require_once("includes/views/header.php");

if (!$session->is_signed_in()) {redirect("login.php");} 

if (empty($_GET['id'])) {
	$user = User::find_by_id($session->user_id);
} elseif (User::is_admin($session->user_id) && isset($_GET['id'])) {
	$user = User::find_by_id($_GET['id']);
} else {
	redirect("users.php");
}

if (isset($_POST['submit'])) {
	 
	$first_name  = trim($_POST['first_name']);
	$middle_name = trim($_POST['middle_name']);
	$last_name   = trim($_POST['last_name']);

	// Verify_update lies in User and check what is sent in, more parameters to be added.
	$error_array = User::verify_update($first_name, $middle_name, $last_name);

	if (empty($error_array)) {

		$user->first_name = $first_name;
		$user->middle_name = $middle_name;
		$user->last_name = $last_name;

		//$user->upload_profile_picture($_FILES['file_upload']);

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

<!-- Upload image to use as user-picture -->
<div class="">
  	<label>Profile Picture</label>
    <input type="file" name="file_upload">
</div>

<!-- Change password -->

<div class="">
<input type="submit" name="submit" value="Submit">

</div>

</form>

</div>
