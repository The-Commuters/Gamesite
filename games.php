<?php include("includes/header.php"); ?>

<?php 
//Sjekker om brukeren er logget inn, kommer ikke nødvendigvis til å være nødvendig i prosjektet.
//Sender dem til login ved hjelp av funksjonen redirect i "functions.php".

$games = Game::find_all();

?>
<div >  

 <table>
  <thead>
   <tr>
    <th>Game</th>
    <th>Id</th>
    <th>File Name</th>
    <th>Title</th>
    <th>Size</th>
  </tr>
</thead>
<tbody>

 <!-- For each loop that runs trough all the elements in the $games array. -->
 <?php foreach ($games as $game) : ?>

   <tr>

    <td>
      <a href="<?php echo $game->game_path();?>">
        <img src="<?php echo $game->game_image_path();?>" style="height: 100px; width: 100px;">
      </a>
    </td>
    <td><?php echo $game->id; ?></td>
    <!-- The <a> leads to the canvas that the game is played in. -->
      <td><a href="<?php echo $game->game_path();?>"><?php echo $game->filename; ?></a></td>
      <td><?php echo $game->title; ?></td>
      <td><?php echo $game->size; ?></td>

    </tr>

    <!-- Ends the foreach loop here.-->
  <?php endforeach; ?>

</tbody>
</table>

</div>

<?php include("includes/footer.php"); ?>