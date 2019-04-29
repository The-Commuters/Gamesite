<?php 

/**
 * The class that creates and stores user-objects, is used
 * whenever something need's to use or store information
 * about the user that is logged in or other users.
 */

class User extends Db_object{

	protected static $db_table = "users";
	protected static $db_table_column = array('unique_id', 'username', 'email', 'password', 'first_name', 
		'middle_name', 'last_name', 'user_image', 'experience_points', 'joined', 'verify_code', 'status', 'signed_in' );
	public $id;
	public $username;
	public $email;
	public $password;
	public $first_name;
	public $middle_name;
	public $last_name;
	public $user_image;
	public $experience_points;
	public $joined;
	public $verify_code;
	public $unique_id;
	public $status;
	public $signed_in;


	/**
	 * Verifiy that the user lies in the database with this email and password, used with login
	 * but can also be used other places.
	 *
	 * @param $email is the email that the user have written into the form
	 * @param $password is the password that the user have written into the form.
	 * @return true if the user is in the database, false if not.
	*/
	public static function verify_user($email, $password) {

		global $database;
		$email = $database->escape_string($email);
		$password = $database->escape_string($password);

		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "email = '{$email}' ";
		$sql .= "AND status = 1 ";
		$sql .= "LIMIT 1";

		// Sends the sql into the database, gets a array with the users back, only one because limit 1.
		$the_result_array = self::find_by_query($sql);

		// Checks if the collected array is empty or not.
		if (!empty($the_result_array)) {

			// Collects the hashed password from the array that was collected by the sql.
			$hashed_password = $the_result_array[0]->password; 

			// Checks here where if the hashed password fits to the password that have been inserted by user.
			if (password_verify($password, $hashed_password)) {

				// Sets the signed_in column in the database to 1.
				$user_id = $the_result_array[0]->id; 
				$user = new User;
				$user = User::find_by_id($user_id);
				$user->signed_in = 1;
				$user->update();

				// Array shift delivers the one in place 0.
				return  array_shift($the_result_array);
			} 

			return false;
		} else {
			return false;
		}	
	}

	/**
	 * Verifies the update of user data on the settings.php, checks if it follows the 
	 * rules is that is set.
	 *
	 * @param $first_name is the new first name
	 * @param $middle_name is the new middle name
	 * @param $last_name is the new last name
	 * @return empty or not-empty $error_array
	*/
	public static function verify_update($first_name, $middle_name, $last_name) {

		global $database;

		$error_array    = array();
		$first_name     = $database->escape_string($first_name);
		$middle_name    = $database->escape_string($middle_name);
		$last_name      = $database->escape_string($last_name);

		if(strlen($first_name) > 30 || strlen($middle_name) > 30 || strlen($last_name) > 30) { 
			array_push($error_array,  "The firstname, middlename or last name cant be longer than 30 characters each.");
		}

		return $error_array;
	}

	/**
	 * Sends the friend request to the user by adding a new row to the database in the friend_ist
	 * with status of 0 which means that it will be pending.
	 *
	 * @param $user_id is the id of the user that is logged inn.
	 * @param $friend_id is the id of the user that request will be sent to.
	 */
	public static function add_friend($user_id, $friend_id) {

		global $database;

		// 0 in status will mean that the friend request is pending, when the reciever accepts this will be changed to 1
		$status = 0;

		$sql  = "INSERT INTO friend_list(user_1, user_2, friendship_status)";
		$sql .= "VALUES ('{$user_id}', '{$friend_id}', '{$status}')";
		if ($database->query($sql)) {
			return true;
		} else {
			return false;
		}

	}

	/**
	 * The search function for users, uses when they 
	 * look trough the list to add to friends.
	 *
	 * @param $search is the input of the user.
	 * @return the list of users that is found.
	 */
	public function find_friend($search) {

		global $database;

		// If there is something in the search-input.
		if ($search !== "") {
			$sql  = "SELECT * FROM users WHERE ";
			$search      = $database->escape_string($search);
			$sql .= " username LIKE '%{$search}%' ";
			return self::find_by_query($sql);
		}
	}

