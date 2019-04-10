<?php 

/**
 * This is the page where people can create a new user,
 * this have to be done to become able to use a few of 
 * the functions on the website.
 */

require_once("includes/views/header.php");

if ($session->is_signed_in()) {redirect("index.php");}

?>

<div>
	
<form id="login-id" action="" method="post">
	
<div class="">
	<label>Username</label>
	<input type="text" id="username" >

</div>

<div class="">
	<label>Email</label>
	<input type="text" id="email" >

</div>

<div class="">
	<label>Password</label>
	<input type="password" id="password" >
	
</div>

<div class="">
	<label>Password_Check</label>
	<input type="password" id="password_check">
	
</div>

<div class="">
<input type="button" name="submit" value="Submit" onclick="register_user()">

</div>

</form>

<!-- The alert is placed here -->
<div id="image"></div>

</div>