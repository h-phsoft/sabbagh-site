/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
var table;
jQuery(document).ready(function () {
  $('#ph_add').on('click', function () {
    swal.fire({
      title: getLabel('Are you sure ?'),
      text: "",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "<i class='flaticon2-check-mark'></i> " + getLabel('Yes'),
      cancelButtonText: "<i class='flaticon2-cross'></i> " + getLabel('No'),
      reverseButtons: true,
      customClass: {
        confirmButton: "btn btn-danger",
        cancelButton: "btn btn-default"
      }
    }).then(function (result) {
      if (result.value) {
        openNew();
      } else if (result.dismiss === "cancel") {
      }
    });
  });
  $('#ph_search').on('click', function () {
    openSearch();
  });
  $('#ph_delete').on('click', function () {
    if (PhSettings.current.delete) {
      doDelete();
    }
  });
  $('#ph_submit').on('click', function () {
    save();
  });
  openNew();
});

function setResultType(nType) {
  $('.result-type').removeClass('btn-warning');
  $('.result-type').addClass('btn-outline-warning');
  $('#result-type-' + nType).removeClass('btn-outline-warning');
  $('#result-type-' + nType).addClass('btn-warning');
  resultType = parseInt($('#result-type-' + nType).data('val'));
}

function openNew() {
  $('#ph_Form').trigger('reset');
  $('#ph_Form').removeClass('was-validated');
  $('#fldTIndex').val(-1);
  $('#fldId').val(0);
  $('#fldProdId').val(0);
  $('#fldProdName').val('');
  $('#fldUnitId').val($('#fldUnitId :first').val());
  $('#fldSnum').val(0);
  $('#fldAnum').val(0);
  $('#fldName').val('');
  $('#fldBox').val(0);
  $('#fldQnt').val(0);
  $('#fldPrice').val(0);
  $('#fldCprice').val(0);
  toggleButtons();
}

function toggleButtons() {

}

function openSearch() {
  $('#ph_Modal').modal('show');
  refreshList();
}

function doDelete() {
  if (PhSettings.current.delete) {
    if ($('#fldId').val() > 0) {
      var vName = '';
      PhUtility.doDelete(vName, {
        'vOperation': 'cpy-Ecom-ProdSize-Delete',
        'nId': $('#fldId').val()
      }, openNew);
    }
  }
}

function save() {
  var form = KTUtil.getById('ph_Form');
  form.classList.remove('was-validated');
  if (form.checkValidity()) {
    PhUtility.doSave({
      'vOperation': 'cpy-Ecom-ProdSize-Save',
      'nId': $('#fldId').val(),
      'nProdId': $('#fldProdId').val(),
      'nUnitId': $('#fldUnitId').val(),
      'nSnum': $('#fldSnum').val(),
      'nAnum': $('#fldAnum').val(),
      'vName': $('#fldName').val(),
      'nBox': $('#fldBox').val(),
      'nQnt': $('#fldQnt').val(),
      'nPrice': $('#fldPrice').val(),
      'nCprice': $('#fldCprice').val(),
    }, openNew);
    if (parseInt($('#fldId').val()) <= 0) {
      $('#ph_Form').trigger('reset');
    }
  } else {
    form.classList.add('was-validated');
  }
}

function cellEditClick(e, cell) {
  var data = cell.getData();
  $('#fldId').val(data.nId);
  $('#fldProdId').val(data.nProdId);
  $('#fldProdName').val(data.vProdName);
  $('#fldUnitId').val(data.nUnitId);
  $('#fldSnum').val(data.nSnum);
  $('#fldAnum').val(data.nAnum);
  $('#fldName').val(data.vName);
  $('#fldBox').val(data.nBox);
  $('#fldQnt').val(data.nQnt);
  $('#fldPrice').val(data.nPrice);
  $('#fldCprice').val(data.nCprice);
  toggleButtons();
  $('#ph_Modal').modal('show');
}

function refreshList() {
  var aColumns = [];
  var nIdx = 0;
  if (PhSettings.current.update) {
    aColumns[nIdx++] = {
      title: getLabel(''),
      width: '4%',
      hozAlign: 'center',
      headerHozAlign: 'center',
      headerSort: false,
      formatter: function (cell, formatterParams) {
        return PhUtility.editButton();
      },
      cellClick: cellEditClick
    };
  }
  aColumns[nIdx++] = {
    title: getLabel('ProdId'),
    field: 'vProdName',
    hozAlign: 'center',
    headerHozAlign: 'center',
    headerFilter: 'input',
    formatter: 'textarea'
  };
  aColumns[nIdx++] = {
    title: getLabel('UnitId'),
    field: 'vUnitName',
    hozAlign: 'center',
    headerHozAlign: 'center',
    headerFilter: 'input',
    formatter: 'textarea'
  };
  aColumns[nIdx++] = {
    title: getLabel('Snum'),
    field: 'nSnum',
    hozAlign: 'center',
    headerHozAlign: 'center',
    headerFilter: 'input',
    formatter: 'textarea'
  };
  aColumns[nIdx++] = {
    title: getLabel('Anum'),
    field: 'nAnum',
    hozAlign: 'center',
    headerHozAlign: 'center',
    headerFilter: 'input',
    formatter: 'textarea'
  };
  aColumns[nIdx++] = {
    title: getLabel('Name'),
    field: 'vName',
    hozAlign: 'center',
    headerHozAlign: 'center',
    headerFilter: 'input',
    formatter: 'textarea'
  };
  aColumns[nIdx++] = {
    title: getLabel('Box'),
    field: 'nBox',
    hozAlign: 'center',
    headerHozAlign: 'center',
    headerFilter: 'input',
    formatter: 'textarea'
  };
  aColumns[nIdx++] = {
    title: getLabel('Qnt'),
    field: 'nQnt',
    hozAlign: 'center',
    headerHozAlign: 'center',
    headerFilter: 'input',
    formatter: 'textarea'
  };
  aColumns[nIdx++] = {
    title: getLabel('Price'),
    field: 'nPrice',
    hozAlign: 'center',
    headerHozAlign: 'center',
    headerFilter: 'input',
    formatter: 'textarea'
  };
  aColumns[nIdx++] = {
    title: getLabel('Cprice'),
    field: 'nCprice',
    hozAlign: 'center',
    headerHozAlign: 'center',
    headerFilter: 'input',
    formatter: 'textarea'
  };
  table = getAjaxTabulator('cpy-Ecom-ProdSize-List', aColumns);
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
