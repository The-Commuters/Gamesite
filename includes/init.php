<?php 

/*
 * Setter her opp de forskjellige pathene til filer, må kanskje endres til det ferdig eproduktet.
 * Tilkaller deretter alle hovedsidene som trengs å tas i bruk, funksjoner, config og sidene man
 * Gå inn på.
*/

defined('DS')            ? null : define('DS', DIRECTORY_SEPARATOR);  // Backslash in windows, annet i mac.
defined('SITE_ROOT')     ? null : define('SITE_ROOT', DS . 'XAMPP'. DS . 'htdocs' . DS . 'gamesite');  // Dette er plassering fil folderen, må endres ettersom hvor den er plassert.
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'includes');  // Definer INCLUDES_PATH omg den ikke er definert allerede. 
defined('CLASSES_PATH')  ? null : define('CLASSES_PATH', INCLUDES_PATH . DS . 'classes' . DS);  // Definer CLASSES_PATH hvis den ikke er definert allerede.
defined('PROCESS_PATH')  ? null : define('PROCESS_PATH', INCLUDES_PATH . DS . 'process' . DS);  // Definer CLASSES_PATH hvis den ikke er definert allerede.

//require_once fordi den gir en stor feilmelding, include gir bare en warning.

require_once("helpers/functions.php");              // Funksjoner som er utenfor klasser. 
require_once("helpers/config.php");                 // Inneholder database konstantene.
require_once("helpers/database.php");               // Database-klassen ligger her.
require_once("classes/db_object.php");      // Parent klasse for db_objekter.
require_once("classes/user.php");           // User-klassen ligger her.
require_once("classes/game.php");           // Klassen som styrer games.
require_once("classes/session.php");        // Kontroll over nåværende session.
require_once("classes/achievement.php");    // Funksjoner som er utenfor klasser. 
require_once("classes/rating.php");         // Klassen som omhandler ratings.
require_once("classes/friendship.php");     // Klassen som omhandler vennelister..
require_once("classes/message.php");        // Klassen som omhandler vennelister..

?>