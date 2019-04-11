<?php 

	/**
	 * 
	 */

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 


	$username = trim($_GET['u']); 
	$email = trim($_GET['e']);
	$password = trim($_GET['p']);
	$password_check = trim($_GET['pc']);

	$error_array = User::verify_new_user($username, $email, $password, $password_check);	

	if (empty($error_array)) {
		
		?>
		<div id="alert" class="alert -success -active">
			<?php 
				echo "The user creation have been sucsessfully finished, an activation email have been sent to your email!";
			?>
		</div>

		<?php

	} else {
		?>
		<div id="alert" class="alert -warning -active">
			<?php 
			if (!empty($error_array)) {
				foreach ($error_array as $error_message) {
					echo $error_message . "<br>";

				}
			} else {
				echo "Your information are incorrect.";
			}
			?>
		</div>
	</div>

	<?php
}
?>
