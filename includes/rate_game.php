<?php include("init.php"); ?>

<?php 

echo "Funker!";


$rating          = new Rating;
$rating->score   = $_GET['s'];
$rating->game_id = $_GET['g'];
echo $rating->score ;
echo $rating->game_id ;
$rating->user_id = $session->user_id;

$rating->verify_Rating();
echo "OK!";



?>