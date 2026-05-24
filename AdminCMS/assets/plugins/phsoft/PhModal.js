let PhModal = function (id, tittle, metta, options = {}) {
  let phM = this;
  phM.ModalId = id;
  phM.ModalTittle = tittle;
  phM.aURL = metta.aURL;
  phM.aFields = metta.aFields;
  phM.aBtns = metta.aBtns;
  phM.defaultOptions = {
  };
  phM.aOptions = $.extend(phM.defaultOptions, options);

  phM.Modal = phM.ModalId + '-Modal';
  phM.ModalBody = phM.ModalId + '-ModalBody';
  phM.Form = phM.ModalId + '-Form';

  phM.$Modal = $('#' + phM.Modal);
  phM.$ModalBody = $('#' + phM.ModalBody);
  phM.$Form = $('#' + phM.Form);

  phM.renderInputText = function (oField) {
    let vComponent = '';
    vComponent += '<label for="" class="col-sm-' + oField.colLabel + ' form-label ph-label text-start text-sm-end">' + getLabel(oField.label) + '</label>';
    vComponent += '  <div class="col-sm-' + oField.colElement + '">';
    vComponent += '    <input id="' + phM.ModalId + oField.element + '" class="form-control form-control-sm" type="text" value="' + oField.defValue + '" autocomplete="off" />';
    vComponent += '  </div>';
    return vComponent;
  };

  phM.renderSelect = function (oField) {
    let vComponent = '';
    vComponent += '<label for="" class="col-sm-' + oField.colLabel + ' form-label ph-label text-start text-sm-end">' + getLabel(oField.label) + '</label>';
    vComponent += '<div class="col-sm-' + oField.colElement + '">';
    vComponent += '  <select id="' + phM.ModalId + oField.element + '" class="form-select form-select-sm">';
    for (let i = 0; i < oField.options.length; i++) {
      vComponent += '  <option value="' + oField.options[i].id + '" ' + (oField.defValue === oField.options[i].id ? 'selected' : '') + '>' + oField.options[i].name + '</option>';
    }
    vComponent += '  </select>';
    vComponent += '</div>';
    return vComponent;
  };

  phM.renderInputNumber = function (oField) {
    let vComponent = '';
    vComponent += '<label for="" class="col-sm-' + oField.colLabel + ' form-label ph-label text-start text-sm-end">' + getLabel(oField.label) + '</label>';
    vComponent += '<div class="col-sm-' + oField.colElement + '">';
    vComponent += '  <input id="' + phM.ModalId + oField.ModalId + '" class="form-control form-control-sm" type="number" min="' + oField.minValue + '" step="' + oField.step + '" max="' + oField.maxValue + '" value="' + oField.defValue + '" autocomplete="off" />';
    vComponent += '</div>';
    return vComponent;
  };

  phM.renderDatePicker = function (oField) {
    let vComponent = '';
    vComponent += '<label for="" class="col-sm-' + oField.colLabel + ' form-label ph-label text-start text-sm-end">' + getLabel(oField.label) + '</label>';
    vComponent += ' <div class="col-sm-' + oField.colElement + '">';
    vComponent += '   <div class="input-group date">';
    vComponent += '     <input id="' + phM.ModalId + oField.element + '" class="form-control form-control-sm ph_datepicker" type="text" value="' + oField.defValue + '" required="true" />';
    vComponent += '     <div class="input-group-append input-group-sm datepicker-btn">';
    vComponent += '       <span class="input-group-text">';
    vComponent += '         <i class="la la-calendar"></i>';
    vComponent += '       </span>';
    vComponent += '     </div>';
    vComponent += '   </div>';
    vComponent += ' </div>';
    return vComponent;
  };

  phM.renderAutocomplete = function (oField) {
    let vComponent = '';
    vComponent += '<label for="" class="col-sm-' + oField.colLabel + ' form-label ph-label text-start text-sm-end">' + getLabel(oField.label) + '</label>';
    vComponent += ' <div class="col-sm-' + oField.colElement + '">';
    vComponent += '   <input id="' + phM.ModalId + oField.element + 'Id" type="hidden" value=""/>';
    vComponent += '   <input id="' + phM.ModalId + oField.element + '" class="form-control form-control-sm phAutocomplete" data-acrel="' + phM.ModalId + oField.element + 'Id" data-acoperation="' + oField.autoCompleteApi + '" type="text" value=""/>';
    vComponent += ' </div>';
    return vComponent;
  };

  phM.renderModal = function () {
    let vHtml = '';
    vHtml += '<div class="modal fade" id="' + phM.Modal + '" tabindex="-1" aria-labelledby="ph-ModalLabel" aria-hidden="true">';
    vHtml += '  <div class="modal-dialog modal-lg">';
    vHtml += '    <div class="modal-content">';
    vHtml += '      <div class="modal-header p-1 m-1">';
    vHtml += '        <h1 class="modal-title fs-5 px-2" id="ph-ModalLabel">' + phM.ModalTittle + '</h1>';
    vHtml += '        <button type="button" class="btn-close px-3" data-bs-dismiss="modal" aria-label="Close"></button>';
    vHtml += '      </div>';
    vHtml += '      <div class="modal-body">';
    vHtml += phM.renderModalBodyForm();
    vHtml += '      </div>';
    vHtml += '      <div class="modal-footer p-1 m-1">';
    vHtml += phM.renderModalFooter();
    vHtml += '      </div>';
    vHtml += '    </div>';
    vHtml += '  </div>';
    vHtml += '</div>';
    return vHtml;
  };

  phM.renderModalBodyForm = function () {
    let vHtml = '';
    let nRow = 0;
    let closeDiv = true;
    vHtml += '<form id="' + phM.Form + '">';
    vHtml += '  <div class="row">';
    for (var i = 0; i < phM.aFields.length; i++) {
      let oField = phM.aFields[i];
      nRow += oField.colLabel + oField.colElement;
      closeDiv = false;
      if (nRow >= 12) {
        vHtml += '<div class="row">';
        closeDiv = true;
        nRow = 0;
      }
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
      if (closeDiv) {
        vHtml += '</div>';
        closeDiv = false;
      }
    }
    vHtml += '  </div>';
    vHtml += '</form>';
    return vHtml;
  };

  phM.renderModalFooter = function () {
    let vHtml = '';
    vHtml += '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-title="Cancel" title="Cancel"><i class="bi bi-x-lg"></i></button>';
    vHtml += '<button id="ph-dSubmit" class="btn btn-info toolbar-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-primary-bg" data-bs-title="Add" title="Add"><i class="bi bi-check-lg"></i></button>';
    return vHtml;
  };

  phM.render = function () {
    let vHtml = '';
    vHtml = phM.renderModal();
    $("body").append(vHtml);
    initPhTApp();
    phAutocomplete();
  };

  phM.jqReady = function () {
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
  $('#ph-DModal').modal('show');
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

  phM.render();
  phM.jqReady();
};
