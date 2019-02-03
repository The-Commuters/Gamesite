<?php include("includes/header.php"); ?>
    
    <?php 
        $current_game_id = $_GET['game'];
        $game = Game::find_by_id($current_game_id);
        if (isset($game)) {
            include($game->game_path());       
        }    
    ?>

 <?php include("includes/footer.php"); ?>

 <!-- Rating in here for now, might add it into a include with ajax at a later point. -->

 <form onchange="rate_game(this.value)">
  <input type="radio" name="stars" value="1"> 1 star
  <input type="radio" name="stars" value="2"> 2 star
  <input type="radio" name="stars" value="3"> 3 star
  <input type="radio" name="stars" value="4"> 4 star
  <input type="radio" name="stars" value="5"> 5 star
</form>

<div id="message">Tilbakemelding will bli vist her!</div>

<script>
function rate_game(score) {

	var game_id = '<?php echo $current_game_id; ?>';

    if (score == "") {
        document.getElementById("message").innerHTML = "";
        return;
    } else { 

        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("message").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET","includes/rate_game.php?s="+score+"&g="+game_id,true);
        xmlhttp.send();
    }
}
</script>