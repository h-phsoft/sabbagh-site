/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
var resultId = 0;
var resultData = [];
var mettaData = {};
jQuery(document).ready(function () {

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/Product",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/Product",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/Product",
      "Method": "DELETE"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/Product",
      "Method": "OPTIONS"
    },
    "Count": {
      "URL": PhSettings.serviceURL + "/Product",
      "Method": "PUT"
    }
  };

  mettaData.ImagePath = '../assets/media/imgs/products/';
  mettaData.DefaultImage = 'vendor-0.png';

  $('.result-type').off('click').on('click', function () {
    $('.result-type').removeClass('btn-warning');
    $('.result-type').addClass('btn-outline-warning');
    $(this).removeClass('btn-outline-warning');
    $(this).addClass('btn-warning');
    resultType = parseInt($(this).data('val'));
    phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
  });

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

  if (PhSettings.Perms.Insert) {
    doNew();
  }

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
  $('#fldStatusId').val($('#fldStatusId :first').val());
  $('#fldOrder').val(0);
  $('#fldName1').val('');
  $('#fldName2').val('');
  $('#fldDesc1').val('');
  $('#fldDesc2').val('');
  $('#fldDesc3').val('');
  $('#fldDesc4').val('');
  $('#fldDesc5').val('');
  $('#fldImage').val('');
  $('#fldImagePreview').attr('src', mettaData.ImagePath + mettaData.DefaultImage);
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
        $('.btn-facts').off('click').on('click', function (e) {
          e.preventDefault();
          nIdx = parseInt($(this).data('rid'));
          let item = resultData[nIdx];
          $.redirect('ecom/productFacts', {"product": item.vName1}, 'GET', '_BLANK');
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
        "nMnum": $('#fldMnum').val(),
        "nStatusId": $('#fldStatusId').val(),
        "nBrandId": $('#fldBrandId').val(),
        "nCatId": $('#fldCatId').val(),
        "nTagId": $('#fldTagId').val(),
        "vName1": $('#fldName1').val(),
        "vName2": $('#fldName2').val(),
        "nQnt": $('#fldQnt').val(),
        "nPrice": $('#fldPrice').val(),
        "nCprice": $('#fldCprice').val(),
        "vDesc1": $('#fldDesc1').val(),
        "vDesc2": $('#fldDesc2').val(),
        "vDesc3": $('#fldDesc3').val(),
        "vDesc4": $('#fldDesc4').val(),
        "vDesc5": $('#fldDesc5').val(),
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
  $('#fldMnum').val(item.nMnum);
  $('#fldStatusId').val(item.nStatusId);
  $('#fldBrandId').val(item.nBrandId);
  $('#fldCatId').val(item.nCatId);
  $('#fldTagId').val(item.nTagId);
  $('#fldName1').val(item.vName1);
  $('#fldName2').val(item.vName2);
  $('#fldQnt').val(item.nQnt);
  $('#fldPrice').val(item.nPrice);
  $('#fldCprice').val(item.nCprice);
  $('#fldDesc1').val(item.vDesc1);
  $('#fldDesc2').val(item.vDesc2);
  $('#fldDesc3').val(item.vDesc3);
  $('#fldDesc4').val(item.vDesc4);
  $('#fldDesc5').val(item.vDesc5);
  $('#fldImage').val(item.vImage);
  $('#fldImagePreview').attr('src', mettaData.ImagePath + item.vImage);
  $('#ph_Modal').modal('show');
}

function renderCards() {
  let vHtml = '';
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml +=
      `<div class="col-sm-5 p-2 mx-auto">
        <div id="item-${item.nId}" class="card card-custom result-card h-100">
          <div class="card-header">
            <div class="row pt-2">
              <div class="col-12">
                <span>${item.vName1}</span>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-3 edit-item d-flex justify-content-center align-items-center" data-rid="${i}">
                <img src="${mettaData.ImagePath}${item.vImage}" width="100%"/>
              </div>
              <div class="col-9">
                <div class="row">
                  <div class="col-12">
                    <span>${item.vName2}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <span>${item.vCatName}</span>
                  </div>
                  <div class="col-6">
                    <span>${item.vBrandName}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <span>${item.vDesc5}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <span>${item.vDesc1}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <span>${item.vDesc3}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <span>${item.vDesc4}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row pt-2">
              <div class="col-4 text-start"">
                <span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span>
              </div>
              <div class="col-4 text-center">
                <span class="btn btn-warning btn-facts" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Facts")}"><i class="bi bi-grid-3x3-gap"></i></span>
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
        <td rowspan="3"></td>
        <td style="width: 19%;">${getLabel("Name1")}</td>
        <td style="width: 19%;">${getLabel("Name2")}</td>
        <td style="width: 19%;">${getLabel("Status")}</td>
        <td style="width: 19%;">${getLabel("Ingredients")}</td>
        <td style="width: 19%;">${getLabel("Contains")}</td>
        <td rowspan="3"></td>
      </tr>
      <tr>
        <td>${getLabel("Brand")}</td>
        <td>${getLabel("Category")}</td>
        <td>${getLabel("Tag")}</td>
        <td>${getLabel("Daily Value")}</td>
        <td>${getLabel("May Contain")}</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>${getLabel("Details")}</td>
        <td></td>
      </tr>
    <thead>
  <tbody>`;
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml += `
<tr>
  <td class="text-start" rowspan="3"><span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span></td>
  <td>${item.vName1}</td>
  <td>${item.vName2}</td>
  <td>${item.vStatusName}</td>
  <td>${item.vDesc1}</td>
  <td>${item.vDesc3}</td>
  <td class="text-end" rowspan="3"><span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Delete")}"><i class="bi bi-trash"></i></span></td>
</tr>
<tr>
  <td>${item.vBrandName}</td>
  <td>${item.vCatName}</td>
  <td>${item.vTagName}</td>
  <td>${item.vDesc2}</td>
  <td>${item.vDesc4}</td>
</tr>
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td>${item.vDesc5}</td>
  <td></td>
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
      <div class="col-2 edit-item d-flex justify-content-center align-items-center" data-rid="${i}">
        <img src="${mettaData.ImagePath}${item.vImage}" width="50%"/>
      </div>
      <div class="col-9">
        <div class="row">
          <div class="col-6">
            <span>${item.vName1}</span>
          </div>
          <div class="col-6">
            <span>${item.vName2}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <span>${item.vBrandName}</span>
          </div>
          <div class="col-6">
            <span>${item.vCatName}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <span>${item.vStatusName}</span>
          </div>
          <div class="col-6">
            <span>${item.vTagName}</span>
          </div>
        </div>
        <div class="row pt-2">
          <div class="col-12">
            <span>${item.vDesc5}</span>
          </div>
        </div>
        <div class="row pt-2">
          <div class="col-12">
            <span>${item.vDesc1}</span>
          </div>
        </div>
        <div class="row pt-2">
          <div class="col-12">
            <span>${item.vDesc2}</span>
          </div>
        </div>
        <div class="row pt-2">
          <div class="col-12">
            <span>${item.vDesc3}</span>
          </div>
        </div>
        <div class="row pt-2">
          <div class="col-12">
            <span>${item.vDesc4}</span>
          </div>
        </div>
      </div>
      <div class="col-1 text-end">
        <span class="btn btn-success btn-edit" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span>
        <span class="btn btn-danger btn-delete" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Delete")}"><i class="bi bi-trash"></i></span>
      </div>
    </div>
  </div>
</div>`;
  }
  $('#resultData').html(vHtml);
}
