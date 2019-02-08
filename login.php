<?php require_once("includes/header.php") ?>

<?php 
//Tar her inn informasjonen til personen som logger inn, sjekker om de eksisterer i databasen, tar i bruk session.php til å ta vare på session-variablene.

// Hvis man er logget inn blir man sendt til index.php.
if ($session->is_signed_in()) {redirect("index.php");}

if (isset($_POST['submit'])) {
	echo "User found!";
		
	$email = trim($_POST['email']); 
	$password = trim($_POST['password']);

	//Sjekker om brukeren er i databasen, ved metode som ligger i User-klassen(user.php)
	$user_found = User::verify_user($email, $password);

	if ($user_found) {
		
		//tar i bruk login() metoden til å legge ting in i $user_id, sette $signed_in til true og sender dem til index.php med en redirect();.
		$session->login($user_found);
		redirect("index.php");
	} else {
		$the_message = "Your password or email are incorrect.";
	}

} else {

		$email = "";
		$password = "";
		$the_message = "";

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


				<!-- Controlls -->
				<div class="login-controllers">
					<!-- Sign up -->
					<button class="button-text">Sign up</button>

					<!-- log in -->
					<input type="submit" name="submit" class="button-contained" value="submit">
				</div>

				<!-- Feilmeldingen kommer til å bli vist her -->
				<div class="login-fail">
					<h4><?php echo $the_message; ?></h4>
				</div>


			</form>

		</div>

		<!-- Login image container -->
		<div class="login-image" style="background-image: url(img/login.jpg)"></div>
	</main>