/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
var resultId = 0;
var resultData = [];
var mettaData = {};

jQuery(document).ready(function () {

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/Logo",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/Logo",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/Logo",
      "Method": "DELETE"
    },
    "Count": {
      "URL": PhSettings.serviceURL + "/Logo",
      "Method": "PUT"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/Logo",
      "Method": "OPTIONS"
    }
  };
  mettaData.ImagePath = PhSettings.mediaPath + 'logos/';
  mettaData.DefaultImage = PhSettings.mediaPath + 'logos/logo.png';

  $('#ph-submit').off('click').on('click', function () {
    if (PhSettings.Perms.Insert || PhSettings.Perms.Update) {
      var $btn = $(this);
      $btn.attr('disabled', true);
      $btn.find('.spinner-border').removeClass('d-none');
      setTimeout(function () {
        $.when(doSave())
          .always(function () {
            $btn.attr('disabled', false);
            $btn.find('.spinner-border').addClass('d-none');
          });
      }, 1);
    }
  });

  doNew();

});

function setBImage(bImage) {
  $('#fldAttach').attr('value', bImage);
  $('#fldFExt').val('png');
}

function doNew() {
  resetFormValid('ph_Form');
  $('#ph_Form').trigger('reset');
  $('#ph_Form').removeClass('was-validated');
  $('#fldImagePreview').attr('src', mettaData.DefaultImage);
  loadFromURL(mettaData.DefaultImage, (result) => {
    setBImage(result);
  });
}

function doSave() {

  if (isValidForm('ph_Form')) {
    $.ajax({
      async: false,
      type: mettaData.URLS.Save.Method,
      url: mettaData.URLS.Save.URL,
      data: {
        "vFExt": $('#fldFExt').val(),
        "vFName": $('#fldFName').val(),
        "vFile": $('#fldAttach').val()
      },
      success: function (response) {
        if (response.Status) {
          showToast(getLabel('lbl.cms.Save'), 'WARNING', response.Message);
        } else {
          showToast(getLabel('lbl.cms.Error'), 'DANGER', response.Message);
        }
      }
    });
  }
}
