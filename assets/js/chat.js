
/**
 * Jquery for the chat, sends and retrieves the messages that
 * belong in the chatroom with the read_chat and write_chat php
 * files.
 */

$(document).ready(function() {
    var chatInterval = 300;                // Refresh interval in miliseconds
    var $chatId      = $("#chatId");       // The chat-id and also the game-id
    var $chatOutput  = $("#chatOutput");   // All the messages that have been collected from the database.
    var $chatInput   = $("#chat-input");   // This is the string that the person writes.
    var $chatSend    = $("#chatSend");     // this is the send button.

    // Sends there inn the message into the database.
    function sendMessage() {
        var chatIdString = $chatId.val();
        var chatInputString = $chatInput.val();

        // Uses here .get to call upon the write_chat php-file.
        $.get("./includes/process/write_chat.php", {
            chatId: chatIdString,
            text: chatInputString
        });

        $chatInput.val("");
        retrieveMessages();
        $('input[name=chatInput').val('');
    }

    // Collects here out the messages for the chatroom.
    function retrieveMessages() {
        var chatIdString = $chatId.val();

        // Sends here the chat-id in and collects the output.
        $.get("./includes/process/read_chat.php", { chatId: chatIdString }, function(data) {
            $chatOutput.html(data); 
        });
    }
    
    // When the enter key is pressed while the focus is on the box.
    $('#chat-input').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);

        // If the shiftkey is NOT pressed down.
        if (!event.shiftKey) {

            // If the key pressed is the Enter key.
            if(keycode == '13'){
                sendMessage();
            
            }
        }
    });

    // Retrieves the messages from the database with every interval
    setInterval(function() {
        retrieveMessages();
    }, chatInterval);
});