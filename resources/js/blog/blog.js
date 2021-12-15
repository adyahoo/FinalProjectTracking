$("#list-view").hide();

$("#view_id").click(function() {
    $(this).toggleClass("fa-th-large fa-list")
    
    if ($(this).hasClass("fa-th-large")) {
        $("#list-view").hide();
        $("#grid-view").show();
    } else {
        $("#list-view").show();
        $("#grid-view").hide();
    }
})