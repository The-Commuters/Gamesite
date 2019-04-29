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

/**
 * Calculates the user level based on the amount
 * of 'Erfaringspoeng' the user have gained.
 *
 * @return the current level of the signed in user.
 */
function calc_user_level() {

	global $session;

    $user = User::find_by_id($session->user_id);
	$user_xp = $user->experience_points;
	$levels = Level::find_all_objects();
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

/**
 * Calculates the needed 'Erfaringspoeng' that
 * the user need to get to the next level, is
 * used to calculate the percentage done to the
 * nexr level(the bar at top of header).
 *
 * @return the needed xp to the next level.
 *
 */
function calc_needed_xp() {

	global $session;

    $user = User::find_by_id($session->user_id);
	$user_xp = $user->experience_points;
	$levels = Level::find_all_objects();
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

/**
 * Calculates the percentage of 'erfaringspoeng' from
 * the current level that is needed to get to the next,
 * is used when the bar on the top that shows a green
 * line that grows when the user earn experience.
 * 
 * @param $user_xp is the current xp of the user.
 * @param $current_needed_xp is the needed 'Erfaringspoeng' to the next level.
 * @return the percentage to the next level.
 */
function Calc_xp_percentage($user_xp, $current_needed_xp) {
	return ($user_xp/$current_needed_xp)*100;
}

}

?>