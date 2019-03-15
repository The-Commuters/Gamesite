<?php require_once("includes/views/header.php") ?>

<?php 

// Kaller på en metode i session som logger en ut. 
$session->logout();

//Funksjon som sender deg til login.
redirect("login.php");

?>


