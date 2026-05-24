/* global PhSettings, PhUtility, swal, KTUtil */
var resultId = 0;
var resultData = [];
var mettaData = {};

jQuery(document).ready(function () {

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/Customers",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/Customers",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/Customers",
      "Method": "DELETE"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/Customers",
      "Method": "OPTIONS"
    },
    "ResetPWD": {
      "URL": PhSettings.serviceURL + "/Customers/ResetPassword",
      "Method": "POST"
    }
  };

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
  $('#addStatusId').val($('#addStatusId :first').val());
  $('#addUserName').val('');
  $('#addUserOrgnum').val('');
  $('#addUserLogon').val('');
  $('#addnpassword').val('');
  $('#addvpassword').val('');
  $('#addUserMobile').val('');
  $('#addUserPhone').val('');
  $('#addUserAddress').val('');
}

function doSearch(vText) {

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
          vHtml += `<div class="col-sm-4 p-2 mx-auto">
                <div id="item-${item.nId}" class="card card-custom result-card p-2 h-100" data-rid="${i}">
                  <div class="card-body">
                    <div class="row pt-2">
                      <div class="col-10">
                        <div class="row pt-2">
                          <div class="col-12">
                            <h4><i class="bi bi-file-person"></i> ${item.vName}</h4>
                            <h6><i class="bi bi-calculator"></i> ${item.vOrgnum}</h6>
                            <h5>${item.vLogon}</h5>
                            <h6><i class="bi bi-${parseInt(item.nStatusId) === 1 ? 'hand-thumbs-up' : 'hand-thumbs-down'}"></i> ${item.vStatusName}</h6>
                            <h6><i class="bi bi-phone"></i> ${item.vMobile}</h6>
                            <h6><i class="bi bi-telephone"></i> ${item.vPhone}</h6>
                            <h6><i class="bi bi-geo-alt"></i> ${item.vAddress}</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row pt-2">
                      <div class="col-3 text-start"">
                        <span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span>
                      </div>
                      <div class="col-6 text-center">
                        <span class="btn btn-warning btn-reset" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Reset Password")}"><i class="bi bi-key"></i></span>
                      </div>
                      <div class="col-3 text-end">
                        <span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Delete")}"><i class="bi bi-trash"></i></span>
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
        "vName": $('#addUserName').val(),
        "vOrgnum": $('#addUserOrgnum').val(),
        "vLogon": $('#addUserLogon').val(),
        "vMobile": $('#addUserMobile').val(),
        "vPhone": $('#addUserPhone').val(),
        "vAddress": $('#addUserAddress').val(),
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

  if (isValidForm('ph_edit_form')) {
    $.ajax({
      async: false,
      type: mettaData.URLS.Save.Method,
      url: mettaData.URLS.Save.URL,
      headers: PhSettings.Headers,
      data: {
        "nId": $('#editUserId').val(),
        "nStatusId": $('#editUserStatus').val(),
        "vName": $('#editUserName').val(),
        "vOrgnum": $('#editUserOrgnum').val(),
        "vLogon": $('#editUserLogon').val(),
        "vMobile": $('#editUserMobile').val(),
        "vPhone": $('#editUserPhone').val(),
        "vAddress": $('#editUserAddress').val()
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

function doDelete(nIdx) {
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

function doEdit(nIdx) {

  resetFormValid('ph_Form');
  let item = resultData[nIdx];
  $('#editUserId').val(item.nId);
  $('#editUserStatus').val(item.nStatusId);
  $('#editUserName').val(item.vName);
  $('#editUserLogon').val(item.vLogon);
  $('#editUserOrgnum').val(item.vOrgnum);
  $('#editUserMobile').val(item.vMobile);
  $('#editUserPhone').val(item.vPhone);
  $('#editUserAddress').val(item.vAddress);
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
