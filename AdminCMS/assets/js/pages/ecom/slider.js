var resultType = 0;
let vUrl = '';
let vFile = '';
let aData = [];
$(document).ready(function () {
  $("#fldFile").change(function (e) {
    e.preventDefault();
    getImage(e);
  });
  $("#ph-submit").click(function (e) {
    e.preventDefault();
    save();
  });
  $("#ph-new").click(function (e) {
    e.preventDefault();
    showMessage({title: getLabel('The.Form.Will.be.Clear') + ' !!',
      successCallback: openNew
    });
  });
  getData();
});

function getImage(e) {
  vUrl = URL.createObjectURL(e.target.files[0]);
  $("#fldImg").attr('src', vUrl);
  base64Encoder(e.target.files[0]);
}
;

function base64Encoder(blob) {
  let reader = new FileReader();
  reader.readAsDataURL(blob);
  reader.onloadend = () => {
    $("#fldAttache").val(reader.result);
  };
}

function save() {
  let nId = parseInt($('#fldId').val());
  let apiMethod = PhSettings.FTree.Slider.Add.Method;
  let apiURL = PhSettings.FTree.Slider.Add.URL;
  if (nId > 0) {
    apiMethod = PhSettings.FTree.Slider.Update.Method;
    apiURL = PhSettings.FTree.Slider.Update.URL;
  }
  $.ajax({
    type: apiMethod,
    url: apiURL,
    data: {
      'nId': $('#fldId').val(),
      'nOrd': $('#fldOrder').val(),
      'vImage': $('#fldImg').attr('name'),
      'vFile': $('#fldAttache').val()
    },
    success: function (response) {
      if (response.Status) {
        openNew();
        getData();
      }
    }
  });
}

function openNew() {
  $("#fldId").val(0);
  $("#fldOrder").val('');
  $("#fldImg").attr('src', '');
  $('#fldFile').val();
  $("#fldAttache").val('');
}

function getData() {
  $.ajax({
    type: PhSettings.FTree.Slider.List.Method,
    url: PhSettings.FTree.Slider.List.URL,
    data: {},
    success: function (response) {
      if (response.Status) {
        aData = response.Data;
        drawData();
      }
    }
  });
}

function drawData() {
  let vHtml = '';
  vHtml += '<div class="table-responsive">';
  vHtml += '  <table class="table align-middle text-center">';
  vHtml += '    <thead class="table-secondary">';
  vHtml += '      <tr>';
  vHtml += '        <td style="width: 2%;">#</td>';
  vHtml += '        <td style="width: 8%;">' + getLabel('Order') + '</td>';
  vHtml += '        <td>' + getLabel('Image') + '</td>';
  vHtml += '      </tr>';
  vHtml += '    </thead>';
  vHtml += '    <tbody class="table-group-divider table-light">';
  for (let i = 0; i < aData.length; i++) {
    vHtml += '      <tr>';
    vHtml += '        <td>';
    vHtml += '          <button class="btn btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
    vHtml += '            <ul class="dropdown-menu">';
    vHtml += '              <li class=""><a class="dropdown-item edit-item" href="javascript:;" data-id="' + aData[i].nId + '" data-index="' + i + '">' + getLabel('Edit') + '</a></li>';
    vHtml += '              <li class=""><a class="dropdown-item delete-item" href="javascript:;" data-id="' + aData[i].nId + '" data-index="' + i + '">' + getLabel('Delete') + '</a></li>';
    vHtml += '            </ul>';
    vHtml += '        </td>';
    vHtml += '        <td>' + aData[i].nOrd + '</td>';
    vHtml += '        <td style="width: 250px; height: 200px;">';
    vHtml += '          <img id="fldImg' + aData[i].nId + '" src="' + aData[i].vImg + '" class="img-thumbnail imgprod w-100 h-100">';
    vHtml += '        </td>';
    vHtml += '      </tr>';
  }
  vHtml += '    </tbody>';
  vHtml += '  </table>';
  vHtml += '</div>';
  $('#tableData').html(vHtml);
  $('.edit-item').click(function (e) {
    e.preventDefault();
    let nIndex = parseInt($(this).data('index'));
    editClick(nIndex);
  });
  $('.delete-item').click(function (e) {
    e.preventDefault();
    let nIndex = parseInt($(this).data('index'));
    deleteClick(nIndex);
  });
}

function editClick(nIndex) {
  $("#fldId").val(aData[nIndex].nId);
  $("#fldOrder").val(aData[nIndex].nOrd);
  $("#fldImg").attr('src', aData[nIndex].vImg);
  $("#fldImg").attr('name', aData[nIndex].vImage);
  $("#fldAttache").val(aData[nIndex].vFile);
}

function deleteClick(nIndex) {
  showMessage({title: getLabel('Delete') + ' !!',
    successCallback: deleteSlider,
    successParameters: {nId: aData[nIndex].nId}
  });
}

function deleteSlider(params) {
  $.ajax({
    async: false,
    type: PhSettings.FTree.Slider.Delete.Method,
    url: PhSettings.FTree.Slider.Delete.URL,
    data: params,
    success: function (response) {
      if (response.Status) {
        getData();
      }
    },
    error: function (response) {
    }
  });
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
