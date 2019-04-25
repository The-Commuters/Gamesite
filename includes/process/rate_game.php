<?php 

	/**
	 * This side is called on with ajax every time 
	 * someone rates a game. It saves or updates the 
	 * users rating in the database.
	*/

	$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
	require_once($path); 

	$rating          = new Rating;		  			// Creates here a new Rating-object.
	$rating->game_id = $_GET['g'];        			// The id of the game that the signed-in user rated.
	$rating->user_id = $session->user_id; 			// The id of the user that is signed-in.

	$rating->verify_Rating();             			// Sets here up or change the current rating from the user.
?>