<div class="chatcontainer">
	<main>
		<div class="userSettings">
			<label id="chatid">Chat ID:</label>
			<input id="chatId" type="text" placeholder="<?php echo $current_game_id; ?>" maxlength="32" value="<?php echo $current_game_id; ?>">
		</div>
		<div class="chat">
			<div id="chatOutput"></div>
			<input id="chatInput" type="text" placeholder="Input Text here" maxlength="128">
			<button id="chatSend">Send</button>
		</div>
	</main>
</div>
<script src="js/chat.js"></script>