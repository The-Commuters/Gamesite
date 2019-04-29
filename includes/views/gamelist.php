
<?php 

/**
 * This view is called in on index.php with
 * a ajax-function every time someone write
 * something into the search-input on the 
 * page.
 */

$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
require_once($path); 

if (isset($_GET['s'])) {
  $category = trim($_GET['c']); 
  $genre = trim($_GET['g']);
  $search = trim($_GET['s']);
  $games = Game::find_game($category, $genre, $search);

} else {
  $search = "";
  $category = "";
  $genre = "";
  $games = Game::find_game($category, $genre, $search);

}
?>

    <div class="cards">
  <!-- For each loop that runs trough all the elements in the $games array. -->
  <?php foreach ($games as $game) : 

    // A switch that decide what color to show.
    switch ($game->genre) {
      case 'Action': $color = "-red";
      break;
      case 'Adventure': $color = "-teal";
      break;
      case 'Comedy': $color = "-yellow";
      break;
      case 'Fantasy': $color = "-purple";
      break;
      case 'Idle': $color = "-indigo";
      break;
      case 'Romance': $color = "-pink";
      break;
      case 'Rouglike': $color = "-green";
      break;
      case 'Sport': $color = "-blue";
      break;
      case 'Simulation': $color = "-orange";
      break;
      case 'Strategy': $color = "-cyan";
      break;
      default: $color = "";
      break;
    }

  ?>

      <a href="gamepage.php?game=<?php echo $game->id; ?>" class="card">
        <div class="card-image" style="background-image: url(<?php echo $game->game_image_path() ?>)">
          <div class="card-image-content">
            <div>
              <div class="title"><?php echo $game->title; ?></div>
              <div class="author"><?php echo $game->creator; ?></div>
            </div>
            <div class="rating"><i class="fas fa-fw fa-heart"></i><span class="rating-placement"><?php echo $game->rating; ?></span></div>
          </div>
        </div>

        <div class="card-body">
          <section class="scroller"><?php echo $game->description; ?></section>

          <footer>
            <div class="chip <?php echo $color; ?>"><?php echo $game->genre; ?></div>
          </footer>
        </div>
      </a>

<?php endforeach; ?>

    </div>