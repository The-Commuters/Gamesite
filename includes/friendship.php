<?php 

//Klassen som omgjør alt ved håndtering av brukere i databasen.
class Friendship extends Db_object{

	//Klasse-variabler kalles properties.
	protected static $db_table = "friend_list"; //Slik at man kan endre navnet på databasetabellen.

	//Array skal brukes i properies() og inneholder achivement-variablene til objektet.
	protected static $db_table_fields = array('id', 'user_1', 'user_2', 'status');
	public $id;
	public $user_1;
	public $user_2;
	public $status;


	// Finds all the friend requests sent to the user that is not answered before by the user.
	public static function find_friend_requests($user_id) {
		
		global $database;

		$sql = "SELECT * FROM friend_list WHERE ";
		$sql .= "user_2 = '{$user_id}' ";
		$sql .= "AND status = '0' ";

		return self::find_by_query($sql);
	
	}

	public function friend_request_handler($user_1, $user_2, $status, $id) {

		global $database;
		global $session;

		$sql  = "SELECT * FROM friend_list WHERE ";
		$sql .= "user_1     = '{$user_1}' ";
		$sql .= "AND user_2 = '{$user_2}' ";
		$sql .= "LIMIT 1";

		$the_result_array = self::find_by_query($sql);

		$friendship = new Friendship();
		$friendship->user_1 = $user_1;
		$friendship->user_2 = $user_2;
		$friendship->status = $status;
		$friendship->id     = $id;

		$friendship->update();

	}

}

?>