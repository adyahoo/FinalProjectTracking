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

function search(id) {
  $("#formSearch" + id).submit();
}
/******/ })()
;
//# sourceMappingURL=layout.js.map