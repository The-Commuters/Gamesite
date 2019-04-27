<?php 

/**
 * This is the page where people can create a new user,
 * this have to be done to become able to use a few of 
 * the functions on the website.
 */

require_once("includes/views/header.php");

if ($session->is_signed_in()) {redirect("index.php");}

?>

<main>
	<div class="banner">Register</div>
</form>

<!-- The alert is placed here -->
<div id="image"></div>

</div>

<main>
<!-- Login -->
<form class="login login-spacing" id="login" action="" method="post">

<!-- Title -->
<div class="login-title-container">
	<h1 class="login-title">Register</h1>
</div>


<div class="login-input">
	<!-- E-mail input -->
	<div class="float-label">
		<input type="email" name="email" id="email" placeholder="E-mail" required>
		<label for="email">E-mail</label>
	</div>

	<!-- Username -->
	<div class="float-label">
		<input type="text" name="username" id="username" placeholder="Username" required>
		<label for="username">Username</label>
	</div>

	<!-- Password input -->
	<div class="float-label">
		<input type="password" name="password" id="password" placeholder="Password" required>
		<label for="password">Password</label>
	</div>

	<!-- Password input check -->
	<div class="float-label">
		<input type="password" name="password_check" id="password_check" placeholder="Password" required>
		<label for="password">Password_Check</label>
	</div>
</div>


<!-- Controls -->
<div class="login-controllers">
	<!-- Sign in -->
	<a href="login.php#email" class="button-text">Sign in</a>

	<!-- Sign up -->
	<input type="button" name="submit" class="button-contained" value="Sign up" onclick="registerUser()">
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
</main>