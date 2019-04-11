<?php require_once("includes/init.php") ?>
<?php include("includes/views/header.php"); ?>
<script src='assets/js/main.js'></script>

<!-- <?php if ($session->is_signed_in()) {redirect("profile.php");} ?> -->

<?php 

if (isset($_POST['submit'])) {

	// Fjerner eventuelle tagger og stringer som kan skade databasen
	$email = trim($_POST['email']);
	// Skjuler passord setting når den andre er i bruk 
	
	//Putter brukerens email inni metoden create_reset_code
	$error_array = Email::create_reset_code($email);

	if (empty($error_array)) {

		$the_message="Email sent";
		
	} else {

		$the_message = "Your information is incorrect.";
	}

} else {
	$email          = "";
	$the_message 	= "";
	$error_array    = "";
}

?>

<div id="email_reset">
	
	<h4><?php echo $the_message; ?></h4>

<!-- 
Åpner en form for slik at brukeren kan skrive inne sin epost for å så kunne få til sent en passord tilbakestillingsepost

-->

<form id="email_form" action="" method="post">

	<div>
		<label>Email</label>
		<input type="email" name="email" value="<?php echo htmlentities($email); ?>" required  >

	</div>
	
	<!-- Div tagger for knapper -->
	<div class="">
		<input type="submit" name="submit" value="Submit">

	</div>

</form>

</div>

<?php 


if (isset($_GET["reset_code"])) {

	// Gjør at det som er inni div taggen ikke vises til brukeren
	echo "<script>
	hide('email_reset');
	</script>";

	$reset_code = ($_GET["reset_code"]);

	// henter inn koden og gir den vidre til aktiverings metoden 
	$code = Email::find_user_by_reset_code($reset_code);

	if($code == true) {

		//var_dump($error_array);
		$the_message="Please set your password";

		$user_id = $code->id;

		$user = User::find_by_id($user_id);

		if (isset($_POST['submit_password'])) {

			$password = trim($_POST['password']);
			$password_check = trim($_POST['password_check']);

			// I am unsure where i want to place this, because i need to get the id or the user object to this method 
			$error_array = User::verify_password_update($user->id,$password, $password_check );


			if (empty($error_array)) {

				var_dump($user);

				$the_message="Password set";

			} else {

				$the_message= "Your new password could not be set";
			}

		} else {

			$password       = "";
			$password_check = "";
			$the_message 	= "";
			$error_array    = "";

		}

	}
	else {

	echo "<script>
	hide('password_setting');
	</script>";

	$password       = "";
	$password_check = "";
	$the_message = "Your link is broken/incorrect.";
	}

}
?>

<!-- Password reset form 
Here the user will put in their new password twice and submit it for checks agianst our database 
-->

<div id='password_setting'>
	<h4><?php echo $the_message; ?></h4>
	<form id="" method="post" action="" >
		
		<div class="">
			<label>Password</label>
			<input type="password" name="password" value="<?php echo htmlentities($password); ?>">

		</div>

		<div class="">
			<label>Password Check</label>
			<input type="password" name="password_check" value="<?php echo htmlentities($password_check); ?>">

		</div>

		<div class="">
			<input type="submit" name="submit_password" value="Submit">

		</div>
	</form>

</div>

<?php 

/*Hvis det er meldinger i errorarray blir de skrivt ut til brukeren med ny linje*/

if (!empty($error_array)) {
	foreach ($error_array as $error_message) {
		echo $error_message . "<br>";

	}
}

?>

<?php include("includes/views/footer.php"); ?>