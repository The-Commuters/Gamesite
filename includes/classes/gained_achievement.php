<?php 

/**
 * gained_achievement-class will handle the achievements earned inside of games,
 * will resemble the achievement-class and work close to it, as things will be
 * collected from that class, will bind together a user and a achievement.
 */

class Gained_Achievement extends Db_object{

	protected static $db_table = "gained_achievements"; 
	protected static $db_table_column = array('achievement_id', 'user_id', 'gained');
	public $achievement_id;
	public $user_id;
	public $gained;

	/**
	 * Creates a row in the database with the user_id
	 * of the user that earned the achievement and the
	 * id of it together with the date.
	 *
	 * @param $achievement_id will be the achievement_id thats bind the user together to the achievement.  
	 */
	public function verify_gained_achivement() {

		global $session;

		$this->gained  = date("Y-m-d");
		$this->user_id = $session->user_id;

		$this->create();

	}

	/**
	 * Checks if the user have already gained the achievement,
	 * is used to stop the user from earning a achievement and
	 * experience points two times.
	 *
	 * @return false if the achievement is gained, false if true.
	 */
	public function check_if_gained() {

		global $session;

		$achievement_id = $this->achievement_id;
		$user_id = $session->user_id;

		$sql = "SELECT * FROM gained_achievements WHERE ";
		$sql .= "achievement_id = '{$achievement_id}' ";
		$sql .= "AND user_id = '{$user_id}' ";
		$sql .= "LIMIT 1";

		$result = self::find_by_query($sql);

		if (!empty($result)) {
			return false;
		}
		return true;

	}

	/**
	 * Collects the gained achievements that a user have, and
	 * is used in the achievement list on the profile. Sends
	 * back an array of gained_achievements-objects.
	 *
	 */
	public function get_gained_achievements($user_id) {

		global $database;

		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "user_id = '{$user_id}' ";

		return static::find_by_query($sql);

	}

}

?>