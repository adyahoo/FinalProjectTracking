$(document).ready(function() {            
    var $path = location.pathname.split("/")[1];
    if ($path !== "") {
        $('.navbar-nav li a[href^="' + location + '"]').addClass('active');
    } else {
        $('.navbar-nav li .home-link').addClass('active');
    }
});