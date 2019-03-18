<?php 

/**
 * This page will contain a list where the admin's
 * can search after users, then they will be able to
 * go to their profile, delete them or change their 
 * information.
 */

include("includes/views/header.php");

if (!$session->is_signed_in() || !User::is_admin($session->user_id)) {redirect("login.php");} 

$genres = array();

if (!isset($_GET['f'])) {

  $search = "";
  $users = User::find_all();

}

?>

<div >  
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
    include("includes/views/userlist.php");
    ?>
  </div>
</div>  

<?php include("includes/views/footer.php"); ?>