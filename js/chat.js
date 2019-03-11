$(document).ready(function() {
    var chatInterval = 300; // Refresh interval in miliseconds
    var $userName = $("#userName"); // The username
    var $chatOutput = $("#chatOutput");
    var $chatInput = $("#chatInput");
    var $chatSend = $("#chatSend");

    function sendMessage() {
        var userNameString = $userName.val();
        var chatInputString = $chatInput.val();

        // Uses here get to call upon the write_chat php-file.
        $.get("./includes/process/write_chat.php", {
            username: userNameString,
            text: chatInputString
        });

        $userName.val("");
        retrieveMessages();
        $('input[name=chatInput').val('');
    }

    function retrieveMessages() {
        $.get("./includes/process/read_chat.php", function(data) {
            $chatOutput.html(data); 
        });
    }

    $chatSend.click(function() {
        sendMessage();
    });

    setInterval(function() {
        retrieveMessages();
    }, chatInterval);
});