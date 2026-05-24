/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
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
    "Count": {
      "URL": PhSettings.serviceURL + "/Customers",
      "Method": "PUT"
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

  $('.result-type').off('click').on('click', function () {
    $('.result-type').removeClass('btn-warning');
    $('.result-type').addClass('btn-outline-warning');
    $(this).removeClass('btn-outline-warning');
    $(this).addClass('btn-warning');
    resultType = parseInt($(this).data('val'));
    phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
  });

  $('#ph-new').on('click', function () {
    doNew();
    $('#addUserModal').modal('show');
  });

  $('#ph-search-text').off('keyup').on('keyup', function () {
    phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
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
  phsDoSearch($('#ph-search-text').val(), mettaData, getPage);

});

function setResultType(nType) {
  $('.result-type').removeClass('btn-warning');
  $('.result-type').addClass('btn-outline-warning');
  $('#result-type-' + nType).removeClass('btn-outline-warning');
  $('#result-type-' + nType).addClass('btn-warning');
  resultType = parseInt($('#result-type-' + nType).data('val'));
}

function doNew() {
  resetFormValid('ph_Form');  // Reset form validation
  $('ph_add_form').trigger('reset');  // Reset the form fields
  $('ph_add_form').removeClass('was-validated');  // Remove validation classes
  $('#addStatusId').val($('#addStatusId :first').val());  // Reset status ID field
  $('#addUserName').val('');  // Clear user name field
  $('#addUserOrgnum').val('');  // Clear organization number field
  $('#addUserLogon').val('');  // Clear user logon field
  $('#addnpassword').val('');  // Clear new password field
  $('#addvpassword').val('');  // Clear verify password field
  $('#addUserMobile').val('');  // Clear mobile field
  $('#addUserPhone').val('');  // Clear phone field
  $('#addUserAddress').val('');  // Clear address field
}

function getPage(vText, nStart, nEnd, nPage, nPerPage) {

  if (PhSettings.Perms.Query) {
    $('#resultData').html('');
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
          resultData = response.Data;  // Store the result data
          switch (resultType) {
            case 0:
              renderCards();
              break;
            case 1:
              renderLines();
              break;
            case 2:
              renderTable();
              break;
            default:
              renderCards();
              break;
          }
          if (PhSettings.Perms.Update) {
            $('.btn-edit').off('click').on('click', function (e) {
              e.preventDefault();
              resultId = parseInt($(this).data('rid'));
              doEdit(resultId);
            });
          }
          if (PhSettings.Perms.Update) {
            $('.btn-reset').off('click').on('click', function (e) {
              e.preventDefault();
              resultId = parseInt($(this).data('rid'));
              doReset(resultId);
            });
          }
          if (PhSettings.Perms.Delete) {
            $('.btn-delete').off('click').on('click', function (e) {
              e.preventDefault();
              resultId = parseInt($(this).data('rid'));
              doDelete(resultId);
            });
          }
        }
      }
    });
  }
}

// Function to add a new user
function doAdd() {
  if (isValidForm('ph_add_form')) {  // Validate the form
    $.ajax({
      async: false,
      type: mettaData.URLS.Save.Method,
      url: mettaData.URLS.Save.URL,
      headers: PhSettings.Headers,
      data: {
        "nId": 0,
        "nStatusId": $('#addUserStatus').val(), // Get status ID from the form
        "vName": $('#addUserName').val(), // Get name from the form
        "vOrgnum": $('#addUserOrgnum').val(), // Get organization number from the form
        "vLogon": $('#addUserLogon').val(), // Get logon from the form
        "vMobile": $('#addUserMobile').val(), // Get mobile number from the form
        "vPhone": $('#addUserPhone').val(), // Get phone number from the form
        "vAddress": $('#addUserAddress').val(), // Get address from the form
        "vNPassword": $('#addnpassword').val(), // Get new password from the form
        "vCPassword": $('#addvpassword').val()  // Get confirm password from the form
      },
      success: function (response) {
        if (response.Status) {
          doNew();  // Reset the form
          phsDoSearch($('#ph-search-text').val(), mettaData, getPage);  // Refresh the search results
          showToast(getLabel('Save'), 'WARNING', response.Message);  // Show success message
        } else {
          showToast(getLabel('Error'), 'DANGER', response.Message);  // Show error message
        }
      }
    });
  }
}

