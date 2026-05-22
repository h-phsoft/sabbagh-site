$(document).ready(function () {
  $("#ph-submit").click(function (e) {
    e.preventDefault();
    let vOld = $('#fldOld').val();
    let vNew = $('#fldNew').val();
    let vConf = $('#fldVerify').val();
    if (vOld && vNew && vConf && vNew === vConf) {
      $.ajax({
        type: PhSettings.changePassword.Method,
        url: PhSettings.changePassword.URL,
        headers: PhSettings.Headers,
        data: {
          'vOPassword': vOld,
          'vNPassword': vNew,
          'vVPassword': vConf
        },
        success: function (response) {
          if (response.Status) {
            $('#Status').text(response.Message);
          }
        }
      });
    }
  });
});
