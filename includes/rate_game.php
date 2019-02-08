<?php include("init.php"); ?>

<?php 

$rating          = new Rating;
$rating->score   = $_GET['s'];
$rating->game_id = $_GET['g'];
$rating->user_id = $session->user_id;

// Setter her opp eller endrer ratingen i databasen.
$rating->verify_Rating();

// Tilkaller her funksjonen som viser frem average score.
$game  = Game::find_by_id($rating->game_id);
$score = $game->get_rating();
echo $score; 

?>