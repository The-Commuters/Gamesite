<?php 



	$path = __DIR__ ."\..\init.php";
	require_once($path); 

	$game = new Game();
	$game->title = $_POST['title'];

	// Sets up the object correctly by using set_file();
	$game->set_file($_FILES['file_upload']);

	if ($game->save()) {
		$message = "Game is correctly added to the website.";
	} else {
		$message = join("<br>", $game->errors);
	}




?>