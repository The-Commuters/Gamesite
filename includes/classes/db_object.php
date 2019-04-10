<?php

/*
 * This is the parent object-class that extends to other object-classes
 * The methods in this class will have to be abstract, and can be used in
 * The sub-classes that is database-objects.
 */

class Db_object {

	protected static $db_table = "users"; 

	/**
	 * Collects all of the objects of this variation from the database-table
	 * that belongs to it, an example would be that it would collect all information
	 * of all the users into an array and returns it.
	 *
	 * @return an array filled with the objects in the database-table.
	 */
	public static function find_all() {

		return static::find_by_query("SELECT * FROM " . static::$db_table . " ");

	}

	/**
	 * Collects one object from a table in the datbase, which is collected depends
	 * on the parameter sent in. If the id is in the datbase then the one object is
	 * sent back, but if not then false is sent back. 
	 * 
	 * @param $id the id of the object that you want to collect.
	 * @return the object if $the_result_array is not empty, false if it is.
	 */
	public static function find_by_id($id) {

		global $database; //Tar i bruk klassen som $database-objektet er laget av, kan da ta i bruk query().
		$the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");

		//Man kan og gjøre dette, synes vi burde det på prosjektet, heter tenery syntax.
		return !empty($the_result_array) ? array_shift($the_result_array) : false;

	}

	/**
	 * Middle-point between the query-Database-method, creates an array and uses the
	 * instantation-method to make an array of objekter and then send them out like
	 * an object array, as all of the rows is made into objects before stored into the
	 * array.
	 *
	 * @param $sql is the SQL created in find_all() or find_by_id() in this class.
	 * @return the newly created object-array filled with objects created in instantation().
	 */
	public static function find_by_query($sql) {

		global $database;
		$result_set = $database->query($sql);
		$the_object_array = array(); 

		while ($row = mysqli_fetch_array($result_set)) { 
			$the_object_array[] = static::instantation($row);
		}

		return $the_object_array;
	}

	/**
	 * This class makes the rows collected with query in find_by_query() into objects of
	 * the class they should be, by finding out the type of the object and then place
	 * each of the items in the $the_record-array into the object. 
	 *  
	 * @param $the_record is one row of the rows collected in find_by_query().
	 * @return $the_object which is the finished object with the values of hte row.
	 */
	public static function instantation($the_record) {

		$calling_call = get_called_class(); // "Late Static Binding" is this called.
		$the_object = new $calling_call;    // New 'User', 'Game' or any of the other classes.

		foreach ($the_record as $the_attribute => $value) {
			if($the_object->has_the_attribute($the_attribute)) { 
				$the_object->$the_attribute = $value;
			}
		}

		return $the_object;

	}

	/**
	 * Checks if the class variable collected has this attribute, used in instantation() to check
	 * if this variable is there, and sets it into the correct place in the object if it does. It
	 * asks if this attribute is in the objects object-properties created at the top of the object-
	 * classes.
	 *
	 * @param $the_attribute is one of the attributes of the object, like 'id' or 'username'
	 * @return true if $the_attribute exists inside of the $object_properties.
	 */
	private function has_the_attribute($the_attribute) {

		$object_properties = get_object_vars($this);

		return array_key_exists($the_attribute, $object_properties); 

	}

	/**
	 * All of the classes has arrays with the table fields in the database at the top of them,
	 * and these is also reflected in the object-properties. This class-method makes an array
	 * filled with the properties the object holds something in, used when one wants to place
	 * and objectt into the database.
	 *
	 * @return $properties an array filled with the fields that an object holds.
	 */
	protected function properties() {
		
		$properties = array();

		foreach (static::$db_table_fields as $db_field) {
			
			if (property_exists($this, $db_field)) {
				$properties[$db_field] = $this->$db_field;
			}

		}

		return $properties;
	}

	/**
	 * Cleans the properties of an object, sends them trough real_escape_string() in the
	 * escape_string() method to ensure that there is no damaging SQL in them. This is to
	 * reduce the chance of SQL-injections.
	 *
	 * @return $clean_properties is the properties of the object that is sent trough real_escape_string().
	 */
	protected function clean_properties() {

		global $database;

		$clean_properties = array();

		foreach ($this->properties() as $key => $value) {
			
			$clean_properties[$key] = $database->escape_string($value);

		}

		return $clean_properties;

	}


	/**
	 * A method that logs any change done to the database done on the website. This is
	 * stored in the 'user_activity' table in the database. Decided to do it here rather
	 * than to do it inside of the database for now with a trigger, as we can decide what 
	 * to put into the fields.
	 *
	 * @param $act tells if it was a delete, update or create.
	 * @param $user_id tells the user that did the thing
	 * @param $target tells the id of the target item.
	 * @param $type tells what table/object it was done on.
	 *
	 */
	protected function log_user_activity($act, $user_id, $target, $type) {

		global $database;

		$sql  = "INSERT INTO user_activity(act, user_id, target_id, type)";
		$sql .= "VALUES ('{$act}', '{$user_id}', '{$target}', '{$type}')";

		if ($database->query($sql)) {
			
			$this->id = $database->the_insert_id();

			return true;

		} else {

			return false;

		}


	}


	/**
	 * Makes the PHP smarter, with this you can do '$user->save();' and if it
	 * is already created it will update, and if its not then it will create it.
	 *
	 * @return either create an object or return, true both times.
	 */
	public function save() {
		
		return isset($this->id) ? $this->update() : $this->create();

	}


	/**
	 * This is the clas that create database-rows for any of the objects that have
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
			
			$this->id = $database->the_insert_id();
			$user_id = isset($session->user_id) ? $session->user_id : $this->id;

			$log = $this->log_user_activity("create", $user_id, $this->id, static::$db_table);

			return true;

		} else {

			return false;

		}

	}

	/**
	 * This updates an object who has a id already stored in the database, it sets
	 * together strings of keys and values into and array and uses the sql command 
	 * UPDATE to change the items that should be changed. Logs the change in the 
	 * database table 'user_activity' with log_user_activity. If any rows is affected
	 * in the database then it returns true, else it returns false. 
	 *
	 * @return true if a row was affected by the sql, false if not.
	 */
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
		//$log = $this->log_user_activity("update", $session->user_id, $this->id, static::$db_table);
		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	}

	/**
	 * Last of the CRUD methods, this delete a row on the objects table with the id
	 * of the object thr method is called on. Then adds a new row to the user_actvity-
	 * table. 
	 *
	 * @return true if a row is deleted and false if not.
	 */
	public function delete() {

		global $database;
		global $session;

		$sql = "DELETE FROM " . static::$db_table . " WHERE id= " . $database->escape_string($this->id);
		$sql .= " LIMIT 1";

		$database->query($sql);
	    $log = $this->log_user_activity("delete", $session->user_id, $this->id, static::$db_table);
		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	}

}// This is the end of the db_object-class.


































?>