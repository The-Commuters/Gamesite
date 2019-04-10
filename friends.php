<?php 

/**
 * This is the page where teh friend-list is placed
 * All of the friends of the signed in users is listed
 * here.
 */

include("includes/views/header.php");

if (!$session->is_signed_in()) {redirect("login.php");} 

if (!isset($_GET['f'])) {
  $search = "";
  $friend = Friendship::find_friends($user->id);
}

?>

<main class="friendlist">
    <h1 class="friendlist-title">Friends</h1>

    <div class="friendlist-container">
        <div class="friend">
            <div class="friend-info">
                <div style="background-image: url(assets/img/avatar.jpg)" class="avatar -s"></div>
                <div class="username">Ripmoff</div>
            </div>

            <div class="friend-status">
                <div class="status -active"></div>
                <div class="description">Online</div>
            </div>

            <div class="friend-actions">
                <a href="chat.php" class="action">
                    <i class="fas fa-fw fa-comment-alt"></i>
                </a>

                <div class="action -delete">
                    <i class="fas fa-fw fa-user-times"></i>
                </div>
            </div>
        </div>

        <div class="friend">
            <div class="friend-info">
                <div style="background-image: url(assets/img/avatar2.jpg)" class="avatar -s"></div>
                <div class="username">Daniel</div>
            </div>

            <div class="friend-status">
                <div class="status -away"></div>
                <div class="description">Idle</div>
            </div>

            <div class="friend-actions">
                <a href="chat.php" class="action">
                    <i class="fas fa-fw fa-comment-alt"></i>
                </a>

                <div class="action -delete">
                    <i class="fas fa-fw fa-user-times"></i>
                </div>
            </div>
        </div>

        <div class="friend">
            <div class="friend-info">
                <div style="background-image: url(assets/img/avatar3.jpg)" class="avatar -s"></div>
                <div class="username">Mafen</div>
            </div>

            <div class="friend-status">
                <div class="status -busy"></div>
                <div class="description">Do Not Disturb</div>
            </div>

            <div class="friend-actions">
                <a href="chat.php" class="action">
                    <i class="fas fa-fw fa-comment-alt"></i>
                </a>

                <div class="action -delete">
                    <i class="fas fa-fw fa-user-times"></i>
                </div>
            </div>
        </div>

        <div class="friend">
            <div class="friend-info">
                <div style="background-image: url(assets/img/avatar4.jpg)" class="avatar -s"></div>
                <div class="username">Harimir</div>
            </div>

            <div class="friend-status">
                <div class="status"></div>
                <div class="description">Offline</div>
            </div>

            <div class="friend-actions">
                <a href="chat.php" class="action">
                    <i class="fas fa-fw fa-comment-alt"></i>
                </a>

                <div class="action -delete">
                    <i class="fas fa-fw fa-user-times"></i>
                </div>
            </div>
        </div>
    </div>

</main>







<?php include("includes/views/footer.php"); ?>