/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/blog/layout.js ***!
  \*************************************/
$(document).ready(function () {
  var $path = location.pathname.split("/")[1];

  if ($path !== "") {
    $('.navbar-nav li a[href^="' + location + '"]').addClass('active');
  } else {
    $('.navbar-nav li .home-link').addClass('active');
  }
});

function searchCategory(id) {
  $("#formSearch" + id).submit();
}

$("#like_btn").click(function () {
  $(this).toggleClass("far fas");
});
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$('i.fa-heart').click(function () {
  var id = $(this).parents(".section-content__count").data('id');
  var c = $('#' + this.id + '-bs3').html();
  var cObjId = this.id;
  var cObj = $(this);
  $.ajax({
    type: 'POST',
    url: '/like',
    data: {
      id: id
    },
    success: function success(data) {
      $(cObj).toggleClass("far fas");

      if (cObj.hasClass("far")) {
        $('#' + cObjId + '-bs3').html(parseInt(c) - 1);
        $('#' + cObjId + '-bs2').html(parseInt(c) - 1);
      } else {
        $('#' + cObjId + '-bs3').html(parseInt(c) + 1);
        $('#' + cObjId + '-bs2').html(parseInt(c) + 1);
      }
    }
  });
});
/******/ })()
;
//# sourceMappingURL=layout.js.map