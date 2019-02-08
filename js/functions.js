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

    var search = document.getElementById("search").value;

    var selector = document.getElementById("category");
    var category = selector.options[selector.selectedIndex].value;

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            document.getElementById("userlist").innerHTML = this.responseText;
    };

    xmlhttp.open("GET","includes/userlist.php?s="+search+"&c="+category,true);
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

    xmlhttp.open("GET","includes/gamelist.php?s="+search+"&c="+category+"&g="+genre,true);
    xmlhttp.send();
    
}