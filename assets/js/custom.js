$(document).ready(function() {
    var app = $.spapp({
        defaultView: "#view_home", // Default view to load
        templateDir: "./views/"    // Directory containing view files
    });

    // Define routes for each view
    app.route({
        view: "view_home",
        load: "home.html",
        onCreate: function() { },
        onReady: function() { }
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

    app.run(); // Start the application
});
