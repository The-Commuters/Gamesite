<?php 

/**
 * This is the profile of users othen than the user that is signed in to the site.
 * On this page the signed in user
 */

if (empty($_GET['id'])) {
	redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

?>


<?php 
// Chat with if friend
if (User::is_friend($session->user_id, $user->id)) {
?>

<main>
	<h1 class="banner">Profile</h1>

	<div class="profile">
		<div class="profile-user">
			<div style="background-image: url(assets/img/avatar.jpg)" class="avatar -s user"></div>
			<div class="username">Ripmoff</div>
			<a href="chat.php" class="action"><i class="fas fa-fw fa-comment-alt"></i></a>
		</div>
		<div class="profile-content">
			<h2 class="title">Personal information</h2>
			<div class="content">
				<div class="profile-info">
					<div class="tag">First Name</div>
					<div class="info">David</div>
				</div>

				<div class="profile-info">
					<div class="tag">Middle Name</div>
					<div class="info">Naist</div>
				</div>

				<div class="profile-info">
					<div class="tag">Last Name</div>
					<div class="info">Øvernes</div>
				</div>
			</div>

			<h2 class="title">Achievements</h2>
			<div class="content">
				<div class="achievement">
					<div style="background-image: url(assets/img/avatar.jpg)" class="achievement-image"></div>
					<div class="achievement-content">
						<div class="title">Shovler</div>
						<div class="description">Use a shovel to dig some dirt</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</main>

<?php
}
?>