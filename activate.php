<?php require_once("includes/init.php") ?>
<?php include("includes/views/header.php"); ?>
<script src='assets/js/main.js'></script>


<?php if ($session->is_signed_in()) {redirect("profile.php");} ?>

<?php 


// Email::send_ActivationMail("newuser@localhost", "Markus", "hI" );

/**
* Sjekker om at det er noe i get variablen, 
* burde sjekke om det er det rette som blir sendt inn

*/
if (isset($_GET["code"])){
	$code = ($_GET["code"]);

	// henter inn koden og gir den vidre til aktiverings metoden 
	
?>
<div id="alert" class="alert -success -active">
			<?php 
			User::activate_user($code);
			?>
		</div>
<?php
	
}


else{
?>
<div id="alert" class="alert -warning -active">
			<?php 
			echo "Activation could not be completed" ;
			?>
		</div>
<?php
}

	


	
	//Email::create_reset_code("newuser@localhost.com");

	//Email::send_Password_resetMail("newuser@localhost", "Mark", "testcode");

?>



<?php include("includes/views/footer.php"); ?>