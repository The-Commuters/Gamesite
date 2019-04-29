<?php 

/**
 * The process file that uploads the file to
 * the folder and creates a row in the games
 * table in the database.
 */

$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
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