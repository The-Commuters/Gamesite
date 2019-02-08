<?php 

//include "header.php";

//Klassen som omgjør alt ved håndtering av epost sending til brukere på siden.
class Email extends User{

	private static $fromEmail = "no-reply@cm-games.com" ;

	public static function mail_Sender($to, $subject, $txt){
		
		$headers = "From:". self::$fromEmail . "\r\n";

		mail($to, $subject, $txt, $headers);


	}

	public static function sendActivationMail($to, $first_name){
 
		$subject = "Hello " . $first_name . " Please activate your account at CM Games";

		$txt = "Please press the link below to acitvate your new account at CM Games" . " http://localhost/gamesite/activate.php=". "somenumbers";
		
		
		self::mail_sender($to, $subject, $txt);
	}

	
	


}

//Email::sendActivationMail("newuser@localhost", "Markus");
?>