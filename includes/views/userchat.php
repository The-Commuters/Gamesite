<!--
$chatroom_id is set up wherever this is called, and will decide what room id it is.
-->
<div class="chatcontainer">
	<main>
		<div class="userSettings">
			<label id="chatid">Chat ID:</label>
			<input id="chatId" type="text" placeholder="<?php echo $chatroom_id ?>" maxlength="32" value="<?php echo $chatroom_id; ?>">
		</div>
		<div class="chat">
			<div id="chatOutput"></div>
			<input id="chatInput" type="text" placeholder="Input Text here" maxlength="128">
			<button id="chatSend">Send</button>
		</div>
	</main>
</div>
<script src="js/chat.js"></script>