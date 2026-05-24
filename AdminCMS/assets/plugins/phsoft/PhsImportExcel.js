/* global bootstrap, XLSX */

let PhsImportExcel = function (aLocalFile = {}, onSave) {
  let _this = this;

  let Labels = {
    ModalLabeled: "Import-Excel-File",
    MatchFields: getLabel("Match Fields"),
    RequiredColumns: getLabel("Required Columns"),
    FileColumns: getLabel("File Columns"),
    Close: getLabel("Close"),
    Save: getLabel("Save")
  };

  /*----------------------------------------------------------------------------------------------------
   * Declare Variables
   ----------------------------------------------------------------------------------------------------*/
  const modalId = 'phsIExcel-' + ((Math.floor(Math.random() * 999) + 100) + Date.now());
  let relFields = [];
  let fileName = '';
  let jsonData = [];

  /*----------------------------------------------------------------------------------------------------
   * Render Page
   ----------------------------------------------------------------------------------------------------*/
  const render = () => {
    let vModal = `<div class="modal fade" id="${modalId}" aria-labelledby="${Labels.ModalLabeled}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div class="modal-header px-2 py-1">
                          <h5>${Labels.MatchFields}</h5>
                        </div>
                        <div class="modal-body" style="height: 70vh; overflow-y: auto;">
                          <form>
                            <div class="row">
                              <div class="col-sm-1 d-hide">
                                <label for="${modalId}-fld_import_File_Attach" class="btn btn-primary">
                                  <i class="bi bi-cloud-upload"></i>
                                </label>
                                <input id="${modalId}-fldFile" type="hidden" value="" >
                                <input id="${modalId}-fld_import_File_Attach" type="file" value="" class="d-none">
                              </div>
                              <div class="col-sm-3 d-hide">
                                <input id="${modalId}-fld_import_name_File" class="form-control form-control-sm" type="text" value="" disabled/>
                              </div>
                            </div>
                            <div class="row pt-2">
                              <div id="${modalId}-import-file-tableMain" class="col-sm-12 ">
                                <table class="table table-bordered table-striped text-center ">
                                  <thead>
                                    <tr>
                                      <td style="width: 40%" class="import-hide-file">
                                        <select id="${modalId}-import-file-localFile" class="form-control form-select w-100">
                                        </select>
                                      </td>
                                      <td style="width: 40%" class="import-hide-file">
                                        <select id="${modalId}-import-file-infoFile" class="form-control form-select w-100"">
                                        </select>
                                      </td>
                                      <td class="import-hide-file" style="width: 10%; text-align: center;">
                                        <button id="${modalId}-import-file-addTable" class="btn btn-info toolbar-btn" >
                                          <i class="bi bi-plus-lg"></i>
                                        </button>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>${Labels.RequiredColumns}</td>
                                      <td>${Labels.FileColumns}</td>
                                      <td></td>
                                    </tr>
                                  </thead>
                                  <tbody id="${modalId}-import-file-tbodyTable">
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer p-1">
                          <button type="button" class="btn btn-secondary" title="${Labels.Close}" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i>
                          </button>
                          <button id="${modalId}-submit-import-file" class="btn btn-primary toolbar-btn" title="${Labels.Save}" data-bs-title="${Labels.Save}" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus">
                            <i class="bi bi-check-lg"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  `;
    $('body').append(vModal);
    import_file_openModal();
  };

  const ExcelToJson = function (e, vCallback = null) {
    const files = e.target.files;
    if (!files || files.length === 0)
      return;
    const file = files[0];
    const nameFile = file.name;
    const reader = new FileReader();
    _this.fileName = file.name;
    reader.onload = function (e) {
      const data = new Uint8Array(e.target.result);
      const workbook = XLSX.read(data, {type: 'array'});
      const sheet = workbook.Sheets[workbook.SheetNames[0]];
      jsonData = XLSX.utils.sheet_to_json(sheet, {defval: '', raw: false, dateNF: 'yyyy-mm-dd'});
      if (vCallback) {
        if (typeof vCallback === "function") {
          vCallback();
        }
      }
    };
    reader.readAsArrayBuffer(file);
  };

  const import_file_openModal = function () {
    $('#' + modalId).modal('show');
    $('#' + modalId + '-fld_import_File_Attach').off('change').change(function (e) {
      e.preventDefault();
      ExcelToJson(e, fillSelect);
      $('#' + modalId + '-fld_import_name_File').val(name);
    });
    $('#' + modalId + '-submit-import-file').off('click').on('click', function (e) {
      e.preventDefault();
      $('#' + modalId).modal('hide');
      let finalData = [];
      for (var i = 0; i < jsonData.length; i++) {
        let item = jsonData[i];
        finalData[i] = {};
        for (var j = 0; j < relFields.length; j++) {
          let fld = relFields[j];
          finalData[i][fld.field] = item[fld.rfield];
        }
      }
      if (onSave) {
        if (typeof onSave === "function") {
          onSave(finalData);
        }
      }
    });
  };

  const fillSelect = function () {
    let cHtml = '';
    $('#' + modalId + '-import-file-localFile').html("");
    for (let i = 0; i < aLocalFile.length; i++) {
      let fld = aLocalFile[i];
      cHtml += `<option value="${fld.field}">${fld.label}</option>`;
    }
    $('#' + modalId + '-import-file-localFile').append(cHtml);

    let vHtml = '';
    $('#' + modalId + '-import-file-infoFile').html("");
    for (let j = 0; j < Object.keys(jsonData[0]).length; j++) {
      vHtml += `<option value="${j}">${Object.keys(jsonData[0])[j]}</option>`;
    }
    $('#' + modalId + '-import-file-infoFile').append(vHtml);

    $('#' + modalId + '-import-file-addTable').click(function (e) {
      e.preventDefault();
      let objectAdd = {
        "field": $('#' + modalId + '-import-file-localFile').val(),
        "nIdx": $('#' + modalId + '-import-file-infoFile').val(),
        "rfield": Object.keys(jsonData[0])[parseInt($('#' + modalId + '-import-file-infoFile').val())],
        "label": $('#' + modalId + '-import-file-localFile option:selected').text()
      };
      $(`#${modalId}-import-file-localFile option[value=${$('#' + modalId + '-import-file-localFile').val()}]`).remove();
      $(`#${modalId}-import-file-infoFile option[value=${$('#' + modalId + '-import-file-infoFile').val()}]`).remove();
      relFields.push(objectAdd);
      import_file_renderTableInfo();
    });
  };

  const import_file_renderTableInfo = function () {
    let vHtml = '';
    if ($('#' + modalId + '-import-file-localFile').is(':empty') || $('#' + modalId + '-import-file-infoFile').is(':empty')) {
      $('.import-hide-file').addClass('d-none');
      $('#' + modalId + '-import-file-tableMain').addClass('w-100');
    }
    for (let i = 0; i < relFields.length; i++) {
      vHtml += `<tr>`;
      vHtml += `<td>${relFields[i].label} </td>`;
      vHtml += `<td>${relFields[i].rfield} </td>`;
      vHtml += `<td><button class="btn btn-sm btn-danger impf-delrow" data-ridx="${i}"><i class="bi bi-x-circle"></i></button></td>`;
      vHtml += `</tr>`;
    }
    $('#' + modalId + '-import-file-tbodyTable').html(vHtml);
    initEvents();
  };

  const initEvents = function () {
    $('.impf-delrow').off('click').on("click", function (e) {
      e.preventDefault();
      import_file_removeRow($(this).data('ridx'));
    });
  };

  const import_file_removeRow = function (ridx) {
    if ($('.import-hide-file').hasClass('d-none')) {
      $('.import-hide-file').removeClass('d-none');
    }
    $('#' + modalId + '-import-file-localFile').append($('<option>', {
      value: relFields[ridx].field,
      text: relFields[ridx].label
    }));
    $('#' + modalId + '-import-file-infoFile').append($('<option>', {
      value: relFields[ridx].nIdx,
      text: relFields[ridx].rfield
    }
    ));
    relFields.splice(ridx, 1);
    import_file_renderTableInfo();
  };

  render();
};
