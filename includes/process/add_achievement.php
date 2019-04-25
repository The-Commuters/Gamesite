<?php
	
	/**
	 * This file will add an achievement to the user
	 * by creating a gained_achievement row in the table
	 * that connects the user an dachievement together.
	 */

	$path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
	require_once($path); 
	
	// Only does this if the user is signed in.
	if ($session->is_signed_in()) {

		// Places the id in a new Gained_Achievement-object.
		$gained_achievement = new Gained_Achievement();
		$gained_achievement->achievement_id = $_GET["aId"];
		
		// If the achievement have not been gained before by this user.
		if ($gained_achievement->check_if_gained()) {

			// Uploads the new achievement.
			$gained_achievement->verify_gained_achivement();
			$achievement_id = $gained_achievement->achievement_id;

			// Collects the achievement from the database by using the achievement-id.
			$achievement = new Achievement();
			$achievement = Achievement::find_by_id($achievement_id);

			// Adds here the experience points to the user's experience_points in their row.
			$user = new User();
			$user = User::find_by_id($session->user_id);
			$user->experience_points += $achievement->experience_points;
			$user->update();

			// Posts the alert for the earned achievement on the screen
			?>
			<div id="alert" class="alert -success -active">
				<img style="width: 100px; height: 100px;" src="<?php echo $achievement->get_achievement_image(); ?>">
				<div><?php echo $achievement->title ?></div>
				<div><?php echo $achievement->text ?></div>
				<div></div>
			</div>
			<?php

		}

	}

?>

