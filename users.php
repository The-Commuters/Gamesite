<?php 

/**
 * This page will contain a list where the admin's
 * can search after users, then they will be able to
 * go to their profile, delete them or change their 
 * information.
 */

include("includes/views/header.php");

// If there is no signed in user, or if the user is not an admin.
if (!$session->is_signed_in() || !User::is_admin($session->user_id)) {redirect("login.php");} 

$genres = array();
$search = "";
$users = User::find_all_objects();

?>

<main>
    <div class="banner">User list</div>

    <div class="user-list">
        <form id="user_search" class="user-list-search" >

            <label>User Search</label>

            <div class="user-list-input">
                <input type="text" placeholder="Search" onkeyup="updateUserlist()" id="search" value="<?php echo htmlentities($search); ?>">

                <select id="category" onchange="updateUserlist()">
                    <option value="all" selected="selected">All</option>
                    <option value="id">ID</option>
                    <option value="name">Name</option>
                    <option value="username">Username</option>
                    <option value="email">Email</option>
                    <option value="date">Date</option>
                </select>
            </div>
        </form>



  <div id="userlist">
    <?php 
    include("includes/views/userlist.php");
    ?>
  </div>
 
    </div>

</main>

<!-- Used for running the process files in for start chatroom and delete user ajax-functions. -->
<div id="userlist-ajax"></div>

<?php include("includes/views/footer.php"); ?>