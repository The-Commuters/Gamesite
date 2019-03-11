<?php 

require_once("config.php");

class Database {

	//Gjør den public slik at den kan brukes over hele klassen.
	//Skal arves senere i kurset
	public $connection;

	//Construct Function, kobler opp når database-variablen bllir opprettet.
	function __construct() {

		$this->open_db_connection();
	}


	//Funksjonen som brukes for å koble til databasen.
	public function open_db_connection() {

		//$this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if ($this->connection->connect_errno) {
			
			die("Database Connection Failed Badly Because..." . $this->connection->connect_error);
		}

	}

	/* Metoden query henter inn sql, sender den inn til databasen, og sender 
	det tilbake som $result, denne skal alltid brukes til å kontakte databasen med queries. */
	public function query($sql) {

		$result = $this->connection->query($sql);

		//Bruker metoden som sjekker om tilbakemeldingen fra databasen er gyldig.
		$this->confirm_query($result);
		return $result;
	}

	//Sjekker om $result er gyldig
	private function confirm_query($result) {

		if(!$result) {

			die("Query Failed" . $this->connection->error);

		}

	}

    //rydder opp dataene som blir sent til databasen, legger / foran potensiel farlige kode.
	public function escape_string($string) {

		$escaped_string = $this->connection->real_escape_string($string);

		return $escaped_string;

	}


	public function the_insert_id() {

		return mysqli_insert_id($this->connection);

	}

} //End of the Database-class

$database = new Database();






?>