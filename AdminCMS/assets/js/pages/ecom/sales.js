/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
var resultId = 0;
var resultData = [];
var mettaData = {};

jQuery(document).ready(function () {

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/Sales",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/Sales",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/Sales",
      "Method": "DELETE"
    },
    "Count": {
      "URL": PhSettings.serviceURL + "/Sales",
      "Method": "PUT"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/Sales",
      "Method": "OPTIONS"
    },
    "Products": {
      "URL": PhSettings.serviceURL + "/Products",
      "Method": "OPTIONS"
    },
    "GetSerial": {
      "URL": PhSettings.serviceURL + "/Serials",
      "Method": "GET"
    }
  };
  mettaData.ImagePath = 'assets/media/avatars/';
  mettaData.DefaultImage = 'manager1.png';

  $('#ph-new').on('click', function () {
    if (PhSettings.Perms.Insert) {
      doNew();
      $('#ph_Modal').modal('show');
    }
  });

  $('#ph-search-text').off('keyup').on('keyup', function () {
    phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
  });

  $('#ph-submit').off('click').on('click', function () {
    if (PhSettings.Perms.Insert || PhSettings.Perms.Update) {
      doSave();
    }
  });

  $('#fldWdays, #fldMdate').off('change').on('change', function () {
    $('#fldEdate').val(formatDate(addDays(new Date($('#fldMdate').val()), parseInt($('#fldWdays').val())), 'yyyy-mm-dd'));
  });

  $('#fldSerialName').off('change').on('change', function () {
    //getSerial($(this).val());
  });

  if (PhSettings.Perms.Insert) {
    doNew();
  }
  phsDoSearch($('#ph-search-text').val(), mettaData, getPage);

  if (parseInt(PhSettings.oUser.GrpId) > 0) {
    $('#fldWdays').prop("disabled", true);
    $('#fldEdate').prop("disabled", true);
  }

});

function setResultType(nType) {
  $('.result-type').removeClass('btn-warning');
  $('.result-type').addClass('btn-outline-warning');
  $('#result-type-' + nType).removeClass('btn-outline-warning');
  $('#result-type-' + nType).addClass('btn-warning');
  resultType = parseInt($('#result-type-' + nType).data('val'));
}

function getAutoSerial(event, ui) {
  $('#fldBrandId').val(ui.item.nBrandId);
  $('#fldBrandName').val(ui.item.vBrandName1);
  $('#fldCatId').val(ui.item.nCatId);
  $('#fldCatName').val(ui.item.vCatName1);
  $('#fldWdays').val(ui.item.nCatWdays);
  $('#fldProdId').val(ui.item.nProdId);
  $('#fldProdName').val(ui.item.vProdName1);
  $('#fldEdate').val(formatDate(addDays(new Date($('#fldMdate').val()), parseInt($('#fldWdays').val())), 'yyyy-mm-dd'));
}

function getSerial(vSerial) {
  $.ajax({
    async: false,
    type: mettaData.URLS.GetSerial.Method,
    url: mettaData.URLS.GetSerial.URL,
    headers: PhSettings.Headers,
    data: {
      "vSerial": vSerial
    },
    success: function (response) {
      if (response.Status) {
        $('#fldBrandId').val(response.Data.nBrandId);
        $('#fldBrandName').val(response.Data.vBrandName1);
        $('#fldCatId').val(response.Data.nCatId);
        $('#fldCatName').val(response.Data.vCatName1);
        $('#fldWdays').val(response.Data.nCatWdays);
        $('#fldProdId').val(response.Data.nProdId);
        $('#fldProdName').val(response.Data.vProdName1);
        $('#fldEdate').val(formatDate(addDays(new Date($('#fldMdate').val()), parseInt($('#fldWdays').val())), 'yyyy-mm-dd'));
      } else {
        showToast(getLabel('Error'), 'DANGER', response.Message);
      }
    }
  });
}

function doNew() {
  resetFormValid('ph_Form');
  $('ph_Form').trigger('reset');
  $('ph_Form').removeClass('was-validated');
  $("#fldId").val(0);
  $("#fldMdate").val(currentDateFormated('yyyy-mm-dd'));
  $("#fldCatId").val('');
  $("#fldCatName").val('');
  $("#fldBrandId").val('');
  $("#fldBrandName").val('');
  $("#fldProdId").val('');
  $("#fldProdName").val('');
  $("#fldSerial").val('');
  $("#fldSerialName").val('');
  $('#fldEdate').val(formatDate(addDays(new Date($('#fldMdate').val()), parseInt($('#fldWdays').val())), 'yyyy-mm-dd'));
  $("#fldCustomer").val('');
  $("#fldCMobile").val('');
  $("#fldCAddress").val('');
}

