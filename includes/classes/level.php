<?php 

/**
 * The level object-class that holds the levels
 * that the users can be at, they are placed in
 * the database and the needed xp to be the level
 * is placed in it, uses id as the level.
 */

class Level extends Db_object{

	protected static $db_table = "level"; 

	protected static $db_table_column = array('needed_xp');
	public $id;
	public $needed_xp;


function calc_user_level() {

	global $session;

    $user = User::find_by_id($session->user_id);
	$user_xp = $user->experience_points;
	$levels = Level::find_all();
	$current_user_level = 0;	

	// Collects the needed xp to get to the next level, and the level of the user.
	foreach ($levels as $level) {
		if ($level->needed_xp >= $user_xp && $user_xp !== 0) {
			if ($level->id != 0) {
				$current_user_level = $level->id-1;	
			}

			// Breaks out of the foreach.
			break; 
		}
	}
	// Calculates the percentage of to the next level.
	return $current_user_level;	
}

function calc_needed_xp() {

	global $session;

    $user = User::find_by_id($session->user_id);
	$user_xp = $user->experience_points;
	$levels = Level::find_all();
	$current_needed_xp = 25;

	// Collects the needed xp to get to the next level, and the level of the user.
	foreach ($levels as $level) {
		if ($level->needed_xp >= $user_xp && $user_xp !== 0) {
			$current_needed_xp = $level->id-1;	

			// Breaks out of the foreach.
			break; 
		}
	}
	// Calculates the percentage of to the next level.
	return $current_needed_xp;	
}

function Calc_xp_percentage($user_xp, $current_needed_xp) {
	return ($user_xp/$current_needed_xp)*100;
}

}

?>