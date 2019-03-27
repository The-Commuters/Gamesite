<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 

$first_name  = trim($_GET['fname']);
$middle_name = trim($_GET['mname']);
$last_name   = trim($_GET['lname']);

	// Verify_update lies in User and check what is sent in, more parameters to be added.
$error_array = User::verify_update($first_name, $middle_name, $last_name);

if (empty($error_array)) {

	$user = User::find_by_id($session->user_id);
	$user->first_name = $first_name;
	$user->middle_name = $middle_name;
	$user->last_name = $last_name;

	$user->update();

} else {
	echo "Not updated!";
}

?>

<!-- The alert that is shown when '-active' is placed in the classlist. -->
<div id="alert" class="alert -warning -active">
	<div>Your name have been updated!</div>
</div>