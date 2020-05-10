require('./bootstrap');

//import {servers} from './admin/servers.js';

window.showCategories = function (elm) {
    var categories = document.getElementById("category").childNodes;

    // Deselect the current selected category
    $("#category").val("");

    for (var i = 0; i < categories.length; i++) {
        if (categories[i].style) {
            if (categories[i].classList.contains(elm.className)) {
                categories[i].style.display = "block";
            } else {
                categories[i].style.display = "none";
            }
        }
    }
}


