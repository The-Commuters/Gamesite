<?php 

//Klassen som omgjør alt ved håndtering av brukere i databasen.
class User extends Db_object{

	//Klasse-variabler kalles properties.
	protected static $db_table = "users"; //Slik at man kan endre navnet på databasetabellen.

	//Array skal brukes i properies() og inneholder bruker-variablene til objektet.
	protected static $db_table_fields = array('username', 'email', 'password', 'first_name', 'middle_name', 'last_name', 'user_image', 'joined', 'verify_code' );
	public $id;
	public $username;
	public $email;
	public $password;
	public $first_name;
	public $middle_name;
	public $last_name;
	public $user_image;
	public $joined;
	public $verify_code;

	// Verifiserer at brukeren ligger i databasen, brukes ved login og kan brukes andre steder.
	public static function verify_user($email, $password) {

		global $database;
		$email = $database->escape_string($email);
		$password = $database->escape_string($password);

		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "email = '{$email}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";


		/* ----------------------------- HASHED PASSORD SATT PÅ VENT TIL NÅ ------------------------------*/
		$the_result_array = self::find_by_query($sql);

		//$hashed_password = $the_result_array->password; 
		//$password = password_verify($password, $hashed_password);
		
		if (!empty($the_result_array)) {

			// Array shif delivers the first
			return  array_shift($the_result_array);
		} else {

			return false;
		}	
	}

	// Verifies the update of user data on the settings.php.
	public static function verify_update($first_name, $middle_name, $last_name) {

		global $database;

		$error_array    = array();
		$first_name     = $database->escape_string($first_name);
		$middle_name    = $database->escape_string($middle_name);
		$last_name      = $database->escape_string($last_name);

		if(strlen($first_name  ) > 30 || strlen($middle_name) > 30 || strlen($last_name) > 30) { 
			array_push($error_array,  "The firstname, middlename or last name cant be longer than 30 characters each.");
		}

		return $error_array;
	}

	public static function add_friend($user_id, $friend_id) {

		global $database;

		// 0 in status will mean that the friend request is pending, when the reciever accepts this will be changed to 1
		$status = 0;

		$sql  = "INSERT INTO friend_list(user_1, user_2, status)";
		$sql .= "VALUES ('{$user_id}', '{$friend_id}', '{$status}')";


		if ($database->query($sql)) {

			return true;

		} else {

			return false;

		}

	}

		// The search function for users.
	public function find_user($search, $category) {

		// Adds things to the search with.
		$sql  = "SELECT * FROM users WHERE ";

		if ($category == 'all') {
			$sql .= " first_name LIKE '%{$search}%' OR";
			$sql .= " middle_name LIKE '%{$search}%' OR";
			$sql .= " last_name LIKE '%{$search}%' OR";
			$sql .= " id LIKE '%{$search}%'";
		}

		//Creator - name or parts of name
		if ($category == 'first_name') {
			$sql .= " first_name LIKE '%{$search}%'";
		}
		
		//Creator - name or parts of name
		if ($category == 'middle_name') {
			$sql .= " middle_name LIKE '%{$search}%'";
		}

		//Creator - name or parts of name
		if ($category == 'last_name') {
			$sql .= " last_name LIKE '%{$search}%'";
		}

		//Creator - name or parts of name
		if ($category == 'id') {
			$sql .= " id LIKE '%{$search}%'";
		}

		return self::find_by_query($sql);
	}

	// checks if the user is an admin or not.
	public static function is_admin($user_id) {

		global $database;

		$sql = "SELECT privilege_level FROM " . self::$db_table . " WHERE ";
		$sql .= "id = '{$user_id}' ";
		$sql .= "AND privilege_level = '1' ";
		$sql .= "LIMIT 1";

		$the_result_array = self::find_by_query($sql);

		return !empty($the_result_array) ? true : false;
	}

	// checks if the user is an admin or not.
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

	// Collects the placement of the game path, used when showing the picture at  the list of users.
	public function get_user_image() {

		return "img" . DS . "profile" . DS . "default" . DS . $this->user_image;
	}

	// Verifiserer at brukeren ligger i databasen, brukes ved llogin og kan brukes andre steder.
	// Kan kuttes opp senere.
	public static function verify_new_user($username, $email, $password, $password_check, $first_name, $middle_name, $last_name) {

		/*
		 * Legger feilmeldinger inn i error_array, error arrayet sendes så tilbake. 
		 * Hvis det er felmeldinger vil ikke brukeren bli laget, og feilmeldingene vil vises.
		*/

		global $database;

		//Creates the error array, error messages will be pushed into this, and 
		$error_array       = array();
		$username          = $database->escape_string($username);
		$email             = $database->escape_string($email);
		$password          = $database->escape_string($password);
		$password_check    = $database->escape_string($password_check);
		$first_name        = $database->escape_string($first_name);
		$middle_name       = $database->escape_string($middle_name);
		$last_name         = $database->escape_string($last_name);


		// Fjerner all potensiel sql kode.
		$username          = strip_tags($username);
		$email             = strip_tags($email);
		$first_name        = strip_tags($first_name);
		$middle_name       = strip_tags($middle_name);
		$last_name         = strip_tags($last_name);
		$password          = strip_tags($password);
		$password_check    = strip_tags($password_check);

		// Sjekker om brukernavn eller email ligger i databasen.
		$sql  = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "username = '{$username}' ";
		$sql .= "LIMIT 1";
		$the_result_array = self::find_by_query($sql);
		if (!empty($the_result_array)) {
			array_push($error_array, "The username is already in use, pick something else!");
		}

		//SJEKKER EMAIL:
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) { 

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

		/*Error message: If the passwords contain other than numbers and letters.*/
		if(preg_match('/[^A-Za-z0-9]/', $password)) {  
			array_push($error_array, "Your password can only contain english characters or numbers");
		}
		
		/*Error message: If the password is not between 5 and 30 characters long.*/
		if((strlen($password) > 30) || strlen($password) < 5) {  
			array_push($error_array, "Your password must be between 5 and 30 characters");
		}


		//Check password - bruker check_password til å sjekke om et passord fungerer, kommer til å tilkalle verify_password.
		if (empty($error_array)) {

			//Check username - bruker check_username til å sjekke om brukernavnet fungerer.

			//sets up the new user and creates it with create();
			$user = new user();

			/*------------------------------------ Skal brukes når hashet passord settes opp --------------------------------------------*/
			//$password = password_hash($password, PASSWORD_BCRYPT);

			$user->username    = $username;
			$user->email       = $email;
			$user->password    = $password;
			$user->first_name  = $first_name;
			$user->middle_name = $middle_name;
			$user->last_name   = $last_name;
			$user->user_image  = "1.png";
			$user->joined      = date("Y-m-d");
			$user->verify_code = md5($username . microtime());

			Email::sendActivationMail($email, $first_name);

			$user->create();



		} 

		return $error_array;
	
	}
}

?>