<!-- Denne siden kommer til å innholde en liste over brukerne og en søkemotor for dem. -->

<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in() || !User::is_admin($session->user_id)) {redirect("login.php");} ?>

<div >  

<?php 

$genres = array();

//These are here so that htmlentities does not show errors, can be removed is the form is placed before it.
if (!isset($_GET['f'])) {

  $search = "";
  $users = User::find_all();

}
?>

<form id="user_search" >
<div class="">

<div>

  <label>User Search</label>
  <input type="text" onkeyup="update_userlist()" id="search" value="<?php echo htmlentities($search); ?>">

  <select id="category" onchange="update_userlist()">
    <option value="all" selected="selected">All</option>
    <option value="first_name">First Name</option>
    <option value="middle_name">Middle Name</option>
    <option value="last_name">Last Name</option>
    <option value="id">ID</option>
  </select>

</div>

</form>
  <div id="userlist">
    <?php 
    include("includes/userlist.php");
    ?>
  </div>
</div>  

<script src="js/functions.js"></script>

<?php include("includes/footer.php"); ?>