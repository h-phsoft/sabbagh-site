/* global PhSettings, PhUtility, swal, KTUtil */
var resultId = 0;
var resultData = [];
var mettaData = {};

jQuery(document).ready(function () {

  let aCondFlds = [
    {"Value": 'all', "Label": getLabel('lbl.cms.All Fields')},
    {"Value": 'name', "Label": getLabel('lbl.cms.Name')},
    {"Value": 'code', "Label": getLabel('lbl.cms.Code')},
    {"Value": 'rem', "Label": getLabel('lbl.cms.Remarks')}
  ];
  let vHtml = '';
  for (var i = 0; i < aCondFlds.length; i++) {
    vHtml += `<option value="${aCondFlds[i].Value}">${aCondFlds[i].Label}</option>`;
  }
  $('#search-fld').html(vHtml);

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/Language",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/Language",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/Language",
      "Method": "DELETE"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/Language",
      "Method": "OPTIONS"
    },
    "Count": {
      "URL": PhSettings.serviceURL + "/Language",
      "Method": "PUT"
    }
  };

  if (PhSettings.Perms.Query) {
    $('.result-type').off('click').on('click', function () {
      $('.result-type').removeClass('btn-warning');
      $('.result-type').addClass('btn-outline-warning');
      $(this).removeClass('btn-outline-warning');
      $(this).addClass('btn-warning');
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
  $('#fldDir').val('ltr');
  $('#fldCode').val('');
  $('#fldRem').val('');
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
          renderTable();
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
        "vCode": $('#fldCode').val(),
        "vDir": $('#fldDir').val(),
        "vRem": $('#fldRem').val()
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
  $('#fldCode').val(item.vCode);
  $('#fldDir').val(item.vDir);
  $('#fldRem').val(item.vRem);
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
                      <hr>
                      ${(PhSettings.Perms.Delete) ? `<a class="dropdown-item btn-delete w-100 text-danger" data-rid="${i}"><i class="bi bi-trash"></i>&nbsp;${getLabel("lbl.cms.Delete")}</a>` : ``}
                    </div>
                  </div>
                </td>
                <td><span>${item.vCode}</span></td>
                <td><span>${item.vName}</span></td>
                <td><span>${item.vDir}</span></td>
                <td><span>${item.vRem}</span></td>
              </tr>`;
  }
  vHtml += ``;
  $('#result-Table tbody').html(vHtml);
}
