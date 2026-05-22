/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
var resultId = 0;
var resultData = [];
var mettaData = {};

jQuery(document).ready(function () {

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/User",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/User",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/User",
      "Method": "DELETE"
    },
    "Count": {
      "URL": PhSettings.serviceURL + "/User",
      "Method": "PUT"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/User",
      "Method": "OPTIONS"
    },
    "ResetPWD": {
      "URL": PhSettings.serviceURL + "/User/ResetPassword",
      "Method": "POST"
    }
  };

  mettaData.ImagePath = PhSettings.mediaPath + '/avatars/';
  mettaData.DefaultImage = 'avatar-0.png';

  if (PhSettings.Perms.Query) {
    $('.result-type').off('click').on('click', function () {
      $('.result-type').removeClass('btn-warning');
      $('.result-type').addClass('btn-outline-warning');
      $(this).removeClass('btn-outline-warning');
      $(this).addClass('btn-warning');
      resultType = parseInt($(this).data('val'));
      phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
    });
  }

  if (PhSettings.Perms.Insert) {
    $('#ph-new').on('click', function () {
      doNew();
    });
  }

  if (PhSettings.Perms.Query) {
    $('#ph-search-text').off('keyup').on('keyup', function () {
      phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
    });
  }

  if (PhSettings.Perms.Insert || PhSettings.Perms.Update) {
    $('#ph-submit').off('click').on('click', function () {
      if (PhSettings.Perms.Insert) {
        var $btn = $(this);
        $btn.attr('disabled', true);
        $btn.find('.spinner-border').removeClass('d-none');
        setTimeout(function () {
          $.when(doAdd())
            .always(function () {
              $btn.attr('disabled', false);
              $btn.find('.spinner-border').addClass('d-none');
            });
        }, 1);
      }
    });
  }

  if (PhSettings.Perms.Update) {
    $('#ph-save').off('click').on('click', function () {
      var $btn = $(this);
      $btn.attr('disabled', true);
      $btn.find('.spinner-border').removeClass('d-none');
      setTimeout(function () {
        $.when(doUpdate())
          .always(function () {
            $btn.attr('disabled', false);
            $btn.find('.spinner-border').addClass('d-none');
          });
      }, 1);
    });
  }

  if (PhSettings.Perms.Update) {
    $('#ph-reset').off('click').on('click', function () {
      var $btn = $(this);
      $btn.attr('disabled', true);
      $btn.find('.spinner-border').removeClass('d-none');
      setTimeout(function () {
        $.when(doResetPWD())
          .always(function () {
            $btn.attr('disabled', false);
            $btn.find('.spinner-border').addClass('d-none');
          });
      }, 1);
    });
  }

  if (PhSettings.Perms.Insert) {
    doNew();
  }
  if (PhSettings.Perms.Query) {
    phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
  }

});

function setResultType(nType) {
  $('.result-type').removeClass('btn-warning');
  $('.result-type').addClass('btn-outline-warning');
  $('#result-type-' + nType).removeClass('btn-outline-warning');
  $('#result-type-' + nType).addClass('btn-warning');
  resultType = parseInt($('#result-type-' + nType).data('val'));
}

function doNew() {
  $('#ph_add_form').addClass('d-none');
  $('#ph_edit_form').addClass('d-none');
  $('#ph_resetPassword_form').addClass('d-none');
  resetFormValid('ph_Form');
  $('#ph_add_form').trigger('reset');
  $('#ph_add_form').removeClass('was-validated');
  $('#fldId').val(0);
  $('#addStatusId').val($('#addStatusId :first').val());
  $('#addUserType').val($('#addUserType :first').val());
  $('#addUserGender').val($('#addUserGender :first').val());
  $('#addUserBranch').val($('#addUserBranch :first').val());
  $('#addUserName').val('');
  $('#addUserLogon').val('');
  $('#addnpassword').val('');
  $('#addvpassword').val('');
  $('#ph_add_form').removeClass('d-none');
}

function getPage(vText, nStart, nEnd, nPage, nPerPage) {

  if (PhSettings.Perms.Query) {
    $.ajax({
      async: false,
      type: mettaData.URLS.List.Method,
      url: mettaData.URLS.List.URL,
      headers: PhSettings.Headers,
      data: {
        start: nStart,
        end: nEnd,
        page: nPage,
        perpage: nPerPage,
        "vText": vText
      },
      success: function (response) {
        if (response.Status) {
          resultData = response.Data;
          renderTable();
          $('.btn-edit').off('click').on('click', function (e) {
            e.preventDefault();
            resultId = parseInt($(this).data('rid'));
            doEdit(resultId);
          });
          $('.btn-reset').off('click').on('click', function (e) {
            e.preventDefault();
            resultId = parseInt($(this).data('rid'));
            doReset(resultId);
          });
          $('.btn-delete').off('click').on('click', function (e) {
            e.preventDefault();
            resultId = parseInt($(this).data('rid'));
            doDelete(resultId);
          });
        }
      }
    });
  }
}

function doAdd() {

  if (isValidForm('ph_add_form')) {
    $.ajax({
      async: false,
      type: mettaData.URLS.Save.Method,
      url: mettaData.URLS.Save.URL,
      headers: PhSettings.Headers,
      data: {
        "nId": 0,
        "nStatusId": $('#addUserStatus').val(),
        "nGenderId": $('#addUserGender').val(),
        "nTypeId": $('#addUserType').val(),
        "nBranId": $('#addUserBranch').val(),
        "vName": $('#addUserName').val(),
        "vLogon": $('#addUserLogon').val(),
        "vNPassword": $('#addnpassword').val(),
        "vCPassword": $('#addvpassword').val()
      },
      success: function (response) {
        if (response.Status) {
          doNew();
          phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
          showToast(getLabel('lbl.cms.Save'), 'WARNING', response.Message);
        } else {
          showToast(getLabel('lbl.cms.Error'), 'DANGER', response.Message);
        }
      }
    });
  }
}

