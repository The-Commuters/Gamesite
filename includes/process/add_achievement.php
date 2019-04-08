<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 

	if ($session->is_signed_in()) {

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


			// Posts the alert for the earned achievement on the screen
			?>
			<div id="alert" class="alert -warning -active">
				<img style="width: 100px; height: 100px;">
				<div>Gained an achievement!</div>
			</div>
			<?php

		}

	}

?>

