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
        onReady: function() { }
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

    const tabLinks = document.querySelectorAll('.tm-tab-link');
    const navLinks = document.querySelectorAll('.tm-page-link');


    tabLinks.forEach(function(tabLink) {
        tabLink.addEventListener('click', function(event) {
            event.preventDefault();


            const tabId = this.getAttribute('data-id');


            document.querySelectorAll('.tm-tab-content').forEach(function(tabContent) {
                tabContent.style.display = 'none';
            });


            document.getElementById(tabId).style.display = 'block';


            tabLinks.forEach(function(link) {
                link.classList.remove('active');
            });


            this.classList.add('active');
        });
    });

    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function(event) {
            navLinks.forEach(function(link) {
                link.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
});
