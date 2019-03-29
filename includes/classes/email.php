<?php 

//Klassen som omgjør alt ved håndtering av epost sending til brukere på siden.
class Email extends User{

	// Denne styrer hvilken mail som eposten blir sent fra 
	private static $fromEmail = "no-reply@cm-games.com" ;

	protected static $db_table = "email_codes";


	public $user_id;
	public $reset_code;

	protected static $db_table_fields = array('id','reset_code' );


	public static function mail_Sender($to, $subject, $txt){
		
		// Denne setter avsender adresses ved bruk av variablen fromEmail
		$headers = "From:". self::$fromEmail . "\r\n";

		/* PHP sin egen mail sender, den bruker standard SMTP Port for mail sending som er 25, disse kan endres i php sine instillinger.
		Virker kun på lokale adresser for øyeblikket. 
		*/
		mail($to, $subject, $txt, $headers);


	}

	// Denne tar inn hvilken mail det skal sendes til og fornavent til brukeren 

	
	public static function send_ActivationMail($to, $user_name, $verify_code ){

		$subject = "Hello " . $user_name . " Please activate your account at CM Games";

		$txt = "Please press the link below to activate your new account at CM Games " . "http://localhost/gamesite/activate.php?code=" . $verify_code . " Thank you for registering. ";
		
		
		self::mail_sender($to, $subject, $txt);
	}

	/**
	 * Sends the user a password reset link 
	 * Then the user can click on reset link 
	 * and set their new password.
	 *
	 * @param $to
	 * @param $user_name
	 * @param $reset_code
	 * 
	 */

	public static function send_Password_ResetMail($to, $user_name, $reset_code ){

		$subject = "Hello " . $user_name . " Here is your password reset";

		$txt = "Please press the link below to reset your password for your account at CM Games " . "http://localhost/gamesite/activate.php?reset_code=" . $reset_code;
		
		
		self::mail_sender($to, $subject, $txt);
	}

	public function create_reset_code($email){

		global $database;
		
		// Tar bort eventuele ting som ikke skal være med i stringen
		$email = $database->escape_string($email);
		
		// Finner brukeren med denne eposten
		$in = User::find_user_by_email($email);

		// Legger bruker objektet inn i variabelen $user og hopper til første posisjon 		
		$user = array_shift($in);
		// Oppretter et nytt email objekt 
		$user_email = new Email();
		// Setter variablene id og lager en unik kode for reseting
		$user_email->id = $user->id;

		$reset_code = md5($user->email . microtime());
	
		$user_email->reset_code = $reset_code;

		// Lagrer alt dette i databasen ved bruk av den overrida create metoden lengere nede
		$user_email->create();

		
		return $reset_code;
		

		
	}

	


	public static function find_user_by_reset_code($code){

		global $database;
		// Tar bort eventuele ting som ikke skal være med i stringen
		$code = $database->escape_string($code);
		
		// Finner ut om reset_code også ligger i databasen
		$sql = "SELECT * FROM ". self::$db_table ." WHERE reset_code = '{$code}' Limit 1 ";
		
		// retunerer det database objektet som blir funnet 
		return static ::find_by_query($sql); 
	}





	/**
	 * This is the clas that create database-rows for any of the objects that have
	 * their own object-classes, this checks and stores rows in the database to be 
	 * used later, and is like the other classes abstract so that it works for all
	 * the classes. It also uses the log_user_activity to create a new row in the 
	 * user activity folder.
	 *
	 * @return true if the object is stored in the database, false if not.
	 */
	public function create() {
		
		global $database;
		global $session;

		$properties = $this->clean_properties();

		$sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ")";
		$sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";

		if ($database->query($sql)) {
			
		
			$user_id = $this->id;

			$log = $this->log_user_activity("password reset", $user_id, $this->id, static::$db_table);

			return true;

		} else {

			return false;

		}

	}

}

?>