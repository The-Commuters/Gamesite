<?php include("includes/header.php"); ?>

<?php 
//Sjekker om brukeren er logget inn, kommer ikke nødvendigvis til å være nødvendig i prosjektet.
//Sender dem til login ved hjelp av funksjonen redirect i "functions.php".

$genres = array();

if (isset($_POST['submit'])) {

  $creator = trim($_POST['creator']); 
  $title = trim($_POST['title']);
  if (isset($_POST['genre_array'])) {
    $genres = $_POST['genre_array'];
  }
  

  $games = Game::find_game($genres, $title, $creator);

} else {

  $title = "";
  $creator = "";
  $games = Game::find_all();

}
?>

<div >  

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

  <?php 
  if ($session->is_signed_in()) {
    if (User::is_admin($session->user_id) && isset($session->user_id)) {
      include("admin_includes/admin_gamelist.php");
    } else {
      include("includes/user_gamelist.php");
    }
  } else {
    include("includes/user_gamelist.php");
  }

  ?>

</tbody>
</table>

<form id="game_search" action="" method="post">
<div class="">

  <label>Game Creator</label>
  <input type="text" name="creator" value="<?php echo htmlentities($creator); ?>">
  
</div>

<div class="">

  <label>Game Title</label>
  <input type="text" name="title" value="<?php echo htmlentities($title); ?>">
  
</div>

<div>
  
  <input type="checkbox" name="genre_array[]" value="Action" 
  <?php if (in_array("Action", $genres)) {echo "checked";} ?>> <label>Action</label><br/>

  <input type="checkbox" name="genre_array[]" value="Comedy" 
  <?php if (in_array("Comedy", $genres)) {echo "checked";} ?>> <label>Comedy</label><br/>

  <input type="checkbox" name="genre_array[]" value="Slice Of Life" 
  <?php if (in_array("Slice Of Life", $genres)) {echo "checked";} ?>> <label>Slice Of Life</label><br/>

</div>

<div class="">
<input type="submit" name="submit" value="Submit">

</div>
</form>

</div>

<?php include("includes/footer.php"); ?>