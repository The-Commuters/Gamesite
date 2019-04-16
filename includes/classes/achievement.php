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

	protected static $db_table_column = array('id', 'title', 'text', 'image', 'game_id', 'experience_points');
	public $id;
	public $title;
	public $text;
	public $image;
	public $game_id;
	public $experience_points;

	/**
	 * Collects the images from the achievement folder that
	 * is placed in the assets folder, the image links will
	 * be stored inside of the $image of this achievement.
	 */
	public function get_achievement_image() {

		return "assets/" . "img/" . "achievements/" . $this->image;
	}


}

?>