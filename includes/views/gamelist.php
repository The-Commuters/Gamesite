
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

    <div class="cards">
  <!-- For each loop that runs trough all the elements in the $games array. -->
  <?php foreach ($games as $game) : ?>


      <a href="gamepage.php?game=<?php echo $game->id; ?>" class="card">
        <div class="card-image" style="background-image: url(<?php echo $game->game_image_path() ?>)">
          <div class="card-image-content">
            <div>
              <div class="title"><?php echo $game->title; ?></div>
              <div class="author"><?php echo $game->creator; ?></div>
            </div>
            <div class="rating"><i class="fas fa-fw fa-heart"></i><span class="rating-placement">#1</span></div>
          </div>
        </div>

        <div class="card-body">
          <section class="scroller">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat accusantium voluptate in impedit ab? Dolores 
          ratione ducimus veritatis aliquam libero vel! Quas sint quam placeat nesciunt sit suscipit, non ipsam!</section>

          <footer>
            <div class="chip -red">Action</div>
            <div class="chip -teal">Adventure</div>
          </footer>
        </div>
      </a>


<?php endforeach; ?>

    </div>