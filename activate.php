<?php require_once("includes/init.php") ?>
<?php include("includes/views/header.php"); ?>


<!-- <?php if ($session->is_signed_in()) {redirect("profile.php");} ?> -->

<?php 


// Email::send_ActivationMail("newuser@localhost", "Markus", "hI" );

/**
* Sjekker om at det er noe i get variablen, 
* burde sjekke om det er det rette som blir sendt inn

*/
if (isset($_GET["code"])){
	$code = ($_GET["code"]);

	// henter inn koden og gir den vidre til aktiverings metoden 
	User::activate_user($code);
}
elseif (isset($_GET["reset_code"])) {
	$reset_code = ($_GET["reset_code"]);

	// henter inn koden og gir den vidre til aktiverings metoden 
	$code = Email::find_user_by_reset_code($reset_code);
	
	$shifted_code = array_shift($code);
	$user_id = $shifted_code->id;



	$user = User::find_by_id($user_id);
	
	var_dump($user);

	


}
else{
	echo "Activation could not be completed \n" ;
}

	
	//Email::create_reset_code("newuser@localhost.com");

	//Email::send_Password_resetMail("newuser@localhost", "Mark", "testcode");

?>



<script src="js/functions.js"></script>

<?php include("includes/views/footer.php"); ?>