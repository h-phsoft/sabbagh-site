/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
var resultId = 0;
var resultData = [];
var mettaData = {};
var nCurPage = 1;
jQuery(document).ready(function () {

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/Country",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/Country",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/Country",
      "Method": "DELETE"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/Country",
      "Method": "OPTIONS"
    },
    "Count": {
      "URL": PhSettings.serviceURL + "/Country",
      "Method": "PUT"
    },
  };

  mettaData.ImagePath = PhSettings.mediaPath + 'Country/';
  mettaData.DefaultImage = PhSettings.mediaPath + 'logos/logo.png';

  if (PhSettings.Perms.Query) {
    $('.result-type').off('click').on('click', function () {
      $('.result-type').removeClass('btn-warning');
      $('.result-type').addClass('btn-outline-warning');
      $(this).removeClass('btn-outline-warning');
      $(this).addClass('btn-warning');
      resultType = parseInt($(this).data('val'));
      toggleMode(0);
      phsDoSearch($('#ph-search-text').val(), mettaData, getPage, nCurPage, 0);
    });
    $('#ph-search-text').off('keyup').on('keyup', function () {
      toggleMode(0);
      phsDoSearch($('#ph-search-text').val(), mettaData, getPage, nCurPage, 0);
    });
    $('.ph-search-list').off('change').on('change', function () {
      toggleMode(0);
      phsDoSearch($('#ph-search-text').val(), mettaData, getPage, nCurPage, 0);
    });
  }

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
    $('#ph-new').on('click', function () {
      doNew();
    });
    doNew();
  }
  if (PhSettings.Perms.Query) {
    toggleMode(0);
    phsDoSearch($('#ph-search-text').val(), mettaData, getPage, nCurPage, 0);
  }
});

function toggleMode(nMode) {
  $('#content-list').addClass('d-none');
  $('#content-form').addClass('d-none');
  $('#result-type-0').removeClass('btn-warning');
  $('#result-type-1').removeClass('btn-warning');
  $('#result-type-0').addClass('btn-outline-warning');
  $('#result-type-1').addClass('btn-outline-warning');
  $('#result-type-0').removeClass('text-black');
  $('#result-type-1').removeClass('text-black');
  if (parseInt(nMode) === 0) {
    $('#result-type-' + resultType).addClass('btn-warning');
    $('#result-type-' + resultType).removeClass('btn-outline-warning');
    $('#result-type-' + resultType).addClass('text-black');
    $('#content-list').removeClass('d-none');
  } else if (parseInt(nMode) === 1) {
    $('#content-form').removeClass('d-none');
  } else {
    $('#content-form').removeClass('d-none');
  }
}

function setResultType(nType) {
  $('.result-type').removeClass('btn-warning');
  $('.result-type').addClass('btn-outline-warning');
  $('#result-type-' + nType).removeClass('btn-outline-warning');
  $('#result-type-' + nType).addClass('btn-warning');
  resultType = parseInt($('#result-type-' + nType).data('val'));
}

function setBImage(bImage) {
  $('#fldAttach').attr('value', bImage);
  $('#fldFExt').val('png');
}

function getPage(vText, nStart, nEnd, nPage, nPerPage) {
  nCurPage = nPage;
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
      "vText": $('#ph-search-text').val(),
    },
    success: function (response) {
      if (response.Status) {
        resultData = response.Data;
        $('#resultData').html('');
        switch (resultType) {
          case 0:
            renderGrid();
            break;
          case 1:
            renderTable();
            break;
          default:
            renderGrid();
            break;
        }
        if (PhSettings.Perms.Update) {
          $('.btn-edit').off('click').on('click', function (e) {
            e.preventDefault();
            resultId = parseInt($(this).data('rid'));
            doEdit(resultId);
          });
        }
        if (PhSettings.Perms.Insert) {
          $('.btn-duplicate').off('click').on('click', function (e) {
            e.preventDefault();
            resultId = parseInt($(this).data('rid'));
            doDuplicate(resultId);
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

function doNew() {
  toggleMode(1);
  $('#ph_Form').trigger('reset');
  $('#ph_Form').removeClass('was-validated');
  $('#fldId').val(0);
  $('#fldId').val(0);
  $('#fldName').val('');
  $('#fldImage').val('logo.png');
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
        "nId": $('#fldId').val(),
        "vName": $('#fldName').val(),
        "vImage": $('#fldImage').val(),
        "vFExt": $('#fldFExt').val(),
        "vFName": $('#fldFName').val(),
        "vFile": $('#fldAttach').val()
      },
      success: function (response) {
        if (response.Status) {
          doNew();
          toggleMode(0);
          phsDoSearch($('#ph-search-text').val(), mettaData, getPage, nCurPage, 0);
          showToast(getLabel('lbl.cms.Save'), 'WARNING', response.Message);
        } else {
          showToast(getLabel('lbl.cms.Error'), 'DANGER', response.Message);
        }
      }
    });
  }
}

function doEdit(nIdx) {
  resetFormValid('ph_Form');
  let item = resultData[nIdx];
  $('#fldId').val(item.nId);
  $('#fldId').val(item.nId);
  $('#fldName').val(item.vName);
  $('#fldImage').val(item.vImage);
  $('#fldImagePreview').attr('src', mettaData.ImagePath + item.vImage);
  loadFromURL(mettaData.ImagePath + item.vImage, (result) => {
    setBImage(result);
  });
  toggleMode(2);
}

function doDuplicate(nIdx) {
  resetFormValid('ph_Form');
  let item = resultData[nIdx];
  $('#fldId').val(0);
  $('#fldId').val(item.nId);
  $('#fldName').val(item.vName);
  $('#fldImage').val(item.vImage);
  $('#fldImagePreview').attr('src', mettaData.ImagePath + item.vImage);
  loadFromURL(mettaData.ImagePath + item.vImage, (result) => {
    setBImage(result);
  });
  toggleMode(2);
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
              toggleMode(0);
              phsDoSearch($('#ph-search-text').val(), mettaData, getPage, nCurPage, 0);
              showToast(getLabel('lbl.cms.Delete'), 'SUCCESS', response.Message);
            } else {
              showToast(getLabel('lbl.cms.Error'), 'DANGER', response.Message);
            }
          }
        });
      } else if (result.dismiss === 'cancel') {
      }
    });
  }
}

