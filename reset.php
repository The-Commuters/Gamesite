<?php require_once("includes/init.php") ?>
<?php include("includes/views/header.php"); ?>
<script src='assets/js/main.js'></script>

<!-- <?php if ($session->is_signed_in()) {redirect("profile.php");} ?> -->

<main>
	<h1 class="banner">Reset password</h1>
<?php 

if (isset($_POST['submit'])) {

	// Fjerner eventuelle tagger og stringer som kan skade databasen
	$email = trim($_POST['email']);
	// Skjuler passord setting når den andre er i bruk 
	
	//Putter brukerens email inni metoden create_reset_code
	$error_array = Email::create_reset_code($email);

	if (empty($error_array)) {
		?>
		<div id="alert" class="alert -success -active">
				<div>Email sent. Please check your email</div>
			</div>
		<?php
		
	} else {
		?>

			<div id="alert" class="alert -warning -active">
				<div>Your information is incorrect.</div>
			</div>

		<?php
		$error_message = "Your information is incorrect.";
	}

} else {
	$email          = "";
	$error_message 	= "";
	$error_array    = "";
}

?>

<div id="email_reset">
	
	<h4></h4>

<!-- 
Åpner en form for slik at brukeren kan skrive inne sin epost for å så kunne få til sent en passord tilbakestillingsepost

-->

<form class="login login-spacing" id="email_form" action="" method="post">

<!-- Title -->
<div class="login-title-container">
	<h2 class="login-title">Reset password</h2>
</div>


<div class="login-input">
	<!-- E-mail input -->
	<div class="float-label">
		<input type="email" name="email" placeholder="E-mail" id="email" value="<?php echo htmlentities($email); ?>" required  >
		<label for="email">E-mail</label>
	</div>

	
</div>
	<!-- Controls -->
	<div class="login-controllers">
		<!-- Sign up -->
		<input type="submit" name="submit" class="button-contained" value="Submit">
	</div>

</form>

</div>

<?php 


if (isset($_GET["reset_code"])) {


	// Gjør at det som er inni div taggen ikke vises til brukeren
	
	$reset_code = ($_GET["reset_code"]);

	// henter inn koden og gir den vidre til aktiverings metoden 
	$in = Email::find_user_by_reset_code($reset_code);

	if(!empty($in)) {

		//var_dump($error_array);
		$code = array_shift($in);
		//$error_message="Please set your password";

		$user_id = $code->id;

		$user = User::find_by_id($user_id);

		if (isset($_POST['submit_password'])) {

			$password = trim($_POST['password']);
			$password_check = trim($_POST['password_check']);

			// I am unsure where i want to place this, because i need to get the id or the user object to this method 
			$error_array = User::verify_password_update($user->id,$password, $password_check );


			if (empty($error_array)) {
				Email::invalitate_reset_code($user_id);
				//var_dump($user_id);
				?>
				<div id="alert" class="alert -success -active">
					<div>Password set.</div>
				</div>
	
			<?php


				//$error_message="Password set";


			} else {
				?>

				<div id="alert" class="alert -warning -active">
					<div>Your new password must match</div>
				</div>
	
			<?php
				$error_message= "Your new password could not be set";
			}

		} else {

			$password       = "";
			$password_check = "";
			$error_message 	= "";
			$error_array    = "";

		}

	}
	else {
	$password       = "";
	$password_check = "";
	//$error_array    = "";

	?>
				<div id="alert" class="alert -warning -active">
					<div>Your reset link is broken/incorrect/used.</div>
				</div>
	
			<?php

	$error_message = "Your link is broken/incorrect.";
	}
}


?>

<!-- Password reset form 
Here the user will put in their new password twice and submit it for checks agianst our database 
-->



<div id="password_setting">
	

<form class="login login-spacing" id="password_form" method="post" action="">

	<!-- Title -->
	<div class="login-title-container">
		<h2 class="login-title">Enter new password</h2>
	</div>


	<div class="login-input">
		<!-- Password input -->
		<div class="float-label">
			<input type="password" name="password" placeholder="Password" id="password" value="<?php echo htmlentities($password); ?>" rquired>
			<label for="password">Password</label>
		</div>

		<!-- Password input check -->
		<div class="float-label">
			<input type="password" name="password_check" placeholder="Password" id="password_check" value="<?php echo htmlentities($password_check); ?>" rquired>
			<label for="password_check">Password check</label>
		</div>
	</div>

	<!-- Controls -->
	<div class="login-controllers">
		<!-- Sign up -->
		<input type="submit" name="submit_password" class="button-contained" value="Reset password">
	</div>

</form>

</div>


<?php 

if (!isset($_GET["reset_code"])){

			echo "<script>
			hide('password_setting');
			</script>";  
		}	

else{
	echo "<script>
	hide('email_reset');
	</script>";
}
	

/*Hvis det er meldinger i errorarray blir de skrivt ut til brukeren med ny linje*/

?>
<!--
<div id="alert" class="alert -warning -active">
			<?php 
			/*
			if (!empty($error_array)) {
				foreach ($error_array as $error_message) {
					echo $error_message . "<br>";
					

				}
			}
			else {

				echo "<script>
			hideAlert();
			</script>";  
			}
			*/
			?>
			
		</div>
		-->			

</main>

<?php include("includes/views/footer.php"); ?>