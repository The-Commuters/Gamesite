<?php 

/**
 * This class handles friendships between users in the database.
 * It contains the two users id, the id of the friendship and
 * the status of it, if 0 then a friend-request is sent, if 1
 * then they are friends.
 */

class Friendship extends Db_object{

	protected static $db_table = "friend_list";

	protected static $db_table_fields = array('id', 'user_1', 'user_2', 'status', 'chatroom', 'chatroom_status');
	public $id;
	public $user_1;
	public $user_2;
	public $status;
	public $chatroom;
	public $chatroom_status;

	/**
	 * Finds all the friend requests sent to the user that is not answered 
	 * before by the user. Then sends them 
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
	 * Finds all the friend that a user have or have been accepted by.
	 * Checks if the user is the one that befriended the other or visa-
	 * versa.
	 *
	 * @param Is the id of the reciever you want the friend requests to.
	 * @return Is the friendlist of the user that is logged in.
	 */
	public static function find_friends($user_id) {
		
		global $database;

		$sql = "SELECT * FROM friend_list WHERE ";
		$sql .= "(user_1 = '{$user_id}' OR ";
		$sql .= "user_2 = '{$user_id}') ";
		$sql .= "AND status = '1' ";

		return self::find_by_query($sql);
	
	}

	/**
	 * 
	 * @param Is the id of the reciever you want the friend requests to.
	 * @return Is the friendlist of the user that is logged in.
	 */
	public static function find_active_chatrooms($user_id) {
		
		global $database;

		$sql = "SELECT * FROM friend_list WHERE ";
		$sql .= "(user_1 = '{$user_id}' OR ";
		$sql .= "user_2 = '{$user_id}') ";
		$sql .= "AND status = '1' ";
		$sql .= "AND chatroom_status = '1' ";

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
		$friendship->user_1   = $user_1;
		$friendship->user_2   = $user_2;
		$friendship->status   = $status;
		$friendship->id       = $id;
		$friendship->chatroom = $user_1 . "X" . $user_2;

		if ($status == 1) {
			
			$friendship->update();
		} else {

			$friendship->delete();
		}

	}

//---------------------------Might be deleted unless used----------------------------------

	/**
	 * Finds the friend object between two users in the database
	 * and returns it where it is needed. 
	 *
	 * @param $user_id is the id of the user that is logged in
	 * @param $friend_id is the friend's id.
	 */
	public function get_friendship($user_id, $friend_id) {

		global $database;

		$sql = "SELECT * FROM friend_list WHERE ";
		$sql .= "(user_1 = '{$user_id}' OR ";
		$sql .= "user_2 = '{$user_id}') ";
		$sql .= "AND (user_1 = '{$friend_id}' OR ";
		$sql .= "user_2 = '{$friend_id}') ";
		$sql .= "LIMIT 1";

		return self::find_by_query($sql);

	}
//------------------------------------------------------------------------------------------

}

?>