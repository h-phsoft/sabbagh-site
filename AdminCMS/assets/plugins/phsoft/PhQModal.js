let PhQModal = function (id, tittle, metta, options = {}) {
  let phM = this;
  phM.ModalId = id;
  phM.ModalTittle = tittle;
  phM.aURL = metta.aURL;
  phM.aFields = metta.aFields;
  phM.aBtns = metta.aBtns;
  phM.defaultOptions = {
    modalSize: 'lg',
    colOper: 3
  };
  phM.aOptions = $.extend(phM.defaultOptions, options);

  phM.Modal = phM.ModalId + '-Modal';
  phM.ModalBody = phM.ModalId + '-ModalBody';
  phM.FormContainer = phM.ModalId + '-FormContainer';
  phM.Form = phM.ModalId + '-Form';
  phM.TableContainer = phM.ModalId + '-TableContainer';
  phM.Table = phM.ModalId + '-Table';
  phM.TablePager = phM.ModalId + '-TablePager';

  phM.renderOperation = function (oField) {
    let vComponent = '';
    vComponent += '<label for="' + phM.ModalId + oField.element + '1" class="col-sm-' + oField.colLabel + ' form-label ph-label text-start px-2">' + oField.label + '</label>';
    vComponent += '<div class="col-sm-' + phM.aOptions.colOper + ' px-0">';
    vComponent += '  <select id="' + phM.ModalId + oField.element + '" class="form-select form-select-sm QFld">';
    for (let i = 0; i < oField.aOpers.length; i++) {
      if (oField.hasOwnProperty('aOpers')) {
        let oper = PhFOperations[oField.aOpers[i]];
        vComponent += '    <option value="' + oper.sign + '">' + oper.sign + '</option>';
      }
    }
    vComponent += '  </select>';
    vComponent += '</div>';
    return vComponent;
  };

  phM.renderInputText = function (oField) {
    let vComponent = '';
    let vClass = '';
    vComponent += phM.renderOperation(oField);
    if (oField.aOpers.includes(PhFOper_BT) || oField.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phM.ModalId + oField.element).val() === '<>' || $('#' + phM.ModalId + oField.element).val() === '><') ? '' : 'd-none';
      vComponent += '  <div class="col-sm-' + oField.colElement + '  px-0">';
      vComponent += '    <input id="' + phM.ModalId + oField.element + '1" class="form-control form-control-sm" type="text" value="' + oField.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
      vComponent += '  <div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '    <input id="' + phM.ModalId + oField.element + '2" class="form-control form-control-sm ' + vClass + ' " type="text" value="' + oField.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
    } else {
      vComponent += '  <div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '    <input id="' + phM.ModalId + oField.element + '1" class="form-control form-control-sm" type="text" value="' + oField.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
    }
    return vComponent;
  };

  phM.renderSelect = function (oField) {
    let vComponent = '';
    vComponent += phM.renderOperation(oField);
    vComponent += '<div class="col-sm-' + oField.colElement + ' px-0">';
    vComponent += '  <select id="' + phM.ModalId + oField.element + '1" class="form-select form-select-sm">';
    vComponent += '    <option value="" ' + (oField.defValue === -1 ? 'selected' : '') + '></option>';
    for (let i = 0; i < oField.options.length; i++) {
      vComponent += '  <option value="' + oField.options[i].id + '" ' + (oField.defValue === oField.options[i].id ? 'selected' : '') + '>' + oField.options[i].name + '</option>';
    }
    vComponent += '  </select>';
    vComponent += '</div>';
    return vComponent;
  };

  phM.renderInputNumber = function (oField) {
    let vComponent = '';
    let vClass = '';
    vComponent += phM.renderOperation(oField);
    if (oField.aOpers.includes(PhFOper_BT) || oField.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phM.ModalId + oField.element).val() === '<>' || $('#' + phM.ModalId + oField.ModalId).val() === '><') ? '' : 'd-none';
      vComponent += '<div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '  <input id="' + phM.ModalId + oField.ModalId + '1" class="form-control form-control-sm" type="number" min="' + oField.minValue + '" step="' + oField.step + '" max="' + oField.maxValue + '" value="' + oField.defValue + '" autocomplete="off" />';
      vComponent += '</div>';
      vComponent += '<div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '  <input id="' + phM.ModalId + oField.ModalId + '2" class="form-control form-control-sm ' + vClass + '" type="number" min="' + oField.minValue + '" step="' + oField.step + '" max="' + oField.maxValue + '" value="' + oField.defValue + '" autocomplete="off" />';
      vComponent += '</div>';
    } else {
      vComponent += '<div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '  <input id="' + phM.ModalId + oField.ModalId + '1" class="form-control form-control-sm" type="number" min="' + oField.minValue + '" step="' + oField.step + '" max="' + oField.maxValue + '" value="' + oField.defValue + '" autocomplete="off" />';
      vComponent += '</div>';
    }
    return vComponent;
  };

  phM.renderDatePicker = function (oField) {
    let vComponent = '';
    let vClass = '';
    vComponent += phM.renderOperation(oField);
    if (oField.aOpers.includes(PhFOper_BT) || oField.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phM.ModalId + oField.element).val() === '<>' || $('#' + phM.ModalId + oField.element).val() === '><') ? '' : 'd-none';
      vComponent += ' <div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '   <div class="input-group date">';
      vComponent += '     <input id="' + phM.ModalId + oField.element + '1" class="form-control form-control-sm ph_datepicker" type="text" value="' + oField.defValue + '" required="true" />';
      vComponent += '     <div class="input-group-append input-group-sm datepicker-btn">';
      vComponent += '       <span class="input-group-text">';
      vComponent += '         <i class="bi bi-calendar4-event fs-"></i>';
      vComponent += '       </span>';
      vComponent += '     </div>';
      vComponent += '   </div>';
      vComponent += ' </div>';
      vComponent += ' <div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '   <div class="input-group date">';
      vComponent += '     <input id="' + phM.ModalId + oField.element + '2" class="form-control form-control-sm ph_datepicker ' + vClass + '" type="text" value="' + oField.defValue + '" required="true" />';
      vComponent += '     <div id="' + phM.ModalId + oField.element + '3" class="input-group-append input-group-sm datepicker-btn ' + vClass + '">';
      vComponent += '       <span class="input-group-text">';
      vComponent += '         <i class="bi bi-calendar4-event"></i>';
      vComponent += '       </span>';
      vComponent += '     </div>';
      vComponent += '   </div>';
      vComponent += ' </div>';
    } else {
      vComponent += ' <div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '   <div class="input-group date">';
      vComponent += '     <input id="' + phM.ModalId + oField.element + '1" class="form-control form-control-sm ph_datepicker" type="text" value="' + oField.defValue + '" required="true" />';
      vComponent += '     <div class="input-group-append input-group-sm datepicker-btn">';
      vComponent += '       <span class="input-group-text">';
      vComponent += '         <i class="la la-calendar"></i>';
      vComponent += '       </span>';
      vComponent += '     </div>';
      vComponent += '   </div>';
      vComponent += ' </div>';
    }
    return vComponent;
  };

  phM.renderAutocomplete = function (oField) {
    let vComponent = '';
    let vClass = '';
    vComponent += phM.renderOperation(oField);
    if (oField.aOpers.includes(PhFOper_BT) || oField.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phM.ModalId + oField.element).val() === '<>' || $('#' + phM.ModalId + oField.element).val() === '><') ? '' : ' d-none';
      vComponent += ' <div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '   <input id="' + phM.ModalId + oField.element + 'Id1" type="hidden" value=""/>';
      vComponent += '   <input id="' + phM.ModalId + oField.element + '1" class="form-control form-control-sm phAutocomplete" data-acrel="' + phM.ModalId + oField.element + 'Id1" data-acoperation="' + oField.autoCompleteApi + '" type="text" value=""/>';
      vComponent += ' </div>';
      vComponent += ' <div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '   <input id="' + phM.ModalId + oField.element + 'Id2" type="hidden" value=""/>';
      vComponent += '   <input id="' + phM.ModalId + oField.element + '2" class="form-control form-control-sm phAutocomplete ' + vClass + '" data-acrel="' + phM.ModalId + oField.element + 'Id2" data-acoperation="' + oField.autoCompleteApi + '" type="text" value=""/>';
      vComponent += ' </div>';
    } else {
      vComponent += ' <div class="col-sm-' + oField.colElement + ' px-0">';
      vComponent += '   <input id="' + phM.ModalId + oField.element + 'Id1" type="hidden" value=""/>';
      vComponent += '   <input id="' + phM.ModalId + oField.element + '1" class="form-control form-control-sm phAutocomplete" data-acrel="' + phM.ModalId + oField.element + 'Id1" data-acoperation="' + oField.autoCompleteApi + '" type="text" value=""/>';
      vComponent += ' </div>';
    }
    return vComponent;
  };

  phM.renderModal = function () {
    let vHtml = '';
    vHtml += '<div class="modal fade" id="' + phM.Modal + '" tabindex="-1" aria-labelledby="ph-ModalLabel" aria-hidden="true">';
    vHtml += '  <div class="modal-dialog modal-' + phM.aOptions.modalSize + '">';
    vHtml += '    <div class="modal-content">';
    vHtml += '      <div class="modal-header p-1 m-1">';
    vHtml += phM.renderModalHeader();
    vHtml += '      </div>';
    vHtml += '      <div class="modal-body">';
    vHtml += '        <div id="' + phM.FormContainer + '">';
    vHtml += '          <form id="' + phM.Form + '">';
    vHtml += phM.renderModalBodyForm();
    vHtml += '          </form>';
    vHtml += '        </div>';
    vHtml += phM.renderModalBodyTable();
    vHtml += '      </div>';
    vHtml += '      <div class="modal-footer p-1 m-1">';
    vHtml += phM.renderModalFooter();
    vHtml += '      </div>';
    vHtml += '    </div>';
    vHtml += '  </div>';
    vHtml += '</div>';
    return vHtml;
  };

  phM.renderModalHeader = function () {
    let vHtml = '';
    vHtml += '  <h1 class="modal-title fs-5 px-2" id="ph-ModalLabel">' + phM.ModalTittle + '</h1>';
    vHtml += '  <button type="button" class="btn-close px-3" data-bs-dismiss="modal" aria-label="Close"></button>';
    return vHtml;
  };

  phM.renderModalBodyForm = function () {
    let vHtml = '';
    for (var i = 0; i < phM.aFields.length; i++) {
      let oField = phM.aFields[i];
      vHtml += '  <div class="row">';
      switch (oField.component) {
        case PhFC_Text:
          vHtml += phM.renderInputText(oField);
          break;
        case PhFC_Select:
          vHtml += phM.renderSelect(oField);
          break;
        case PhFC_Number:
          vHtml += phM.renderInputNumber(oField);
          break;
        case PhFC_DatePicker:
          vHtml += phM.renderDatePicker(oField);
          break;
        case PhFC_Autocomplete:
          vHtml += phM.renderAutocomplete(oField);
          break;
        default:
          vHtml += phM.renderInputText(oField);
          break;
      }
      vHtml += '   </div>';
    }
    return vHtml;
  };

  phM.renderModalBodyTable = function () {
    let vHtml = '';
    vHtml += '<div id="' + phM.TableContainer + '">';
    vHtml += '  <div id="' + phM.Table + '">';
    vHtml += '  </div>';
    vHtml += '  <div id="' + phM.TablePager + '">';
    vHtml += '  </div>';
    vHtml += '</div>';
    return vHtml;
  };

  phM.renderModalFooter = function () {
    let vHtml = '';
    vHtml += ' <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-title="Cancel" title="Cancel"><i class="bi bi-x-lg"></i></button>';
    vHtml += phM.renderBtns(PhM_Btn_Footer);
    return vHtml;
  };

  phM.renderBtns = function (nPosition) {
    let vHtml = '';
    for (var i = 0; i < phM.aBtns.length; i++) {
      if (phM.aBtns[i].position === nPosition) {
        vHtml += '<button id="' + phM.ModalId + '-' + phM.aBtns[i].id + '" class="btn btn-' + phM.aBtns[i].color + ' toolbar-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-' + phM.aBtns[i].color + '-bg" data-bs-title="' + phM.aBtns[i].title + '" title="' + phM.aBtns[i].title + '">';
        vHtml += '  <i class="' + phM.aBtns[i].icon + '"></i>';
        vHtml += '</button>';
      }
    }
    return vHtml;
  };

  phM.render = function () {
    let vHtml = '';
    vHtml = phM.renderModal();
    $("body").append(vHtml);
    phM.bind();
    initPhTApp();
    phAutocomplete();
  };

  phM.jqReady = function () {
    $('.QFld').change(function (e) {
      e.preventDefault();
      phM.showSecondField($(this).attr('id'));
    });
  };

  phM.showSecondField = function (fldId) {
    if ($('#' + fldId).val() === '<>' || $('#' + fldId).val() === '><') {
      $('#' + fldId + '2').removeClass('d-none');
      $('#' + fldId + '3').removeClass('d-none');
      $('#' + fldId + '2').val('');
    } else {
      $('#' + fldId + '2').addClass('d-none');
      $('#' + fldId + '3').addClass('d-none');
      $('#' + fldId + '2').val('');
    }
  };

  phM.toogle = function () {
  };

  phM.openNew = function () {
    for (let index = 0; index < phM.aFields.length; index++) {
      if (phM.aFields[index].hasOwnProperty('options')) {
        $('#' + phM.aFields[index].element).val($('#' + phM.aFields[index].element + ' option:first').val());
      } else {
        $('#' + phM.aFields[index].element).val(phM.aFields[index].defValue);
      }
      if (phM.aFields[index].hasOwnProperty("rElement")) {
        $('#' + phM.aFields[index].rElement).val(phM.aFields[index].defValue);
      }
    }
    phM.$Modal.modal('show');
  };

  phM.renderTable = function () {
    let vHtml = '';
    if (true) {
    } else {
      phM.queryAlert();
    }
  };

  phM.renderTableHeader = function () {
    let vTableHead = '';
    return vTableHead;
  };

  phM.renderTableBody = function () {
    let vTableBady = '';
    return vTableBady;
  };

  phM.getData = function () {
    let aQData = [];
    return aQData;
  };

  phM.getMessage = function () {
    swal.fire({
      title: getLabel('Page NOT Found !!'),
      text: getLabel(''),
      icon: "error"
    });
    $('#pager-all').html();
  };

  phM.queryAlert = function () {
    let queryAlert = '';
    queryAlert = '<h4 class="text-center text-danger">' + getLabel('There are no results matching your search options') + '</h4>';
    return queryAlert;
  };

  phM.bind = function () {
    phM.$Modal = $('#' + phM.Modal);
    phM.$ModalBody = $('#' + phM.ModalBody);
    phM.$FormContainer = $('#' + phM.FormContainer);
    phM.$Form = $('#' + phM.Form);
    phM.$TableContainer = $('#' + phM.TableContainer);
    phM.$Table = $('#' + phM.Table);
    phM.$TablePager = $('#' + phM.TablePager);
  };

  phM.render();
  phM.jqReady();
};
