
<?php 

/**
 * This is the page where the users can change their data,
 * Can only be reached by admins with the access to the
 * userlist or the users themself.
 */

if (empty($_GET['id'])) {
  redirect("index.php");
}

$user = User::find_by_id($session->user_id);

require_once("includes/views/header.php");

if (!$session->is_signed_in()) {redirect("login.php");} 

?>

<!-- The alert is placed here -->
<div id="image"></div>

<main>
	<h1 class="banner">Profile</h1>

	<div class="profile">
		<div class="profile-user">
			<div style="background-image: url(<?php echo $user->get_user_image();?>)" class="avatar -s user"></div>
			<div class="username"><?php echo $user->username;?></div>
			<a class="action" onclick="startChat(<?php echo $session->user_id .',' . $user->id?>)"><i class="fas fa-fw fa-comment-alt"></i></a>
		</div>
		<div class="profile-content">
			<h2 class="title">Personal information</h2>
			<div class="content">
	        	<form>
					<div class="profile-info">
						<div class="tag">First Name</div>
						<input id="fname" type="text" name="first_name" value="<?php echo $user->first_name ?>" >
					</div>

					<div class="profile-info">
						<div class="tag">Middle Name</div>
						<input id="mname" type="text" name="middle_name" value="<?php echo $user->middle_name; ?>" >
					</div>

					<div class="profile-info">
						<div class="tag">Last Name</div>
						<input id="lname" type="text" name="last_name" value="<?php echo $user->last_name; ?>" >
	  			    </div>

			        <div class="profile-info">
			          <input class="button-contained" type="button" name="submit" value="Submit" onclick="updateNames()">
			        </div>
	      		</form>

		      	<div class="profile-info">
		        	<div class="tag">Change photo</div>

		        	<div class="drop-zone" id="drop_zone" ondrop="uploadFile(event)" ondragover="return false">
		          		<div id="drag_upload_file">
		            		<div class="drop-zone-actions">
		              			<div>Drag a file or press the button</div>
		              			<input type="button" value="Select File" onclick="findFile();" class="button-outlined">
		            		</div>
		            		<input type="file" id="selectfile">
		          		</div>
		        	</div>
		      	</div>
			</div>

			<h2 class="title">Achievements</h2>
			<div class="content">
			<?php 

			// Will show of achievements that the user have gained.
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