/* global PhSettings, swal */
var mettaData = {};
var aPerms = [];

var table;
var aPerms = ['isOK', 'Insert', 'Update', 'Delete', 'Query', 'Print', 'Commit', 'Revoke', 'Export', 'Import', 'Special'];
jQuery(document).ready(function () {

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/PGrp",
      "Method": "POST"
    },
    "Update": {
      "URL": PhSettings.serviceURL + "/PGrp/Perms",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/PGrp",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/PGrp",
      "Method": "DELETE"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/PGrp",
      "Method": "OPTIONS"
    }
  };

  $('#ph-new').on('click', function () {
    doNew();
  });

  $('#ph-edit').on('click', function () {
    doEdit();
  });

  $('#ph-delete').on('click', function () {
    doDelete($('#lstPGrp').val());
  });

  $('#lstPGrp').on('change', function () {
    getPGrp($('#lstPGrp').val());
  });

  $('#ph-submit').on('click', function () {
    doSave();
  });

  $('#ph-save').on('click', function () {
    doUpdatePermissions();
  });

  initForm();
  getPGrps();
});

function getPGrps() {
  $.ajax({
    type: mettaData.URLS.List.Method,
    async: false,
    url: mettaData.URLS.List.URL,
    headers: PhSettings.Headers,
    success: function (response) {
      if (response.Status) {
        let vHTML = '';
        for (var i = 0; i < response.Data.length; i++) {
          vHTML += `<option value="${response.Data[i].nId}">${response.Data[i].vName}</option>`;
        }
        $('#lstPGrp').html(vHTML);
        getPGrp($('#lstPGrp').val());
      }
    }
  });
}

function initForm() {
  let options = `<option value="-1" selected>----------</option>
                       <option value="1">${getLabel('Grant')}</option>
                       <option value="0">${getLabel('Ban')}</option>
                       <option value="2">${getLabel('Invert')}</option>`;
  let vHtml = '';
  vHtml += `<table id="permsTable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center"><select data-rel='Isok' class="change-perm form-control text-center">${options}</select></th>
                        <th class="text-center"></th>
                        <th class="text-center"><select data-rel="Qry" class="change-perm form-control text-center">${options}</select></th>
                        <th class="text-center"><select data-rel="Ins" class="change-perm form-control text-center">${options}</select></th>
                        <th class="text-center"><select data-rel="Upd" class="change-perm form-control text-center">${options}</select></th>
                        <th class="text-center"><select data-rel="Del" class="change-perm form-control text-center">${options}</select></th>
                        <th class="text-center"><select data-rel="Prt" class="change-perm form-control text-center">${options}</select></th>
                        <th class="text-center"><select data-rel="Imp" class="change-perm form-control text-center">${options}</select></th>
                        <th class="text-center"><select data-rel="Exp" class="change-perm form-control text-center">${options}</select></th>
                        <th class="text-center"><select data-rel="Cmt" class="change-perm form-control text-center">${options}</select></th>
                        <th class="text-center"><select data-rel="Rvk" class="change-perm form-control text-center">${options}</select></th>
                        <th class="text-center"><select data-rel="Spc" class="change-perm form-control text-center">${options}</select></th>
                      </tr>
                      <tr>
                        <th class="text-center"></th>
                        <th class="text-center" style="width: 20%;">${getLabel("Name")}</th>
                        <th class="text-center">${getLabel("Query")}</th>
                        <th class="text-center">${getLabel("Insert")}</th>
                        <th class="text-center">${getLabel("Update")}</th>
                        <th class="text-center">${getLabel("Delete")}</th>
                        <th class="text-center">${getLabel("Print")}</th>
                        <th class="text-center">${getLabel("Import")}</th>
                        <th class="text-center">${getLabel("Export")}</th>
                        <th class="text-center">${getLabel("Commit")}</th>
                        <th class="text-center">${getLabel("Revoke")}</th>
                        <th class="text-center">${getLabel("Special")}</th>
                      </tr>
                    </thead>
                    <tbody>`;
  vHtml += `  </tbody>
            </table>`;
  $('#resultData').html(vHtml);
  $('.change-perm').off('change').on('change', function (e) {
    e.preventDefault();
    let vRel = $(this).data('rel');
    let chPerm = parseInt($(this).val());
    if (chPerm >= 0) {
      for (var i = 0; i < aPerms.length; i++) {
        switch (chPerm) {
          case 0:
            aPerms[i][vRel] = 0;
            break;
          case 1:
            aPerms[i][vRel] = 1;
            break;
          case 2:
            aPerms[i][vRel] = 1 - aPerms[i][vRel];
            break;
          default:

            break;
        }
      }
      drawPerms();
      $(this).val(-1);
    }
  });
}

function getPGrp(nId) {
  $('#ph-delete').addClass('d-none');
  $('#ph-edit').addClass('d-none');
  $.ajax({
    type: mettaData.URLS.Get.Method,
    async: false,
    url: mettaData.URLS.Get.URL,
    headers: PhSettings.Headers,
    data: {
      "id": nId
    },
    success: function (response) {
      if (response.Status) {
        aPerms = response.Data.aPerms;
        $('#ph-delete').removeClass('d-none');
        $('#ph-edit').removeClass('d-none');
        drawPerms();
      } else {
        showToast('Get Group ' + nId, 'WARNING', response.Message);
      }
    },
    error: function (response) {
      showToast('Error', 'DANGER', response);
    }
  });
}

