<?php require_once("includes/header.php") ?>

<?php 
//Tar her inn informasjonen til personen som logger inn, sjekker om de eksisterer i databasen, tar i bruk session.php til å ta vare på session-variablene.


/* Hvis man er logget inn blir man sendt til index.php.*/
if ($session->is_signed_in()) {redirect("index.php");}

if (isset($_POST['submit'])) {
	 

	$username = trim($_POST['username']); 
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$password_check = trim($_POST['password_check']);
	$first_name = trim($_POST['first_name']);
	$middle_name = trim($_POST['middle_name']);
	$last_name = trim($_POST['last_name']);

	//Sjekker om brukeren er i databasen, ved metode som ligger i User-klassen(user.php)
	//$user_found = User::verify_user($username, $password);

	$error_array = User::verify_new_user($username, $email, $password, $password_check, $first_name, $middle_name, $last_name);	

	if (empty($error_array)) {
		
		//tar i bruk login() metoden til å legge ting in i $user_if, sette $signed_in til true og sender dem til index.php.
		//$session->login($user_found);
		redirect("login.php");

	} else {
		// Kan gjøre det bedre her, sette et error-array foran input-boksene sån som vi gjorde ved forrige prosjekt.
		$the_message = "Your information are incorrect.";
	}

} else {

		$username = "";
		$email = "";
		$password = "";
		$password_check = "";
		$the_message = "";
		$first_name = "";
		$middle_name = "";
		$last_name = "";
		$error_array = "";

	}


?>


<!-- Formen som jeg tar i bruk. -->
<div>
<!-- Feilmeldinger kommer her -->
<h4><?php echo $the_message; ?></h4>
	
<form id="login-id" action="" method="post">
	
<div class="">
	<label>Username</label>
	<!-- htmlentities er en tryggere måte å sette inn en string på -->
	<input type="text" name="username" value="<?php echo htmlentities($username); ?>" >

</div>

<div class="">
	<label>Email</label>
	<!-- htmlentities er en tryggere måte å sette inn en string på -->
	<input type="text" name="email" value="<?php echo htmlentities($email); ?>" >

</div>

<div class="">
	<label>First Name</label>
	<!-- htmlentities er en tryggere måte å sette inn en string på -->
	<input type="text" name="first_name" value="<?php echo htmlentities($first_name); ?>" >

</div>

<div class="">
	<label>Middle Name</label>
	<!-- htmlentities er en tryggere måte å sette inn en string på -->
	<input type="text" name="middle_name" value="<?php echo htmlentities($middle_name); ?>" >

</div>

<div class="">
	<label>Last Name</label>
	<!-- htmlentities er en tryggere måte å sette inn en string på -->
	<input type="text" name="last_name" value="<?php echo htmlentities($last_name); ?>" >

</div>

<div class="">
	<label>Password</label>
	<input type="password" name="password" value="<?php echo htmlentities($password); ?>">
	
</div>

<div class="">
	<label>Password_Check</label>
	<input type="password" name="password_check" value="<?php echo htmlentities($password_check); ?>">
	
</div>

<?php 
// Legger her ut alle error-meldingene på rad, hvis det er noen.
if (!empty($error_array)) {
	foreach ($error_array as $error_message) {
		echo $error_message . "<br>";
	}
}

?>

<div class="">
<input type="submit" name="submit" value="Submit">

</div>

</form>

</div>