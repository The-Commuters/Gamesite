<?php 


//Klassen som omgjør alt ved håndtering av brukere i databasen.
class Achievement extends Db_object{

	//Klasse-variabler kalles properties.
	protected static $db_table = "gained_achievements"; //Slik at man kan endre navnet på databasetabellen.

	//Array skal brukes i properies() og inneholder achivement-variablene til objektet.
	protected static $db_table_fields = array('id', 'user_id', 'gained');
	public $achievements_id;
	public $user_id;
	public $gained;

	// Denne skal lage et achivement-objekt som så skal sendes inn til databasen.
	// Objektet skal være satt sammen med rader fra både users og achievements.
	// Skal kunne kalles på inne i spill hvis en viss handling skal skje.
	// Feks: alle ball-objekter blir spist av en spillerstyrt slange.
	// Kallet blir da noe alla: verify_achivement($user_id, $achivement_id);   

	public function verify_gained_achivement($achievement_id) {

		global $session;

		$this->gained  = date("Y-m-d");
		$this->user_id = $session->user_id;
		$this->id      = $achievement_id;

		$this->create();

	}


}

?>