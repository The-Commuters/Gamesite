<?php 

/**
 * Rating-classs holds objekts that are created when a user
 * decides to grade a game, the game_id is the id of the 
 * rated game and the user_id is the id of the user that
 * rated it. 
 */

class Rating extends Db_object {

	protected static $db_table = "ratings"; 

	protected static $db_table_fields = array('game_id', 'user_id');
	public $id; 
	public $game_id;
	public $user_id;

	/**
	 * Whenever a logged in user decides to rate a game, and presses 
	 * one of the radio-buttons, this method will be called. It will
	 * place a new row in the ratings-table and or update one depending
	 * on if the user have rated the game before.
	 */
	public function verify_Rating() {

		global $session;
		global $database;

		$game_id = $database->escape_string($this->game_id);
		$user_id = $session->user_id;

		$rating  = new Rating();

		$rating->game_id = $game_id;
		$rating->user_id = $user_id;
	
		$sql  = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "user_id = '{$user_id}' ";
		$sql .= "AND game_id = '{$game_id}' ";
		$sql .= "LIMIT 1";

		$the_result_array = self::find_by_query($sql);

		$game = new Game();
		$game = Game::find_by_id($game_id);

		if (!empty($the_result_array)) {
			$rating->id = $the_result_array[0]->id;
			$rating->delete();
			$game->rating -= 1;
		} else {
			$rating->create();
			$game->rating += 1;
		}
		
		$game->update();

	}

	public function check_if_rated($game_id, $user_id) {

		global $session;
		global $database;

		$game_id = $database->escape_string($game_id);
		$user_id = $session->user_id;

		$sql  = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "user_id = '{$user_id}' ";
		$sql .= "AND game_id = '{$game_id}' ";
		$sql .= "LIMIT 1";

		return static::find_by_query($sql);

	}


} // End of Ratings-class.



?>