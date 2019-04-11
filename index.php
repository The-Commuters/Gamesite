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
                    <div class="list">
                        <div>Adventure</div>
                        <div>Action</div>
                        <div>Comedy</div>
                        <div>Fantasy</div>
                        <div>Idle</div>
                        <div>Romance</div>
                        <div>Rouglike</div>
                        <div>Sport</div>
                        <div class="active">Simulation</div>
                        <div>Strategy</div>
                    </div>
                </div>

                <!-- Sort -->
                <div class="dropdown -left">
                    <div class="option">
                        <i class="fas fa-fw fa-sort"></i>
                    </div>

                    <div class="list">
                        <div>Popularity</div>
                        <div>Title</div>
                        <div>Creator</div>
                        <div>Newest</div>
                        <div class="active">Oldest</div>
                    </div>
                </div>
            </div>
        </header>

        <div id="gameslist">
            <?php include("includes/views/gamelist.php"); ?>
        </div>
    </div>

</main>

<?php include("includes/views/footer.php"); ?>