<?php 

//Klassen som omgjør alt ved håndtering av brukere i databasen.
class Message extends Db_object{

	//Klasse-variabler kalles properties.
	protected static $db_table = "user_chat"; //Slik at man kan endre navnet på databasetabellen.

	//Array skal brukes i properies() og inneholder achivement-variablene til objektet.
	protected static $db_table_fields = array('id', 'user_id', 'username', 'text', 'time');
	public $id;
	public $user_id;
	public $username;
	public $text;
	public $time;



}

?>