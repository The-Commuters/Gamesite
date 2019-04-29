<?php 

/**
 * This class will hold messages that is sent with the chat,
 * it will also be used to control the rooms that friends and
 * users chat in.
 */

class Message extends Db_object{

	protected static $db_table = "user_chat"; 
	protected static $db_table_column = array('room_id', 'user_id', 'username', 'text', 'time', 'viewed');
	public $id;
	public $room_id;
	public $user_id;
	public $username;
	public $text;
	public $time;
	public $viewed;

	/**
	 * Finds all the messages in user_chat that has the same game_id as the param,
	 * then sends them back out again
	 *
	 * @param $game_id is the id for the game.
	 * @return the messages that belong to the chat at the side of the game.
	 */
	public static function find_messages($room_id) {

		global $database;
		$room_id = $database->escape_string($room_id);
		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "room_id = '{$room_id}' ";
		$sql .= "ORDER BY id";
		return static::find_by_query($sql);

	}

	/**
	 * Counts all of the uread messages that a user have
	 * from another user in the chat they share, this is
	 * then viewed beside the users name.
	 *
	 * @param $room_id is the id of the chatroom between the users.
	 * @param $user_id is the id of the user that is not the signed in one.
	 * @return the list of messages that have not been read.
	 */
	public static function count_unread_messages($room_id, $user_id) {

		global $database;
		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "room_id = '{$room_id}' AND ";
		$sql .= "user_id = '{$user_id}' AND ";
		$sql .= "viewed = 0 ";
		return static::find_by_query($sql);

	}

} // End of Message-class

?>