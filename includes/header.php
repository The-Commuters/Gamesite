<?php// ob_start(); ?>
<?php require_once("init.php"); ?> <!-- Så alle filene blir satt i gang.-->


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Game-Site</title>
     

</head>

<body>

    <a href="index.php">Index</a>
    <a href="games.php">List of games</a>
    <a href="users.php">List of users</a>

    <?php if ($session->is_signed_in()) { ?>
	
	<a href="profile.php?id=<?php echo $session->user_id;?>">Profile</a>
	<a href="upload.php">Upload</a>
    <a href="logout.php">Logout</a>

    <?php } else { ?>

    <a href="login.php">Login</a> 
    <a href="register.php">Register</a></p>

    <?php } ?>

    <div id="wrapper">