<?php 

/**
 * The process that registers a user after being
 * called on by ajax, runs the verify_new _user-
 * method and posts error or sucess alert.
 */

$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
require_once($path);

$username = trim($_GET['u']); 
$email = trim($_GET['e']);
$password = trim($_GET['p']);
$password_check = trim($_GET['pc']);

// The User-method that checks if the user-informastion is valid, and collects potential errors.
$error_array = User::verify_new_user($username, $email, $password, $password_check);	

// If there was no errors, then...
if (empty($error_array)) {
	
	?>
	<div id="alert" class="alert -success -active">
		<?php echo "The user creation have been sucsessfully finished, an activation email have been sent to your email!"; ?>
	</div>

	<?php } else { ?>

	<div id="alert" class="alert -warning -active">
		<?php 

		// Sends out the complete error-array.
		if (!empty($error_array)) {
			foreach ($error_array as $error_message) {
				echo $error_message . "<br>";
			}
		} else {
			echo "Your information are incorrect.";
		}

		?>
	</div>
<?php } ?>
