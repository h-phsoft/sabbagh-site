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
    "List": {
      "URL": PhSettings.serviceURL + "/User",
      "Method": "OPTIONS"
    },
    "ResetPWD": {
      "URL": PhSettings.serviceURL + "/User/ResetPassword",
      "Method": "POST"
    }
  };
  mettaData.ImagePath = 'assets/media/avatars/';
  mettaData.DefaultImage = 'manager1.png';

  $('#ph-new').on('click', function () {
    doNew();
    $('#addUserModal').modal('show');
  });

  $('#ph-search-text').off('keyup').on('keyup', function () {
    doSearch($('#ph-search-text').val());
  });

  $('#ph-submit').off('click').on('click', function () {
    doAdd();
  });

  $('#ph-reset').off('click').on('click', function () {
    doResetPWD();
  });

  $('#ph-save').off('click').on('click', function () {
    doUpdate();
  });

  doNew();
  doSearch('');

});

function doNew() {
  resetFormValid('ph_Form');
  $('ph_add_form').trigger('reset');
  $('ph_add_form').removeClass('was-validated');
  $('#fldId').val(0);
  $('#addStatusId').val($('#addStatusId :first').val());
  $('#addUserType').val($('#addUserType :first').val());
  $('#addUserGender').val($('#addUserGender :first').val());
  $('#addUserBranch').val($('#addUserBranch :first').val());
  $('#addUserName').val('');
  $('#addUserLogon').val('');
  $('#addnpassword').val('');
  $('#addvpassword').val('');
}

function doSearch(vText) {

  if (PhSettings.Perms.Query) {
    $.ajax({
      async: false,
      type: mettaData.URLS.List.Method,
      url: mettaData.URLS.List.URL,
      headers: PhSettings.Headers,
      data: {
        "vText": vText
      },
      success: function (response) {
        if (response.Status) {
          resultData = response.Data;
          let vHtml = '';
          for (var i = 0; i < resultData.length; i++) {
            let item = resultData[i];
            let editBtn = '';
            let resetBtn = '';
            let deleteBtn = '';
            if (PhSettings.Perms.Update) {
              editBtn = `<span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span>`;
              resetBtn = `<span class="btn btn-warning btn-reset" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Reset Password")}"><i class="bi bi-key"></i></span>`;
            }
            if (PhSettings.Perms.Delete) {
              deleteBtn = `<span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Delete")}"><i class="bi bi-trash"></i></span>`;
            }
            vHtml += `<div class="col-sm-3 p-2 mx-auto">
                <div id="item-${item.nId}" class="card card-custom result-card h-100" data-rid="${i}">
                  <div class="card-header">
                    <span>${item.vName}</span>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-2">
                        <img src="${mettaData.ImagePath}manager${item.nGender}.png" width="100%"/>
                      </div>
                      <div class="col-10">
                        <div class="row">
                          <div class="col-12 col-sm-6">
                            <span>${item.vLogon}</span>
                          </div>
                          <div class="col-12 col-sm-6">
                            <span>${item.vGenderName}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-sm-6">
                            <span>${item.vBranName}</span>
                          </div>
                          <div class="col-12 col-sm-6">
                            <span>${item.vStatusName}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row pt-2">
                      <div class="col-3 text-start"">
                        ${editBtn}
                      </div>
                      <div class="col-6 text-center">
                        ${resetBtn}
                      </div>
                      <div class="col-3 text-end">
                        ${deleteBtn}
                      </div>
                    </div>
                  </div>
                </div>
              </div>`;
          }
          $('#resultData').html(vHtml);
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
          doSearch('');
          showToast(getLabel('Save'), 'WARNING', response.Message);
        } else {
          showToast(getLabel('Error'), 'DANGER', response.Message);
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
            doSearch('');
            showToast(getLabel('Save'), 'WARNING', response.Message);
          } else {
            showToast(getLabel('Error'), 'DANGER', response.Message);
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
        title: getLabel('Delete'),
        text: getLabel('Are you sure ?'),
        showCancelButton: true,
        confirmButtonText: "<i class='bi bi-check-lg'></i> " + getLabel('Yes'),
        cancelButtonText: "<i class='bi bi-x-lg'></i> " + getLabel('No')
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
                doSearch('');
                showToast(getLabel('Delete'), 'SUCCESS', response.Message);
              } else {
                showToast(getLabel('Error'), 'DANGER', response.Message);
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

  resetFormValid('ph_edit_form');
  let item = resultData[nIdx];
  $('#editUserId').val(item.nId);
  $('#editUserStatus').val(item.nStatus);
  $('#editUserGender').val(item.nGender);
  $('#editUserType').val(item.nType);
  $('#editUserBranch').val(item.nBranId);
  $('#editUserName').val(item.vName);
  $('#editUserLogon').val(item.vLogon);
  $('#editUserModal').modal('show');
}

function doReset(nIdx) {

  resetFormValid('ph_Form');
  let item = resultData[nIdx];
  $('#resetUserId').val(item.nId);
  $('#resetNPassword').val('');
  $('#resetVPassword').val('');
  $('#resetPasswordModal').modal('show');
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
            doSearch('');
            showToast(getLabel('Reset Password'), 'WARNING', response.Message);
          } else {
            showToast(getLabel('Error'), 'DANGER', response.Message);
          }
        }
      });
    }
  }
}

