/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
var resultId = 0;
var aCats = [];
var resultData = [];
var mettaData = {};

jQuery(document).ready(function () {

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/Serials",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/Serials",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/Serials",
      "Method": "DELETE"
    },
    "Count": {
      "URL": PhSettings.serviceURL + "/Serials",
      "Method": "PUT"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/Serials",
      "Method": "OPTIONS"
    },
    "Import": {
      "URL": PhSettings.serviceURL + "/Serials/Import",
      "Method": "POST"
    },
    "Products": {
      "URL": PhSettings.serviceURL + "/Products",
      "Method": "OPTIONS"
    }
  };
  mettaData.ImagePath = 'assets/media/avatars/';
  mettaData.DefaultImage = 'manager1.png';

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

  $('#fldWdays, #fldMdate').off('change').on('change', function () {
    $('#fldEdate').val(formatDate(addDays(new Date($('#fldMdate').val()), parseInt($('#fldWdays').val())), 'yyyy-mm-dd'));
  });

  getProducts();
  doNew();
  phsDoSearch($('#ph-search-text').val(), mettaData, getPage);

  if (parseInt(PhSettings.oUser.GrpId) > 0) {
    $('#fldWdays').prop("disabled", true);
    $('#fldEdate').prop("disabled", true);
  }
  $('#ph-import').click(function (e) {
    e.preventDefault();
    let aLocalFile = [
      {"field": "productName",
        "label": "Product Name"
      },
      {"field": "serial",
        "label": "Serial"
      }
    ];
    phsImportExcel = new PhsImportExcel(aLocalFile, doImport);
  });

});

function setResultType(nType) {
  $('.result-type').removeClass('btn-warning');
  $('.result-type').addClass('btn-outline-warning');
  $('#result-type-' + nType).removeClass('btn-outline-warning');
  $('#result-type-' + nType).addClass('btn-warning');
  resultType = parseInt($('#result-type-' + nType).data('val'));
}

function doImport(aData) {
  $.ajax({
    async: false,
    type: mettaData.URLS.Import.Method,
    url: mettaData.URLS.Import.URL,
    headers: PhSettings.Headers,
    data: {
      aData: aData
    },
    success: function (response) {
      if (response.Status) {
        phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
      }
    }
  });
}

function getProducts() {
  $.ajax({
    async: false,
    type: mettaData.URLS.Products.Method,
    url: mettaData.URLS.Products.URL,
    headers: PhSettings.Headers,
    success: function (response) {
      aCats = [];
      if (response.Status) {
        aCats = response.Data;
        $vHtml = '';
        let cat;
        for (var i = 0; i < aCats.length; i++) {
          cat = aCats[i];
          $vHtml += `<Option value="${i}">${cat.Name}</option>`;
        }
        $('#fldCatId').html($vHtml);
        $('#fldCatId').off('change').on('change', function (event) {
          $('#fldWdays').val(aCats[$(this).val()].WDays);
          initBrands($(this).val());
        });
        setCat(0);
      }
    }
  });
}

function setCat(nCatIdx) {
  $('#fldWdays').val(aCats[nCatIdx].WDays);
  $('#fldCatId').val(nCatIdx);
  initBrands(nCatIdx);
}

function initBrands(nCatIdx) {
  $vHtml = '';
  let cat = aCats[nCatIdx];
  for (var i = 0; i < cat.Brands.length; i++) {
    let brand = cat.Brands[i];
    $vHtml += `<Option value="${i}">${brand.Name}</option>`;
  }
  $('#fldBrandId').html($vHtml);
  $('#fldBrandId').off('change').on('change', function (event) {
    initProducts(nCatIdx, $(this).val());
  });
  setBrand(nCatIdx, 0);
}

function setBrand(nCatIdx, nBrandIdx) {
  $('#fldBrandId').val(nBrandIdx);
  initProducts(nCatIdx, nBrandIdx);
}

function initProducts(nCatIdx, nBrandIdx) {
  $vHtml = '';
  let brand = aCats[nCatIdx].Brands[nBrandIdx];
  for (var i = 0; i < brand.Products.length; i++) {
    let product = brand.Products[i];
    $vHtml += `<Option value="${product.nId}">${product.vName1}</option>`;
  }
  $('#fldProdId').html($vHtml);
  setProduct(aCats[nCatIdx].Brands[nBrandIdx].Products[0].nId);
}

function setProduct(nId) {
  $('#fldProdId').val(nId);
}

function doNew() {
  resetFormValid('ph_Form');
  $('ph_Form').trigger('reset');
  $('ph_Form').removeClass('was-validated');
  setCat(0);
  $("#fldId").val(0);
  $("#fldSNum").val('');
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
                        <th class="text-center">${getLabel("Brand")}</th>
                        <th class="text-center">${getLabel("Category")}</th>
                        <th class="text-center">${getLabel("Product")}</th>
                        <th class="text-center">${getLabel("Serial")}</th>
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
                      <td class="text-center">${item.vBrandName}</td>
                      <td class="text-center">${item.vCatName}</td>
                      <td class="text-center">${item.vProdName}</td>
                      <td class="text-center">${item.vSerial}</td>
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
    if (PhSettings.Perms.Insert || PhSettings.Perms.Update) {
      $.ajax({
        async: false,
        type: mettaData.URLS.Save.Method,
        url: mettaData.URLS.Save.URL,
        headers: PhSettings.Headers,
        data: {
          "nId": parseInt($("#fldId").val()),
          "nProdId": $("#fldProdId").val(),
          "vSerial": $("#fldSerial").val()
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
        if (PhSettings.Perms.Delete) {
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
        }
      } else if (result.dismiss === "cancel") {
      }
    });
  }
}

function doEdit(nIdx) {

  if (PhSettings.Perms.Edit) {
    resetFormValid('ph_Form');
    $('ph_form').trigger('reset');
    $('ph_form').removeClass('was-validated');
    let item = resultData[nIdx];
    for (var i = 0; i < aCats.length; i++) {
      let cat = aCats[i];
      if (cat.nId === parseInt(item.nCatId)) {
        setCat(i);
        for (var j = 0; j < cat.Brands.length; j++) {
          let brand = cat.Brands[j];
          if (brand.nId === parseInt(item.nBrandId)) {
            setBrand(i, j);
          }
        }
      }
    }
    $("#fldId").val(item.nId);
    $("#fldProdId").val(item.nProdId);
    $("#fldSNum").val(item.vSerial);
    $('#ph_Modal').modal('show');
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
