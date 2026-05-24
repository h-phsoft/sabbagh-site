/* global PhSettings*/
"use strict";
jQuery(document).ready(function () {
  $('#login-form').addClass('needs-validation');
  $('#login-form').removeClass('was-validated');
  $('#ph-login').on('click', function (e) {
    e.preventDefault();
    doSignIn();
  });
  $('#username, #password').on('keyup', function (e) {
    e.preventDefault();
    if (e.which === 13) {
      doSignIn();
    }
  });
  $('#loginStatus').html('');
});

function doSignIn() {
  let vUsername = $('#username').val();
  let vPassword = $('#password').val();
  if (isValidForm('login-form')) {
    $.ajax({
      type: PhSettings.login.Method,
      async: false,
      url: PhSettings.login.URL,
      headers: PhSettings.Headers,
      data: {
        "username": vUsername,
        "password": vPassword
      },
      success: function (response) {
        if (response.Status) {
          window.location.href = window.location.href
        } else {
          $('#loginStatus').text(response.Message);
        }
      }
    });
  } else {
    $('#login-form').removeClass('needs-validation');
    $('#login-form').addClass('was-validated');
  }
}
