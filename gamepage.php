<?php


/*
 * Dette her er siden som spillet blir lagt på, man kommer hit etter å ha
 * trykt på et spill i listen over spill, skal og inneholde et rating-system som
 * ligger under spillet.
*/

include("includes/views/header.php"); 

$current_game_id = $_GET['game'];
$game = Game::find_by_id($current_game_id);?>

<main class="gamepage">
	<div class="banner"><?php echo $game->title; ?>
    <!-- The rating checkbox only shows if the user is signed int -->
  <?php if ($session->is_signed_in()) { ?>

    <div class="heart-thing">
      <!-- If the checkbox is pressed the heart will be red, on click rate_game() will happen -->
      <input id="heart" type="checkbox" onchange="rate_game(<?php echo $game->id; ?>)"
      <?php echo (empty(Rating::check_if_rated($game->id, $user->id)) ? "" : "checked");?>/>
      <label for="heart"><i class="fas fa-heart"></i></label>
    </div>

  <?php } ?>
  </div>

  <div class="gamepage-container">
    <div class="gamepage-game">
    <?php
    // Includes the link to the canvas
    if (isset($game) && file_exists($game->game_path())) { include($game->game_path()); }
    ?>
    </div>

    <div class="chat gamepage-chat">
        <div class="header">
            <!-- The <a> is sent by the javascript that control the Html and css -->
            <div class="username">Chat</div>;
            <i id="state" class="state -away"></i>
        </div>
          <div class="view" id="view">

              <!-- Shows all the messages sent by read_chat.php inside here -->
              <div id="chatOutput"></div>

          </div>

          <div class="input">
              <textarea  rows="1" placeholder="Message" id="chat-input"></textarea>
          </div>

          <!-- Where room-id is stored in the value property -->
          <input id="chatId" style="display: none;" value="<?php echo $game->id; ?>">

          <!-- The javascript-file that holds the functions needed for the chat -->
          <script src="assets/js/chat_backend.js"></script>
      </div>
    </div>
</main>




<?php

//$chatroom_id = $current_game_id;
//include("includes/views/userchat.php");

include("includes/views/footer.php");

?>
