<?php 

	/**
	 * This side is called on with ajax every time 
	 * someone rates a game. It saves or updates the 
	 * users rating in the database.
	*/

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 

	$rating          = new Rating;		  			// Creates here a new Rating-object.
	$rating->score   = $_GET['s'];        			// The score that the signed-in user gave the game.
	$rating->game_id = $_GET['g'];        			// The id of the game that the signed-in user rated.
	$rating->user_id = $session->user_id; 			// The id of the user that is signed-in.

	$rating->verify_Rating();             			// Sets here up or change the current rating from the user.

	$game  = Game::find_by_id($rating->game_id);	// Gather the whole game-object into $game.
	$score = $game->get_rating();					// Gets the average rating for the game with get_rating().
	echo $score; 									// Echo's here the game to be viewed by the users.

?>