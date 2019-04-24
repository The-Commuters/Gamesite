
/**
 * The ajax function that rates the game when one of the input
 * boxes is checked, is used whenever a user rates a game on 
 * the gamesite.
 *
 * @param int game_id Spillet som det gjelder sin id.
 */
function rate_game(game_id) {

    xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("message").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET","includes/process/rate_game.php?g="+game_id,true);
    xmlhttp.send();

}

function update_userlist() {

    var search = document.getElementById("search").value;

    var selector = document.getElementById("category");
    var category = selector.options[selector.selectedIndex].value;

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("userlist").innerHTML = this.responseText;
    };

    xmlhttp.open("GET","includes/views/userlist.php?s="+search+"&c="+category,true);
    xmlhttp.send();

}

function update_gamelist() {

    var search = document.getElementById("search").value;

    var selector = document.getElementById("genre");
    var genre = selector.options[selector.selectedIndex].value;

    var selector = document.getElementById("category");
    var category = selector.options[selector.selectedIndex].value;

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("gameslist").innerHTML = this.responseText;
    };

    xmlhttp.open("GET","includes/views/gamelist.php?s="+search+"&c="+category+"&g="+genre,true);
    xmlhttp.send();
    
}

/**
 * updates the friendlist after a user friend have been
 * deleted from it, is called upon in the delete_friend()
 * function. 
 */
function update_friendlist() {

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("friendlist_content-ajax").innerHTML = this.responseText;

    };

    xmlhttp.open("GET","includes/views/friendlist_content.php",true);
    xmlhttp.send();
    
}

function find_friend() {

    var search = document.getElementById("search").value;

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("friend_search").innerHTML = this.responseText;
    };

    xmlhttp.open("GET","includes/process/friend_search.php?s="+search,true);
    xmlhttp.send();
    
}

/**
 *
 */
function delete_friend(user_id, friend_id) {

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("friendlist-ajax").innerHTML = this.responseText;

    };
    
    // Updates the friendlist in 0.1 second, giving the process time to finish.
    setTimeout(function(){ update_friendlist(); }, 100);

    xmlhttp.open("GET","includes/process/delete_friend.php?user_id="+user_id+"&friend_id="+friend_id,true);
    xmlhttp.send();
    
}

function send_friend_request(user_id, other_id) {

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("friend_search").innerHTML = this.responseText;
            document.getElementById("search").value = "";
    };

    hide_alert();

    xmlhttp.open("GET","includes/process/add_friend.php?i="+user_id+"&o="+other_id,true);
    xmlhttp.send();
    
}

/**
 *Accept one of the friend request when the user 
 * accept, changed the friend_list status to 1.
 */
function handle_friend_request(user_id, other_id, id, act) {

    //Act is 0 if declined and 1 if accepted.

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("friendlist-ajax").innerHTML = this.responseText;

    };
    
    hide_alert();

    // Updates the friendlist in 0.1 second, giving the process time to finish.
    setTimeout(function(){ update_friendlist(); }, 100);

    xmlhttp.open("GET","includes/process/handle_friend_request.php?ui="+user_id+"&oi="+other_id+"&a="+act+"&id="+id,true);
    xmlhttp.send();
    
}

// Belongs to the chat,
function close_chatroom(friendship_id) {

    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        document.getElementById("username").innerHTML = this.responseText;
    };
    xmlhttp.open("GET","includes/process/close_chatroom.php?fsId="+friendship_id,true);
    xmlhttp.send();
    
}

// Belongs to the chat, starts a chat between two people. 
function start_chat(user_1, user_2) { 
 
    xmlhttp = new XMLHttpRequest(); 
 
    xmlhttp.onreadystatechange = function() { 
        document.getElementById("friendlist-ajax").innerHTML = this.responseText; 
    }; 
    xmlhttp.open("GET","includes/process/start_chatroom.php?u1="+user_1+"&u2="+user_2,true); 
    xmlhttp.send(); 
    setTimeout(function(){ 
        window.location.href = 'chat.php?user='+user_2; 
    }, 1000);
} 

// Updates the settings of a user
function update_names() {

    var first_name  = document.getElementById("fname").value;
    var middle_name = document.getElementById("mname").value;
    var last_name   = document.getElementById("lname").value;

    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        document.getElementById("image").innerHTML = this.responseText;
    };

    hide_alert();

    xmlhttp.open("GET","includes/process/update_settings.php?fname="+first_name+"&mname="+middle_name+"&lname="+last_name,true);
    xmlhttp.send();
    
}

// Belongs to the chat, starts a chat between two people.
function earn_achievement(achievement_id) {

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        document.getElementById("info").innerHTML = this.responseText;
    };

    hide_alert();
    
    
    xmlhttp.open("GET","includes/process/add_achievement.php?aId="+achievement_id,true);
    xmlhttp.send();
}

/**
 * Refreshes the header picture that shows of the users
 * avatar, is called in file_upload and used when a user
 * upload a new avatar. 
 */
function refresh_header_picture() {

    // Timeout to ensure that the new avatar have been placed in the database.
    setTimeout(function(){ 
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            document.getElementById("profile").innerHTML = this.responseText;
        };
        
        xmlhttp.open("GET","includes/process/refresh_header_picture.php",true);
        xmlhttp.send();
    }, 200);

}

/**
 * Registers the user if the information is correct,
 * Opens up the process register_user.php on the 
 * register.php.
 */
function register_user() {

    var password_check   = document.getElementById("password_check").value;
    var password         = document.getElementById("password").value;
    var email            = document.getElementById("email").value;
    var username         = document.getElementById("username").value;

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        document.getElementById("image").innerHTML = this.responseText;
    };

    hide_alert();
    
    xmlhttp.open("GET","includes/process/register_user.php?pc="+ password_check +"&p=" + password + "&u=" + username + "&e=" + email,true);
    xmlhttp.send();
}


//-------------------------- Upload profile image -----------------------------

/**
 * Happens when a file is dropped in the square, it will call 
 * on the function that call's on the php process.
 *
 * @param {event} event - The event in question.
 */
function upload_file(event) {
    var file;
    event.preventDefault();
    file = event.dataTransfer.files[0];
    file_upload(file);
    
  }
 
// On button
function find_file() {
    var file;
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        file = document.getElementById('selectfile').files[0];
      file_upload(file);
    };
  }
 
// Upload avatar picture.
function file_upload(file) {
    if(file != undefined) {
        var form_data = new FormData();                  
        form_data.append('file', file);

        xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            document.getElementById("image").innerHTML = this.responseText;
        };

        
        hide_alert();


        xmlhttp.open("POST","includes/process/upload_profile_picture.php",true);


        refresh_header_picture();
        xmlhttp.send(form_data);

    }
  }

// closes alert after 3 seconds
function hide_alert() {

    setTimeout(function(){ 
        document.getElementById('alert').classList.remove("-active");
    }, 3000);


}

function hide(id){
    document.getElementById(id).style.display="none";
    //console.log("ho");
}
