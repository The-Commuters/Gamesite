<?php 

/**
 * 
 */

$page = basename(__FILE__, '.php');
include("includes/views/header.php");
?>
<main class="games">

<!--
<div class="rating">
    <i class="fas fa-fw fa-star"></i>
    <i class="fas fa-fw fa-star"></i>
    <i class="fas fa-fw fa-star"></i>
    <i class="fas fa-fw fa-star"></i>
    <i class="fas fa-fw fa-star"></i>
</div>
-->
    <div class="category">
        <header>
            <div class="category-title">Popular</div>

            <form class="category-searchbar">
                <input type="text" placeholder="Find a game" class="bar">
                <div class="search">
                    <i class="fas fa-fw fa-search"></i>
                </div>
            </form>

            <div class="sort">
                <i class="fas fa-fw fa-sort"></i>
            </div>
        </header>

        <div class="cards">
            <a href="" class="card">
                <div class="card-image" style="background-image: url(assets/img/game.jpg)">
                    <div class="card-image-content">
                        <div>
                            <div class="title">Titanrise</div>
                            <div class="author">Titandev</div>
                        </div>
                        <div class="rating"><i class="fas fa-fw fa-heart"></i><span class="rating-placement">#1</span></div>
                    </div>
                </div>

                <div class="card-body">
                    <section class="scroller">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat accusantium voluptate in impedit ab? Dolores ratione ducimus veritatis aliquam libero vel! Quas sint quam placeat nesciunt sit suscipit, non ipsam!</section>

                    <footer>
                        <div class="chip -red">Action</div>
                        <div class="chip -teal">Adventure</div>
                    </footer>
                </div>
            </a>

            <a href="" class="card">
                <div class="card-image" style="background-image: url(assets/img/game.jpg)">
                    <div class="card-image-content">
                        <div>
                            <div class="title">Titanrise</div>
                            <div class="author">Titandev</div>
                        </div>
                        <div class="rating"><i class="fas fa-fw fa-heart"></i><span class="rating-placement">#2</span></div>
                    </div>
                </div>

                <div class="card-body">
                    <section class="scroller">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat accusantium voluptate in impedit ab? Dolores ratione ducimus veritatis aliquam libero vel! Quas sint quam placeat nesciunt sit suscipit, non ipsam!</section>

                    <footer>
                        <div class="chip -pink">Romance</div>
                        <div class="chip -green">Rougelike</div>
                    </footer>
                </div>
            </a>

            <a href="" class="card">
                <div class="card-image" style="background-image: url(assets/img/game.jpg)">
                    <div class="card-image-content">
                        <div>
                            <div class="title">Titanrise</div>
                            <div class="author">Titandev</div>
                        </div>
                        <div class="rating"><i class="fas fa-fw fa-heart"></i><span class="rating-placement">#4</span></div>
                    </div>
                </div>

                <div class="card-body">
                    <section class="scroller">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat accusantium voluptate in impedit ab? Dolores ratione ducimus veritatis aliquam libero vel! Quas sint quam placeat nesciunt sit suscipit, non ipsam!</section>

                    <footer>
                        <div class="chip -orange">Simulation</div>
                        <div class="chip -cyan">Strategy</div>
                    </footer>
                </div>
            </a>

            <a href="" class="card">
                <div class="card-image" style="background-image: url(assets/img/game.jpg)">
                    <div class="card-image-content">
                        <div>
                            <div class="title">Titanrise</div>
                            <div class="author">Titandev</div>
                        </div>
                        <div class="rating"><i class="fas fa-fw fa-heart"></i><span class="rating-placement">#4</span></div>
                    </div>
                </div>

                <div class="card-body">
                    <section class="scroller">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat accusantium voluptate in impedit ab? Dolores ratione ducimus veritatis aliquam libero vel! Quas sint quam placeat nesciunt sit suscipit, non ipsam!</section>

                    <footer>
                        <div class="chip -blue">Sport</div>
                        <div class="chip -indigo">Idle</div>
                        <div class="chip -purple">fantasy</div>
                    </footer>
                </div>
            </a>
        </div>
    </div>


</main>

<?php include("includes/views/footer.php"); ?>