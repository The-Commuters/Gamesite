
<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 
?> 


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Character set -->
    <meta charset="utf-8">

    <!-- Making IE act like Edge -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Setting the viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <title>Game-Site</title>

    <!-- Page description -->
    <meta name="description" content="Description of the page less than 150 characters">

    <!-- Icon -->
    <link rel="icon" type="image/png" href="favicon.png">

    <!-- CSS files -->
    <link rel="stylesheet" href="css/main.css">

    <!-- JavaScript files -->
    <script src="js/main.js" async></script>
     

</head>
<body>
    <div>
    <a href="index.php">Index</a>
    <a href="games.php">List of games</a>

    <?php if ($session->is_signed_in()) { ?>

        <a href="profile.php?id=<?php echo $session->user_id;?>">Profile</a>
        <a href="upload.php">Upload</a>
        <a href="settings.php">Settings</a>
        <a href="logout.php">Logout</a>
	
        <?php if (User::is_admin($session->user_id)) { ?>

            <a href="users.php">List of users</a>
        
        <?php } ?>

    <?php } else { ?>

    <a href="login.php">Login</a> 
    <a href="register.php">Register</a></p>

    <?php } ?>
    </div>
