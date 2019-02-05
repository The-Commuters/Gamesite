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

    xmlhttp.open("GET","includes/rate_game.php?s="+score+"&g="+game_id,true);
    xmlhttp.send();
    }
}

function update_userlist() {

    var first_name = document.getElementById("first_name").value;
    var middle_name = document.getElementById("middle_name").value;
    var last_name = document.getElementById("last_name").value;
    var id = document.getElementById("id").value;

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("userlist").innerHTML = this.responseText;
    };

    xmlhttp.open("GET","includes/userlist.php?f="+first_name+"&m="+middle_name+ "&l=" + last_name+"&u="+id,true);
    xmlhttp.send();
    
}