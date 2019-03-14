
<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 

// If a user is logged in, collect all information about that user.
if ($session->is_signed_in()) {
    $user = User::find_by_id($session->user_id);
}

// Collects the pagename, is useful when you need to decide what page you are on.
$page = $_SERVER['REQUEST_URI'];
$page = substr($page, 10);
?> 


<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        // Calls here in the head.php that lies in the helpers folder
        include("includes/helpers/head.php");
    ?>
     
</head>
<body>
        <!-- Header -->
    <header>
        <!-- XP Bar -->
        <div class="bar">
            <div class="xp" Style="width: 70%"></div>
        </div>

        <!-- Header content-->
        <div class="header -main">
            <!-- Branding icon-->
            <a href="index.php" class="brand"><img src="assets/img/brand.svg" alt="Brand"></a>

            <!-- Navigation -->
            <nav>
                <a href="index.php" class="item <?php if($page == "index.php"){echo "-active";}?>">Games</a>
                <a href="index.html" class="item <?php if($page == "about.php"){echo "-active";}?>">About</a>
                <a href="index.html" class="item <?php if($page == "faq.php"){echo "-active";}?>">FAQ</a>
            </nav>

            <?php if ($session->is_signed_in()) { ?>

            <!-- Avatar (Only show when logged in)-->
            <div class="profile dropdown -left">
                <a href="profile.php?id=<?php echo $user->id;?>" class="profile">
                    <div class="username"><?php echo $user->username; ?></div>
                    <div style="background-image: url(<?php echo $user->get_user_image(); ?>)" class="avatar"></div>
                </a>

                <div class="list">
                    <a href="profile.php?id=<?php echo $user->id;?>">Profile</a>
                    <a href="settings.php">Settings</a>
                    <a href="achievement.php">Achievements</a>
                    <a href="statistics.php">Statistics</a>
                    <a href="upload.php">Submit game</a>
                    <?php if (User::is_admin($user->id)) { ?>
                        <a href="users.php">Users</a>
                    <?php } ?>
                    <a href="logout.php">Logout</a>
                </div>
            </div>

            <?php } else { ?>

            <!-- Register / login (Only show when not logged in)-->
            <div class="login-controllers">
                <!-- Sign up -->
                <a href="register.php#username" class="button-text">Sign up</a>

                <!-- log in -->
                <a href="login.php#email" class="button-contained">Sign in</a>
            </div>

            <?php } ?>  

        </div>
    </header>
