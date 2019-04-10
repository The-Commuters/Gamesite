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

	
	function __construct() {

		$this->open_db_connection();
	}


	/**
	 * The connection to the database, is called
	 * on in the construct and happens on every load
	 * in.
	 */
	public function open_db_connection() {

		$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if ($this->connection->connect_errno) {
			
			die("Database Connection Failed Badly Because..." . $this->connection->connect_error);
		}

	}

	/** 
	 * The method that sends a query trough the connection
	 * to the database and gets it back as $result, all
	 * contact with the database go trough here.
	 */
	public function query($sql) {

		$result = $this->connection->query($sql);

		//Bruker metoden som sjekker om tilbakemeldingen fra databasen er gyldig.
		$this->confirm_query($result);
		return $result;
	}

	
	/**
	 * Checks if the result of the query is something
	 * and not nothing, kills the process if its not.
	 */
	private function confirm_query($result) {

		if(!$result) {

			die("Query Failed" . $this->connection->error);

		}

	}

   	/**
	 * Cleans up all that is sent to the database with real_escape_string(),
	 * Makes the SQL in the text not dangerous to the database.
	 */
	public function escape_string($string) {

		$escaped_string = $this->connection->real_escape_string($string);

		return $escaped_string;

	}

	/**
	 *
	 */
	public function the_insert_id() {

		return mysqli_insert_id($this->connection);

	}

} //End of the Database-class

/** 
 * A database-object is created here, which means that it is done 
 * every time this page is included. And it is included in the init
 * at the top of each page.
 */
$database = new Database();






?>