// Function to update an existing user
function doUpdate() {
  if (isValidForm('ph_edit_form')) {  // Validate the form
    $.ajax({
      async: false,
      type: mettaData.URLS.Save.Method,
      url: mettaData.URLS.Save.URL,
      headers: PhSettings.Headers,
      data: {
        "nId":
          $('#editUserId').val(), // Get user ID from the form
        "nStatusId": $('#editUserStatus').val(), // Get status ID from the form
        "vName": $('#editUserName').val(), // Get name from the form
        "vOrgnum": $('#editUserOrgnum').val(), // Get organization number from the form
        "vLogon": $('#editUserLogon').val(), // Get logon from the form
        "vMobile": $('#editUserMobile').val(), // Get mobile number from the form
        "vPhone": $('#editUserPhone').val(), // Get phone number from the form
        "vAddress": $('#editUserAddress').val()  // Get address from the form
      },
      success: function (response) {
        if (response.Status) {
          doNew();  // Reset the form
          phsDoSearch($('#ph-search-text').val(), mettaData, getPage);  // Refresh the search results
          showToast(getLabel('Save'), 'WARNING', response.Message);  // Show success message
        } else {
          showToast(getLabel('Error'), 'DANGER', response.Message);  // Show error message
        }
      }
    });
  }
}

// Function to delete a user
function doDelete(nIdx) {
  let item = resultData[nIdx];  // Get the selected item from the result data
  let nId = item.nId;  // Get the ID of the selected item
  if (nId > 0) {
    swal.fire({
      title: getLabel('Delete'), // Confirmation title
      text: getLabel('Are you sure ?'), // Confirmation message
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
            "nId": nId  // Send the ID of the user to delete
          },
          success: function (response) {
            if (response.Status) {
              doNew();  // Reset the form
              phsDoSearch($('#ph-search-text').val(), mettaData, getPage);  // Refresh the search results
              showToast(getLabel('Delete'), 'SUCCESS', response.Message);  // Show success message
            } else {
              showToast(getLabel('Error'), 'DANGER', response.Message);  // Show error message
            }
          }
        });
      } else if (result.dismiss === "cancel") {
        // Handle cancel action if needed
      }
    });
  }
}

// Function to edit a user
function doEdit(nIdx) {
  resetFormValid('ph_Form');  // Reset form validation
  let item = resultData[nIdx];  // Get the selected item from the result data
  $('#editUserId').val(item.nId);  // Set the user ID in the form
  $('#editUserStatus').val(item.nStatusId);  // Set the status ID in the form
  $('#editUserName').val(item.vName);  // Set the name in the form
  $('#editUserLogon').val(item.vLogon);  // Set the logon in the form
  $('#editUserOrgnum').val(item.vOrgnum);  // Set the organization number in the form
  $('#editUserMobile').val(item.vMobile);  // Set the mobile number in the form
  $('#editUserPhone').val(item.vPhone);  // Set the phone number in the form
  $('#editUserAddress').val(item.vAddress);  // Set the address in the form
  $('#editUserModal').modal('show');  // Show the edit user modal
}

// Function to reset a user's password
function doReset(nIdx) {
  resetFormValid('ph_Form');  // Reset form validation
  let item = resultData[nIdx];  // Get the selected item from the result data
  $('#resetUserId').val(item.nId);  // Set the user ID in the reset password form
  $('#resetNPassword').val('');  // Clear the new password field
  $('#resetVPassword').val('');  // Clear the verify password field
  $('#resetPasswordModal').modal('show');  // Show the reset password modal
}

// Function to perform password reset
function doResetPWD() {
  if (isValidForm('ph_resetPassword_form')) {  // Validate the form
    $.ajax({
      async: false,
      type: mettaData.URLS.ResetPWD.Method,
      url: mettaData.URLS.ResetPWD.URL,
      headers: PhSettings.Headers,
      data: {
        "nId": $('#resetUserId').val(), // Get the user ID from the form
        "vNPassword": $('#resetNPassword').val(), // Get the new password from the form
        "vVPassword": $('#resetVPassword').val()  // Get the verify password from the form
      },
      success: function (response) {
        if (response.Status) {
          doNew();  // Reset the form
          phsDoSearch($('#ph-search-text').val(), mettaData, getPage);  // Refresh the search results
          showToast(getLabel('Reset Password'), 'WARNING', response.Message);  // Show success message
        } else {
          showToast(getLabel('Error'), 'DANGER', response.Message);  // Show error message
        }
      }
    });
  }
}

