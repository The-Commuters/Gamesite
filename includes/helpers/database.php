<?php 

require_once("config.php");

/**
 * The Database class handles contact between the website and 
 * the database, both sql sent and the connection itself. It
 * also hold the escape_string that clean the strings sent
 * to it for SQL-injection with real_escape_string().
 */

class Database {

	public $connection;

	/**
	 * The construct method ensures that a database connection,
	 * is called whenever a database object is called on.
	 */
	function __construct() {
		
		$this->open_db_connection();
	}


	/**
	 * The connection to the database, is called on in the 
	 * construct and happens on every load in. Which is every
	 * time a page is loaded in because of the $database in
	 * the bottom of the page.
	 */
	public function open_db_connection() {

		// Opens a connection to the database with the constants defined in config.
		$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		// If an error have happened, then show the error-message.
		if ($this->connection->connect_errno) {
			die("Database Connection Failed Because..." . $this->connection->connect_error);
		}

	}

	/**
	 * Collects the last id inserted into the database, this
	 * means that any auto-generated id is collected and sent
	 * back to where this method is called.
	 */
	public function get_last_insert_id() {

		return mysqli_insert_id($this->connection);
	}

	/** 
	 * The method that sends a query trough the connection
	 * to the database and gets it back as $result, all
	 * contact with the database go trough here.
	 *
	 * @return $result the result of the query to the database.
	 */
	public function query($sql) {

		$result = $this->connection->query($sql);
		return $result;
	}

   	/**
	 * Cleans up all that is sent to the database with real_escape_string(),
	 * Makes the SQL in the text not dangerous to the database.
	 */
	public function escape_string($string) {

		$safe_string = $this->connection->real_escape_string($string);
		return $safe_string;
	}

} // End of class.

/** 
 * A database-object is created here, which means that it is done 
 * every time this page is included. And it is included in the init
 * at the top of each page.
 */
$database = new Database();






?>