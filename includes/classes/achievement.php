<?php 

/**
 * Achievement-class will handle the achievements that 
 * is in the Achivements table in the database. Used
 * to collect the images and text when one need to show
 * the achievements of a user, when its earned or for
 * the game.
 */

class Achievement extends Db_object{

	protected static $db_table = "achievements"; 

	protected static $db_table_fields = array('id', 'title', 'text', 'game_id');
	public $id;
	public $title;
	public $text;
	public $game_id;

	/**
	 * 
	 *
	 * @param $achievement_id will be the id thats bind the user together to the achievement.  
	 */
	public function verify_gained_achivement() {

	}

}

?>