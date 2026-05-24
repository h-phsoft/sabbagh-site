/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
var resultId = 0;
var resultData = [];
var mettaData = {};

jQuery(document).ready(function () {

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/Banner",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/Banner",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/Banner",
      "Method": "DELETE"
    },
    "Count": {
      "URL": PhSettings.serviceURL + "/Banner",
      "Method": "PUT"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/Banner",
      "Method": "OPTIONS"
    }
  };
  mettaData.ImagePath = '../assets/media/imgs/banner/';
  mettaData.DefaultImage = 'banner-0.png';

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
    $('#ph_Modal').modal('show');
  });

  $('#ph-search-text').off('keyup').on('keyup', function () {
    phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
  });

  $('#ph-submit').off('click').on('click', function () {
    doSave();
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
  resetFormValid('ph_Form');
  $('#ph_Form').trigger('reset');
  $('#ph_Form').removeClass('was-validated');
  $('#fldId').val(0);
  $('#fldOrder').val(0);
  $('#fldName').val('');
  $('#fldImage').val('');
  $('#fldImagePreview').attr('src', mettaData.ImagePath + mettaData.DefaultImage);
}

function getPage(vText, nStart, nEnd, nPage, nPerPage) {

  $.ajax({
    async: false,
    type: mettaData.URLS.List.Method,
    url: mettaData.URLS.List.URL,
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
        $('.btn-edit').off('click').on('click', function (e) {
          e.preventDefault();
          resultId = parseInt($(this).data('rid'));
          doEdit(resultId);
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

function doSave() {

  if (isValidForm('ph_Form')) {
    $.ajax({
      async: false,
      type: mettaData.URLS.Save.Method,
      url: mettaData.URLS.Save.URL,
      data: {
        "nId": $('#fldId').val(),
        "nOrder": $('#fldOrder').val(),
        "vName": $('#fldName').val(),
        "vImage": $('#fldImage').val(),
        "vFExt": $('#fldFExt').val(),
        "vFName": $('#fldFName').val(),
        "vFile": $('#fldAttach').val()
      },
      success: function (response) {
        if (response.Status) {
          doNew();
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
          data: {
            "nId": nId
          },
          success: function (response) {
            if (response.Status) {
              doNew();
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
  let item = resultData[nIdx];
  $('#fldId').val(item.nId);
  $('#fldOrder').val(item.nOrder);
  $('#fldName').val(item.vName);
  $('#fldImage').val(item.vImage);
  $('#fldImagePreview').attr('src', mettaData.ImagePath + item.vImage);
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
                <h4>${item.vName}</h4>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <img src="${mettaData.ImagePath}${item.vImage}" width="100%"/>
              </div>
              <div class="col-8">
                <h6>${item.nOrder}</h6>
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
        <td>${getLabel("Order")}</td>
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
  <td>${item.nOrder}</td>
  <td>${item.vName}</td>
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
      <div class="col-1 text-start">
        <span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span>
      </div>
      <div class="col-10">
        <div class="row">
          <div class="col-2">
            <img src="${mettaData.ImagePath}${item.vImage}" width="50%"/>
          </div>
          <div class="col-1">
            <h6>${item.nOrder}</h6>
          </div>
          <div class="col-9">
            <h5>${item.vName}</h5>
          </div>
        </div>
      </div>
      <div class="col-1 text-end">
        <span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Delete")}"><i class="bi bi-trash"></i></span>
      </div>
    </div>
  </div>
</div>`;
  }
  $('#resultData').html(vHtml);
}
