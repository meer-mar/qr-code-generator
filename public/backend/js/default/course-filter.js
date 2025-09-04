$(function() {
  'use strict';

  $(".draggable-list").sortable({
      handle: ".move-icon",
      cursor: "move",
      axis: "y",
  });
  $(".draggable-list").disableSelection();

  $(".add-button").on("click", function(e) {
      e.preventDefault();
      var clone = $(".darg-item").clone();
      clone.removeClass("d-none");
      clone.removeClass("darg-item");
      $(".draggable-list").append(clone);
  });
  $('body').on('click', '.remove-item', function(e) {
      e.preventDefault();
      $(this).closest('.form-group').remove();
  });
});