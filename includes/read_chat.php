<?php
	
	include("init.php");

	$messages = Message::find_all();

	foreach ($messages as $message) : 

        $username=$message->username;
        $text=$message->text;
        $time=date('G:i', strtotime($message->time));

        echo "<p>$time | $username: $text</p>\n";


    endforeach; 

?>