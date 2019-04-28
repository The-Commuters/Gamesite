<?php 

/**
 * This class does the email handling 
 * and sending to the users on the page.
 *
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

class Email extends User{

	// This controls which email adress, the emails created by this class is sent from
	private static $fromEmail = "no-reply@cm-games.com" ;

	protected static $db_table = "email_codes";


	public $user_id;
	public $reset_code;
	public $used;

	protected static $db_table_column = array('id','reset_code' ,'used' );

	/*
	public static function mail_Sender($to, $subject, $txt){
		
		// Denne setter avsender adresses ved bruk av variablen fromEmail
		$headers = "From:". self::$fromEmail . "\r\n";

		/* PHP sin egen mail sender, den bruker standard SMTP Port for mail sending som er 25, disse kan endres i php sine instillinger.
		Virker kun på lokale adresser for øyeblikket. 
		
		mail($to, $subject, $txt, $headers);


	}
	*/

	/**
	* A method that will take in the users mail from either 
	* the sendactivationmail function or the sendresetmail function  
	* and then send mail to it using the PHPMailer library
	* 
	* It has 2 options either local mail-sending 
	* or sending using a remote SMTP server.
	* The remote option currently uses SendGrids API 
	* and therefore needs a api key to function 
	* 
	* These can be switched between by uncommenting 
	* the other option and vice versa.  
	* 
	* @param $mail
	* @param $to
	* @param $user_name
	* @param $subject
	* @param $txt
	* 
	*/

	public static function mail_Sender($mail, $to, $user_name, $subject, $txt){

		$mail_array = array();
		
        /* Set the mail sender. */
	   $mail->setFrom('no-reply@cm-games.com', 'CM-Games');

	   /* Add a recipient. */
	   $mail->addAddress($to, $user_name);

	   /* Set the subject. */
	   $mail->Subject = $subject;

	   /* Set the mail message body. */
	   $mail->Body = $txt;
	 
	  /* Tells PHPMailer to use SMTP. */
	   $mail->isSMTP();
	   
	   
	   // * For local use *
	   /* If you want to use it localy 
	   *  you need a local mailserver that has a 
	   *  SMTP server running on localhost with port 25 
	   *  and a mail client that can connect to the server 
	   *  and read these mails.
	   */

	   // SMTP server address. 
	   $mail->Host = 'localhost';

	   $mail->Port = 25;  



	// * For Sendgrid use or any other mail provider online*

	
	   /*
	// SMTP Host
	   $mail->Host = 'smtp.sendgrid.net';

	// Uses SMTP authentication. 
	   $mail->SMTPAuth = true;
	
	// Username and password / api key
	   $mail->Username = 'apikey';

	// A file that needs to contain an key or a password for connecting to the SMTP server
	   require 'safe.php';
	   $mail->Password = $api;

	// Sets the encryption system. 
	   $mail->SMTPSecure = 'tls';

	// Sets the SMTP port. 
	   $mail->Port = 587;

	*/
	 	
	   $mail->SMTPDebug = 0;
	   
	  
	/* Finally , it will send the mail. */

	  if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
    array_push($mail_array, "Mail sending failed, Please try again");
} else {
    //echo "Message sent!";
}
return $mail_array;
	}

 	/*

	public static function send_ActivationMail($to, $user_name, $verify_code ){

		$subject = "Hello " . $user_name . " Please activate your account at CM Games";

		$txt = "Please press the link below to activate your new account at CM Games " . "http://localhost/gamesite/activate.php?code=" . $verify_code . " Thank you for registering. ";
		
		
		self::mail_sender($to, $subject, $txt);
	}
	*/

	/**
	* This method will take the users email in and 
	* then, it will send a activation mail with their unique verify-code to 
	* the mail that they put in when signed up for our site.
	* 
	* It uses the mail_sender method to do this. 
	* 
	* @param $to
	* @param $user_name
	* @param $verify_code
	* 
	*/

	public static function send_ActivationMail($to, $user_name, $verify_code ){
		$mail = new PHPMailer();

		$mail_array = array();

		$subject = "Hello " . $user_name . " Please activate your account at CM Games";

		$txt = "Please press the link below to activate your new account at CM Games " . "http://localhost/gamesite/activate.php?code=" . $verify_code . " Thank you for registering. ";
		
		
		$mail_array = self::mail_sender($mail, $to, $user_name , $subject, $txt);

		return $mail_array;
	}
	
	

	/*

	public static function send_Password_ResetMail($to, $user_name, $reset_code ){

		$subject = "Hello " . $user_name . " Here is your password reset";

		$txt = "Please press the link below to reset your password for your account at CM Games " . "http://localhost/gamesite/reset.php?reset_code=" . $reset_code;
		
		
		self::mail_sender($to, $subject, $txt);
	}

	*/

	/**
	 * This method sends the user a password reset link 
	 * using the mail_Sender method with their username 
	 * and their code from the create_reset_code method,
	 * 
	 * Then the user can click on reset link 
	 * and set their new password.
	 *
	 * @param $to
	 * @param $user_name
	 * @param $reset_code
	 * 
	 */

	// PHPMailer version
	public static function send_Password_ResetMail($to, $user_name, $reset_code ){
		$mail = new PHPMailer();

		$subject = "Hello " . $user_name . " Here is your password reset";

		$txt = "Please press the link below to reset your password for your account at CM Games " . "http://localhost/gamesite/reset.php?reset_code=" . $reset_code;
		
		
		self::mail_sender($mail, $to, $user_name, $subject, $txt);
	}

	/**
	* This method will take in the users email, check if 
	* it is in the database, and if it is in the database, 
	* it will create a unique code for them to 
	* reset their password with, and then it will send it using 
	* the send_Password_resetMail method.
	*
	* @param $email
	*/

	public function create_reset_code($email){

		global $database;
		

		$error_array = array();
		// Removes any code that should not be included in the string
		$email = $database->escape_string($email);
		
		// Finds the user with this specific email 
		$in = User::find_user_by_email($email);
	
		// Adds the user object to the variable $user and jumps to the first position.
		if(!empty($in)){
			$user = array_shift($in);

		// Creates a new email object 
		$user_email = new Email();
		// Setter variablene id og lager en unik kode for reseting
		$user_email->id = $user->id;

		$reset_code = md5($user->email . microtime());
	
		$user_email->reset_code = $reset_code;

		// Lagrer alt dette i databasen ved bruk av den overrida create metoden lengere nede
		$user_email->save();


		// Sender ut eposten til den som forespurte den skulle alt værte ok og eposten ligger i vår database
		self::send_Password_resetMail($user->email, $user->username, $reset_code);
		
		return $error_array;

	}
	else{
		array_push($error_array, "This user could not be found or this user has a password reset active");

		return $error_array;
		}


	}

   /**
	* Method that will take in the reset code from the user 
	* and then it will try to locate this reset code in the database 
	* and if it finds it, it will allow the user to 
	* set a new password of their choice thru the 
	* method verify_password_update in the user class  . 
	*
	* If it cant find it it will let 
	* the user know that the code is invalid.
	*
	* @param $code
	*/


	public static function find_user_by_reset_code($code){

		global $database;

		$error_array    = array();

		// Tar bort eventuele ting som ikke skal være med i stringen
		$code = $database->escape_string($code);
		
		// Finner ut om reset_code også ligger i databasen
		$sql = "SELECT * FROM ". self::$db_table ." WHERE reset_code = '{$code}' and used = 0 Limit 1 ";

		// Prøver på noe som daniel har brukt, Ternary 
		//$the_result_array = static::find_by_query($sql);

		
		// retunerer det database objektet som blir funnet 
		//return !empty($the_result_array) ? array_shift($the_result_array) :  $error_array;

		return static ::find_by_query($sql);
	}

   /**
	* Method that will take in the user id from the find_by_id method 
	* and then it will try to locate this user in the database 
	* and if it finds it, it will render the reset link useless 
	* since it has been used, so the next time, 
	* the user needs a new password
	* they will need to request a new link.  
	* 
	* @param $id
	*/

	public static function invalitate_reset_code($id){

		global $database;

		$error_array    = array();

		// Tar bort eventuele ting som ikke skal være med i stringen
		$in = $database->escape_string($id);
		
		$in = self::find_by_id($id);
	
		if(!empty($in)){
			
		$user_email = $in;
	
		$user_email->used = 1;

		$user_email->update();

	}

}

	/**
	 * This is the class that create database-rows for any of the objects that have
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