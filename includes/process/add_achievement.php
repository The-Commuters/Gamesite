<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 

	if ($session->is_signed_in()) {

		$achievement = new Achievement();
		$achievement->id = $_GET["aId"];
		
		// If the achievement have not been gained before by this user.
		if ($achievement->check_if_gained()) {
			$achievement->verify_gained_achivement();

			// Here we need to show the achived achievement in the info.
			// Needs to be made.		
			?>

			<div id="alert" class="alert -warning -active">
				<div>Gained an achievement!</div>
			</div>
				
			<?php

		}

	}

?>

