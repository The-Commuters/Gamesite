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

    <form action="">
        
        <select id="genre" class="hide-element" onchange="update_gamelist()">
            <option value="" selected="selected">Genre</option>
            <option value="Action">Action</option>
            <option value="Comedy">Comedy</option>
            <option value="Adventure">Adventure</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Idle">Idle</option>
            <option value="Rougelike">Rougelike</option>
            <option value="Sport">Sport</option>
            <option value="Simulation">Simulation</option>
            <option value="Strategy">Strategy</option>
            <option value="Romance">Romance</option>
        </select>
    </form>

    <form class="game-search" >
        <div class="search-button">
            <i class="fas fa-search"></i>
        </div>

        <input placeholder="Search for game here" onkeyup="update_gamelist()" id="search" class="search-input" />
    </form>

    <div class="category">
        <header>
            <div class="category-title">Popular</div>

            <div class="game-options">
                <!-- Genre -->
                <div class="dropdown -left">
                    <div class="option">
                        <i class="fas fa-fw fa-book"></i>
                    </div>

                    <!--
                      --  Action red
                      --  Adventure teal
                      --  Comedy yellow
                      --  Fantasy purple
                      --  Idle indigo
                      --  Romance pink
                      --  Rouglike green
                      --  Sport blue
                      --  Simulation orange
                      --  Strategy cyan
                    -->
                    <div id="genrelist" class="list">
                        <div class="genre active"data-genre="">All Genres</div>
                        <div class="genre" data-genre="Adventure">Adventure</div>
                        <div class="genre" data-genre="Action">Action</div>
                        <div class="genre" data-genre="Comedy">Comedy</div>
                        <div class="genre" data-genre="Fantasy">Fantasy</div>
                        <div class="genre" data-genre="Idle">Idle</div>
                        <div class="genre" data-genre="Romance">Romance</div>
                        <div class="genre" data-genre="Rougelike">Rougelike</div>
                        <div class="genre" data-genre="Sport">Sport</div>
                        <div class="genre" data-genre="Simulation">Simulation</div>
                        <div class="genre" data-genre="Strategy">Strategy</div>
                    </div>
                </div>

                <script src="assets/js/gamelist_sorting.js"></script>
            </div>
        </header>

        <div id="gameslist">
            <?php include("includes/views/gamelist.php"); ?>
        </div>
    </div>

</main>

<?php include("includes/views/footer.php"); ?>