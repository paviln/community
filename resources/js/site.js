require('./bootstrap');

window.filterCategory = function (elm) {
    var category = elm.getAttribute('value');
    var game = elm.parentElement.className;

    var servers = document.getElementsByClassName(game);

    if (category === "all") {
        for (var i = 1; i < servers.length; i++) {
            if (servers[i].style) {
                servers[i].style.display = "block";
            }
        }
    } else {
        for (var i = 1; i < servers.length; i++) {
            if (servers[i].style) {
                if (servers[i].getAttribute('data-categiry') === category) {
                    servers[i].style.display = "block";
                } else {
                    servers[i].style.display = "none";
                }
            }
        }
    }
}
