<?php 

	/**
	 * Delete's the game from the database when this 
	 * process is called with ajax, is used when a 
	 * admin presses the button to delete a game. 
	 */


	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 

	if (!$session->is_signed_in()) {redirect("login.php");} 

	if (empty($_GET['id'])) {
		redirect("../../games.php");
	}

	$game = Game::find_by_id($_GET['id']);

	$game->delete();

	redirect("../../games.php");

?>