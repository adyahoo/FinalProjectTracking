$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var index = $('#filterIndex').val()

    $('#cancelLabelSearch').click(function() {
        $('#labelSearch').hide()
    });

    $('#cancelLabelKategori').click(function() {
        $('#labelKategori').hide()
    });

    for(let i = 1; i <= index; i++) {
        $('#cancelLabelFilter-' + i).click(function() {
            $('#labelFilter-' + i).hide()
        });
    }

    $('#sortSelect').change(function () {
        sortValue = this.value
        checkViewLayout()
    })

    $('#viewId').click(function () {
        sortValue = $('#sortSelect').val()

        if (sortValue != null) {
            checkViewLayout()
        }
    })
});

$("#listView").hide();

$("#viewId").click(function() {
    $(this).toggleClass("fa-th-large fa-list")
    
    if ($(this).hasClass("fa-th-large")) {
        $("#listView").hide();
        $("#gridView").show();
    } else {
        $("#listView").show();
        $("#gridView").hide();
    }
});

(function($, document, window, viewport){      
    var sticky = function () {                    
        if( window.innerWidth > 768 ) {
            $('#sidebar').addClass('sticky-top')
            $('#collapseSidebar').addClass('show')
        } else {
            $('#collapseSidebar').removeClass("show")
        }
    }
    
    $(document).ready(function () {
        sticky()
    })
    
    $(window).resize(
        viewport.changed(function() {
            sticky()             
        })
    );
})(jQuery, document, window, ResponsiveBootstrapToolkit);


$('#yearSelect').change(function() {
    var selected = $('#yearSelect').find(":selected").val()
    if (selected != 0) {
        $('#monthSelect').removeAttr('disabled')
    }
})

function checkViewLayout() {
    if ($('#viewId').hasClass("fa-th-large")) {
        getSortedData(sortValue, 'grid')
    } else {
        getSortedData(sortValue, 'list')
    }
}

function getSortedData(data, type) {
    $.ajax({
        type: 'POST',
        url: '/sort_blog',
        data: {
            data: data,
            type: type,
        },
        success: function success(data) {
            if (type == 'grid') {
                $('#gridContent').html(data)
            } else {
                $('#listContent').html(data)
            }
        }
    });
}