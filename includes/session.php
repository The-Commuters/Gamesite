<?php

//Denne klassen håndterer Session, sjekker om bruker er logget in, starter session, setter opp $user_id slik at den kan brukes andre steder på ettsiden.
class Session {

	private $signed_in = false;
	public $user_id;
	public $message;
	public $current_game;

	//Construct skjer automatisk hver gang et session objekt blir intialisert.
	function __construct() {

		session_start();
		$this->check_the_login(); //Skal gjøres hver gang en side blir åpnet.
		$this->check_message();

	}

	//Funksjon som skaper en output melding hvor teksten blir bestemt når metoden kalles.
	public function message($msg="") {
	
		if (!empty($msg)) {

			$_SESSION['message'] = $msg;

		} else {

			return $this->message;

		}

	}

	// Forsikrer seg om at session er set, så den ikke viser meldingen to ganger.
	public function check_message() {

		if (isset($_session['message'])) {

			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);

		} else {

			$this->message = "";
		}

	}

	// Er en "getter", man kan kalle denne fra hvor som helst, tar inn en private variabel og
	// sender den ut til hvor den måtte trengs, siden metoden er public.
	public function is_signed_in() {

		return $this->signed_in;

	}

	// Er en "getter", man kan kalle denne fra hvor som helst, tar inn en private variabel og
	// sender den ut til hvor den måtte trengs, siden metoden er public.
	public function get_user_id() {

		return $this->user_id;

	}

	//Skjer når bruker logger inn, legger inn $user_id og endrer $signed_in til 'true'
	public function login($user) {

		if ($user) {

			$this->user_id = $_SESSION['user_id'] = $user->id; //$id i User-klassen.
			$this->signed_in = true;

		}

	}

	//Metode som brukes til å logge ut, unsetter variabler.
	public function logout() {

		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->signed_in = false;

	}

	//Denne metoden skal konrollere flowen, om en er logget inn eller ikke.
	private function check_the_login() {

		if (isset($_SESSION['user_id'])) {
			
			$this->user_id = $_SESSION['user_id']; 
			$this->signed_in = true;

		} else {

			unset($this->user_id);
			$this->signed_in = false;

		}

	}

} // End of the Session-class.

$session = new Session();   //Starter her seession automatisk, alle som bruker nettsiden wil da ha en session.


?>