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

  <?php endforeach; ?>

</tbody>
</table>

</div>

<?php include("includes/footer.php"); ?>