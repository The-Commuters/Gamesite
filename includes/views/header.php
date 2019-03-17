
<?php 

require_once("includes/init.php");

/*$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); */

// If a user is logged in, collect all information about that user.
if ($session->is_signed_in()) {
    $user = User::find_by_id($session->user_id);
}


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
		<div class="xp">
			<div class="xp-bar" Style="width: 70%"></div>
		</div>

		<!-- Header content-->
		<div class="header">

			<!-- Navigation -->
			<nav>
				<!-- Branding icon-->
				<a href="index.php" class="brand"><img src="assets/img/brand-green.svg" alt="Brand"></a>

				<!-- Other items-->
				<a href="index.php" class="item <?php if($page == "index"){echo "-active";} ?>">Games</a>
				<a href="#" class="item">About</a>
				<a href="#" class="item">Contact</a>
            </nav>

            <?php if ($session->is_signed_in()) { ?>

            <div class="interaction">
				<!-- Avatar (Only show when logged in)-->
				<div class="dropdown -center">
					<div class="profile">
						<div style="background-image: url(<?php echo $user->get_user_image(); ?>)" class="avatar"></div>
						<div class="icon-buffer"><i class="fas fa-angle-down icon"></i></div>
					</div>

					<div class="list">
                        <a href="profile.php?id=<?php echo $user->id;?>"><i class="fas fa-fw fa-user"></i>Profile</a>
						<a href="settings.php"><i class="fas fa-fw fa-cog"></i>Settings</a>
						<a href="chat.php"><i class="fas fa-fw fa-envelope"></i>Messages</a>
						<a href="logout.php"><i class="fas fa-fw fa-sign-out-alt"></i>Sign out</a>
						<hr class="divider">
						<a href="#"><i class="fas fa-fw fa-heart"></i>Donate</a>
						<a href="upload.php"><i class="fas fa-fw fa-upload"></i>Submit game</a>
					</div>
				</div>

				<!-- Notifications -->
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
