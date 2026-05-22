/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
var resultId = 0;
var resultData = [];
var mettaData = {};

jQuery(document).ready(function () {

  let aCondFlds = [
    {"Value": 'all', "Label": getLabel('lbl.cms.All Fields')},
    {"Value": 'name', "Label": getLabel('lbl.cms.Name')},
    {"Value": 'phone', "Label": getLabel('lbl.cms.Phone')},
    {"Value": 'address', "Label": getLabel('lbl.cms.Address')}
  ];
  let vHtml = '';
  for (var i = 0; i < aCondFlds.length; i++) {
    vHtml += `<option value="${aCondFlds[i].Value}">${aCondFlds[i].Label}</option>`;
  }
  $('#search-fld').html(vHtml);

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/Branch",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/Branch",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/Branch",
      "Method": "DELETE"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/Branch",
      "Method": "OPTIONS"
    },
    "Count": {
      "URL": PhSettings.serviceURL + "/Branch",
      "Method": "PUT"
    }
  };
  mettaData.ImagePath = '../assets/media/imgs/branch/';
  mettaData.DefaultImage = 'default_Branch.png';

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
      $('#ph_Modal').modal('show');
    });
  }

  if (PhSettings.Perms.Query) {
    $('#ph-search-text').off('keyup').on('keyup', function () {
      phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
    });
  }
  $('#search-fld').off('change').on('change', function () {
    if (PhSettings.Perms.Query) {
      phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
    }
  });

  if (PhSettings.Perms.Insert || PhSettings.Perms.Update) {
    $('#ph-submit').off('click').on('click', function () {
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
    });
  }

  if (PhSettings.Perms.Insert) {
    doNew();
  }

  if (PhSettings.Perms.Query) {
    phsDoSearch('', mettaData, getPage);
  }

});

function doNew() {
  resetFormValid('ph_Form');
  $('#ph_Form').trigger('reset');
  $('#ph_Form').removeClass('was-validated');
  $('#fldId').val(0);
  $('#fldName').val('');
  $('#fldPhone').val('');
  $('#fldAddress').val('');
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
        "vText": vText,
        "vSFld": $('#search-fld').val()
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
}

function doSave() {

  if (isValidForm('ph_Form')) {
    $.ajax({
      async: false,
      type: mettaData.URLS.Save.Method,
      url: mettaData.URLS.Save.URL,
      data: {
        "nId": $('#fldId').val(),
        "vName": $('#fldName').val(),
        "vPhone": $('#fldPhone').val(),
        "vAddress": $('#fldAddress').val()
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

function doDelete(nIdx) {
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

function doEdit(nIdx) {

  resetFormValid('ph_Form');
  let item = resultData[nIdx];
  $('#fldId').val(item.nId);
  $('#fldName').val(item.vName);
  $('#fldPhone').val(item.vPhone);
  $('#fldAddress').val(item.vAddress);
  $('#ph_Modal').modal('show');
}

function renderCards() {
  let vHtml = '';
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml +=
      `<div class="col-sm-4 p-2 mx-auto">
        <div id="item-${item.nId}" class="card card-ph result-card h-100">
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
            <div class="row">
              <div class="col-12">
                <span>${item.vAddress}</span>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row pt-2">
              <div class="col-6 text-start"">
                ${PhSettings.Perms.Update ? `<span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("lbl.cms.Edit")}"><i class="bi bi-pencil"></i></span>` : ``}
              </div>
              <div class="col-6 text-end">
                ${PhSettings.Perms.Delete ? `<span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("lbl.cms.Delete")}"><i class="bi bi-trash"></i></span>` : ``}
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
        <td>${getLabel("lbl.cms.Name")}</td>
        <td>${getLabel("lbl.cms.Phone")}</td>
        <td>${getLabel("lbl.cms.Address")}</td>
        <td></td>
      </tr>
    <thead>
    <tbody>`;
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml += `
<tr>
  <td class="text-start">${PhSettings.Perms.Update ? `<span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("lbl.cms.Edit")}"><i class="bi bi-pencil"></i></span>` : ``}</td>
  <td><span>${item.vName}</span></td>
  <td><span>${item.vPhone}</span></td>
  <td><span>${item.vAddress}</span></td>
  <td class="text-end">${PhSettings.Perms.Update ? `<span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("lbl.cms.Delete")}"><i class="bi bi-trash"></i></span>` : ``}</td>
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
  <div id="item-${item.nId}" class="card card-ph result-card p-2">
    <div class="row">
      <div class="col-2 text-start">
        ${PhSettings.Perms.Update ? `<span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("lbl.cms.Edit")}"><i class="bi bi-pencil"></i></span>` : ``}
      </div>
      <div class="col-8">
        <div class="row">
          <div class="col-4">
            <span>${item.vName}</span>
          </div>
          <div class="col-4">
            <span>${item.vPhone}</span>
          </div>
          <div class="col-4">
            <span>${item.vAddress}</span>
          </div>
        </div>
      </div>
      <div class="col-2 text-end">
        ${PhSettings.Perms.Delete ? `<span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("lbl.cms.Delete")}"><i class="bi bi-trash"></i></span>` : ``}
      </div>
    </div>
  </div>
</div>`;
  }
  $('#resultData').html(vHtml);
}
