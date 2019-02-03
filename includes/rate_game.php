<?php include("init.php"); ?>

<?php 

echo "Funker!";


$rating          = new Rating;
$rating->score   = intval($_GET['s']);
$rating->game_id = intval($_GET['g']);
echo $rating->score ;
echo $rating->game_id ;
$rating->user_id = $session->user_id;

$rating->verify_Rating();
echo "OK!";



?>