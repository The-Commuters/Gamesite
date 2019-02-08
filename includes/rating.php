<?php 


class Rating extends Db_object {

	//Klasse-variabler kalles properties.
	protected static $db_table = "ratings"; //Slik at man kan endre navnet på databasetabellen.

	//Array skal brukes i properies() og inneholder bruker-variablene til objektet.
	protected static $db_table_fields = array('game_id', 'user_id', 'score');
	public $id; 
	public $game_id;
	public $user_id;
	public $score;

	// Dette skal da være objektet som håndterer ratingene til spilleme
	// Objekter som blir sendt til databasen blir laget her, og utregninger
	// Av gjennomsnittlig score skal og foregå her.

	public function verify_Rating() {

		// Will check if there already is a rating for the game by the user.
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

} // End of ratings-class.



?>