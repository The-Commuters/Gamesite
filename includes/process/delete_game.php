<?php 

/**
 * Delete's the game from the database when this 
 * process is called with ajax, is used when a 
 * admin presses the button to delete a game. 
 * Is not used atm in the project
 */


$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
require_once($path); 

if (!$session->is_signed_in()) {redirect("login.php");} 

if (empty($_GET['id'])) {
	redirect("../../games.php");
}

// Finds and deletes the game with the id.
$game = Game::find_by_id($_GET['id']);
$game->delete();

redirect("../../games.php");

?>