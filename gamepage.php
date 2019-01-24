<?php include("includes/header.php"); ?>
    
    <?php 
        $current_game = $session->current_game;
        if (isset($current_game)) {
            include($current_game);       
        }    
    ?>


  <?php include("includes/footer.php"); ?>