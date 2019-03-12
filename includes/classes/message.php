<?php 

//Klassen som omgjør alt ved håndtering av brukere i databasen.
class Message extends Db_object{

	//Klasse-variabler kalles properties.
	protected static $db_table = "user_chat"; //Slik at man kan endre navnet på databasetabellen.

	//Array skal brukes i properies() og inneholder achivement-variablene til objektet.
	protected static $db_table_fields = array('id', 'game_id', 'user_id', 'username', 'text', 'time');
	public $id;
	public $game_id;
	public $user_id;
	public $username;
	public $text;
	public $time;

	/**
	 * Finds all the messages in user_chat that has the same game_id as the param,
	 * then sends them back out again
	 *
	 * @param $game_id is the id for the game.
	 * @return the messages that belong to the chat at the side of the game.
	 */
	public static function find_messages($game_id) {

		global $database;
		$game_id = $database->escape_string($game_id);

		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "game_id = '{$game_id}' ";
		$sql .= "ORDER BY id";

		return static::find_by_query($sql);

	}

}

?>