<?php 



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