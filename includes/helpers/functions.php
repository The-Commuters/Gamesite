<?php 

/**
 * This is where all the php-functions outside of classes is
 * placed.
 */

/**
 * Function that uses the header to send the user to the page
 * that the string $location says, is cleaner than placing 
 * static header()'s everywhere. 
 */
function redirect($location) {
	
	header("Location: {$location}");

}

/** 
 * This function allows you to register multiple functions 
 * (or static methods from your own Autoload class) that PHP 
 * will put into a stack/queue and call sequentially when a 
 * "new Class" is declared. The classes is called after 
 * each other's on the init, so this need's to be used.
 * Simply, puts the classes to be loaded in into a stack.
 */
function class_auto_loader($class) {

	$class = strtolower($class);

	$the_path = "includes/classes/{$class}.php";

	if(is_file($the_path) && !class_exists($class)) {

		include $the_path;

	} 
}

// Registers the auto-loader for the php-classes.
spl_autoload_register('class_auto_loader');

?>