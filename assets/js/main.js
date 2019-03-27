
/**
 *
 * @param int game_id Spillet som det gjelder sin id.
 */
function rate_game(game_id) {

    var score = document.querySelector('input[name="stars"]:checked').value;

    if (score == "") {
        document.getElementById("message").innerHTML = "";
        return;
    } else { 

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("message").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET","includes/process/rate_game.php?s="+score+"&g="+game_id,true);
    xmlhttp.send();
    }
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

function find_friend() {

    var search = document.getElementById("search").value;

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("friend_search").innerHTML = this.responseText;
    };

    xmlhttp.open("GET","includes/process/friend_search.php?s="+search,true);
    xmlhttp.send();
    
}

function send_friend_request(user_id, other_id) {

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("send_friend_request").innerHTML = this.responseText;
    };

    xmlhttp.open("GET","includes/process/add_friend.php?i="+user_id+"&o="+other_id,true);
    xmlhttp.send();
    
}

//Accept one of the friend request when the user accept, changed the friend_list status to 1.
function handle_friend_request(user_id, other_id, id, act) {

    //Act is 0 if declined and 1 if accepted.

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("handle_friend_request").innerHTML = this.responseText;
    };
    
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
        document.getElementById("chat").innerHTML = this.responseText;
    };
    xmlhttp.open("GET","includes/process/start_chatroom.php?u1="+user_1+"&u2="+user_2,true);
    xmlhttp.send();

    window.location.href = 'chat.php?user=' + user_2;
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

    show_alert();

    xmlhttp.open("GET","includes/process/update_settings.php?fname="+first_name+"&mname="+middle_name+"&lname="+last_name,true);
    xmlhttp.send();
    
}

//-------------------------- Upload profile image -----------------------------

// On drop
function upload_file(event) {
    var file;
    event.preventDefault();
    file = event.dataTransfer.files[0];
    avatar_upload(file);
  }
 
// On button
function find_file() {
    var file;
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        file = document.getElementById('selectfile').files[0];
      avatar_upload(file);
    };
  }
 
// Upload avatar picture.
function avatar_upload(file) {
    if(file != undefined) {
        var form_data = new FormData();                  
        form_data.append('file', file);

        xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            document.getElementById("image").innerHTML = this.responseText;
        };

        show_alert();

        xmlhttp.open("POST","includes/process/upload_profile_picture.php",true);
        xmlhttp.send(form_data);

    }
  }

// closes alert after 3 seconds
function show_alert() {

    setTimeout(function(){ 
        document.getElementById('alert').classList.remove("-active");
    }, 3000);


}