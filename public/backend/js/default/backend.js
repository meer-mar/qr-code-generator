'use strict';

/** Global Variables */
const isDemo = $("meta[name=mode]").attr('content');
const csrf_token = $("meta[name=csrf-token]").attr('content');
const loading = `<div class="d-flex justify-content-center align-items:center p-3">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>`


/** Reusable Functions */

/**
 * Translates all inputs one by one to the specified language.
 *
 * @param {string} lang - The language to translate the inputs to.
 */
function translateAllTo(lang) {
  if (isDemo == 0) {
    toastr.error(demo_mode_error);
    return;
  }

  $('#translate-btn').prop('disabled', true);
  $('#update-btn').prop('disabled', true);

  var inputs = $('[data-translate="true"]').toArray();

  var isTranslatingInputs = true;

  function translateOneByOne(inputs, index = 0) {
    if (index >= inputs.length) {
      if (isTranslatingInputs) {
        isTranslatingInputs = false;
        translateAllTextarea();
      }
      $('#translate-btn').prop('disabled', false);
      $('#update-btn').prop('disabled', false);
      return;
    }

    var $input = $(inputs[index]);
    var inputValue = $input.val();

    if (inputValue) {
      $.ajax({
        url: `${base_url}/admin/languages/update-single`,
        type: "POST",
        data: {
          lang: lang,
          text: inputValue,
          _token: csrf_token
        },
        dataType: 'json',
        beforeSend: function () {
          $input.prop('disabled', true);
          iziToast.show({
            timeout: false,
            close: true,
            theme: 'dark',
            icon: 'loader',
            iconUrl: 'https://hub.izmirnic.com/Files/Images/loading.gif',
            title: translation_processing,
            position: 'center',
          });
        },
        success: function (response) {
          $input.val(response);
          $input.prop('disabled', false);
          iziToast.destroy();
          toastr.success(translation_success);
          translateOneByOne(inputs, index + 1);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus, errorThrown);
          iziToast.destroy();
          toastr.error('Error', errorThrown);
        }
      });
    } else {
      translateOneByOne(inputs, index + 1);
    }
  }

  function translateAllTextarea() {
    var inputs = $('textarea[data-translate="true"]').toArray();
    if (inputs.length === 0) {
      return;
    }
    translateOneByOne(inputs);
  }

  translateOneByOne(inputs);
};

// get states
function getStates(url) {
  $.ajax({
    method: 'GET',
    url: url,
    beforeSend: function () {
      $('.state').html(`<option value="">Loading...</option>`);
    },
    success: function (data) {
      $('.state').html(`<option value="">Select</option>`);
      $.each(data, function (key, value) {
        $('.state').append(`<option value="${value.id}">${value.name}</option>`);
      })
    },
    error: function (xhr, status, error) {
      $('.state').html(`<option value="">Select</option>`);
    }
  })
}

function getLocation(url, selector) {
  $.ajax({
    method: "GET",
    url: url,
    beforeSend: function () {
      $.ajax({
        method: "GET",
        url: url,
        beforeSend: function () {
          $(selector).html(`<option value="">Loading...</option>`);
        },
        success: function (data) {
          $(selector).html(`<option value="">Select</option>`);
          $.each(data, function (key, value) {
            $(selector).append(
              `<option value="${value.id}">${value.name}</option>`
            );
          });
        },
        error: function (xhr, status, error) {
          $(selector).html(`<option value="">Select</option>`);
        },
      });
    },
  });
}


/** Show dynamic modal
 * @param {string} url
 */
function showDynamicModal(url) {
  $.ajax({
    method: "GET",
    url: url,
    beforeSend: function () {
      $(".dynamic-modal .modal-body").html(loading);
    },
    success: function (data) {
      $(".dynamic-modal .modal-body").html(data);
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        orientation: "bottom auto"
      });
    },
    error: function (xhr, status, error) { },
  });
}


/** Show dynamic modal */
$(".show-modal").on("click", function (e) {
  e.preventDefault();
  $(".dynamic-modal").modal("show");
  let url = $(this).attr("data-url");
  showDynamicModal(url);
});


/** On Document Ready */

$(document).ready(function () {

  /** Change status toggle */
  $('.change-status').on('change', function (e) {
    e.preventDefault();

    if (!isDemo) return toastr.error(demo_mode_error);

    const url = $(this).attr('data-url');

    $.ajax({
      type: "put",
      data: {
        _token: csrf_token,
      },
      url: url,
      success: function (response) {
        if (response.success) {
          toastr.success(response.message);
        } else {
          toastr.warning(response.message);
        }
      },
      error: function (err) {
        console.log(err);
      }
    })


  })

})