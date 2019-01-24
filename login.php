<?php require_once("includes/header.php") ?>

<?php 
//Tar her inn informasjonen til personen som logger inn, sjekker om de eksisterer i databasen, tar i bruk session.php til å ta vare på session-variablene.

// Hvis man er logget inn blir man sendt til index.php.
if ($session->is_signed_in()) {redirect("index.php");}

if (isset($_POST['submit'])) {
	
	$username = trim($_POST['username']); 
	$password = trim($_POST['password']);

	//Sjekker om brukeren er i databasen, ved metode som ligger i User-klassen(user.php)
	$user_found = User::verify_user($username, $password);

	if ($user_found) {
		
		//tar i bruk login() metoden til å legge ting in i $user_id, sette $signed_in til true og sender dem til index.php med en redirect();.
		$session->login($user_found);
		redirect("index.php");
	} else {
		$the_message = "Your password or username are incorrect.";
	}

} else {

		$username = "";
		$password = "";
		$the_message = "";

	}
?>

<div>

<!-- Feilmeldingen kommer til å bli vist her -->
<h4><?php echo $the_message; ?></h4>
	
<form id="login-id" action="" method="post">
	
	<div class="">
		<label>Username</label>

		<!-- htmlentities er en tryggere måte å sette inn en string på -->
		<input type="text" name="username" value="<?php echo htmlentities($username); ?>" >

	</div>

	<div class="">
		<label>Password</label>
		<input type="password" name="password" value="<?php echo htmlentities($password); ?>">
		
	</div>


	<div class="">
		<input type="submit" name="submit" value="Submit">
	</div>


</form>

</div>