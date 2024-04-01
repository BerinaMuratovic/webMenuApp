
$(document).ready(function() {
    var app = $.spapp({
        defaultView: "#view_home",
        templateDir: "./views/"
    });

    app.route({
        view: "view_about",
        load: "about.html",
        onCreate: function() { },
        onReady: function() { }
    });

    app.route({
        view: "view_special",
        load: "special-items.html",
        onCreate: function() { },
        onReady: function() {
            getSpecialItems()
        }
    });

    app.route({
        view: "view_reservations",
        load: "reservations.html",
        onCreate: function() { },
        onReady: function() { }
    });
    app.route({
        view: "view_login",
        load: "login.html",
        onCreate: function() { },
        onReady: function() { }
    });

    app.route({
        view: "view_register",
        load: "register.html",
        onCreate: function() { },
        onReady: function() { }
    });

    app.run();
});
document.addEventListener("DOMContentLoaded", function() {
    getDrinksByType("cold")
    const tabLinks = document.querySelectorAll('.tm-tab-link');

    tabLinks.forEach(function(tabLink) {
        tabLink.addEventListener('click',  function(event) {
            event.preventDefault();
            const tabId = this.getAttribute('data-id');

            try {
                const listOfDrinks = document.getElementById('list-of-drinks');
                listOfDrinks.innerHTML = getDrinksByType(tabId);

                tabLinks.forEach(function(link) {
                    link.classList.remove('active');
                });
                this.classList.add('active');
            } catch (error) {
                console.error('Error fetching drinks:', error);
            }
        });
    });
});


