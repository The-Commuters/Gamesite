<?php include("includes/header.php"); ?>

<?php 


// Email::send_ActivationMail("newuser@localhost", "Markus", "hI" );

/**
* Sjekker om at det er noe i get variablen, 
* burde sjekke om det er det rette som blir sendt inn

*/
if (isset($_GET["code"])){
	$code = ($_GET["code"]);

	User::activate_user($code);

}else{
	echo "Activation could not be completed";
}


?>


<script src="js/functions.js"></script>

<?php include("includes/footer.php"); ?>