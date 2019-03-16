<?php 

//Klassen som omgjør alt ved håndtering av epost sending til brukere på siden.
class Email extends User{

	// Denne styrer hvilken mail som eposten blir sent fra 
	private static $fromEmail = "no-reply@cm-games.com" ;

	public static function mail_Sender($to, $subject, $txt){
		
		// Denne setter avsender adresses ved bruk av variablen fromEmail
		$headers = "From:". self::$fromEmail . "\r\n";

		/* PHP sin egen mail sender, den bruker standard SMTP Port for mail sending som er 25, disse kan endres i php sine instillinger.
		Virker kun på lokale adresser for øyeblikket. 
		*/
		mail($to, $subject, $txt, $headers);


	}

	// Denne tar inn hvilken mail det skal sendes til og fornavent til brukeren 

	/**
	To do 
	* Legge til aktiveringslink : Doneish, trenger formatering
	* Sjekke om denne er klikket på
	* Deretter aktivere konto.


	*/
	public static function send_ActivationMail($to, $first_name, $verify_code ){
 
		$subject = "Hello " . $first_name . " Please activate your account at CM Games";

		$txt = "Please press the link below to activate your new account at CM Games " . "http://localhost/gamesite/activate.php?code=" . $verify_code . " Thank you for registering. ";
		
		
		self::mail_sender($to, $subject, $txt);
	}

}

?>