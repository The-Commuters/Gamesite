<?php 

/**
 * The index-page will be where people enter the website
 * and it will also be where users can search for games.
 */

$page = basename(__FILE__, '.php');
include("includes/views/header.php"); 

$genres = array();

if (!isset($_GET['s'])) {
  $search = "";
  $users = User::find_all();

}

?>

<div>  

  <form id="game_search" >
    <div class="">

      <label>Game Search</label>
      <input type="text" onkeyup="update_gamelist()" id="search" value="<?php echo htmlentities($search); ?>">

      <select id="category" onchange="update_gamelist()">
        <option value="" selected="selected">All</option>
        <option value="title">Title</option>
        <option value="creator">Creator</option>
      </select>

      <select id="genre" onchange="update_gamelist()">
        <option value="" selected="selected">All</option>
        <option value="action">Action</option>
        <option value="comedy">Comedy</option>
        <option value="slice of life">Slife Of Life</option>
      </select>
    </div>

  </form>

  <div id="gameslist">
    <?php include("includes/views/gamelist.php"); ?>
  </div>

</div>

<?php include("includes/views/footer.php"); ?>