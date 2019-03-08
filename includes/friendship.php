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

	/**
	 * Finds all the friend requests sent to the user that is not answered before by the user.
	 *
	 * @param Is the id of the reciever you want the friend requests to.
	 * @return Is the friend requests that is sent to the id in param.
	 */
	public static function find_friend_requests($user_id) {
		
		global $database;

		$sql = "SELECT * FROM friend_list WHERE ";
		$sql .= "user_2 = '{$user_id}' ";
		$sql .= "AND status = '0' ";

		return self::find_by_query($sql);
	
	}

	/**
	 * Will here accept or decline depending on wheter the input-param $status
	 * is 1 or 0, if it is 1 then it will be accepted and the row in the database
	 * will be updated to say so.
	 *
	 * @param $user_1 is the user that sent the friend-request
	 * @param $user_2 is the user that recieved the request, and have now accepted or refused.
	 * @param $status is either 1 for accept or 0 for refuse friend-request.
	 * @param $id is the id of the request, will use this to update.
	 * @return true if the process was finished and false if there was errors.
	 */
	public function friend_request_handler($user_1, $user_2, $status, $id) {

		global $database;
		global $session;

		$friendship = new Friendship();
		$friendship->user_1 = $user_1;
		$friendship->user_2 = $user_2;
		$friendship->status = $status;
		$friendship->id     = $id;

		if ($status == 1) {
			
			$friendship->update();
		} else {

			$friendship->delete();
		}

	}

}

?>