<?php 

/**
 * Achievement-class will handle the achievements that 
 * is in the Achivements table in the database. Used
 * to collect the images and text when one need to show
 * the achievements of a user, when its earned or for
 * the game.
 */

class Level extends Db_object{

	protected static $db_table = "level"; 

	protected static $db_table_fields = array('needed_xp');
	public $id;
	public $needed_xi;

}

?>