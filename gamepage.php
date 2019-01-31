<?php include("includes/header.php"); ?>
    
    <?php 
        $current_game_id = $_GET['game'];
        $game = Game::find_by_id($current_game_id);
        if (isset($game)) {
            include($game->game_path());       
        }    
    ?>

 <?php include("includes/footer.php"); ?>