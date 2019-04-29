<?php

/**
 * This class handles the current session of the user that have
 * logged in, and can be used to chack if a user is logged in
 * or not, and which user it is.
 */

class Session {

	private $signed_in = false; // This will be used to check if a user is signed in or not.
	public $user_id;			// This will be used to collect the id of the signed in user.		

	/**
	 * Happens whenever a session is started, which is every time 
	 * this class is run, one can see the $session = new Session()
	 * at the end of this class. The constructor checks the login
	 * and then checks messages(not really used yet)
	 */
	function __construct() {

		session_start();			// Starts a new session.
		$this->check_the_login();	// Check if the user is signed in.

	}

	/**
	 * Is a 'getter' that one can use to check wheter a user is signed
	 * in or not, in check_the_login() this->signed_in is set to be true
	 * if someone is logged in and false if not. If true then 'true' will
	 * be returned.
	 *
	 * @return true if logged in, false if not.
	 */
	public function is_signed_in() {

		return $this->signed_in;

	}

	/**
	 * Happens whenever a user sucessfully signs in to the website, the $session's
	 * $user_id will be set and the signed_in property will be set to 'true'.
	 *
	 * @param $user the user object, if it holds one then the things are done.
	 */
	public function login($user) {

		if ($user) {

			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->signed_in = true;

		}

	}

	/**
	 * This methos is called whenever a user presses the log-out
	 * button, it unsets the user-id that lies in session, the
	 * user_id that lies in $session and sets the signed_in 
	 * property to  false. Also changes the database-object
	 * of the user's signed_in column to 0.
	 */
	public function logout() {

		// Changes here the signed_in of the user to 0.
		$user = new User();
		$user = User::find_by_id($_SESSION['user_id']);
		$user->signed_in = 0;
		$user->update();

		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->signed_in = false;

	}

	/**
	 * This method is here to control the flow, it checks if someone
	 * is logged in by looking at the $_SESSION, if it is then the
	 * newly created Session object will given the same user_id, else
	 * things will be unset. This is called in the constructor, and
	 * sets up the the Session's properties.
	 */
	private function check_the_login() {

		// If the session-variable is set with the user id.
		if (isset($_SESSION['user_id'])) {
			$this->signed_in = true;
			$this->user_id = $_SESSION['user_id']; 
		} else {
			unset($this->user_id);
			$this->signed_in = false;
		}
	}
} // End of the Session-class.

/**
 * As the $database a new object is created every
 * time a page is loaded in. This starts the
 * constructor and collects the SESSION variable.
 */
$session = new Session();
?>