$( "ul.submenu li" ).click(function() {
    alert();
    $("ul.submenu li").removeClass("open");
    $("#menulink + .dropdown-menu").css("display", "none");
});