function drawPerms() {
  let vHtml = ``;
  for (var i = 0; i < aPerms.length; i++) {
    let perm = aPerms[i];
    console.log(perm.oProg.vPName, getLabel(perm.oProg.vPName));
    vHtml += `<tr>
                <th class="text-center"><input class="rowChange" data-idx="${i}" data-rel="Isok" type="checkbox" ${perm.Isok === 1 ? 'checked' : ''}/></th>
                <th class="text-center">${getLabel(perm.oProg.vPName)}-${getLabel(perm.oProg.Name)}</th>
                <th class="text-center"><input class="rowChange" type="checkbox" data-idx="${i}" data-rel="Qry" ${perm.Qry === 1 ? 'checked' : ''}/></th>
                <th class="text-center"><input class="rowChange" type="checkbox" data-idx="${i}" data-rel="Ins" ${perm.Ins === 1 ? 'checked' : ''}/></th>
                <th class="text-center"><input class="rowChange" type="checkbox" data-idx="${i}" data-rel="Upd" ${perm.Upd === 1 ? 'checked' : ''}/></th>
                <th class="text-center"><input class="rowChange" type="checkbox" data-idx="${i}" data-rel="Del" ${perm.Del === 1 ? 'checked' : ''}/></th>
                <th class="text-center"><input class="rowChange" type="checkbox" data-idx="${i}" data-rel="Prt" ${perm.Prt === 1 ? 'checked' : ''}/></th>
                <th class="text-center"><input class="rowChange" type="checkbox" data-idx="${i}" data-rel="Imp" ${perm.Imp === 1 ? 'checked' : ''}/></th>
                <th class="text-center"><input class="rowChange" type="checkbox" data-idx="${i}" data-rel="Exp" ${perm.Exp === 1 ? 'checked' : ''}/></th>
                <th class="text-center"><input class="rowChange" type="checkbox" data-idx="${i}" data-rel="Cmt" ${perm.Cmt === 1 ? 'checked' : ''}/></th>
                <th class="text-center"><input class="rowChange" type="checkbox" data-idx="${i}" data-rel="Rvk" ${perm.Rvk === 1 ? 'checked' : ''}/></th>
                <th class="text-center"><input class="rowChange" type="checkbox" data-idx="${i}" data-rel="Spc" ${perm.Spc === 1 ? 'checked' : ''}/></th>
              </tr>`;
  }
  $('#permsTable tbody').html(vHtml);
  $('.rowChange').off('change').on('change', function () {
    let nIdx = $(this).data('idx');
    let vRel = $(this).data('rel');
    let bChecked = $(this).is(":checked");
    if (bChecked) {
      aPerms[nIdx][vRel] = 1;
    } else {
      aPerms[nIdx][vRel] = 0;
    }
  });
}

function doNew() {
  $('#fldId').val(0);
  $('#fldName').val('');
  $('#ph_Modal').modal('show');
}

function doEdit() {
  $('#fldId').val($('#lstPGrp').val());
  $('#fldName').val($('#lstPGrp option:selected').text());
  $('#ph_Modal').modal('show');
}

function doUpdatePermissions() {
  let nId = parseInt($('#lstPGrp').val());
  $.ajax({
    type: mettaData.URLS.Update.Method,
    async: false,
    url: mettaData.URLS.Update.URL,
    headers: PhSettings.Headers,
    data: {
      "nId": nId,
      "permissions": aPerms
    },
    success: function (response) {
      if (response.Status) {
        showToast(getLabel('Save'), 'INFO', response.Message);
      } else {
        showToast(getLabel('Save'), 'WARNING', response.Message);
      }
    },
    error: function (response) {
      showToast(getLabel('Error'), 'DANGER', response.Message);
    }
  });
}

function doSave() {
  let nId = parseInt($('#fldId').val());
  $.ajax({
    type: mettaData.URLS.Save.Method,
    async: false,
    url: mettaData.URLS.Save.URL,
    headers: PhSettings.Headers,
    data: {
      "nId": nId,
      "vName": $('#fldName').val(),
      "aParams": aPerms
    },
    success: function (response) {
      if (response.Status) {
        showToast(getLabel('Save'), 'INFO', response.Message);
        if (parseInt(response.Id) > 0) {
          getPGrps();
          $('#ph_Modal').modal('hide');
          $('#lstPGrp').val(response.Id);
          getPGrp(response.Id);
        }
      } else {
        showToast(getLabel('Save'), 'WARNING', response.Message);
      }
    },
    error: function (response) {
      showToast(getLabel('Error'), 'DANGER', response.Message);
    }
  });
}

function doDelete(nId) {
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
              showToast(getLabel('Delete'), 'SUCCESS', response.Message);
              getPGrps();
            } else {
              swal.fire({
                title: getLabel('Delete'),
                text: response.Message,
                confirmButtonText: "<i class='bi bi-check-lg'></i> " + getLabel('ok')
              }).then(function (result) {
                if (result.value) {
                }
              });
            }
          },
          error: function (response) {
            showToast(getLabel('Error'), 'DANGER', response.Message);
          }
        });
      } else if (result.dismiss === "cancel") {
      }
    });
  }
}
