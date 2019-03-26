"use strict";

// Applying chat
initChatpanel(getChatpanels());

/**
 * Gets the array of chat panels.
 */
function getChatpanels() {
    return document.getElementById("chatlist").getElementsByClassName("user");
}

function initChatpanel(chatPanels) {
    Array.from(chatPanels).forEach(element => {
        element.addEventListener('click', event => {
            makeActive(element, event);
        });
    });
}

// Make active
function makeActive(active, event) {
    let close = active.children;

    if (event.target === close[close.length-1] || event.target === close[close.length-1].children[0]) {
    } else {
        // Remove all other active
        if (active.classList.contains("-active")) {
            active.classList.remove("-active");

            // Cleans the username and the id of the chat.
            document.getElementById("chatId").value = "0";
            document.getElementById('username').innerText = "";

        } else {
            Array.from(getChatpanels()).forEach(element => {
                if (element.classList.contains("-active") && !element.classList.contains("-hide")) {
                    element.classList.remove("-active");
                }
            });
            active.classList.add("-active");

            // Gets the value from the div, sets it in chatId.
            document.getElementById("chatId").value = active.getAttribute('value');

            // Sets up the title here with the <a>, does this here so that we can get the correct user-id.
            let title = '<a href="profile.php?id=' + active.getAttribute('userId') + '" class="username">' + active.getAttribute('username') + '</a>';
            document.getElementById('username').innerHTML = title;

            let signed_in = active.getAttribute('signed_in');
            if (signed_in == 1) { 
                document.getElementById('state').classList.remove("-away");
                document.getElementById('state').classList.add("-active");
            } else {
                document.getElementById('state').classList.add("-away");
                document.getElementById('state').classList.remove("-active");
            }
        }
        let view = document.getElementById("view");
        setTimeout(function(){ view.scrollTop = view.scrollHeight; }, 500);

    }
}

//////////////////////////////////////////////////////////////////////////////


// font awsome iconer går fra i til svg må delaye initClose() til etter
// iknonene har blitt lastet in
let chatlist = document.getElementById("chatlist");

let listed = false;

if (!listed) {
    chatlist.addEventListener("click", event => {
        initClose(getClose());
    });
    listed = true;
}


/**
 * Gets the array of close buttons.
 */
function getClose() {
    return document.getElementById("chatlist").getElementsByClassName("close");
}

/**
 * @closeArray = An array of clsoe buttons
 *
 * Applies all the click event listeners
 */
function initClose(closeArray) {
    Array.from(closeArray).forEach(element => {
        console.log(element);
        element.addEventListener('click', event => {
            hideChatPanel(element.parentNode);
        });
    });
}


/**
 * @node = A close button on a chatpanel.
 *
 * Applies the -hide class to the hidepanel.
 */
function hideChatPanel(node) {
    // Execute behaviour if the active chat is closed

    if (node.classList.contains("-active")) {

        // Not found yet
        let found = false;

        // tries to find a replacement
        Array.from(getClose()).forEach(element => {
            let parentClose = element.parentNode;
            if (!parentClose.classList.contains("-active") && !found && !parentClose.classList.contains("-hide")) {
                found = true;
                parentClose.classList.add("-active");

                // Gets the value from the div, sets it in chatId.
                document.getElementById("chatId").value = parentClose.getAttribute('value');

                // Sets up the title here with the <a>, does this here so that we can get the correct user-id.
                let title = '<a href="profile.php?id=' + parentClose.getAttribute('userId') + '" class="username">' + parentClose.getAttribute('username') + '</a>';
                document.getElementById('username').innerHTML = title;
                
                let view = document.getElementById("view");
                setTimeout(function(){ view.scrollTop = view.scrollHeight; }, 300);

            }

        });

        node.classList.remove("-active");
        node.classList.add("-hide");


        let view = document.getElementById("view");
        view.scrollTop = view.scrollHeight;


        // Call on the ajax function to close a chat, sends room_id.
        close_chatroom(node.getAttribute('fsId'));
      
        // Check if a replacement for active has been found
        if (!found) {
            // ADD a add new chat button

            // Sets it at zero if there is none left.
            document.getElementById("chatId").value = "0";
            document.getElementById('username').innerText = "";

            let view = document.getElementById("view");
            setTimeout(function(){ view.scrollTop = view.scrollHeight; }, 300);

        }
    } else {
        // Hide chatpanel
        node.classList.add("-hide");

        // Call on the ajax function to close a chat, sends room_id.
        close_chatroom(node.getAttribute('fsId'));

    }
}


////////////////////////////////////////////////////////////////////////////////////////7

// view make it go to the bottom.
let view = document.getElementById("view");

////////////////////////////////////////////////////////////////////////////////////////7

// Chat Input
let input = document.getElementById("chat-input");

let inputValue;
let map = {};
let reset = false;

// On enter key pressed
input.onkeydown = onkeyup = function(e){
    e = e || event;
    map[e.keyCode] = e.type == 'keydown';

    if (!(map[16]) && map[13]) {
        inputValue = input.value;
        setTimeout(function(){ view.scrollTop = view.scrollHeight; }, 200);
        reset = true;
    }

}

input.addEventListener("input", event => {

    if (reset) {
        reset = false;
        input.value = "";
        input.style.height = "";
    }
});

