<?php include("includes/header.php"); ?>

<?php  
//Sjekker om brukeren er logget inn, kommer ikke nødvendigvis til å være nødvendig i prosjektet.
//Sender dem til login ved hjelp av funksjonen redirect i "functions.php".
if (!$session->is_signed_in()) {redirect("login.php");}
?>

<?php 

$message = "";
if (isset($_POST['submit'])) {

	$game = new Game();
	$game->title = $_POST['title'];

	// Sets up the object correctly by using set_file();
	$game->set_file($_FILES['file_upload']);

	if ($game->save()) {
		$message = "Game is correctly added to the website.";
	} else {
		$message = join("<br>", $game->errors);
	}

}

?>

<p> <b> The upload of games currently works in a specific way:</b> <br>
1. Make one php-file that contains the canvas for the game, named like "snakegame".<br>
2. Make one image that you want to show in the gamelist, named "image.png".<br>
3. Put all the files in a folder with the the same name as the main php-file, like "snakegame".<br>
4. Place all the other files you need into the same folder.<br>
5. Turn the folder into a ZIP-file, with "Send to" on right click.<br>
6. Upload the ZIP-file down under.
 </p>

<?php echo $message;  ?>
<!-- This will be the upload form for games. -->
<form action="upload.php" method="post" enctype="multipart/form-data">
   
   <div>
      <input type="text" name="title" placeholder="Insert game-title">
  </div>

  <div>
      <input type="file" name="file_upload">
  </div>

  <div>
      <input type="submit" name="submit" value="Upload Game">
  </div>

</form>

<?php include("includes/footer.php"); ?>