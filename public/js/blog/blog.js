/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/blog/blog.js ***!
  \***********************************/
$("#list-view").hide();
$("#view_id").click(function () {
  $(this).toggleClass("fa-th-large fa-list");

  if ($(this).hasClass("fa-th-large")) {
    $("#list-view").hide();
    $("#grid-view").show();
  } else {
    $("#list-view").show();
    $("#grid-view").hide();
  }
});

(function ($, document, window, viewport) {
  var sticky = function sticky() {
    if (window.innerWidth > 768) {
      $('#sidebar').addClass('sticky-top');
      $('#collapseSidebar').addClass('show');
    } else {
      $('#collapseSidebar').removeClass("show");
    }
  };

  $(document).ready(function () {
    sticky();
  });
  $(window).resize(viewport.changed(function () {
    sticky();
  }));
})(jQuery, document, window, ResponsiveBootstrapToolkit);

$(document).ready(function () {
  var index = $('#filterIndex').val();
  $('#cancelLabelSearch').click(function () {
    $('#labelSearch').hide();
  });
  $('#cancelLabelKategori').click(function () {
    $('#labelKategori').hide();
  });

  var _loop = function _loop(i) {
    $('#cancelLabelFilter-' + i).click(function () {
      $('#labelFilter-' + i).hide();
    });
  };

  for (var i = 1; i <= index; i++) {
    _loop(i);
  }
});
$('#yearSelect').change(function () {
  var selected = $('#yearSelect').find(":selected").val();

  if (selected != 0) {
    $('#monthSelect').removeAttr('disabled');
  }
});
/******/ })()
;
//# sourceMappingURL=blog.js.map