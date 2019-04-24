<?php 

/*
 * Dette her er siden som spillet blir lagt på, man kommer hit etter å ha 
 * trykt på et spill i listen over spill, skal og inneholde et rating-system som
 * ligger under spillet.
*/

include("includes/views/header.php"); ?>

<div>

  <?php 
  
  /**
   * Collects the id of the game from the URL and includes
   * the link to the canvas, if there is no game nothing 
   * will be shown.
   */
  $current_game_id = $_GET['game'];
  $game = Game::find_by_id($current_game_id);
  if (isset($game) && $game->filename != "") {
    include($game->game_path());    

  } 

  ?>
  
</div>

<!-- The rating checkbox only shows if the user is signed int -->
<?php if ($session->is_signed_in()) { ?>

    <!-- If the checkbox is pressed the heart will be red, on click rate_game() will happen -->
    <input id="heart" type="checkbox" onchange="rate_game(<?php echo $game->id; ?>)" 
      <?php echo (empty(Rating::check_if_rated($game->id, $user->id)) ? "" : "checked");?>/>
    <label for="heart"><i class="fas fa-heart"></i></label>

<?php } ?>

<div id="message">
<!--
  <?php 
  if ($score = $game->get_rating()) {
    echo $score; 
  } else {
    echo "Game has never been rated";
  }
  ?>
-->
</div>

<?php 

//$chatroom_id = $current_game_id;
//include("includes/views/userchat.php"); 

include("includes/views/footer.php"); 

?>
