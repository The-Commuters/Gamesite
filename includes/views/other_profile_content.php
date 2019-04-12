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
			<div style="background-image: url(<?php echo $user->get_user_image();?>)" class="avatar -s user"></div>
			<div class="username"><?php echo $user->username;?></div>
			<a class="action" onclick="start_chat(<?php echo $session->user_id .',' . $user->id?>)"><i class="fas fa-fw fa-comment-alt"></i></a>
		</div>
		<div class="profile-content">
			<h2 class="title">Personal information</h2>
			<div class="content">
				<div class="profile-info">
					<div class="tag">First Name</div>
					<div class="info"><?php echo $user->first_name;?></div>
				</div>

				<div class="profile-info">
					<div class="tag">Middle Name</div>
					<div class="info"><?php echo $user->middle_name;?></div>
				</div>

				<div class="profile-info">
					<div class="tag">Last Name</div>
					<div class="info"><?php echo $user->last_name;?></div>
				</div>
			</div>

			<h2 class="title">Achievements</h2>
			<div class="content">
			<?php 
			$gained_achievements = Gained_Achievement::get_gained_achievements($user->id);
			foreach ($gained_achievements as $gained_achievement) :

				$achievement = new Achievement();
				$achievement = Achievement::find_by_id($gained_achievement->achievement_id);
				?>


				<div class="achievement">
					<div style="background-image: url(<?php echo $achievement->get_achievement_image() ?>)" class="achievement-image"></div>
					<div class="achievement-content">
						<div class="title"><?php echo $achievement->title; ?></div>
						<div class="description"><?php echo $achievement->text; ?></div>
					</div>
				</div>


				<?php 
			endforeach;
			?>
			</div>
		</div>
	</div>

</main>

<?php
}
?>