function renderGrid() {
  let vHtml = '';
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml +=
      `<div class="col-sm-3 p-2 mx-auto">
        <div id="item-${item.nId}" class="card card-product h-100">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-12 edit-item" data-rid="${i}">
                <img src="${mettaData.ImagePath}${item.vImage}" width="100%"/>
                <div class="dropdown px-3">
                  <a href="#" data-bs-toggle="dropdown" class="btn btn-outline-secondary rounded btn-sm font-sm" aria-expanded="false">
                    <i class="icon bi bi-three-dots"></i>
                  </a>
                  <div class="dropdown-menu" style="margin: 0px;">
                    ${PhSettings.Perms.Update ? `<a class="dropdown-item btn-edit w-100" data-rid="${i}"><i class="bi bi-pencil"></i>&nbsp;${getLabel("lbl.cms.Edit")}</a>` : ``}
                    ${PhSettings.Perms.Insert ? `<a class="dropdown-item btn-duplicate w-100" data-rid="${i}"><i class="bi bi-files"></i>&nbsp;${getLabel("lbl.cms.Duplicate")}</a>` : ``}
                    <hr>
                    ${(PhSettings.Perms.Delete) ? `<a class="dropdown-item btn-delete w-100 text-danger" data-rid="${i}"><i class="bi bi-trash"></i>&nbsp;${getLabel("lbl.cms.Delete")}</a>` : ``}
                  </div>
                </div>
              </div>
            </div>
            <div class="row pt-3 px-3">
              <div class="col-12">
                <div class="row">
                  <div class="col-12">
                    <span>${item.vName}</span>
                  </div>
                </div>
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
  for (var i = 0; i < resultData.length; i++) {
    let item = resultData[i];
    vHtml += `<article class="itemlist">
                <div class="row align-items-center">
                  <div class="col-1 text-start">
                    <div class="row py-1">
                      <div class="col-12 text-start">
                        <div class="dropdown">
                          <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm" aria-expanded="false">
                            <i class="icon bi bi-three-dots"></i>
                          </a>
                          <div class="dropdown-menu" style="margin: 0px;">
                            ${PhSettings.Perms.Update ? `<a class="dropdown-item btn-edit w-100" data-rid="${i}"><i class="bi bi-pencil"></i>&nbsp;${getLabel("lbl.cms.Edit")}</a>` : ``}
                            ${PhSettings.Perms.Insert ? `<a class="dropdown-item btn-duplicate w-100" data-rid="${i}"><i class="bi bi-files"></i>&nbsp;${getLabel("lbl.cms.Duplicate")}</a>` : ``}
                            <hr>
                            ${(PhSettings.Perms.Delete) ? `<a class="dropdown-item btn-delete w-100 text-danger" data-rid="${i}"><i class="bi bi-trash"></i>&nbsp;${getLabel("lbl.cms.Delete")}</a>` : ``}
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row py-1">
                      <div class="col-12 text-start">
                      </div>
                    </div>
                    <div class="row py-1">
                      <div class="col-12 text-start">
                      </div>
                    </div>
                  </div>
                  <div class="col-1 edit-item" data-rid="${i}">
                    <img src="${mettaData.ImagePath}${item.vImage}" alt="${item.vName}" width="100%">
                  </div>
                  <div class="col-9">
                    <div class="row">
                      <div class="col-sm-6">
                        <span>${item.vName}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </article>`;
  }
  $('#resultData').html(vHtml);
}