	/**
	 * The search function for users, it gets in one parameter containing what the
	 * User want to search after, and one that describes what type it category(first_name,
	 * last_name). Then it searches trough the database with the one it is told, and sends
	 * back the list of users that fit.
	 *
	 * @param $search the input of the user, example: frank
	 * @param $category the category that they want to search in, example: firstname.
	 * @return a list that holds the users that fits the bill.
	 */
	public function find_user($search, $category) {

		global $database;

		// Adds things to the search with.
		$sql  = "SELECT * FROM users WHERE";
		$sql .= " privilege_level = '0' AND (";

		$search      = $database->escape_string($search);
		$category    = $database->escape_string($category);

		if ($category == 'all') {
			$sql .= " first_name LIKE '%{$search}%' OR";
			$sql .= " middle_name LIKE '%{$search}%' OR";
			$sql .= " last_name LIKE '%{$search}%' OR";
			$sql .= " email LIKE '%{$search}%' OR";
			$sql .= " username LIKE '%{$search}%' OR";
			$sql .= " joined LIKE '%{$search}%' OR";
			$sql .= " id LIKE '%{$search}%'";
		}

		//Creator - name or parts of name
		if ($category == 'name') {
			$sql .= " first_name LIKE '%{$search}%' OR";
			$sql .= " middle_name LIKE '%{$search}%' OR";
			$sql .= " last_name LIKE '%{$search}%'";
		}
		
		//Creator - name or parts of name
		if ($category == 'username') {
			$sql .= " username LIKE '%{$search}%'";
		}

		//Creator - name or parts of name
		if ($category == 'email') {
			$sql .= " email LIKE '%{$search}%'";
		}

		//Creator - name or parts of name
		if ($category == 'id') {
			$sql .= " id LIKE '%{$search}%'";
		}

		//Creator - name or parts of name
		if ($category == 'date') {
			$sql .= " joined LIKE '%{$search}%'";
		}
		$sql .= ")";
		return self::find_by_query($sql);
	}

	/**
	 * checks if the user is an admin or not, does so by collecting the privilege_level form the
	 * user's row in the database. If it is 1, then collect it and return True, meaning that the
	 * user with the in-parameter user_id is an admin.
	 *
	 * @param $user_id the id of the user you want to question if it is a Administrator. 
	 * @return True if the user is an admin or false if the user is not. 
	*/
	public static function is_admin($user_id) {

		global $database;

		$sql = "SELECT privilege_level FROM " . self::$db_table . " WHERE ";
		$sql .= "id = '{$user_id}' ";
		$sql .= "AND privilege_level = '1' ";
		$sql .= "LIMIT 1";

		$the_result_array = self::find_by_query($sql);

		return !empty($the_result_array) ? true : false;
	}

	/**
	 * checks if the user is an friend of the logged in user or not.
	 *
	 * @param $user_id is the id of the signed in user.
	 * @param $friend_id is the id of the other user.
	 * @return true if friend, false if not.
	 */
	public static function is_friend($user_id, $friend_id) {

		global $database;

		$sql  = "SELECT * FROM friend_list WHERE ";
		$sql .= "user_1     = '{$user_id}' ";
		$sql .= "AND user_2 = '{$friend_id}' ";
		$sql .= "OR user_2  = '{$user_id}' ";
		$sql .= "AND user_1 = '{$friend_id}' ";
		$sql .= "LIMIT 1";

		$the_result_array = self::find_by_query($sql);

		return !empty($the_result_array) ? true : false;
	}	

	/**
	 * Collects the placement of the game path, used when showing the picture at 
	 * the list of users. And elswhere the user-picture might need to be shown.
	 *
	 * @return the string where the image is stored.
	 */
	public function get_user_image() {

		return "assets/" . "img/" . "profile/" . "default/" . $this->user_image;
	}

	/**
	 * Verifies that the user-information that have been entered is correct
	 * and places all the errors that may happen in the error_array to be sent
	 * back to the user.
     *
	 * @param $username
	 * @param $email
	 * @param $password
	 * @param $password_check
	 * @param $first_name
	 * @param $middle_name
	 * @param $last_name
	 * @return the error_array, empty if all is well.
	 */
	public static function verify_new_user($username, $email, $password, $password_check) {

		global $database;

		//Creates the error array, error messages will be pushed into this, and showed on the register page.
		$error_array       = array();
		$username          = $database->escape_string($username);
		$email             = $database->escape_string($email);
		$password          = $database->escape_string($password);
		$password_check    = $database->escape_string($password_check);

		// Fjerner all potensiel sql kode.
		$username          = strip_tags($username);
		$email             = strip_tags($email);
		$password          = strip_tags($password);
		$password_check    = strip_tags($password_check);

		// Checks if the user already is in hte database.
		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "email = '{$email}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";
		$the_result_array = self::find_by_query($sql);

		if (!empty($the_result_array)) {
			array_push($error_array, "The username is already in use, pick something else!");
		}

		//Checks the email by filtering it of unwanted characters.
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) { 

			// Filters out the characters that should not be in a email.
			$email = filter_var($email, FILTER_VALIDATE_EMAIL); 
			$email_check = $database->query("SELECT email FROM " . self::$db_table . " WHERE email='$email'");
			$num_rows = mysqli_num_rows($email_check); 

			/*Error message: The email is in the database.*/
			if($num_rows > 0) {  
				array_push($error_array, "Email already in use");
			}

		} else {
			array_push($error_array, "Invalid email format"); 
		}

		/*Error message: If the passwords are not the same*/
		if($password != $password_check) { 
			array_push($error_array,  "Your passwords do not match");
		}
		
		/*Error message: If the password is not between 5 and 30 characters long.*/
		if((strlen($password) > 50) || strlen($password) < 5) {  
			array_push($error_array, "Your password must be between 5 and 50 characters");
		}

