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

// Make active and also change the current room_id
function makeActive(active, event) {
    let close = active.children;

    if (event.target === close[close.length-1] || event.target === close[close.length-1].children[0]) {
    } else {
        // Remove all other active
        if (active.classList.contains("-active")) {
            active.classList.remove("-active");
        } else {
            Array.from(getChatpanels()).forEach(element => {
                if (element.classList.contains("-active") && !element.classList.contains("-hide")) {
                    element.classList.remove("-active");
                }
            });
            active.classList.add("-active");
        }
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
            }
        });

        node.classList.remove("-active");
        node.classList.add("-hide");

        // Check if a replacement for active has been found
        if (!found) {
            // ADD a add new chat button
        }
    } else {
        // Hide chatpanel
        node.classList.add("-hide");
    }
}

////////////////////////////////////////////////////////////////////////////////////////7


// Chat Input
let input = document.getElementById("chat-input");
var room = document.getElementById("chatId");


let inputValue, room_id;
let map = {};
let reset = false;

// On enter key pressed
input.onkeydown = onkeyup = function(e){
    e = e || event;
    map[e.keyCode] = e.type == 'keydown';
    if (!(map[16]) && map[13]) {
        alert(input.value);
        inputValue = input.value;
        room_id = input.value;
        reset = true;
    }

}

input.addEventListener("input", event => {
    input.style.height = "";
    input.style.height = input.scrollHeight + "px";

    let inputParent = input.parentNode;
    inputParent.scrollTop = inputParent.scrollHeight - inputParent.clientHeight;

    if (reset) {
        reset = false;
        input.value = "";
        input.style.height = "";
        input.style.height = input.scrollHeight + "px";
    }
});