<?php
	
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/gamesite/includes/init.php";
	require_once($path); 

	$messages = Message::find_all();

	foreach ($messages as $message) : 

        $username=$message->username;
        $text=$message->text;
        $time=date('G:i', strtotime($message->time));

        echo "<p>$time | $username: $text</p>\n";

    endforeach; 

?>