		$password = password_hash($password, PASSWORD_DEFAULT);

		//Check password - bruker check_password til å sjekke om et passord fungerer, kommer til å tilkalle verify_password.
		if (empty($error_array)) {

			// Creats a new user object and fill's in the information.
			$user = new user();														
			$user->username    = $username;
			$user->email       = $email;
			$user->password    = $password;
			$user->unique_id   = $user->create_unique_id();
			$user->user_image  = "1.png";
			$user->joined      = date("Y-m-d");
			$user->verify_code = md5($username . microtime());

			 $mail_array = Email::send_ActivationMail($email, $username, $user->verify_code);
			

			if(empty($mail_array)){
				$user->create();
			}
			else
				array_push($error_array, array_shift($mail_array));
			

		} 

		return $error_array;

	}

	/**
	 * Method that takes in the users id, password 
	 * and password check from password setting form 
	 * when reseting the password, it will check if the 
	 * password matches the password check. And then 
	 * it will check the length of the password.
	 * 
	 * Then it will hash the password using password_hash() 
	 * method and then it will save the new password 
	 * to the database.
	 *
	 * @param $id;
	 * @param $password;
	 * @param $password_check;
	 */

	public function verify_password_update($id, $password, $password_check)
	{
		global $database;
		$error_array       = array();
		$password          = $database->escape_string($password); 
		$password_check    = $database->escape_string($password_check);

		$password          = strip_tags($password); 
		$password_check    = strip_tags($password_check); 

		if($password != $password_check) { 
			array_push($error_array, "Your passwords do not match");
				
		}

		/* If the password is less that 5 chars and longer than 50 chars it will let the user know that they cant do that.
		*/
		if((strlen($password) > 50) || strlen($password) < 5) {  
			array_push($error_array, "Your password must be between 5 and 50 characters");
		}



		$hashed_password = password_hash($password, PASSWORD_DEFAULT);


		if(empty($error_array)){

		
		$user = self::find_by_id($id);

		$user->password = $hashed_password;

		$user->update();
		
		}

		return $error_array;
	}

	/**
	 * Function that creates the number that has to be added behind the username.
	 * The number will be made up by five characters and is stored into the
	 * database seperate from the username. 
	 *
	 * @param $length is the length of the number.
	 * @return the number that is created.
	 */
	public static function create_unique_id($length = 5) {
		
		$characters = array_merge(range('0','9'));
		$max = count($characters) - 1;
		$number = 0;
		for ($i = 0; $i < $length; $i++) {
			$random = mt_rand(0, $max);
			$number .= $characters[$random];
		}
		return $number;
	}
	
	/** 
	* Method that will find a user based on their email. 
	* The method uses the find_by_query method from 
	* the db_object class. 
	*   
	* For this to work the user has to have been activated 
	* thru the email verifciation system.
	* 
	* @param $email;
	*/

	public static function find_user_by_email($email){

		global $database;
		
		// Removes any code that should not be included in the string
		$email = $database->escape_string($email);
		
		// Finds out if the requested email is in the database and is activated 
		$sql = "SELECT * FROM ". self::$db_table ." WHERE email = '{$email}' AND status = 1 Limit 1 ";
		
		// returns the found database object
		return static ::find_by_query($sql); 
	}

	/** 
	* Method that will find a user based on their activation code. 
	* The method uses the find_by_query method from 
	* the db_object class. 
	*   
	* For this to work the user has to be not activated 
	* thru the email verifciation system.
	*
	* The reason being that this method is used 
	* to find the user thru the activation code, 
	* so that the user can be actiaved 
	* thru the activate user method.
	*
	* @param $code;
	*/

	public static function find_user_by_code($code){

		global $database;
		
		// Removes any code that should not be included in the string
		$code = $database->escape_string($code);
		
		// Finds out if the requested verify_code also is in the database
		$sql = "SELECT * FROM ". self::$db_table ." WHERE verify_code = '{$code}' AND status = 0 Limit 1 ";
		
		// Returns the found database object
		return static ::find_by_query($sql); 
	}
	
	/**
	* This method takes in the activation code 
	* from the get parameter in the browser window
	* and then it checks if it can find the 
	* code in the verify colum in our user table.
	* 
	* If it can find it will activate the user 
	* and tell the user that thier account 
	* has been activeated
	* 
	* If it cant find the user it will let the user 
	* know that their user cant be activated.
	*
	* @param $code
	*/


	public function activate_user($code){
		global $database;

		// Finds the user who has that activation code in the database
		$in = self::find_user_by_code($code);
		
		// Gets the db-object and sees if it is empty
		
		if(!empty($in)){
		// Retrieves the next object in the row and returns it
			$user = array_shift($in);
		
			
		// This changes the status of the user to active or acitive is 1 and default is 0
			$user->status = 1;

			$user->update();
			
			echo "User was acitvated";
		}
		else{
			echo "This user could not be found or this user is active";
		}



	}


}

?>