<?php 

/**
 * Achievement-class will handle the achievements earned inside of games
 */

class Achievement extends Db_object{

	protected static $db_table = "gained_achievements"; 

	protected static $db_table_fields = array('id', 'user_id', 'gained');
	public $achievements_id;
	public $user_id;
	public $gained;

	/**
	* Denne skal lage et achivement-objekt som så skal sendes inn til databasen.
	* Objektet skal være satt sammen med rader fra både users og achievements.
	* Skal kunne kalles på inne i spill hvis en viss handling skal skje.
	* Feks: alle ball-objekter blir spist av en spillerstyrt slange.
	* Kallet blir da noe alla: verify_achivement($user_id, $achivement_id); 
	*
	* @param $achievement_id will be the id thats bind the user together to the achievement.  
	*/
	public function verify_gained_achivement() {

		global $session;

		$id = $this->id;

		$this->gained  = date("Y-m-d");
		$this->user_id = $session->user_id;

		$this->create();

	}

	/**
	 *
	 *
	 */
	public function check_if_gained() {

		global $session;

		$id = $this->id;
		$user_id = $session->user_id;

		$sql = "SELECT * FROM gained_achievements WHERE ";
		$sql .= "id = '{$id}' ";
		$sql .= "AND user_id = '{$user_id}' ";
		$sql .= "LIMIT 1";

		$result = self::find_by_query($sql);

		if (!empty($result)) {
			return false;
		}
		return true;

	}


}

?>