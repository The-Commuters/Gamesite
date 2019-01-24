<?php 

//require_once fordi den gir en stor feilmelding, include gir bare en warning.


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);  //backslash in windows, annet i mac.
define('SITE_ROOT', DS . 'XAMPP'. DS . 'htdocs' . DS . 'gamesite');  //Dette er plassering fil folderen, må endres ettersom hvor den er plassert.
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'includes');

require_once("functions.php"); // Funksjoner som er utenfor klasser. 
require_once("config.php"); // Inneholder database konstantene.
require_once("database.php"); // Database-klassen ligger her.
require_once("db_object.php"); // Parent klasse for db_objekter.
require_once("user.php"); // User-klassen ligger her.
require_once("game.php"); // Klassen som styrer games.
require_once("session.php");// Kontroll over nåværende session.
require_once("achievement.php"); // Funksjoner som er utenfor klasser. 
require_once("rating.php"); // Klassen som omhandler ratings.
//Place paths later on here.

?>