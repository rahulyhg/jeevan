require.config({
    paths: {
        "async": "../../../lib/routelib/async-0.1.1",
        "domReady": "../../../lib/routelib/domReady-2.0.1",
        "knockout": "../../../lib/routelib/knockout-3.0.0.min",
        "eventEmitter": "../../../lib/routelib/eventEmitter",
        "jquery": "../../../lib/routelib/jquery-1.8.2.min",
        "jquery.cookie": "../../../lib/routelib/jquery.cookie",
        "jquery.ui": "../../../lib/routelib/jquery-ui-1.10.3.custom.min",
        "jquery.ui.sortable": "../../../lib/routelib/jquery-ui-1.10.3.custom.min",
        "knockout.sortable": "../../../lib/routelib/knockout.sortable-0.8.4.min",
        "datepicker": "../../../lib/routelib/bootstrap-datepicker.min",
    }
});

require(["domReady!", "app"], function (doc, App) {
    var app = new App();
    app.init();
});
