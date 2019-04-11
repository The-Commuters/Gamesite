<?php 

/**
 * The login page where users can login to the website 
 * by typing their email and password into a form and
 * pressing the submit button.
 */

require_once("includes/init.php");
?>
<head>

	<?php

	include("includes/helpers/head.php");

	?>    

</head>
<?php
if ($session->is_signed_in()) {redirect("index.php");}

if (isset($_POST['submit'])) {

	$email = trim($_POST['email']); 
	$password = trim($_POST['password']);

	$user_found = User::verify_user($email, $password);

	if ($user_found) {
		$session->login($user_found);
		redirect("index.php");

	} else {

		?>
		<div id="alert" class="alert -warning -active">
			<div>Your password or email are incorrect.</div>
		</div>

		<?php
	}

} else {
	$email = "";
	$password = "";
}

?>


<!-- Main -->
<main class="login-wrapper">
	<!-- Login container-->
	<div class="login-container">

		<!-- Login -->
		<form class="login" id="login" action="" method="post">

			<!-- Title -->
			<div class="login-title-container">
				<h1 class="login-title">Login</h1>
			</div>


			<div class="login-input">
				<!-- E-mail input -->
				<div class="float-label">
					<input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo htmlentities($email); ?>">
					<label for="email">E-mail</label>
				</div>

				<!-- Password input -->
				<div class="float-label">
					<input type="password" name="password" id="password" placeholder="Password" value="<?php echo htmlentities($password); ?>">
					<label for="password">Password</label>
				</div>
			</div>


			<!-- Controls -->
			<div class="login-controllers">
				<!-- Sign up -->
				<a href="register.php#username" class="button-text">Sign up</a>

				<!-- password reset -->
				<a href="reset.php" class="button-text">Lost Password?</a>

				<!-- log in -->
				<input type="submit" name="submit" id="submit" class="button-contained" value="submit">
			</div>

			<script type="text/javascript">
				document.getElementById("login").onkeypress = function(e) {
					var key = e.charCode || e.keyCode || 0;     
					if (key == 13) {
						e.preventDefault();
					}
				}
			</script>

		</form>

	</div>

	<!-- Login image container -->
	<div class="login-image" style="background-image: url(assets/img/login.jpg)"></div>
</main>

