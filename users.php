<!-- Denne siden kommer til å innholde en liste over brukerne og en søkemotor for dem. -->

<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in() || !User::is_admin($session->user_id)) {redirect("login.php");} ?>

<div >  

<?php 

$genres = array();

//These are here so that htmlentities does not show errors, can be removed is the form is placed before it.
if (!isset($_GET['f'])) {

  $last_name = "";
  $middle_name = "";
  $first_name = "";
  $id = "";
  $users = User::find_all();

}
?>

<form id="user_search" >
<div class="">

  <div>
  <label>First Name</label>
  <input type="text" id="first_name" value="<?php echo htmlentities($first_name); ?>">
  </div>

  <div>
  <label>Middle Name</label>
  <input type="text"  id="middle_name" value="<?php echo htmlentities($middle_name); ?>">
  </div>

  <div>
  <label>Last Name</label>
  <input type="text" id="last_name" value="<?php echo htmlentities($last_name); ?>">
  </div>

  <div>
  <label>ID</label>
  <input type="text" id="id" value="<?php echo htmlentities($id); ?>">
  </div>

</div>
<input type="button" onclick="update_userlist()" value="Submit">


</form>
  <div id="userlist">
    <?php 
    include("includes/userlist.php");
    ?>
  </div>
</div>  


<script src="js/functions.js"></script>

<?php include("includes/footer.php"); ?>