function getPage(vText, nStart, nEnd, nPage, nPerPage) {

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
        resultData = response.Data;
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
        let vHtml = '';
        vHtml += `<table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th class="text-center">${getLabel("Branch")}</th>
                        <th class="text-center">${getLabel("Brand")}</th>
                        <th class="text-center">${getLabel("Category")}</th>
                        <th class="text-center">${getLabel("Product")}</th>
                        <th class="text-center">${getLabel("Customer")}</th>
                        <th class="text-center">${getLabel("Mobile")}</th>
                        <th class="text-center">${getLabel("Serial")}</th>
                        <th class="text-center">${getLabel("Warranty")}</th>
                        <th class="text-center">${getLabel("Start Date")}</th>
                        <th class="text-center">${getLabel("Expire Date")}</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>`;
        for (var i = 0; i < resultData.length; i++) {
          let item = resultData[i];
          let vEdit = ``;
          let vDelete = ``;
          if (PhSettings.Perms.Update) {
            vEdit = `<span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span>`;
          }
          if (PhSettings.Perms.Delete) {
            vDelete = `<span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Delete")}"><i class="bi bi-trash"></i></span>`;
          }
          vHtml += `<tr>
                      <td>
                       ${vEdit}
                      </td>
                      <td class="text-center">${item.vBranchName}</td>
                      <td class="text-center">${item.vBrandName}</td>
                      <td class="text-center">${item.vCatName}</td>
                      <td class="text-center">${item.vProdName}</td>
                      <td class="text-center">${item.vCustomer}</td>
                      <td class="text-center">${item.vCMobile}</td>
                      <td class="text-center">${item.vSerial}</td>
                      <td class="text-center">${item.nWDays}</td>
                      <td class="text-center">${item.dMDate}</td>
                      <td class="text-center">${item.dEDate}</td>
                      <td>
                       ${vDelete}
                      </td>
                    </tr>`;
        }
        vHtml += `</tbody>
                </table>`;
        $('#resultData').html(vHtml);
        if (PhSettings.Perms.Update) {
          $('.btn-edit').off('click').on('click', function (e) {
            e.preventDefault();
            resultId = parseInt($(this).data('rid'));
            doEdit(resultId);
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

function doSave() {

  if (isValidForm('ph_Form')) {
    $.ajax({
      async: false,
      type: mettaData.URLS.Save.Method,
      url: mettaData.URLS.Save.URL,
      headers: PhSettings.Headers,
      data: {
        "nId": parseInt($("#fldId").val()),
        "nProdId": $("#fldProdId").val(),
        "vSerial": $("#fldSerial").val(),
        "nWDays": $("#fldWdays").val(),
        "dMDate": $("#fldMdate").val(),
        "dEDate": $("#fldEdate").val(),
        "vCustomer": $("#fldCustomer").val(),
        "vCMobile": $("#fldCMobile").val(),
        "vCAddress": $("#fldCAddress").val()
      },
      success: function (response) {
        if (response.Status) {
          doNew();
          $('#resultData').html('');
          phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
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
              $('#resultData').html('');
              phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
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
  $('ph_form').trigger('reset');
  $('ph_form').removeClass('was-validated');
  let item = resultData[nIdx];
  //
  $("#fldId").val(item.nId);
  $("#fldMdate").val(item.dMDate);
  $("#fldCatId").val(item.nCatId);
  $("#fldCatName").val(item.vCatName);
  $("#fldBrandId").val(item.nBrandId);
  $("#fldBrandName").val(item.vBrandName);
  $("#fldProdId").val(item.nProdId);
  $("#fldProdName").val(item.vProdName);
  $("#fldSerial").val(item.vSerial);
  $("#fldSerialName").val(item.vSerial);
  $("#fldWdays").val(item.nWDays);
  $('#fldEdate').val(item.dEDate);
  $("#fldCustomer").val(item.vCustomer);
  $("#fldCMobile").val(item.vCMobile);
  $("#fldCAddress").val(item.vCAddress);
  $('#ph_Modal').modal('show');
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
              <div class="col-12">
                <span>${item.vPhone}</span>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row pt-2">
              <div class="col-6 text-start"">
                <span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span>
              </div>
              <div class="col-6 text-end">
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
        <td></td>
      </tr>
    <thead>
    <tbody>`;
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml += `
<tr>
  <td class="text-start"><span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span></td>
  <td><span>${item.vName}</span></td>
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
      </div>
      <div class="col-8">
        <div class="row">
          <div class="col-4">
            <span>${item.vAddress}</span>
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
