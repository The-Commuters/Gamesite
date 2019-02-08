
<?php require_once("../includes/header.php") ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

if (empty($_GET['id'])) {
	redirect("../games.php");
}

$game = Game::find_by_id($_GET['id']);

$game->delete();

redirect("../games.php");

?>