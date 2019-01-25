<?php

/*
 * This is the parent object-class that extends to other object-classes
 * The methods in this class will have to be abstract, and can be used in
 * The sub-classes that is database-objects.
 */

class Db_object {
	

	protected static $db_table = "users"; //Slik at man kan endre navnet på databasetabellen.


	//Henter ut alle objektene fra databasen.
	public static function find_all() {

		// Kan gjøre det enklere ved å ta i bruk find this query som er nedenfor, kan da spare mye plass.
		// Er abstract.
		return static::find_by_query("SELECT * FROM " . static::$db_table . " ");

	}


	//Finner et objekt ved å ta imot id-en og søke etter den i databasen.
	public static function find_by_id($id) {

		global $database; //Tar i bruk klassen som $database-objektet er laget av, kan da ta i bruk query().
		$the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");

		//Man kan og gjøre dette, synes vi burde det på prosjektet, heter tenery syntax.
		return !empty($the_result_array) ? array_shift($the_result_array) : false;

	}


	//Mellom-steg mellom query og metoden som tar den i bruk, kutter ned det som må stå inne i metoden.
	public static function find_by_query($sql) {

		global $database;
		$result_set = $database->query($sql);
		$the_object_array = array(); //lager her et tomt array.

		while ($row = mysqli_fetch_array($result_set)) { //Henter table.
			$the_object_array[] = static::instantation($row);//bruker instantion, lager et array med objekter.
		}

		return $the_object_array;
	}


	//Lager her en instans av klassen, et OBJEKT, kan gjøres kortere med en loop, VERY important method.
	public static function instantation($the_record) {

 	    // Tar i bruk "Late static binding" og henter inn hvilke klasse-objekt som blir kallet.
		$calling_call = get_called_class();

		$the_object = new $calling_call;

		//With short way auto instantiation, går gjennom alle variablene, og hvis de er like setter dem inn.
		foreach ($the_record as $the_attribute => $value) {

			if($the_object->has_the_attribute($the_attribute)) { //"Hvis det er slik at objektet har denne attributten, så..."
				$the_object->$the_attribute = $value;
			}
		}

		return $the_object;

	}

	//Sjekker om hentet klassevariablen fra nettet har noe å hente fra det som hentes fra databasen.
	//Har dette User-objektet denne atributten.
	private function has_the_attribute($the_attribute) {

		$object_properties = get_object_vars($this);

		return array_key_exists($the_attribute, $object_properties); //"Er dette i denne?"

	}


	//Brukes til å hente alle objekt-variablene ut i et array til å brukes i andre metoder.
	protected function properties() {
		
		$properties = array();

		foreach (static::$db_table_fields as $db_field) {
			
			if (property_exists($this, $db_field)) {
				$properties[$db_field] = $this->$db_field;
			}

		}

		return $properties;
	}


	//Henter ut "Rene" properties some er escape_string'et.
	protected function clean_properties() {

		global $database;

		$clean_properties = array();

		foreach ($this->properties() as $key => $value) {
			
			$clean_properties[$key] = $database->escape_string($value);

		}

		return $clean_properties;

	}


	// Puts something into the user_activiy-table in the database
	protected function log_user_activity($act, $user_id, $target, $type) {

		global $database;

		//$database->escape_string();

		$sql  = "INSERT INTO user_activity(act, user_id, target_id, type)";
		$sql .= "VALUES ('{$act}', '{$user_id}', '{$target}', '{$type}')";


		if ($database->query($sql)) {
			
			$this->id = $database->the_insert_id();

			return true;

		} else {

			return false;

		}


	}


	//Gjør koden smartere, sier at man skal oppdatere et database-objekt hvis den er der, og lage den hvis ikke.
	public function save() {
		
		return isset($this->id) ? $this->update() : $this->create();

	}


	// Legger til et nytt objekt i databasen ut ifra et object som er satt opp.
	public function create() {
		
		global $database;
		global $session;

		$properties = $this->clean_properties();



		//Setter det opp slik for at den skal bli enklere å holde orden på.
		//Implode deler opp alle array variabler med et komma så det blir en String.
		//Gjør slik at man kan legge til flere kolonner i databasen.
		$sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ")";
		$sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";

		// Hvis denne queryen blir sendt til databasen ved database-metode 'query', så...
		if ($database->query($sql)) {
			
			$this->id = $database->the_insert_id();

			// Sets user_id as the logged in user if there is one logged in, helps when there is a user logged in.
			$user_id = isset($session->user_id) ? $session->user_id : $this->id;
			// Logs the creation of a object in the user activity-table on the database.
			$log = $this->log_user_activity("create", $user_id, $this->id, static::$db_table);

			return true;

		} else {

			return false;

		}

	}


	//Oppdaterer et objekt
	public function update() {
		
		global $database;
		global $session;

		$properties = $this->properties();

		$propteries_pairs = array();

		foreach ($properties as $key => $value) {

			$propteries_pairs[] = "{$key}='{$value}'";

		}

		$sql  = "UPDATE " . static::$db_table . " SET ";
		$sql .= implode(", ", $propteries_pairs);
		$sql .= " WHERE id= " . $database->escape_string($this->id);

		$database->query($sql);

		//Logs the creation of a object in the user activity-table on the database.
		$log = $this->log_user_activity("update", $session->user_id, $this->id, static::$db_table);
		
		//If the affected rows equal one, then... 
		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	}


	public function delete() {
		global $database;

		$sql = "DELETE FROM " . static::$db_table . " WHERE id= " . $database->escape_string($this->id);
		$sql .= " LIMIT 1";

		$database->query($sql);

		//Logs the creation of a object in the user activity-table on the database.
	    $log = $this->log_user_activity("delete", $session->user_id, $this->id, static::$db_table);
		
		//If the affected rows equal one, then... 
		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	}

}// This is the end of the db_object-class.


































?>