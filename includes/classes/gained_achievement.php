<?php 

/**
 * Achievement-class will handle the achievements earned inside of games
 */

class Gained_Achievement extends Db_object{

	protected static $db_table = "gained_achievements"; 

	protected static $db_table_fields = array('achievement_id', 'user_id', 'gained');
	public $achievement_id;
	public $user_id;
	public $gained;

	/**
	* Denne skal lage et achivement-objekt som så skal sendes inn til databasen.
	* Objektet skal være satt sammen med rader fra både users og achievements.
	* Skal kunne kalles på inne i spill hvis en viss handling skal skje.
	* Feks: alle ball-objekter blir spist av en spillerstyrt slange.
	* Kallet blir da noe alla: verify_achivement($user_id, $achivement_id); 
	*
	* @param $achievement_id will be the achievement_id thats bind the user together to the achievement.  
	*/
	public function verify_gained_achivement() {

		global $session;

		$achievement_id = $this->achievement_id;

		$this->gained  = date("Y-m-d");
		$this->user_id = $session->user_id;

		$this->create();

	}

	/**
	 * Checks if the user have already gained the achievement,
	 * is used to stop the user from earning a achievement and
	 * experience points two times.
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

	public function get_gained_achievements($user_id) {

		global $database;

		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "user_id = '{$user_id}' ";

		return static::find_by_query($sql);

	}

}

?>