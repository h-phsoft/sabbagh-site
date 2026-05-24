/* global PhF_Query_2, PhF_Query_1, PhFC_CheckBox, PhFC_Radio */
let PhQForm = function (container, metta, options = {}) {
  let phF = this;
  phF.aQData = [];
  phF.aQueryData = [];
  phF.tablePageCount = 1;
  phF.tablePageCurrent = 1;
  phF.tableRowCount = 10;
  phF.tableRowDataCount = 0;
  phF.container = container;
  phF.aURL = metta.aURL;
  phF.URL = metta.aURL.Url + metta.aURL.Api;
  phF.aQryFlds = metta.QFields;
  //
  phF.version = '0.1.210602.1145';
  phF.defaultOptions = {
    mode: PhF_Mode_Query,
    cols: 2,
    btns: {
      "execute": "ph_execute",
      "reset": "ph_reset",
      "toggleCriteria": "ph_toggleCriteria",
      "tnext": "table-pager-next",
      "tlast": "table-pager-last",
      "tprevious": "table-pager-previous",
      "tfirst": "table-pager-first",
      "tcount": "table-pager-count"
    }
  };
  phF.options = $.extend(phF.defaultOptions, options);
  //
  phF.queryContainer = container + 'QueryContainer';
  phF.queryCritirya = container + 'QueryCritirya';
  phF.queryGrouping = container + 'QueryGrouping';
  phF.queryValues = container + 'QueryValues';
  phF.queryReportOptions = container + 'QueryReportOptions';
  phF.queryDisplayOptions = container + 'QueryDisplayOptions';
  phF.queryResult = container + 'QueryResult';
  phF.queryTable = container + 'QueryTable';
  phF.queryTableData = container + 'QueryTableData';

  phF.$queryContainer = $('#' + phF.queryContainer);
  phF.$queryCritirya = $('#' + phF.queryCritirya);
  phF.$queryGrouping = $('#' + phF.queryGrouping);
  phF.$queryValues = $('#' + phF.queryValues);
  phF.$queryReportOptions = $('#' + phF.queryReportOptions);
  phF.$queryDisplayOptions = $('#' + phF.queryDisplayOptions);
  phF.$queryResult = $('#' + phF.queryResult);
  phF.$queryTable = $('#' + phF.queryTable);
  phF.$queryTableData = $('#' + phF.queryTableData);

  phF.renderOperation = function (fld) {
    let vComponent = '';
    vComponent += '<select id="' + phF.container + 'QFld' + fld.field + '" class="form-control form-control-sm form-select QFld">';
    for (let i = 0; i < fld.aOpers.length; i++) {
      let oper = PhFOperations[fld.aOpers[i]];
      vComponent += '  <option value="' + oper.sign + '">' + oper.label + '</option>';
    }
    vComponent += '</select>';
    return vComponent;
  };

  phF.renderSelectGroups = function (i) {
    let vHtml = '';
    let vSelected = '';
    vHtml += '<select id="' + phF.container + 'QFld' + phF.options.grouping.groubName + '' + i + '" class="form-control form-control-sm form-select">';
    if (i > 0) {
      vHtml += '  <option value="-1">' + getLabel("None") + '</option>';
    }
    for (let index = 0; index < phF.options.grouping.groups.length; index++) {
      vSelected = '';
      if (phF.options.grouping.groupsSelected[i] !== undefined && phF.options.grouping.groupsSelected[i] === index) {
        vSelected = ' selected';
      }
      vHtml += '  <option value="' + phF.options.grouping.groups[index].value + '"' + vSelected + '>' + phF.options.grouping.groups[index].label + '</option>';
    }
    vHtml += '</select>';
    return vHtml;
  };

  phF.renderSelectValues = function (i) {
    let vHtml = '';
    let vSelected = '';
    vHtml += '<select id="' + phF.container + 'QFld' + phF.options.value.valueName + '' + i + '" class="form-control form-control-sm form-select">';
    if (i > 0) {
      vHtml += '  <option value="-1">' + getLabel("None") + '</option>';
    }
    for (let index = 0; index < phF.options.value.values.length; index++) {
      vSelected = '';
      if (phF.options.value.valueSelected[i] !== undefined && phF.options.value.valueSelected[i] === index) {
        vSelected = ' selected';
      }
      vHtml += '  <option value="' + phF.options.value.values[index].value + '"' + vSelected + '>' + phF.options.value.values[index].label + '</option>';
    }
    vHtml += '</select>';
    return vHtml;
  };

  phF.renderInputText = function (fld) {
    let vComponent = '';
    let vClass = '';
    vComponent += '<div class="row mb-1">';
    vComponent += '  <label for="' + phF.container + 'QFld' + fld.field + '" class="col-sm-2 col-form-label col-form-label-md text-center ph-label">' + fld.label + '</label>';
    vComponent += '  <div class="col-sm-3 px-0">';
    vComponent += phF.renderOperation(fld);
    vComponent += '  </div>';
    if (fld.aOpers.includes(PhFOper_BT) || fld.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phF.container + 'QFld' + fld.field).val() === '<>' || $('#' + phF.container + 'QFld' + fld.field).val() === '><') ? '' : 'd-none';
      vComponent += '  <div class="col-sm-3 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.field + '1" class="form-control form-control-sm" type="text" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
      vComponent += '  <div class="col-sm-3 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.field + '2" class="form-control form-control-sm ' + vClass + ' " type="text" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
    } else {
      vComponent += '  <div class="col-sm-6 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.field + '1" class="form-control form-control-sm" type="text" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
    }
    vComponent += '</div>';
    return vComponent;
  };

  phF.renderSelect = function (fld) {
    let vComponent = '';
    vComponent += '<div class="row mb-1">';
    vComponent += '  <label for="' + phF.container + 'QFld' + fld.field + '" class="col-sm-2 col-form-label col-form-label-md text-center ph-label">' + fld.label + '</label>';
    vComponent += '  <div class="col-sm-3 px-0">';
    vComponent += phF.renderOperation(fld);
    vComponent += '  </div>';
    vComponent += '  <div class="col-sm-6 px-0">';
    vComponent += '    <select id="' + phF.container + 'QFld' + fld.field + '1" class="form-control form-control-sm form-select">';
    vComponent += '      <option value="" ' + (fld.defValue === -1 ? 'selected' : '') + '></option>';
    for (let i = 0; i < fld.options.length; i++) {
      vComponent += '      <option value="' + fld.options[i].id + '" ' + (fld.defValue === fld.options[i].id ? 'selected' : '') + '>' + fld.options[i].name + '</option>';
    }
    vComponent += '    </select>';
    vComponent += '  </div>';
    vComponent += '</div>';
    return vComponent;
  };

  phF.renderInputNumber = function (fld) {
    let vComponent = '';
    let vClass = '';
    vComponent += '<div class="row mb-1">';
    vComponent += '  <label for="' + phF.container + 'QFld' + fld.field + '" class="col-sm-2 col-form-label col-form-label-md text-center ph-label">' + fld.label + '</label>';
    vComponent += '  <div class="col-sm-3 px-0">';
    vComponent += phF.renderOperation(fld);
    vComponent += '  </div>';
    if (fld.aOpers.includes(PhFOper_BT) || fld.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phF.container + 'QFld' + fld.field).val() === '<>' || $('#' + phF.container + 'QFld' + fld.field).val() === '><') ? '' : 'd-none';
      vComponent += '  <div class="col-sm-3 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.field + '1" class="form-control form-control-sm" type="number" min="' + fld.minValue + '" step="' + fld.step + '" max="' + fld.maxValue + '" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
      vComponent += '  <div class="col-sm-3 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.field + '2" class="form-control form-control-sm ' + vClass + '" type="number" min="' + fld.minValue + '" step="' + fld.step + '" max="' + fld.maxValue + '" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
    } else {
      vComponent += '  <div class="col-sm-6 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.field + '1" class="form-control form-control-sm" type="number" min="' + fld.minValue + '" step="' + fld.step + '" max="' + fld.maxValue + '" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
    }
    vComponent += '</div>';
    return vComponent;
  };

  phF.renderDatePicker = function (fld) {
    let vComponent = '';
    let vClass = '';
    vComponent += '<div class="row mb-1">';
    vComponent += '  <label for="' + phF.container + 'QFld' + fld.field + '" class="col-sm-2 col-form-label col-form-label-md text-center ph-label">' + fld.label + '</label>';
    vComponent += '  <div class="col-sm-3 px-0">';
    vComponent += phF.renderOperation(fld);
    vComponent += '  </div>';
    if (fld.aOpers.includes(PhFOper_BT) || fld.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phF.container + 'QFld' + fld.field).val() === '<>' || $('#' + phF.container + 'QFld' + fld.field).val() === '><') ? '' : 'd-none';
      vComponent += ' <div class="col-sm-3 px-0">';
      vComponent += '   <div class="input-group date">';
      vComponent += '     <input id="' + phF.container + 'QFld' + fld.field + '1" class="form-control form-control-sm ph_datepicker" type="text" value="' + fld.defValue + '" required="true" />';
      vComponent += '     <div class="input-group-append datepicker-btn">';
      vComponent += '       <span class="input-group-text">';
      vComponent += '         <i class="la la-calendar"></i>';
      vComponent += '       </span>';
      vComponent += '     </div>';
      vComponent += '   </div>';
      vComponent += ' </div>';
      vComponent += ' <div class="col-sm-3 px-0">';
      vComponent += '   <div class="input-group date">';
      vComponent += '     <input id="' + phF.container + 'QFld' + fld.field + '2" class="form-control form-control-sm ph_datepicker ' + vClass + '" type="text" value="' + fld.defValue + '" required="true" />';
      vComponent += '     <div class="input-group-append datepicker-btn ' + vClass + '">';
      vComponent += '       <span class="input-group-text">';
      vComponent += '         <i class="la la-calendar"></i>';
      vComponent += '       </span>';
      vComponent += '     </div>';
      vComponent += '   </div>';
      vComponent += ' </div>';
    } else {
      vComponent += ' <div class="col-sm-6 px-0">';
      vComponent += '   <div class="input-group date">';
      vComponent += '     <input id="' + phF.container + 'QFld' + fld.field + '1" class="form-control form-control-sm ph_datepicker" type="text" value="' + fld.defValue + '" required="true" />';
      vComponent += '     <div class="input-group-append datepicker-btn">';
      vComponent += '       <span class="input-group-text">';
      vComponent += '         <i class="la la-calendar"></i>';
      vComponent += '       </span>';
      vComponent += '     </div>';
      vComponent += '   </div>';
      vComponent += ' </div>';
    }
    vComponent += '</div>';
    return vComponent;
  };

  phF.renderAutocomplete = function (fld) {
    let vComponent = '';
    let vClass = '';
    vComponent += '<div class="row mb-1">';
    vComponent += '  <label for="' + phF.container + 'QFld' + fld.field + '" class="col-sm-2 col-form-label col-form-label-md text-center ph-label">' + fld.label + '</label>';
    vComponent += '  <div class="col-sm-3 px-0">';
    vComponent += phF.renderOperation(fld);
    vComponent += '  </div>';
    if (fld.aOpers.includes(PhFOper_BT) || fld.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phF.container + 'QFld' + fld.field).val() === '<>' || $('#' + phF.container + 'QFld' + fld.field).val() === '><') ? '' : 'd-none';
      vComponent += ' <div class="col-sm-3 px-0">';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.field + 'Id1" type="hidden" value=""/>';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.field + '1" class="form-control form-control-sm phAutocomplete" data-acrel="' + phF.container + 'QFld' + fld.field + 'Id1" data-acoperation="' + fld.autoCompleteApi + '" type="text" value=""/>';
      vComponent += ' </div>';
      vComponent += ' <div class="col-sm-3 px-0">';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.field + 'Id2" type="hidden" value=""/>';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.field + '2" class="form-control form-control-sm phAutocomplete ' + vClass + '" data-acrel="' + phF.container + 'QFld' + fld.field + 'Id2" data-acoperation="' + fld.autoCompleteApi + '" type="text" value=""/>';
      vComponent += ' </div>';
    } else {
      vComponent += ' <div class="col-sm-6 px-0">';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.field + 'Id1" type="hidden" value=""/>';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.field + '1" class="form-control form-control-sm phAutocomplete" data-acrel="' + phF.container + 'QFld' + fld.field + 'Id1" data-acoperation="' + fld.autoCompleteApi + '" type="text" value=""/>';
      vComponent += ' </div>';
    }
    vComponent += '</div>';
    return vComponent;
  };

  phF.renderQueryField = function () {
    let vHtml = '';
    vHtml = '<div class="card card-custom" id="' + phF.queryGrouping + '">';
    vHtml += ' <h3 class="card-title p-2  px-3 mb-0">' + getLabel("Filters") + ' <hr></h3>';
    vHtml += ' <div class="card-body pt-1">';
    for (let i = 0; i < phF.aQryFlds.length; i++) {
      let fld = phF.aQryFlds[i];
      switch (fld.component) {
        case PhFC_Text:
          vHtml += phF.renderInputText(fld);
          break;
        case PhFC_Select:
          vHtml += phF.renderSelect(fld);
          break;
        case PhFC_Number:
          vHtml += phF.renderInputNumber(fld);
          break;
        case PhFC_DatePicker:
          vHtml += phF.renderDatePicker(fld);
          break;
        case PhFC_Autocomplete:
          vHtml += phF.renderAutocomplete(fld);
          break;
        default:
          vHtml += phF.renderInputText(fld);
          break;
      }
    }
    vHtml += '</div>';
    vHtml += '</div>';
    return vHtml;
  };

  phF.renderQueryGroup = function () {
    let vHtml = '';
    let nLength = phF.options.grouping.groups.length;
    if (phF.options.grouping.groubNumber > 0) {
      nLength = phF.options.grouping.groubNumber;
    }
    vHtml += '<div  id="' + phF.queryGrouping + '" class="card card-custom card h-100">';
    vHtml += ' <h3 class="card-title p-2 px-3 mb-0">' + getLabel("Grouping") + ' <hr></h3>';
    vHtml += ' <div class="card-body pt-1">';
    for (let i = 0; i < nLength; i++) {
      vHtml += '  <div class="row mb-1">';
      vHtml += '   <label for="' + phF.container + 'QFld' + phF.options.grouping.groubName + '' + i + '" class="col-sm-4 col-form-label col-form-label-md text-center ph-label">' + getLabel('Group') + ' ' + parseInt(i + 1) + ' ' + getLabel('By') + '</label>';
      vHtml += '   <div class="col-sm-8">';
      vHtml += phF.renderSelectGroups(i);
      vHtml += '    </div>';
      vHtml += '  </div>';
    }
    ;
    vHtml += '  </div>';
    vHtml += '</div>';
    return vHtml;
  };

  phF.renderQueryValue = function () {
    let vHtml = '';
    let vChecked = '';
    vHtml += '<div id="' + phF.queryValues + '" class="card card-custom card h-100">';
    vHtml += ' <h3 class="card-title p-2 px-3 mb-0">' + getLabel("Values") + ' <hr></h3>';
    vHtml += ' <div class="card-body pt-1">';
    if (phF.options.value.valueType === PhFC_CheckBox) {
      for (let index = 0; index < phF.options.value.values.length; index++) {
        vChecked = '';
        if (phF.options.value.valueSelected[index] !== undefined && phF.options.value.valueSelected[index] === 1) {
          vChecked = ' checked';
        }
        vHtml += '<div class="row mb-1">';
        vHtml += '  <label for="' + phF.container + 'QFld' + phF.options.value.valueName + '' + index + '" class="col-sm-4 col-form-label col-form-label-md text-start ph-label">' + getLabel(phF.options.value.values[index].label) + '</label>';
        vHtml += '   <div class="col-sm-8">';
        vHtml += '     <label class="checkbox checkbox-success">';
        vHtml += '     <input id="' + phF.container + 'QFld' + phF.options.value.valueName + '' + index + '" type="checkbox" ' + vChecked + '>';
        vHtml += '     <span></span> </label>';
        vHtml += '  </div>';
        vHtml += '</div>';
      }
    } else if (phF.options.value.valueType === PhFC_Select) {
      let nLength = phF.options.value.values.length;
      if (phF.options.value.valueNumber > 0) {
        nLength = phF.options.value.valueNumber;
      }
      for (let index = 0; index < nLength; index++) {
        vHtml += '  <div class="row mb-1">';
        vHtml += '   <label for="' + phF.container + 'QFld' + phF.options.value.valueName + '' + index + '" class="col-sm-4 col-form-label col-form-label-md text-center ph-label">' + getLabel('Value') + ' ' + parseInt(index + 1) + '</label>';
        vHtml += '   <div class="col-sm-8">';
        vHtml += phF.renderSelectValues(index);
        vHtml += '    </div>';
        vHtml += '  </div>';
      }
      ;
    }
    vHtml += ' </div>';
    vHtml += '</div>';
    return vHtml;
  };

  phF.renderCheckBoxRepOption = function (fld) {
    let vHtml = '';
    let vChecked = '';
    for (let index = 0; index < fld.options.length; index++) {
      vChecked = '';
      if (fld.options[index].selected) {
        vChecked = ' checked';
      }
      vHtml += '<div class="row mb-1">';
      vHtml += '  <label for="' + phF.container + 'QFldRepO' + fld.options[index].field + '" class="col-sm-4 col-form-label col-form-label-md text-start ph-label">' + getLabel(fld.options[index].label) + '</label>';
      vHtml += '   <div class="col-sm-8">';
      vHtml += '     <label class="checkbox checkbox-success">';
      vHtml += '     <input id="' + phF.container + 'QFldRepO' + fld.options[index].field + '" type="checkbox" ' + vChecked + '>';
      vHtml += '     <span></span> </label>';
      vHtml += '  </div>';
      vHtml += '</div>';
    }
    return vHtml;
  };

  phF.renderSelectRepOption = function (fld) {
    let vHtml = '';
    let vSelected = '';
    vHtml += '<div class="row mb-1">';
    vHtml += '  <label for="' + phF.container + 'QFldRepO' + fld.field + '" class="col-sm-4 col-form-label col-form-label-md text-start ph-label">' + getLabel(fld.label) + '</label>';
    vHtml += '  <div class="col-sm-8">';
    vHtml += '    <select id="' + phF.container + 'QFldRepO' + fld.field + '" class="form-control form-control-sm form-select">';
    vHtml += '  <option value="-1">' + getLabel("None") + '</option>';
    for (let index = 0; index < fld.options.length; index++) {
      vSelected = '';
      if (fld.options[index].selected) {
        vSelected = ' selected';
      }
      vHtml += '  <option value="' + fld.options[index].value + '"' + vSelected + '>' + fld.options[index].label + '</option>';
    }
    vHtml += '    </select>';
    vHtml += '  </div>';
    vHtml += '</div>';
    return vHtml;
  };

  phF.renderRadioRepOption = function (fld) {
    let vHtml = '';
    let vChecked = '';
    for (let index = 0; index < fld.options.length; index++) {
      vChecked = '';
      if (fld.options[index].selected) {
        vChecked = ' checked';
      }
      vHtml += '<div class="row mb-1">';
      vHtml += '  <label for="' + phF.container + 'QFldRepO' + fld.options.field + index + 'index" class="col-sm-4 col-form-label col-form-label-md text-start ph-label">' + getLabel(fld.options[index].label) + '</label>';
      vHtml += '   <div class="col-sm-8">';
      vHtml += '     <label class="radio radio-warning">';
      vHtml += '     <input id="' + phF.container + 'QFldRepO' + fld.options.field + index + '" name="' + fld.options.field + '" type="radio" ' + vChecked + '>';
      vHtml += '     <span></span> </label>';
      vHtml += '  </div>';
      vHtml += '</div>';
    }
    return vHtml;
  };

  phF.renderQueryRepOptions = function () {
    let vHtml = '';
    vHtml += '<div  id="' + phF.queryReportOptions + '" class="card card-custom card h-100">';
    vHtml += ' <h3 class="card-title p-2 px-3 mb-0">' + getLabel("Report Option") + ' <hr></h3>';
    vHtml += ' <div class="card-body pt-1">';
    for (let index = 0; index < phF.options.reportOption.length; index++) {
      let fld = phF.options.reportOption[index];
      if (fld.type === PhFC_CheckBox) {
        vHtml += phF.renderCheckBoxRepOption(fld);
      } else if (fld.type === PhFC_Radio) {
        vHtml += phF.renderRadioRepOption(fld);
      } else if (fld.type === PhFC_Select) {
        vHtml += phF.renderSelectRepOption(fld);
      }
    }
    vHtml += '  </div>';
    vHtml += '</div>';
    return vHtml;
  };

  phF.renderQueryDisplayOptions = function () {
    let vHtml = '';
    vHtml += '<div  id="' + phF.queryDisplayOptions + '" class="card card-custom">';
    vHtml += ' <h3 class="card-title p-2 px-3 mb-0">' + getLabel("Display Option") + ' <hr></h3>';
    vHtml += ' <div class="card-body pt-1">';
    for (let index = 0; index < phF.options.displayOption.length; index++) {
      let fld = phF.options.displayOption[index];
      if (fld.type === PhFC_CheckBox) {
        vHtml += phF.renderCheckBoxRepOption(fld);
      } else if (fld.type === PhFC_Radio) {
        vHtml += phF.renderRadioRepOption(fld);
      } else if (fld.type === PhFC_Select) {
        vHtml += phF.renderSelectRepOption(fld);
      }
    }
    vHtml += '  </div>';
    vHtml += '</div>';
    return vHtml;
  };

  phF.render = function () {
    let vHtml = '';
    if (phF.options.type === PhF_Query_1) {
      vHtml += '<div class="row">';
      vHtml += '  <div class="col-sm-7">';
      vHtml += phF.renderQueryField();
      vHtml += '  </div>';
      if (phF.options.hasOwnProperty('grouping')) {
        vHtml += '  <div class="col-sm-5 px-0">';
        vHtml += phF.renderQueryGroup();
        vHtml += '  </div>';
      }
      ;
      vHtml += '</div>';
      if (phF.options.hasOwnProperty('value')) {
        vHtml += '<div class="row pt-1">';
        vHtml += '  <div class="col-sm-12 pr-0">';
        vHtml += phF.renderQueryValue();
        vHtml += '  </div>';
        vHtml += '</div>';
      }
      vHtml += '<div class="row pt-1">';
      if (phF.options.hasOwnProperty('reportOption')) {
        vHtml += '  <div class="col-sm-6 pr-0">';
        vHtml += phF.renderQueryRepOptions();
        vHtml += '  </div>';
      }
      if (phF.options.hasOwnProperty('displayOption')) {
        vHtml += '  <div class="col-sm-6 pr-0">';
        vHtml += phF.renderQueryDisplayOptions();
        vHtml += '  </div>';
      }
      vHtml += '</div>';
    } else if (phF.options.type === PhF_Query_2) {
      vHtml += '<div class="row pb-2">';
      vHtml += '  <div class="col-sm-12">';
      vHtml += phF.renderQueryField();
      vHtml += '  </div>';
      vHtml += ' </div>';
      vHtml += '<div class="row">';
      if (phF.options.hasOwnProperty('grouping')) {
        vHtml += '  <div class="col-sm-4">';
        vHtml += phF.renderQueryGroup();
        vHtml += '  </div>';
      }
      if (phF.options.hasOwnProperty('value')) {
        vHtml += '  <div class="col-sm-4">';
        vHtml += phF.renderQueryValue();
        vHtml += '  </div>';
      }
      if (phF.options.hasOwnProperty('reportOption')) {
        vHtml += '  <div class="col-sm-4">';
        vHtml += phF.renderQueryRepOptions();
        vHtml += '  </div>';
      }
      vHtml += '</div>';
      if (phF.options.hasOwnProperty('displayOption')) {
        vHtml += '<div class="row pt-2">';
        vHtml += '  <div class="col-sm-12">';
        vHtml += phF.renderQueryDisplayOptions();
        vHtml += '  </div>';
        vHtml += '</div>';
      }
    }
    phF.$queryContainer.html(vHtml);
  };

  phF.jqReady = function () {
    $("#" + phF.options.btns.execute).click(function (e) {
      e.preventDefault();
      phF.doSearch();
    });
    $("#" + phF.options.btns.reset).click(function (e) {
      e.preventDefault();
      phF.resetQuery();
      phF.toogle(PhF_Toogle_Query);
    });
    $("#" + phF.options.btns.toggleCriteria).click(function (e) {
      phF.toogle();
    });
    $("#" + phF.options.btns.tnext).click(function (e) {
      e.preventDefault();
      if (phF.tablePageCurrent < phF.tablePageCount) {
        phF.tablePageCurrent++;
        phF.doSearch();
      }
    });
    $("#" + phF.options.btns.tlast).click(function (e) {
      e.preventDefault();
      if (phF.tablePageCurrent !== phF.tablePageCount) {
        phF.tablePageCurrent = phF.tablePageCount;
        phF.doSearch();
      }
    });
    $("#" + phF.options.btns.tprevious).click(function (e) {
      e.preventDefault();
      if (phF.tablePageCurrent > 1) {
        phF.tablePageCurrent--;
        phF.doSearch();
      }
    });
    $("#" + phF.options.btns.tfirst).click(function (e) {
      e.preventDefault();
      if (phF.tablePageCurrent !== 1) {
        phF.tablePageCurrent = 1;
        phF.doSearch();
      }
    });
    $('#' + phF.options.btns.tcount).change(function (e) {
      e.preventDefault();
      phF.doSearch();
    });
    $('.QFld').change(function (e) {
      e.preventDefault();
      phF.showSecondField($(this).attr('id'));
    });
  };

  phF.showSecondField = function (fldId) {
    if ($('#' + fldId).val() === '<>' || $('#' + fldId).val() === '><') {
      $('#' + fldId + '2').removeClass('d-none');
      $('#' + fldId + '2').val('');
    } else {
      $('#' + fldId + '2').addClass('d-none');
      $('#' + fldId + '2').val('');
    }
  };

  phF.toogle = function () {
    $('#' + phF.options.btns.toggleCriteria).removeClass('btn-light-success');
    $('#' + phF.options.btns.toggleCriteria).removeClass('btn-light-danger');
    phF.$queryContainer.removeClass('d-block');
    phF.$queryContainer.removeClass('d-none');
    $('#' + phF.options.btns.reset).removeClass('d-none');
    toggleCriteria = !toggleCriteria;
    if (toggleCriteria) {
      $('#' + phF.options.btns.toggleCriteria).html('<i class="icon-2x la la-toggle-on"></i>');
      $('#' + phF.options.btns.toggleCriteria).addClass('btn-light-success');
      phF.$queryContainer.addClass('d-block');
      phF.$queryResult.addClass('d-none');
    } else {
      $('#' + phF.options.btns.toggleCriteria).html('<i class="icon-2x la la-toggle-off"></i>');
      $('#' + phF.options.btns.toggleCriteria).addClass('btn-light-danger');
      phF.$queryContainer.addClass('d-none');
      phF.$queryResult.removeClass('d-none');
    }
  };

  phF.resetQuery = function () {
    for (let index = 0; index < phF.aQryFlds.length; index++) {
      $('#' + phF.container + 'QFld' + phF.aQryFlds[index].field).val($('#' + phF.container + 'QFld' + phF.aQryFlds[index].field + ' :first').val());
      phF.showSecondField(phF.container + 'QFld' + phF.aQryFlds[index].field);
      $('#' + phF.container + 'QFld' + phF.aQryFlds[index].field + '1').val(phF.aQryFlds[index].defValue);
    }
    phF.toogle(PhF_Toogle_Query);
  };

  phF.renderTableQuery = function () {
    let vHtml = '';
    vHtml += '<table id="' + phF.queryTableData + '" class="table table-bordered table-striped table-details">';
    vHtml += '  <thead>';
    vHtml += phF.renderTableHeader();
    vHtml += '  </thead>';
    vHtml += '  <tbody>';
    vHtml += phF.renderTableBody();
    vHtml += '  </tbody>';
    vHtml += '</table>';
    phF.$queryTable.html(vHtml);
    phF.tablePageCount = Math.ceil(phF.tableRowDataCount / phF.tableRowCount);
    $("#table-pager-all").html(phF.tablePageCount);
    $("#table-pager-current").html(phF.tablePageCurrent);
    $("#table-pager-dep").html('Total  Records ' + phF.tableRowDataCount);
  };

  phF.renderTableHeader = function () {
    let vTableHead = '';
    vTableHead += '<tr>';
    vTableHead += ' <td style="width: 4%;">#</td>';
    vTableHead += ' <td style="width: 4%;"></td>';
    let width = parseInt(90 / phF.aQryFlds.length);
    for (let index = 1; index < phF.aQryFlds.length; index++) {
      vTableHead += ' <td style="width:' + width + '%;">' + phF.aQryFlds[index].label + '</td>';
    }
    vTableHead += '</tr>';
    return vTableHead;
  };

  phF.renderTableBody = function () {
    let vTableBady = '';
    for (let index = 0; index < phF.aQueryData.length; index++) {
      vTableBady += '<tr>';
      vTableBady += ' <td style="width: 4%;">' + parseInt(index + 1) + '</td>';
      vTableBady += ' <td style="width: 4%;">';
      vTableBady += '   <a href="javascript:;" class="btn btn-light-primary p-1 edit-item" data-id="' + phF.aQueryData[index].id + '" data-index="' + index + '">';
      vTableBady += '    <i class="icon-x flaticon-edit"></i>';
      vTableBady += '   </a>';
      vTableBady += ' </td>';
      let width = parseInt(92 / phF.aQryFlds.length);
      for (let i = 0; i < phF.aQryFlds.length; i++) {
        if (phF.aQueryData[index].hasOwnProperty(phF.aQryFlds[i].dbName) && phF.aQryFlds[i].dbName !== 'id') {
          vTableBady += ' <td style="width: ' + width + '%;">' + phF.aQueryData[index][phF.aQryFlds[i].dbName] + '</td>';
        }
      }
      ;
      vTableBady += '</tr>';
    }
    return vTableBady;
  };

  phF.doSearch = function () {
    phF.tableRowCount = $('#table-pager-count').val();
    let method = phF.aURL.Search.Method;
    let url = phF.URL + phF.aURL.Search.URL + '?page=' + phF.tablePageCurrent + '&' + 'size=' + phF.tableRowCount;
    $.ajax({
      type: method,
      url: url,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': PhSettings.Headers.Authorization
      },
      data: JSON.stringify(
              phF.aQData = phF.getQueryData()
              ),
      success: function (response) {
        if (response.status) {
          phF.aQueryData = response.data.list;
          phF.tableRowDataCount = response.data.count;
          phF.toogle(PhF_Toogle_Execute);
          phF.renderTableQuery();
        } else {
          phF.$queryTable.html(getLabel("Result not found"));
          phF.toogle(PhF_Toogle_Execute);
        }
        ;
      },
      error: function (response) {
      }
    });
  };

  phF.getQueryData = function () {
    phF.aQData = [];
    let idx = 0;
    for (let index = 0; index < phF.aQryFlds.length; index++) {
      let fld = phF.aQryFlds[index];
      let fldId = phF.container + 'QFld' + fld.field;
      if ($("#" + fldId + '1').val() !== '' && $("#" + fldId + '1').val() !== null) {
        phF.aQData[idx] = {};
        phF.aQData[idx].fieldName = fld.dbName;
        phF.aQData[idx].operation = $("#" + fldId).val();
        phF.aQData[idx].value1 = $("#" + fldId + '1').val();
        phF.aQData[idx].value2 = '';
        if (($("#" + fldId).val() === '<>' ||
                $("#" + fldId).val() === '><') &&
                ($("#" + fldId + '2').val() !== '' && $("#" + fldId + '2').val() !== null)) {
          phF.aQData[idx].value2 = $("#" + fldId + '2').val();
        }
        idx++;
      }
    }
    return phF.aQData;
  };

  phF.render();

  phF.jqReady();

};