<?php require_once("includes/init.php") ?>
<?php include("includes/views/header.php"); ?>

<!-- <?php if ($session->is_signed_in()) {redirect("profile.php");} ?> -->

<?php 

if (isset($_POST['submit'])) {

	// Fjerner eventuelle tagger og stringer som kan skade databasen	 
	$email = trim($_POST['email']);

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

<div>
<h4><?php echo $the_message; ?></h4>

<!-- 
Åpner en form for slik at brukeren kan skrive inne sin epost for å så kunne få til sent en passord tilbakestillingsepost

-->
	
<form id="reset-password" action="" method="post">

<div class="">
	<label>Email</label>
	<input type="email" name="email" value="<?php echo htmlentities($email); ?>" required  >

</div>

 <?php 

/*Hvis det er meldinger i errorarray blir de skrivt ut til brukeren med ny linje*/

if (!empty($error_array)) {
	foreach ($error_array as $error_message) {
		echo $error_message . "<br>";

	}
}

?>

<!-- Div tagger for knapper -->
<div class="">
<input type="submit" name="submit" value="Submit">

</div>

</form>

</div>

<?php 



if (isset($_GET["reset_code"])) {

	$reset_code = ($_GET["reset_code"]);

	// henter inn koden og gir den vidre til aktiverings metoden 
	$code = Email::find_user_by_reset_code($reset_code);
	
	$shifted_code = array_shift($code);
	$user_id = $shifted_code->id;

	$user = User::find_by_id($user_id);
	
	//var_dump($user);

}
else{

}

	//Email::create_reset_code("newuser@localhost.com");

	//Email::send_Password_resetMail("newuser@localhost", "Mark", "testcode");

?>



<?php include("includes/views/footer.php"); ?>