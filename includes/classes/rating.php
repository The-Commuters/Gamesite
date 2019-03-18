<?php 

/**
 * Rating-classs holds objekts that are created when a user
 * decides to grade a game, the game_id is the id of the 
 * rated game and the user_id is the id of the user that
 * rated it. 
 */

class Rating extends Db_object {

	protected static $db_table = "ratings"; 

	protected static $db_table_fields = array('game_id', 'user_id', 'score');
	public $id; 
	public $game_id;
	public $user_id;
	public $score;

	/**
	 * Whenever a logged in user decides to rate a game, and presses 
	 * one of the radio-buttons, this method will be called. It will
	 * place a new row in the ratings-table and or update one depending
	 * on if the user have rated the game before.
	 */
	public function verify_Rating() {

		global $session;
		global $database;

		$score   = $database->escape_string($this->score);
		$game_id = $database->escape_string($this->game_id);
		$user_id = $session->user_id;

		$rating  = new Rating();

		$rating->score   = $score;
		$rating->game_id = $game_id;
		$rating->user_id = $user_id;
	
		$sql  = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "user_id = '{$user_id}' ";
		$sql .= "AND game_id = '{$game_id}' ";
		$sql .= "LIMIT 1";

		$the_result_array = self::find_by_query($sql);

		if (!empty($the_result_array)) {
			$rating->id = $the_result_array[0]->id;
			$rating->update();
		} else {
			$rating->create();
		}

	}

} // End of Ratings-class.



?>