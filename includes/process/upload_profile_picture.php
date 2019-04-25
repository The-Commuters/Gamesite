<?php

/**
 * This file is called whenever someone uploads a new image
 * to their profile, it will show the alert on the page
 * when the process is done.
 */

$path = __DIR__ ."\..\init.php";
require_once($path);
	
// Checks if the uploaded file if of a acceptable type.
$file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
if (in_array($_FILES['file']['type'], $file_types)) {

	// Creates the storage folder if it's not there from before.
	$image_storage = SITE_ROOT . DS . 'assets' . DS . 'img' . DS . 'profile' . DS . 'default';
	if (!file_exists($image_storage)) {
		mkdir($image_storage, 0777);
	}

	// Creates the new name of the image, adds the time to make it unique.
	$image_name = time() . '_' . $_FILES['file']['name'];
	$image_dir = $image_storage . DS . $image_name;

	$user = new User;
	$user = User::find_by_id($session->user_id);

	// Deletes the old profile image here.
	try {unlink($image_storage . DS . $user->user_image);} catch (exception $e) {}

	// Places the new image name in the image folder.
	$user->user_image = $image_name;
	$user->update();

	// Moves the uploaded file to $image_dir.
	move_uploaded_file($_FILES['file']['tmp_name'], $image_dir);

?>
<!-- The profile picture have been sucessfully updated. -->
<div id="alert" class="alert -success -active">
	<div>Your profile picture have been updated!</div>
</div>

<?php } else { ?>
<!-- The picture upload have been rejected because of unsupported filetype. -->
<div id="alert" class="alert -danger -active">
	<div>The filetype of the image is not accepted!</div>
</div>

<?php } ?>

