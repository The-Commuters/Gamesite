"use strict";

// Aplying the genrelist.
initGenreist(getGenrelist());

/**
 *  Gets the array of genre-divs.
 */
function getGenrelist() {
    return document.getElementById("genrelist").getElementsByClassName("genre");
}

function initGenreist(genrelist) {
    Array.from(genrelist).forEach(element => {
        element.addEventListener('click', event => {
            makeActive(element, event);
        });
    });
}

// Make active
function makeActive(active, event) {

        // Remove all other active
        if (active.classList.contains("active")) {
            active.classList.remove("active");
        } else {
            Array.from(getGenrelist()).forEach(element => {
                if (element.classList.contains("active")) {
                    element.classList.remove("active");
                }
            });
            active.classList.add("active"); 
        }
        document.getElementById('genre').value = active.getAttribute('data-genre');
        update_gamelist();
}

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////


// font awsome iconer går fra i til svg må delaye initClose() til etter
// iknonene har blitt lastet in
let genrelist = document.getElementById("genrelist");
let categorylist = document.getElementById("categorylist");



