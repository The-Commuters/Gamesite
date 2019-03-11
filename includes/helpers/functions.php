<?php 
//Denne siden inneholder individuelle funksjoner som ikke er inne i klasser.


//Funksjon som sjekker om vi har glemt å legge ved de riktige includes, safety-net.
//Scanner application og leter etter udeklarerte objekter, sier ifra hvis man ikke finner filer.
// Gjør applikasjonen mer roburst.
function classAutoLoader($class) {

	$class = strtolower($class);

	$the_path = "includes/classes/{$class}.php";

	if(is_file($the_path) && !class_exists($class)) {

		include $the_path;

	} 
}

//Laget denne da det er enklere å ta denne i bruk enn statiske headere, man skriver in hvor man ønsker at bruker skal bli ledet hen i kallet på funksjonen.
function redirect($location) {
	
	header("Location: {$location}");

}


spl_autoload_register('classAutoLoader');


?>