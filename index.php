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
}

?>

<main class="games">

    <div class="category">
        <header>
            <div class="category-title">Popular</div>

            <form class="category-searchbar">
                <input type="text" placeholder="Find a game" class="bar" onkeyup="update_gamelist()" id="search">
                <div class="search">
                    <i class="fas fa-fw fa-search"></i>
                </div>

                <!-- Temporary solution -->
                <select id="category" onchange="update_gamelist()">
                  <option value="" selected="selected">Category</option>
                  <option value="title">Title</option>
                  <option value="creator">Creator</option>
                </select>

                <select id="genre" onchange="update_gamelist()">
                  <option value="" selected="selected">Genre</option>
                  <option value="action">Action</option>
                  <option value="comedy">Comedy</option>
                  <option value="slice of life">Slife Of Life</option>
                </select>

            </form>

            <div class="sort">
                <i class="fas fa-fw fa-sort"></i>
            </div>
        </header>



<div id="gameslist">
    <?php include("includes/views/gamelist.php"); ?>
</div>
        
    </div>

</main>

<?php include("includes/views/footer.php"); ?>