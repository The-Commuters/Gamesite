
<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 

//Sjekker om brukeren er logget inn, kommer ikke nødvendigvis til å være nødvendig i prosjektet.
//Sender dem til login ved hjelp av funksjonen redirect i "functions.php".

$genres = array();

if (isset($_GET['s'])) {

  $category = trim($_GET['c']); 
  $genre = trim($_GET['g']);
  $search = trim($_GET['s']);
  
  $games = Game::find_game($category, $genre, $search);

} else {

  $search = "";
  $games = Game::find_all();

}
?>

 <table>
  <thead>
   <tr>
    <th>Game</th>
    <th>Id</th>
    <th>File Name</th>
    <th>Title</th>
    <th>Genre</th>
    <th>Creator</th>
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
	<td><a href="gamepage.php?game=<?php echo $game->id; ?>"><?php echo $game->filename; ?></a></td>
	<td><?php echo $game->title; ?></td>
	<td><?php echo $game->genre; ?></td>
  <td><?php echo $game->creator; ?></td>
  <td><?php echo $game->size; ?></td>

  <?php 
  if ($session->is_signed_in()) {
    if (User::is_admin($session->user_id)) { ?>
	<td><a href="includes/process/delete_game.php?id=<?php echo $game->id; ?>" 
		onclick="return confirm('Are you sure you want to delete <?php echo $game->title ?>')">Delete</a></td>
  <?php
      } 
    } 
  ?>


</tr>

<?php endforeach; ?>

</tbody>
</table>