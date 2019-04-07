<?php 

// Includes teh php-file that defines the path's and includes the object classes.
require_once("includes/init.php");

//If somone is signed in, place the signed in user in the $user variable.
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
				<a href="about.php" class="item <?php if($page == "about"){echo "-active";} ?>">About</a>
				<a href="contact.php" class="item <?php if($page == "contact"){echo "-active";} ?>">Contact</a>
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
						<a href="friends.php"><i class="fas fa-fw fa-user-friends"></i>Friendlist</a>
						<a href="chat.php"><i class="fas fa-fw fa-envelope"></i>Messages</a>

						<?php if ($user->is_admin($user->id)) { ?>

						<a href="users.php"><i class="fas fa-fw fa-users"></i>User list</a>

						<?php } ?>

						<hr class="divider">
						<a href="donate.php"><i class="fas fa-fw fa-heart"></i>Donate</a>
						<a href="upload.php"><i class="fas fa-fw fa-upload"></i>Submit game</a>

						<hr class="divider">
						<a href="logout.php"><i class="fas fa-fw fa-sign-out-alt"></i>Sign out</a>

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