function doUpdate() {

  if (PhSettings.Perms.Update) {
    if (isValidForm('ph_edit_form')) {
      $.ajax({
        async: false,
        type: mettaData.URLS.Save.Method,
        url: mettaData.URLS.Save.URL,
        headers: PhSettings.Headers,
        data: {
          "nId": $('#editUserId').val(),
          "nStatusId": $('#editUserStatus').val(),
          "nGenderId": $('#editUserGender').val(),
          "nTypeId": $('#editUserType').val(),
          "nBranId": $('#editUserBranch').val(),
          "vName": $('#editUserName').val(),
          "vLogon": $('#editUserLogon').val()
        },
        success: function (response) {
          if (response.Status) {
            doNew();
            phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
            showToast(getLabel('lbl.cms.Save'), 'WARNING', response.Message);
          } else {
            showToast(getLabel('lbl.cms.Error'), 'DANGER', response.Message);
          }
        }
      });
    }
  }
}

function doDelete(nIdx) {

  if (PhSettings.Perms.Delete) {
    let item = resultData[nIdx];
    let nId = item.nId;
    if (nId > 0) {
      swal.fire({
        title: getLabel('lbl.cms.Delete'),
        text: getLabel('lbl.cms.Are you sure ?'),
        showCancelButton: true,
        confirmButtonText: "<i class='bi bi-check-lg'></i> " + getLabel('lbl.cms.Yes'),
        cancelButtonText: "<i class='bi bi-x-lg'></i> " + getLabel('lbl.cms.No')
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            async: false,
            type: mettaData.URLS.Delete.Method,
            url: mettaData.URLS.Delete.URL,
            headers: PhSettings.Headers,
            data: {
              "nId": nId
            },
            success: function (response) {
              if (response.Status) {
                doNew();
                phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
                showToast(getLabel('lbl.cms.Delete'), 'SUCCESS', response.Message);
              } else {
                showToast(getLabel('lbl.cms.Error'), 'DANGER', response.Message);
              }
            }
          });
        } else if (result.dismiss === "cancel") {
        }
      });
    }
  }
}

function doEdit(nIdx) {

  $('#ph_add_form').addClass('d-none');
  $('#ph_edit_form').addClass('d-none');
  $('#ph_resetPassword_form').addClass('d-none');
  resetFormValid('ph_edit_form');
  let item = resultData[nIdx];
  $('#editUserId').val(item.nId);
  $('#editUserStatus').val(item.nStatus);
  $('#editUserGender').val(item.nGender);
  $('#editUserType').val(item.nType);
  $('#editUserBranch').val(item.nBranId);
  $('#editUserName').val(item.vName);
  $('#editUserLogon').val(item.vLogon);
  $('#ph_edit_form').removeClass('d-none');
}

function doReset(nIdx) {

  $('#ph_add_form').addClass('d-none');
  $('#ph_edit_form').addClass('d-none');
  $('#ph_resetPassword_form').addClass('d-none');
  resetFormValid('ph_Form');
  let item = resultData[nIdx];
  $('#resetUserId').val(item.nId);
  $('#resetNPassword').val('');
  $('#resetVPassword').val('');
  $('#ph_resetPassword_form').removeClass('d-none');
}

function doResetPWD() {

  if (PhSettings.Perms.Update) {
    if (isValidForm('ph_resetPassword_form')) {
      $.ajax({
        async: false,
        type: mettaData.URLS.ResetPWD.Method,
        url: mettaData.URLS.ResetPWD.URL,
        headers: PhSettings.Headers,
        data: {
          "nId": $('#resetUserId').val(),
          "vNPassword": $('#resetNPassword').val(),
          "vVPassword": $('#resetVPassword').val()
        },
        success: function (response) {
          if (response.Status) {
            doNew();
            phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
            showToast(getLabel('lbl.cms.Reset Password'), 'WARNING', response.Message);
          } else {
            showToast(getLabel('lbl.cms.Error'), 'DANGER', response.Message);
          }
        }
      });
    }
  }
}

function renderTable() {
  let vHtml = '';
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml += `<tr>
                <td class="text-start">
                  <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm" aria-expanded="false">
                      <i class="icon bi bi-three-dots"></i>
                    </a>
                    <div class="dropdown-menu" style="margin: 0px;">
                      ${PhSettings.Perms.Update ? `<a class="dropdown-item btn-edit w-100" data-rid="${i}"><i class="bi bi-pencil"></i>&nbsp;${getLabel("lbl.cms.Edit")}</a>` : ``}
                      ${PhSettings.Perms.Update ? `<a class="dropdown-item text-warning btn-reset" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("lbl.cms.Reset Password")}"><i class="bi bi-key"></i>${getLabel("lbl.cms.Reset Password")}</a>` : ``}
                      <hr>
                      ${(PhSettings.Perms.Delete) ? `<a class="dropdown-item btn-delete w-100 text-danger" data-rid="${i}"><i class="bi bi-trash"></i>&nbsp;${getLabel("lbl.cms.Delete")}</a>` : ``}
                    </div>
                  </div>
                </td>
                <td>${item.vName}</td>
                <td>${item.vLogon}</td>
                <td>${item.vGenderName}</td>
                <td>${item.vStatusName}</td>
              </tr>`;
  }
  $('#result-Table tbody').html(vHtml);
}
