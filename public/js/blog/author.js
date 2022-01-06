/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/blog/author.js ***!
  \*************************************/
$(document).ready(function () {
  $('#authorSortSelect').change(function () {
    sortValue = this.value;
    checkViewLayout();
  });
  $('#viewId').click(function () {
    sortValue = $('#authorSortSelect').val();

    if (sortValue != null) {
      checkViewLayout();
    }
  });
});

function checkViewLayout() {
  userId = $('#userSelectedId').val();

  if ($('#viewId').hasClass("fa-th-large")) {
    getSortedData(sortValue, 'grid', userId);
  } else {
    getSortedData(sortValue, 'list', userId);
  }
}

function getSortedData(data, type, id) {
  $.ajax({
    type: 'POST',
    url: '/author_sort_blog',
    data: {
      data: data,
      type: type,
      id: id
    },
    success: function success(data) {
      if (type == 'grid') {
        $('#gridContent').html(data);
      } else {
        $('#listContent').html(data);
      }
    }
  });
}
/******/ })()
;
//# sourceMappingURL=author.js.map