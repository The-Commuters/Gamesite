<?php 

/*
 * Dette her er siden som spillet blir lagt på, man kommer hit etter å ha 
 * trykt på et spill i listen over spill, skal og inneholde et rating-system som
 * ligger under spillet.
*/

include("includes/views/header.php"); ?>
    
  <div>
    <?php 
        $current_game_id = $_GET['game'];
        $game = Game::find_by_id($current_game_id);
        if (isset($game)) {
            include($game->game_path());       
        }    
    ?>
  </div>

<?php if ($session->is_signed_in()) { ?>
   
 <form id="gamescore" onchange="rate_game(<?php echo $game->id; ?>)">
  <input type="radio" name="stars" value="1"> 1 star
  <input type="radio" name="stars" value="2"> 2 star
  <input type="radio" name="stars" value="3"> 3 star
  <input type="radio" name="stars" value="4"> 4 star
  <input type="radio" name="stars" value="5"> 5 star
</form>

<?php } ?>

<div id="message">

<?php 
if ($score = $game->get_rating()) {
    echo $score; 
} else {
    echo "Game has never been rated";
}
?>

</div>

<script src="js/functions.js"></script>

 <?php include("includes/views/footer.php"); ?>
