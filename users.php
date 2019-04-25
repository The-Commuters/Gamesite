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

<main>
    <div class="banner">User list</div>

    <div class="user-list">
        <form id="user_search" class="user-list-search" >

            <label>User Search</label>

            <div class="user-list-input">
                <input type="text" placeholder="Search" onkeyup="update_userlist()" id="search" value="<?php echo htmlentities($search); ?>">

                <select id="category" onchange="update_userlist()">
                    <option value="all" selected="selected">All</option>
                    <option value="id">ID</option>
                    <option value="name">Name</option>
                    <option value="username">Username</option>
                    <option value="email">Email</option>
                    <option value="date">Date</option>
                </select>
            </div>
        </form>

        <table class="user-list-list">
          <thead>
            <tr>
              <th>Avatar</th>
              <th>Username</th>
              <th class="user-list-hide-laptop">Name</th>
              <th class="user-list-hide-tablet">Email</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td><div class="avatar -s" style="background-image: url(<?php echo $user->get_user_image(); ?>)"></div></td>
              <td>WilliWonka</td>
              <td class="user-list-hide-laptop">Willi Wonka</td>
              <td class="user-list-hide-tablet">hehe@willi.no</td>
              <td>
                <div class="user-list-actions">
                  <a href="profile.php" data-tooltip="Profile" class="user-list-action tooltip"><i class="fas fa-user"></i></a>

                  <!-- Legg till en sjekk for om de virkelig vil slette denne brukeren -->
                  <button data-tooltip="Delete" class="user-list-action -delete tooltip"><i class="fas fa-user-times"></i></button>

                  <!-- Legg till en sjekk for om de virkelig vil promote denne brukeren -->
                  <button data-tooltip="Promote" class="user-list-action -promote tooltip"><i class="fas fa-user-tie"></i></button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
    </div>

</main>

<div>
  <div id="userlist">
    <?php 
    include("includes/views/userlist.php");
    ?>
  </div>
</div>  

<?php include("includes/views/footer.php"); ?>