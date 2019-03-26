<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/gamesite/includes/init.php";
require_once($path); 

// Checks if the uploaded file if of a acceptable type.
$file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
if (!(in_array($_FILES['file']['type'], $file_types))) {
	echo "Wrong filetype";
	return;
}

// Creates the storage folder if it's not there from before.
$image_storage = SITE_ROOT . DS . 'assets' . DS . 'img' . DS . 'profile' . DS . 'default';
if (!file_exists($image_storage)) {
	mkdir($image_storage, 0777);
}

$image_name = time() . '_' . $_FILES['file']['name'];
$image_dir = $image_storage . DS . $image_name;

$user = new User;
$user = User::find_by_id($session->user_id);
$user->user_image = $image_name;
$user->update();

move_uploaded_file($_FILES['file']['tmp_name'], $image_dir);
?>

<!-- The alert that is shown when '-active' is placed in the classlist. -->
<div id="alert" class="alert -warning -active">
	<div>Your profile picture have been updates!</div>
</div>