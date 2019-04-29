<?php 

/**
 * This class does the email handling 
 * and sending to the users on the page.
 *
 */

/**
* Here, I have chosen to use PHPMailer instead of
* PHP own included mailer, since this one works on all platforms
* and without any setup on the server host, other than the standard 
* XAMPP setup or lamp setup if you are using Linux.
*
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

class Email extends User{

	// This controls which email address, the emails created by this class is sent from
	private static $fromEmail = "no-reply@cm-games.com" ;

	protected static $db_table = "email_codes";


	public $user_id;
	public $reset_code;
	public $used;

	protected static $db_table_column = array('id','reset_code' ,'used' );

	/*
	public static function mail_Sender($to, $subject, $txt){
		
	// This sets the sender address by using the variable fromEmail
		$headers = "From:". self::$fromEmail . "\r\n";

	/*
	* PHP's own mail sender, it uses the standard 
	* SMTP port for mail sending which is 25, 
	* this can be changed in php's settings.
	* Only works on local addresses at the moment.
	*/

	/*
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
		
       // Sets the mail sender.
	   $mail->setFrom('no-reply@cm-games.tk', 'CM-Games');

	   // Adds a recipient.
	   $mail->addAddress($to, $user_name);

	   // Sets the subject.
	   $mail->Subject = $subject;

	   // Sets the mail message body. 
	   $mail->Body = $txt;
	 
	  // Tells PHPMailer to use SMTP. 
	   $mail->isSMTP();
	   
	   
	   /* For local use */
	   /* If you want to use it locally 
	   *  you need a local mail server that has a 
	   *  SMTP server running on localhost with port 25 
	   *  and a mail client that can connect to the server 
	   *  and read these mails.
	   */
	   
	   
	   /* SMTP server address. */
	  
	   /*
	   $mail->Host = 'localhost';
		
	   $mail->Port = 25;  
		*/
		

	/* For Turbo-SMTP use or any other mail provider online */
	   
	// SMTP Host
	   $mail->Host = 'pro.turbo-smtp.com';

	// Uses SMTP authentication. 
	   $mail->SMTPAuth = true;
	
	// Username and password / api key
	   require 'safe.php';
	   $mail->Username = $api_username;

	// A file that needs to contain an key or a password for connecting to the SMTP server
	   $mail->Password = $api_password;

	// Sets the encryption system. 
	   $mail->SMTPSecure = 'ssl';

	// Sets the SMTP port. 
	   $mail->Port = 465;

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
	* then, it will send a activation mail 
	* with their unique verify-code to 
	* the mail that they put in 
	* when signed up for our site.
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

		$mail_array = array();

		$subject = "Hello " . $user_name . " Here is your password reset";

		$txt = "Please press the link below to reset your password for your account at CM Games " . "http://localhost/gamesite/reset.php?reset_code=" . $reset_code;
		
		
		$mail_array = self::mail_sender($mail, $to, $user_name, $subject, $txt);

		return $mail_array;
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
		
		$mail_array = array();

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

		// Sets the variable id and creates a unique code for resetting.

		$user_email->id = $user->id;

		$reset_code = md5($user->email . microtime());
	
		$user_email->reset_code = $reset_code;

		// Sends the email to the person who requested it should all be ok and the email is in our database.

		$mail_array = self::send_Password_resetMail($user->email, $user->username, $reset_code);

		// Saves all this to the database using the overrided create method further down.
		if(empty($mail_array))

			$user_email->create();
		else
			array_push($error_array, array_shift($mail_array));
		
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

		// Removes any code that should not be included in the string
		$code = $database->escape_string($code);
		
		// Finds out if the requested reset_code also is in the database
		$sql = "SELECT * FROM ". self::$db_table ." WHERE reset_code = '{$code}' and used = 0 Limit 1 ";

		return static ::find_by_query($sql);
	}

   /**
	* Method that will take in the user id from
	* the find_by_id method and then it will 
	* try to locate this user in the database 
	* and if it finds it, it will make
	* the reset link useless since it has been used, 
	* so the next time, the user needs a new password
	* they will need to request a new link.  
	* 
	* @param $id
	*/

	public static function invalitate_reset_code($id){

		global $database;

		$error_array    = array();

		// Removes any code that should not be included in the string
		$id = $database->escape_string($id);
	
		if(!empty($id)){
		
		$user_email = new Email();
		$user_email = self::find_by_id($id);
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