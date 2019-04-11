
<?php 
if (empty($_GET['id'])) {
  redirect("users.php");
}

$user = User::find_by_id($session->user_id);
?>

<?php 
echo "This is your profile page " . $user->username . ", but there is little for you to do here at the moment.";
?>




<?php 

/**
 * This is the page where the users can change their data,
 * Can only be reached by admins with the access to the
 * userlist or the users themself.
 */

require_once("includes/views/header.php");

if (!$session->is_signed_in()) {redirect("login.php");} 

?>

<div>
	
<form id="login-id" action="" method="post">
	
<div class="">
	<label>First Name</label>
	<input id="fname" type="text" name="first_name" value="<?php echo $user->first_name ?>" >
</div>

<div class="">
	<label>Middle Name</label>
	<input id="mname" type="text" name="middle_name" value="<?php echo $user->middle_name; ?>" >
</div>

<div class="">
	<label>Last Name</label>
	<input id="lname" type="text" name="last_name" value="<?php echo $user->last_name; ?>" >
</div>

<!-- Change password -->

<div class="">
<input type="button" name="submit" value="Submit" onclick="update_names()">

</div>

</form>

<div id="drop_zone" ondrop="upload_file(event, 1)" ondragover="return false">
  <div id="drag_upload_file">
    <p>Place file in the blue area!</p>
    <input type="button" value="Select File" onclick="find_file();">
    <input type="file" id="selectfile">
  </div>
</div>

<!-- The alert is placed here -->
<div id="image"></div>

</div>