function renderCards() {
  let vHtml = '';
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml +=
      `<div class="col-sm-3 p-2 mx-auto">
        <div id="item-${item.nId}" class="card card-custom result-card h-100">
          <div class="card-header">
            <div class="row pt-2">
              <div class="col-12">
                <span>${item.vName}</span>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <h6><i class="bi bi-calculator"></i> ${item.vOrgnum}</h6>
              </div>
              <div class="col-6">
                <h5>${item.vLogon}</h5>
              </div>
              <div class="col-6">
                <h6><i class="bi bi-${parseInt(item.nStatusId) === 1 ? 'hand-thumbs-up' : 'hand-thumbs-down'}"></i> ${item.vStatusName}</h6>
              </div>
              <div class="col-6">
                <h6><i class="bi bi-phone"></i> ${item.vMobile}</h6>
              </div>
              <div class="col-6">
                <h6><i class="bi bi-telephone"></i> ${item.vPhone}</h6>
              </div>
              <div class="col-6">
                <h6><i class="bi bi-geo-alt"></i> ${item.vAddress}</h6>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row pt-2">
              <div class="col-4 text-start"">
                <span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span>
              </div>
              <div class="col-4 text-start"">
                <span class="btn btn-warning btn-reset" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Reset Password")}"><i class="bi bi-key"></i></span>
              </div>
              <div class="col-4 text-end">
                <span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Delete")}"><i class="bi bi-trash"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>`;
  }
  $('#resultData').html(vHtml);
}

function renderTable() {
  let vHtml = '';
  vHtml += `
<div class="col-12 p-2 mx-auto">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <td></td>
        <td>${getLabel("Name")}</td>
        <td><span><i class="bi bi-calculator"></i> ${getLabel("Orgnum")}</span></td>
        <h5>${getLabel("Logon")}</h5>
        <td><span>${getLabel("Status")}</span></td>
        <td><span><i class="bi bi-phone"></i> ${getLabel("Mobile")}</span></td>
        <td><span><i class="bi bi-telephone"></i> ${getLabel("Phone")}</span></td>
        <td><span><i class="bi bi-geo-alt"></i> ${getLabel("Address")}</span></td>
        <td></td>
      </tr>
    <thead>
    <tbody>`;
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml += `
<tr>
  <td class="text-start">
    <span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span>
    <span class="btn btn-warning btn-reset" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Reset Password")}"><i class="bi bi-key"></i></span>
  </td>
  <td><span>${item.vName}</span></td>
  <td><span><i class="bi bi-calculator"></i> ${item.vOrgnum}</span></td>
  <h5>${item.vLogon}</h5>
  <td><span><i class="bi bi-${parseInt(item.nStatusId) === 1 ? 'hand-thumbs-up' : 'hand-thumbs-down'}"></i> ${item.vStatusName}</span></td>
  <td><span><i class="bi bi-phone"></i> ${item.vMobile}</span></td>
  <td><span><i class="bi bi-telephone"></i> ${item.vPhone}</span></td>
  <td><span><i class="bi bi-geo-alt"></i> ${item.vAddress}</span></td>
  <td class="text-end"><span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Delete")}"><i class="bi bi-trash"></i></span></td>
</tr>`;
  }
  vHtml += `
  </tbody>
</table>`;
  $('#resultData').html(vHtml);
}

function renderLines() {
  let vHtml = '';
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml += `
<div class="col-12 mx-auto">
  <div id="item-${item.nId}" class="card card-custom result-card p-2">
    <div class="row">
      <div class="col-2 text-start">
        <span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span>
        <span class="btn btn-warning btn-reset" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Reset Password")}"><i class="bi bi-key"></i></span>
      </div>
      <div class="col-8">
        <div class="row">
          <div class="col-3">
            <h4><i class="bi bi-file-person"></i> ${item.vName}</h4>
          </div>
          <div class="col-3">
            <h6><i class="bi bi-calculator"></i> ${item.vOrgnum}</h6>
          </div>
          <div class="col-3">
            <h5>${item.vLogon}</h5>
          </div>
          <div class="col-3">
            <h6><i class="bi bi-${parseInt(item.nStatusId) === 1 ? 'hand-thumbs-up' : 'hand-thumbs-down'}"></i> ${item.vStatusName}</h6>
          </div>
          <div class="col-3">
            <h6><i class="bi bi-phone"></i> ${item.vMobile}</h6>
          </div>
          <div class="col-3">
            <h6><i class="bi bi-telephone"></i> ${item.vPhone}</h6>
          </div>
          <div class="col-3">
            <h6><i class="bi bi-geo-alt"></i> ${item.vAddress}</h6>
          </div>
        </div>
      </div>
      <div class="col-2 text-end">
        <span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Delete")}"><i class="bi bi-trash"></i></span>
      </div>
    </div>
  </div>
</div>`;
  }
  $('#resultData').html(vHtml);
}
