/* global Intl, KTUtil, swal */

// Initializing a class definition
let IdGenerator = function () {
  let nLastId = (Math.floor(Math.random() * 999) + 100) + Date.now();
  this.genId = function () {
    return nLastId++;
  };
};
let IdGen = new IdGenerator();

let PhTable_ORDER_WIDTH = '31px';
//
let PhTable_SUM = 'sum';
let PhTable_MIN = 'min';
let PhTable_MAX = 'max';
let PhTable_AVG = 'avg';
let PhTable_COUNT = 'count';
//
let PhTable_WIDTH_FIXED = 0;
let PhTable_WIDTH_VARIABLE = 1;
//
let PhTable_HEIGHT_UNIT = 'vh';
let PhTable_HEIGHT = '30';
let PhTable_MAX_HEIGHT = '30';
//
let PhTable = function (vContainer, aCols, aData, options = {}) {
  let phT = this;
  phT.vContainer = vContainer;
  phT.aCols = aCols;
  phT.aData = aData;
  phT.options = options;
  //
  phT.id = vContainer + '-PhTable'; //IdGen.genId();
  phT.version = '0.3.230321.1212';
  phT.defaultOptions = {
    widthType: PhTable_WIDTH_VARIABLE,
    nRowWidth: 0,
    heightUnit: PhTable_HEIGHT_UNIT,
    height: PhTable_HEIGHT,
    maxHeight: PhTable_MAX_HEIGHT,
    addRowBtn: true,
  };
  phT.options = $.extend(phT.defaultOptions, phT.options);
  phT.tableHeaderId = 'phTableHeader-' + phT.id;
  phT.tableBodyId = 'phTableBody-' + phT.id;
  phT.tableFooterId = 'phTableFooter-' + phT.id;
  phT.$container = $('#' + vContainer);
  phT.aOriginalData = aData;
  phT.nTabIndex = 0;
  phT.nRows = 0;
  phT.aRows = [];
  phT.$container.css('width', '100%');
  phT.$container.css('overflow-x', 'auto');
  phT.aColumns = [];
  for (let nColumn = 0; nColumn < phT.aCols.length; nColumn++) {
    phT.aColumns[nColumn] = Object.assign(
            {title: '',
              field: '',
              width: '',
              datatype: 'string',
              visible: true,
              aggregate: '',
              component: 'display',
              componentAttr: {},
              componentType: 'text',
              enabled: true,
              required: false,
              ajax: false,
              ajaxType: 'POST',
              async: false,
              ajaxURL: '',
              ajaxData: {},
              options: [],
              callback: '',
              format: '',
              classes: '',
              attr: '',
              action: '',
              defValue: '',
              defLabel: '',
              isSent: true
            }, phT.aCols[nColumn]);
  }

  phT.unbindCallback = function () {
    for (let nColNum = 0; nColNum < phT.aColumns.length; nColNum++) {
      if (phT.aColumns[nColNum].hasOwnProperty('callback') && phT.aColumns[nColNum].callback !== '' && phT.aColumns[nColNum].field !== '') {
        if (typeof phT.aColumns[nColNum].callback.callback === "function") {
          $('.' + phT.aColumns[nColNum].field).unbind(phT.aColumns[nColNum].callback.event);
        }
      }
    }
  };

  phT.initCallback = function () {
    for (let nColNum = 0; nColNum < phT.aColumns.length; nColNum++) {
      if (phT.aColumns[nColNum].hasOwnProperty('callback') && phT.aColumns[nColNum].callback !== '' && phT.aColumns[nColNum].field !== '') {
        if (typeof phT.aColumns[nColNum].callback.callback === "function") {
          let callback = phT.aColumns[nColNum].callback.callback;
          $('.' + phT.aColumns[nColNum].field)
                  .on(phT.aColumns[nColNum].callback.event, callback);
        }
      }
    }
    $('.phcell').off('keypress').on('keypress', function (e) {
      let keyCode = e.keyCode || e.which;
      if (keyCode === 13) {
        e.preventDefault();
      }
    });
  };

  phT.initAutocomplete0 = function () {
    $(".ph-autocomplete").autocomplete({
      source: function (request, response) {
        let nCol = parseInt($(this).data('col'));
        let oCol = Object.assign({}, phT.aColumns[nCol]);
        let oAjaxData = '';
        if (oCol.hasOwnProperty('ajax') && oCol.ajax === true) {
          if (typeof oCol.ajaxData === "function") {
            oAjaxData = JSON.parse(JSON.stringify(oCol.ajaxData()));
          } else {
            oAjaxData = JSON.parse(JSON.stringify(oCol.ajaxData));
          }
          oAjaxData.term = request.term;
          $.ajax({
            type: oCol.ajaxType,
            async: oCol.ajaxAsync,
            url: oCol.ajaxURL,
            data: oAjaxData,
            success: function (ajaxResponse) {
              response(ajaxResponse.Data);
            }
          });
        } else {
          response(oCol.options);
        }
      },
      minLength: 0,
      focus: function (event, ui) {
        return false;
      },
      select: function (event, ui) {
        $(this).val(ui.item.label);
        let vField = $(this).data('field');
        let nRow = $(this).data('row');
        let nCol = $(this).data('col');
        if (vField !== undefined) {
          phT.aRows[nRow].fields[vField].value = ui.item.value;
          phT.aRows[nRow].fields[vField].label = ui.item.label;
          phT.aRows[nRow].fields[vField].isChanged = true;
        }
        return false;
      }
    });
  };

  phT.initAutocomplete = function () {
    let aData = [];
    for (let nColNum = 0; nColNum < phT.aColumns.length; nColNum++) {
      if (phT.aColumns[nColNum].hasOwnProperty('autocomplete') && phT.aColumns[nColNum].autocomplete === true && phT.aColumns[nColNum].field !== '') {
        if (phT.aColumns[nColNum].hasOwnProperty('ajax') && phT.aColumns[nColNum].ajax === true) {
          $(".ph-ac-" + phT.aColumns[nColNum].field).autocomplete({
            source: function (request, response) {
              let autoCompleteSelectorId = this.element[0].id;
              let nCol = $('#' + autoCompleteSelectorId).data('col');
              let oColumn = Object.assign({}, phT.aColumns[nCol]);
              let oAjaxData = {};
              if (typeof oColumn.ajaxData === "function") {
                oAjaxData = oColumn.ajaxData();
              } else {
                oAjaxData = oColumn.ajaxData;
              }
              oAjaxData.term = request.term;
              oColumn.ajaxData.term = request.term;
              $.ajax({
                type: oColumn.ajaxType,
                async: oColumn.ajaxAsync,
                url: oColumn.ajaxURL,
                headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json',
                  'Authorization': PhSettings.Headers.Authorization
                },
                data: JSON.stringify(oAjaxData), //oColumn.ajaxData,
                success: function (ajaxResponse) {
                  response(ajaxResponse.data.List);
                }
              });
            },
            minLength: 0,
            focus: function (event, ui) {
              return false;
            },
            select: function (event, ui) {
              $(this).val(ui.item.label);
              let vField = $(this).data('field');
              let nRow = $(this).data('row');
              let nCol = $(this).data('col');
              if (vField !== undefined) {
                phT.aRows[nRow].fields[vField].value = ui.item.value;
                phT.aRows[nRow].fields[vField].label = ui.item.label;
                phT.aRows[nRow].fields[vField].isChanged = true;
              }
              return false;
            }
          });
        } else {
          if (phT.aColumns[nColNum].hasOwnProperty('options') && phT.aColumns[nColNum].options !== '') {
            let oColumn = JSON.parse(JSON.stringify(phT.aColumns[nColNum]));
            $(".ph-ac-" + phT.aColumns[nColNum].field).autocomplete({
              source: oColumn.options,
              minLength: 0,
              focus: function (event, ui) {
                return false;
              },
              select: function (event, ui) {
                $(this).val(ui.item.label);
                let vField = $(this).data('field');
                let nRow = $(this).data('row');
                let nCol = $(this).data('col');
                if (vField !== undefined) {
                  phT.aRows[nRow].fields[vField].value = ui.List.value;
                  phT.aRows[nRow].fields[vField].label = ui.List.label;
                  phT.aRows[nRow].fields[vField].isChanged = true;
                }
                return false;
              }
            });
          }
        }
      }
    }
  };

  phT.setWidthType = function (nType = PhTable_WIDTH_VARIABLE) {
    phT.options.widthType = nType;
    phT.render();
  };

  phT.setHeight = function (nHeight) {
    phT.options.height = nHeight;
    phT.options.maxHeight = nHeight;
    phT.render();
  };

  phT.enableField = function (nRow, vField) {
    phT.aRows[nRow].fields[vField].enabled = true;
    phT.renderRow(nRow);
  };

  phT.disableField = function (nRow, vField) {
    phT.aRows[nRow].fields[vField].enabled = false;
    phT.renderRow(nRow);
  };

  phT.getField = function (nRow, vField) {
    let fld = '';
    if (phT.aRows[nRow].fields.hasOwnProperty(vField)) {
      fld = phT.aRows[nRow].fields[vField];
    }
    return fld;
  };

  phT.getFieldValue = function (nRow, vField) {
    let value = '';
    if (phT.aRows[nRow].fields.hasOwnProperty(vField)) {
      value = phT.aRows[nRow].fields[vField].value;
    }
    return value;
  };

  phT.setFieldValue = function (nRow, vField, vValue) {
    phT.aRows[nRow].fields[vField].value = vValue;
    phT.aRows[nRow].fields[vField].isChanged = true;
    phT.refreshRow(nRow);
  };

  phT.setFieldValueLabel = function (nRow, vField, vValue, vLabel) {
    phT.aRows[nRow].fields[vField].value = vValue;
    phT.aRows[nRow].fields[vField].label = vLabel;
    phT.aRows[nRow].fields[vField].isChanged = true;
    phT.refreshRow(nRow);
  };

  phT.addClass = function (nRow, nCol, vClass) {
    $('#' + phT.id + '-' + nRow + '-' + nCol).addClass(vClass);
  };

  phT.removeClass = function (nRow, nCol, vClass) {
    $('#' + phT.id + '-' + nRow + '-' + nCol).removeClass(vClass);
  };

  phT.getSum = function (field) {
    let nRet = 0;
    for (let nRowNum = 0; nRowNum < phT.aRows.length; nRowNum++) {
      try {
        nRet += Number(phT.aRows[nRowNum].fields[field].value);
      } catch (e) {

      }
    }
    return nRet;
  };

  phT.getMax = function (field) {
    let nRet = 0;
    for (let nRowNum = 0; nRowNum < phT.aRows.length; nRowNum++) {
      try {
        nRet = Math.max(nRet, Number(phT.aRows[nRowNum].fields[field].value));
      } catch (e) {

      }
    }
    return nRet;
  };

  phT.getMin = function (field) {
    let nRet = 0;
    for (let nRowNum = 0; nRowNum < phT.aRows.length; nRowNum++) {
      try {
        nRet = Math.min(nRet, Number(phT.aRows[nRowNum].fields[field].value));
      } catch (e) {

      }
    }
    return nRet;
  };

  phT.getAvg = function (field) {
    let nRet = 0;
    if (phT.aOriginalData.length > 0) {
      for (let nRowNum = 0; nRowNum < phT.aRows.length; nRowNum++) {
        try {
          nRet += Number(phT.aRows[nRowNum].fields[field].value);
        } catch (e) {

        }
      }
      nRet = nRet / phT.aOriginalData.length;
    }
    return nRet;
  };

  phT.getCount = function (field) {
    let nRet = 0;
    for (let nRowNum = 0; nRowNum < phT.aRows.length; nRowNum++) {
      try {
        if (!(phT.aRows[nRowNum].fields[field].value === '')) {
          nRet++;
        }
      } catch (e) {

      }
    }
    return nRet;
  };

  phT.getColumnByField = function (field) {
    let column = {};
    for (let nColNum = 0; nColNum < phT.aColumns.length; nColNum++) {
      if (field === phT.aColumns[nColNum].field) {
        column = phT.aColumns[nColNum];
      }
    }
    return column;
  };

  phT.setData = function (aData) {
    phT.aOriginalData = aData;
    phT.initRows();
    phT.render();
  };

  phT.getData = function () {
    return phT.aRows;
  };

  phT.getDeleted = function () {
    let aDeleted = [];
    let nIdx = 0;
    for (var i = 0; i < phT.aRows.length; i++) {
      let row = phT.aRows[i];
      if (row.isDeleted) {
        if (row.fields.hasOwnProperty('id')) {
          aDeleted[nIdx] = row.fields['id'].value;
          nIdx++;
        }
      }
    }
    return aDeleted;
  };

  phT.getRows = function () {
    let aRetRows = [];
    let nIdx = 0;
    for (var i = 0; i < phT.aRows.length; i++) {
      let row = phT.aRows[i];
      if (!row.isDeleted) {
        aRetRows[nIdx] = {};
        for (var j = 0; j < phT.aColumns.length; j++) {
          let col = phT.aColumns[j];
          if (col.hasOwnProperty('isSent') && col.isSent) {
            if (row.fields.hasOwnProperty(col.field)) {
              aRetRows[nIdx][col.field] = row.fields[col.field].value;
            }
          }
        }
        nIdx++;
      }
    }
    return aRetRows;
  };

  phT.initRows = function () {
    let oColumn = {};
    let bEnabled = true;
    let vLabel = '';
    let vValue = '';
    phT.nRows = 0;
    phT.aRows = [];
    if (phT.aOriginalData.length > 0) {
      for (let nRowNum = 0; nRowNum < phT.aOriginalData.length; nRowNum++) {
        phT.aRows[nRowNum] = {
          isNew: false,
          isDeleted: false,
          fields: {}
        };
        for (const [key, value] of Object.entries(phT.aOriginalData[nRowNum])) {
          bEnabled = true;
          vValue = value;
          vLabel = value;
          if (vLabel === null || vLabel === 'null') {
            vLabel = '';
            vValue = '';
          }
          if (phT.aOriginalData[nRowNum][key] !== null) {
            if (phT.aOriginalData[nRowNum][key].hasOwnProperty('enabled')) {
              if (typeof phT.aOriginalData[nRowNum][key].enabled === "function") {
                bEnabled = phT.aOriginalData[nRowNum][key].enabled(nRowNum);
              } else {
                bEnabled = phT.aOriginalData[nRowNum][key].enabled;
              }
            }
            if (phT.aOriginalData[nRowNum][key].hasOwnProperty('label')) {
              vLabel = phT.aOriginalData[nRowNum][key].label;
            }
          }
          oColumn = phT.getColumnByField(key);
          if (oColumn.hasOwnProperty('rfield')) {
            if (phT.aOriginalData[nRowNum][oColumn.rfield] !== '') {
              vLabel = phT.aOriginalData[nRowNum][oColumn.rfield];
            }
          }
          phT.aRows[nRowNum].fields[key] = {
            field: key,
            origin: vValue,
            value: vValue,
            label: vLabel,
            enabled: bEnabled,
            isChanged: false
          };
        }
        phT.nRows++;
      }
    }
  };

  phT.addEmptyRow = function () {
    let field = '';
    let vValue = '';
    let vLabel = '';
    let bEnabled = true;
    phT.aRows[phT.nRows] = {
      isNew: true,
      isDeleted: false,
      fields: {}
    };
    for (let nColNum = 0; nColNum < phT.aColumns.length; nColNum++) {
      bEnabled = true;
      field = phT.aColumns[nColNum].field;
      vValue = '';
      vLabel = '';
      if (phT.aColumns[nColNum].hasOwnProperty('defValue') && phT.aColumns[nColNum].defValue !== '') {
        vValue = phT.aColumns[nColNum].defValue;
        bEnabled = phT.aColumns[nColNum].enabled;
        if (typeof phT.aColumns[nColNum].enabled === "function") {
          bEnabled = phT.aColumns[nColNum].enabled(-1);
        } else {
          bEnabled = phT.aColumns[nColNum].enabled;
        }
      }
      if (phT.aColumns[nColNum].hasOwnProperty('defLabel') && phT.aColumns[nColNum].defLabel !== '') {
        vLabel = phT.aColumns[nColNum].defLabel;
      }
      phT.aRows[phT.nRows].fields[field] = {
        field: phT.aColumns[nColNum].field,
        origin: vValue,
        enabled: bEnabled,
        value: vValue,
        label: vLabel,
        isChanged: false
      };
    }
    phT.nRows++;
  };

  phT.deleteRow = function (nRowNum) {
    if (phT.aRows[nRowNum] !== undefined) {
      if (phT.aRows[nRowNum].isNew) {
        phT.aRows.splice(nRowNum, 1);
        phT.nRows--;
      } else {
        phT.aRows[nRowNum].isDeleted = true;
      }
      phT.render();
    }
  };

  phT.getRow = function (nRowNum) {
    if (phT.aRows[nRowNum] !== undefined) {
      return phT.aRows[nRowNum];
    }
  };

  phT.getRowCount = function () {
    return phT.aRows.length;
  };

  phT.getRowNum = function (vField, nValue) {
    let nRow = 0;
    for (let nRowNum = 0; nRowNum < phT.nRows; nRowNum++) {
      let value = phT.getFieldValue(nRowNum, vField);
      if (value == nValue) {
        nRow = nRowNum;
        break;
      }
    }
    return nRow;
  };

  phT.renderDisplay = function (cell, nRowNum, nColNum, vValue) {
    let typeId = phT.id + '-' + nRowNum + '-' + nColNum;
    let vComponent = '';
    let vClasses = '';
    let vAttr = '';
    if (cell.hasOwnProperty('attr') && cell.required !== '') {
      vAttr += ' ' + cell.attr;
    }
    if (cell.hasOwnProperty('classes') && cell.classes !== '') {
      vClasses = cell.classes;
    }
    vComponent = '<span class="form-control form-control-sm ' + vClasses + ' ' + cell.field + ' cell-' + phT.id + ' col-' + phT.id + '-' + nColNum + '" id="' + typeId + '" ' + vAttr + ' data-field="' + cell.field + '" data-tid="' + phT.id + '" data-row="' + nRowNum + '" data-col="' + nColNum + '">' + vValue + '</span>';
    return vComponent;
  };

  phT.renderImage = function (cell, nRowNum, nColNum, vValue, bEnabled) {
    //let typeId = cell.field + '-' + phT.id + '-' + nRowNum;
    let typeId = phT.id + '-' + nRowNum + '-' + nColNum;
    let vComponent = '';
    let vComponentAttr = '';
    let vClasses = '';
    let vAttr = '';
    if (cell.hasOwnProperty('attr') && cell.required !== '') {
      vAttr += ' ' + cell.attr;
    }
    if (cell.hasOwnProperty('classes') && cell.classes !== '') {
      vClasses = cell.classes;
    }
    if (cell.hasOwnProperty('componentAttr')) {
      if (cell.componentAttr.hasOwnProperty('width')) {
        vComponentAttr += ' width="' + cell.componentAttr.width + '"';
      }
      if (cell.componentAttr.hasOwnProperty('height')) {
        vComponentAttr += ' height="' + cell.componentAttr.height + '"';
      }
    }
    vComponent = '<img src="' + vValue + '" ' + vComponentAttr + ' class="' + vClasses + ' ' + cell.field + ' cell-' + phT.id + ' col-' + phT.id + '-' + nColNum + '" id="' + typeId + '" ' + vAttr + ' data-field="' + cell.field + '" data-tid="' + phT.id + '" data-row="' + nRowNum + '" data-col="' + nColNum + '"/>';
    return vComponent;
  };

  phT.renderInput = function (cell, nRowNum, nColNum, vCurrValue, vCurrLabel, bEnabled) {
    //let typeId = cell.field + '-' + phT.id + '-' + nRowNum;
    let typeId = phT.id + '-' + nRowNum + '-' + nColNum;
    let nextId = phT.id + '-' + nRowNum + '-' + cell.next;
    let vComponent = '';
    let vClasses = '';
    let vAttr = ' tabindex="' + phT.nTabIndex + '"';
    if (parseInt(cell.next) === 0) {
      vAttr += ' data-next="' + phT.id + '-' + (nRowNum + 1) + '-1"';
    } else {
      vAttr += ' data-next="' + nextId + '"';
    }
    if (cell.datatype === 'decimal' && vCurrValue !== '') {
      vCurrValue = decimalFormat(parseFloat(vCurrValue));
    }
    if (cell.hasOwnProperty('autocomplete') && cell.autocomplete === true) {
      vClasses = ' ph-autocomplete ph-ac-' + cell.field;
      typeId = 'ph-ac-' + cell.field + '-' + phT.id + '-' + nRowNum;
      vCurrValue = vCurrLabel;
    }
    if (cell.hasOwnProperty('required') && cell.required === true) {
      vAttr += ' required="" ';
    }
    if (vCurrValue !== '') {
      vAttr += ' value="' + vCurrValue + '" ';
    } else {
      if (cell.hasOwnProperty('autocomplete') && cell.autocomplete === true) {
        if (cell.hasOwnProperty('defLabel') && cell.defLabel !== '') {
          vAttr += ' value="' + cell.defLabel + '" ';
        } else {
          vAttr += ' value="" ';
        }
      } else {
        if (cell.hasOwnProperty('defValue') && cell.defValue !== '') {
          vAttr += ' value="' + cell.defValue + '" ';
        } else {
          vAttr += ' value="" ';
        }
      }
    }
    if (cell.hasOwnProperty('enabled')) {
      if (typeof cell.enabled === "function") {
        if (!cell.enabled(nRowNum)) {
          vAttr += ' disabled';
        }
      } else {
        if (!cell.enabled) {
          vAttr += ' disabled';
        }
      }
    }
    if (cell.hasOwnProperty('attr') && cell.required !== '') {
      vAttr += ' ' + cell.attr;
    }
    if (cell.hasOwnProperty('classes') && cell.classes !== '') {
      vClasses += ' ' + cell.classes;
    }
    vComponent = '<input class="form-control form-control-sm phcell ' + vClasses + ' ' + cell.field + ' cell-' + phT.id + ' col-' + phT.id + '-' + nColNum + '" type="' + cell.componentType + '" id="' + typeId + '" ' + vAttr + ' data-field="' + cell.field + '" data-tid="' + phT.id + '" data-row="' + nRowNum + '" data-col="' + nColNum + '">';
    if (cell.componentType === 'date') {
      vComponent = '<input class="form-control form-control-sm phcell ph_datepicker ' + vClasses + ' ' + cell.field + ' cell-' + phT.id + ' col-' + phT.id + '-' + nColNum + '" type="text" id="' + typeId + '" ' + vAttr + ' data-field="' + cell.field + '" data-tid="' + phT.id + '" data-row="' + nRowNum + '" data-col="' + nColNum + '">';
    }
    return vComponent;
  };

  phT.renderButton = function (cell, nRowNum, nColNum, bEnabled) {
    //let typeId = cell.field + '-' + phT.id + '-' + nRowNum;
    let typeId = phT.id + '-' + nRowNum + '-' + nColNum;
    let vComponent = '';
    let vClasses = '';
    let vAttr = ' tabindex="' + phT.nTabIndex + '"';
    if (cell.hasOwnProperty('required') && cell.required === true) {
      vAttr += ' required="" ';
    }
    if (cell.hasOwnProperty('attr') && cell.required !== '') {
      vAttr += ' ' + cell.attr;
    }
    if (cell.hasOwnProperty('enabled')) {
      if (typeof cell.enabled === "function") {
        if (!cell.enabled(nRowNum)) {
          vAttr += ' disabled';
        }
      } else {
        if (!cell.enabled) {
          vAttr += ' disabled';
        }
      }
    }
    if (cell.hasOwnProperty('classes') && cell.classes !== '') {
      vClasses = cell.classes;
    }
    vComponent = '<button class="btn btn-sm ' + vClasses + ' ' + cell.field + ' cell-' + phT.id + ' p-1" id="' + typeId + '" ' + vAttr + ' data-field="' + cell.field + '" data-tid="' + phT.id + '" data-row="' + nRowNum + '" data-col="' + nColNum + '">';
    if (cell.hasOwnProperty('format') && cell.format !== '') {
      vComponent += cell.format;
    }
    vComponent += '</button>';
    return vComponent;
  };


  phT.renderSelect = function (cell, nRowNum, nColNum, vCurrValue, bEnabled) {
    //let typeId = cell.field + '-' + phT.id + '-' + nRowNum;
    let typeId = phT.id + '-' + nRowNum + '-' + nColNum;
    let vComponent = '';
    let vClasses = '';
    let vAttr = ' tabindex="' + phT.nTabIndex + '"';
    if (cell.hasOwnProperty('required') && cell.required === true) {
      vAttr += ' required="" ';
    }
    if (cell.hasOwnProperty('attr') && cell.required !== '') {
      vAttr += ' ' + cell.attr;
    }
    if (cell.hasOwnProperty('enabled')) {
      if (typeof cell.enabled === "function") {
        if (!cell.enabled(nRowNum)) {
          vAttr += ' disabled';
        }
      } else {
        if (!cell.enabled) {
          vAttr += ' disabled';
        }
      }
    }
    if (cell.hasOwnProperty('classes') && cell.classes !== '') {
      vClasses = cell.classes;
    }
    vComponent = '<select class="form-select form-select-sm ' + vClasses + ' ' + cell.field + ' cell-' + phT.id + ' col-' + phT.id + '-' + nColNum + '" id="' + typeId + '" ' + vAttr + ' data-field="' + cell.field + '" data-tid="' + phT.id + '" data-row="' + nRowNum + '" data-col="' + nColNum + '" style="width: 100% important;">';
    if (cell.hasOwnProperty('options') && cell.options !== '' && Array.isArray(cell.options)) {
      for (let i = 0; i < cell.options.length; i++) {
        let vSelected = '';
        // dont use ===
        if (vCurrValue == cell.options[i].value || (vCurrValue === '' && i === 0)) {
          vSelected = 'selected';
        }
        vComponent += '  <option value="' + cell.options[i].id + '" ' + vSelected + '>' + cell.options[i].name + '</option>';
      }
    } else {
      vComponent += '  <option value="">Please Select</option>';
    }
    vComponent += '</select>';
    return vComponent;
  };

  phT.renderNormalSelect = function (cell, nRowNum, nColNum, vCurrValue, bEnabled) {
    let typeId = phT.id + '-' + nRowNum + '-' + nColNum;
    let vComponent = '';
    let vClasses = '';
    let vAttr = ' tabindex="' + phT.nTabIndex + '"';
    if (cell.hasOwnProperty('required') && cell.required === true) {
      vAttr += ' required="" ';
    }
    if (cell.hasOwnProperty('attr') && cell.required !== '') {
      vAttr += ' ' + cell.attr;
    }
    if (cell.hasOwnProperty('enabled')) {
      if (typeof cell.enabled === "function") {
        if (!cell.enabled(nRowNum)) {
          vAttr += ' disabled';
        }
      } else {
        if (!cell.enabled) {
          vAttr += ' disabled';
        }
      }
    }
    if (cell.hasOwnProperty('classes') && cell.classes !== '') {
      vClasses = cell.classes;
    }
    vComponent = '<select class="form-select form-select-sm' + vClasses + ' ' + cell.field + ' cell-' + phT.id + ' col-' + phT.id + '-' + nColNum + '" id="' + typeId + '" ' + vAttr + ' data-field="' + cell.field + '" data-tid="' + phT.id + '" data-row="' + nRowNum + '" data-col="' + nColNum + '" style="width: 100% important;">';
    if (cell.hasOwnProperty('options') && cell.options !== '' && Array.isArray(cell.options)) {
      for (let i = 0; i < cell.options.length; i++) {
        let vSelected = '';
        // dont use ===
        if (vCurrValue === cell.options[i].value || (vCurrValue === '' && i === 0)) {
          vSelected = 'selected';
        }
        vComponent += '  <option value="' + cell.options[i].id + '" ' + vSelected + '>' + cell.options[i].name + '</option>';
      }
    } else {
      vComponent += '  <option value="">Please Select</option>';
    }
    vComponent += '</select>';
    console.log(vComponent);
    return vComponent;
  };

  phT.renderAjaxSelect = function (cell, nRowNum, nColNum, vCurrValue, bEnabled) {
    //let typeId = cell.field + '-' + phT.id + '-' + nRowNum;
    let typeId = phT.id + '-' + nRowNum + '-' + nColNum;
    let vComponent = '';
    let vClasses = '';
    let vAttr = ' tabindex="' + phT.nTabIndex + '"';
    if (cell.hasOwnProperty('required') && cell.required === true) {
      vAttr += ' required="" ';
    }
    if (cell.hasOwnProperty('attr') && cell.required !== '') {
      vAttr += ' ' + cell.attr;
    }
    if (cell.hasOwnProperty('enabled')) {
      if (typeof cell.enabled === "function") {
        if (!cell.enabled(nRowNum)) {
          vAttr += ' disabled';
        }
      } else {
        if (!cell.enabled) {
          vAttr += ' disabled';
        }
      }
    }
    if (cell.hasOwnProperty('classes') && cell.classes !== '') {
      vClasses = cell.classes;
    }
    vComponent = '<select class="form-select form-select-sm w-100 ' + vClasses + ' ' + cell.field + ' cell-' + phT.id + ' col-' + phT.id + '-' + nColNum + '" id="' + typeId + '" ' + vAttr + ' data-field="' + cell.field + '" data-tid="' + phT.id + '" data-row="' + nRowNum + '" data-col="' + nColNum + '">';
    if (cell.hasOwnProperty('options') && cell.options !== '' && Array.isArray(cell.options)) {
      for (let i = 0; i < cell.options.length; i++) {
        let vSelected = '';
        // dont use ===
        if (vCurrValue === cell.options[i].value || (vCurrValue === '' && i === 0)) {
          vSelected = 'selected';
        }
        vComponent += '  <option value="' + cell.options[i].value + '" ' + vSelected + '>' + cell.options[i].label + '</option>';
      }
    } else {
      vComponent += '  <option value="">Please Select</option>';
    }
    vComponent += '</select>';
    return vComponent;
  };

  phT.refreshRow = function (nRowNum) {
    let cell;
    let vValue = '';
    let vLabel = '';
    let bEnabled;
    let vId = '';
    for (let nColNum = 0; nColNum < phT.aColumns.length; nColNum++) {
      bEnabled = true;
      vId = phT.id + '-' + nRowNum + '-' + nColNum;
      cell = phT.aColumns[nColNum];
      if (cell.hasOwnProperty('visible') && cell.visible) {
        vValue = '';
        vLabel = '';
        if (phT.aRows[nRowNum].fields.hasOwnProperty(cell.field)) {
          vValue = phT.aRows[nRowNum].fields[cell.field].value;
          vLabel = phT.aRows[nRowNum].fields[cell.field].label;
          if (typeof phT.aRows[nRowNum].fields[cell.field].enabled === "function") {
            bEnabled = phT.aRows[nRowNum].fields[cell.field].enabled(nRowNum);
          } else {
            bEnabled = phT.aRows[nRowNum].fields[cell.field].enabled;
          }
        }
        if (cell !== '') {
          if (cell.hasOwnProperty('component') && cell.component !== '') {
            $('#' + vId).prop('disabled', !bEnabled);
            switch (cell.component) {
              case 'display':
                $('#' + vId).text(vLabel);
                break;
              case 'input':
                if (cell.hasOwnProperty('ajax') && cell.ajax === true) {
                  $('#' + vId).val(vLabel);
                } else {
                  if (cell.datatype === 'decimal') {
//                    if (isNaN(vValue)) {
//                      vValue = phT.aRows[nRowNum].fields[cell.field].defValue;
//                    }
                    vValue = decimalFormat(vValue);
                  } else if (cell.datatype === 'integer') {
//                    if (isNaN(vValue)) {
//                      vValue = phT.aRows[nRowNum].fields[cell.field].defValue;
//                    }
                    vValue = integerFormat(vValue);
                  }
                  $('#' + vId).val(vValue);
                }
                break;
              case 'select':
              case 'nselect':
                $('#' + vId).val(vValue);
                break;
              case 'button':

                break;
              case 'image':
                $('#' + vId).attr('src', vValue);
                break;
              default:
                $('#' + vId).text(vLabel);
                break;
            }
          }
        }
      }
    }
    phT.refreshFooter();
  };

  phT.renderRow = function (nRowNum) {
    let vHtml = '';
    let cell;
    let vComponent;
    let vValue = '';
    let vLabel = '';
    let bEnabled = true;
    let vWidth;
    vHtml += '<div style="width: ' + PhTable_ORDER_WIDTH + ';" class="ph-table-cell p-0 text-center">' + (nRowNum + 1) + '</div>';
    for (let nColNum = 0; nColNum < phT.aColumns.length; nColNum++) {
      phT.nTabIndex++;
      cell = phT.aColumns[nColNum];
      //console.log(nColNum, cell.field);
      if (cell.hasOwnProperty('visible') && cell.visible) {
        vValue = '';
        vLabel = '';
        if (phT.aRows[nRowNum].fields.hasOwnProperty(cell.field)) {
          vValue = phT.aRows[nRowNum].fields[cell.field].value;
          vLabel = phT.aRows[nRowNum].fields[cell.field].label;
          if (typeof phT.aRows[nRowNum].fields[cell.field].enabled === "function") {
            bEnabled = phT.aRows[nRowNum].fields[cell.field].enabled(nRowNum);
          } else {
            bEnabled = phT.aRows[nRowNum].fields[cell.field].enabled;
          }
        }
        vComponent = '';
        vWidth = '';
        if (cell.hasOwnProperty('width') && cell.width !== '') {
          vWidth = 'width: ' + cell.width + ';';
        }
        if (cell !== '') {
          if (cell.hasOwnProperty('component') && cell.component !== '') {
            switch (cell.component) {
              case 'display':
                vComponent = phT.renderDisplay(cell, nRowNum, nColNum, vValue);
                break;
              case 'input':
                vComponent = phT.renderInput(cell, nRowNum, nColNum, vValue, vLabel, bEnabled);
                break;
              case 'select':
                if (cell.hasOwnProperty('ajax') && cell.ajax === true) {
                  vComponent = phT.renderAjaxSelect(cell, nRowNum, nColNum, vValue, bEnabled);
                } else {
                  vComponent = phT.renderSelect(cell, nRowNum, nColNum, vValue, bEnabled);
                }
                break;
              case 'nselect':
                vComponent = phT.renderNormalSelect(cell, nRowNum, nColNum, vValue, bEnabled);
                break;
              case 'button':
                vComponent = phT.renderButton(cell, nRowNum, nColNum, bEnabled);
                break;
              case 'image':
                vComponent = phT.renderImage(cell, nRowNum, nColNum, vValue, bEnabled);
                break;
              default:
                vComponent = phT.renderDisplay(cell, nRowNum, nColNum, vValue);
                break;
            }
          }
        }
        vHtml += '<div style="' + vWidth + '" class="ph-table-cell p-0">' + vComponent + '</div>';
      }
    }
    if (phT.options.widthType === PhTable_WIDTH_VARIABLE) {
      vHtml = '<div class="ph-table-row ' + ((nRowNum % 2 === 0) ? 'ph-table-row-even' : 'ph-table-row-odd Number') + ' align-items-center" style="width: ' + phT.options.nRowWidth + 'px; display: flex;">' + vHtml + '</div>';
    } else {
      vHtml = '<div class="ph-table-row ' + ((nRowNum % 2 === 0) ? 'ph-table-row-even' : 'ph-table-row-odd Number') + ' align-items-center" style="width: 100%; display: flex;">' + vHtml + '</div>';
    }
    return vHtml;
  };

  phT.renderRows = function () {
    let vHtml = '';
    for (let nRowNum = 0; nRowNum < phT.nRows; nRowNum++) {
      if (!phT.aRows[nRowNum].isDeleted) {
        vHtml += phT.renderRow(nRowNum);
      }
    }
    return vHtml;
  };

  phT.renderHeader = function () {
    let vHtml = '';
    vHtml = '<div style="width: ' + PhTable_ORDER_WIDTH + ';">';
    if (phT.options.addRowBtn) {
      vHtml += '<span id="' + phT.id + '-addRow" class="btn btn-sm btn-primary font-weight-bolder btn-' + phT.id + '-addRow text-uppercase pl-3 pr-2" data-tableid="' + phT.id + '" data-toggle="tooltip" title="New Row"><i class="bi bi-plus-lg"></i></span>';
    } else {
      vHtml += '&nbsp;';
    }
    vHtml += '</div>';
    for (let i = 0; i < phT.aColumns.length; i++) {
      let cell = phT.aColumns[i];
      if (cell.hasOwnProperty('visible') && cell.visible) {
        let vWidth = '';
        if (cell.hasOwnProperty('width') && cell.width !== '') {
          vWidth = 'width: ' + cell.width + ';';
        }
        vHtml += '<div id="head-' + phT.id + '-' + i + '" style="' + vWidth + '" class="ph-table-col float-left border border-1 text-center p-1">' + cell.title + '</div>';
      }
    }
    if (phT.options.widthType === PhTable_WIDTH_VARIABLE) {
      vHtml = '<div class="ph-table-header" style="width: ' + phT.options.nRowWidth + 'px; display: flex;">' + vHtml + '</div>';
    } else {
      vHtml = '<div class="ph-table-header" style="width: calc(100% - 18px); display: flex;">' + vHtml + '</div>';
    }
    return vHtml;
  };

  phT.renderBody = function () {
    let vHtml = '';
    if (phT.options.widthType === PhTable_WIDTH_VARIABLE) {
      vHtml += '<div class="ph-table-body" style="width: ' + (phT.options.nRowWidth + 20) + 'px; max-height: ' + phT.options.maxHeight + phT.options.heightUnit + '; height: ' + phT.options.maxHeight + phT.options.heightUnit + '; overflow-y: auto; overflow-x: hidden;">';
    } else {
      vHtml += '<div class="ph-table-body" style="width: 100%; max-height: ' + phT.options.maxHeight + phT.options.heightUnit + '; height: ' + phT.options.maxHeight + phT.options.heightUnit + '; overflow-y: auto; overflow-x: hidden;">';
    }
    vHtml += phT.renderRows();
    vHtml += '</div>';
    return vHtml;
  };

  phT.refreshFooter = function () {
    let vValue = '';
    let cell;
    for (let i = 0; i < phT.aColumns.length; i++) {
      cell = phT.aColumns[i];
      if (cell.hasOwnProperty('visible') && cell.visible) {
        vValue = '&nbsp;';
        if (cell.hasOwnProperty('aggregate') && cell.aggregate !== '') {
          switch (cell.aggregate) {
            case PhTable_SUM:
              vValue = phT.getSum(cell.field);
              break;
            case PhTable_AVG:
              vValue = phT.getAvg(cell.field);
              break;
            case PhTable_MIN:
              vValue = phT.getMin(cell.field);
              break;
            case PhTable_MAX:
              vValue = phT.getMax(cell.field);
              break;
            case PhTable_COUNT:
              vValue = phT.getCount(cell.field);
              break;
            default:
              break;
          }
          if (cell.datatype === 'decimal') {
            vValue = decimalFormat(parseFloat(vValue));
          } else if (cell.datatype === 'integer') {
            vValue = integerFormat(parseInt(vValue));
          }
          $('#foot-' + phT.id + '-' + i).text(vValue);
        }
      }
    }
  };

  phT.renderFooter = function () {
    let vHtml = '';
    let vWidth = '';
    let vValue = '';
    let cell;
    vHtml = '<div style="width: ' + PhTable_ORDER_WIDTH + ';">&nbsp;</div>';
    for (let i = 0; i < phT.aColumns.length; i++) {
      cell = phT.aColumns[i];
      if (cell.hasOwnProperty('visible') && cell.visible) {
        vWidth = '';
        vValue = '&nbsp;';
        if (cell.hasOwnProperty('width') && cell.width !== '') {
          vWidth = 'width: ' + cell.width + ';';
        }
        if (cell.hasOwnProperty('aggregate') && cell.aggregate !== '') {
          switch (cell.aggregate) {
            case PhTable_SUM:
              vValue = phT.getSum(cell.field);
              break;
            case PhTable_AVG:
              vValue = phT.getAvg(cell.field);
              break;
            case PhTable_MIN:
              vValue = phT.getMin(cell.field);
              break;
            case PhTable_MAX:
              vValue = phT.getMax(cell.field);
              break;
            case PhTable_COUNT:
              vValue = phT.getCount(cell.field);
              break;
            default:
              break;
          }
          if (cell.datatype === 'decimal') {
            vValue = decimalFormat(parseFloat(vValue));
          } else if (cell.datatype === 'integer') {
            vValue = integerFormat(parseInt(vValue));
          }
        }
        vHtml += '<div id="foot-' + phT.id + '-' + i + '" style="' + vWidth + '" class="ph-table-col float-left border border-1 p-1">' + vValue + '</div>';
      }
    }
    if (phT.options.widthType === PhTable_WIDTH_VARIABLE) {
      vHtml = '<div class="ph-table-footer" style="width: ' + phT.options.nRowWidth + 'px; display: flex;">' + vHtml + '</div>';
    } else {
      vHtml = '<div class="ph-table-footer" style="width: calc(100% - 18px); display: flex;">' + vHtml + '</div>';
    }
    return vHtml;
  };

  phT.render = function () {
    let vHtml = '';
    phT.options.nRowWidth = phT.getRowWidth();
    vHtml += phT.renderHeader();
    vHtml += phT.renderBody();
    vHtml += phT.renderFooter();
    phT.$container.html(vHtml);
    let arrows;
    var isRtl = true;
    if (PhSettings.GUId.vDir === 'ltr') {
      isRtl = false;
      arrows = {
        leftArrow: '<i class="bi bi-arrow-right-short"></i>',
        rightArrow: '<i class="bi bi-arrow-left-short"></i>'
      };
    } else {
      arrows = {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
      };
    }
    $('.ph_datepicker').datepicker({
      rtl: PhSettings.GUId.vDir,
      isRTL: isRtl,
      dateFormat: 'dd-mm-yy',
      minDate: '01-01-2023',
      defaultDate: currentDate(),
      changeMonth: true,
      changeYear: true,
      showOtherMonths: true,
      selectOtherMonths: true,
      todayBtn: 'linked',
      todayHighlight: true,
      templates: arrows
    });
    // dont change order of 4 next rows
    $('.cell-' + phT.id).unbind('change');
    phT.unbindCallback();
    $('.cell-' + phT.id).off('change').on('change', phT.onChange);
    $('.cell-' + phT.id).off('blur').on('blur', phT.onBlur);
    $('.cell-' + phT.id).off('keyup').on('keyup', phT.keyup);
    $('.btn-' + phT.id + '-addRow').off('click').on('click', phT.onAddRowBtn);
    phT.initCallback();
    phT.initAutocomplete();
  };

  phT.getRowWidth = function () {
    let innerWidth = window.innerWidth - 25;
    let nPos = -1;
    let nWidth = 15;
    phT.$container.html('<div style="width: 100%;">&nbsp;</div>');
    if (phT.$container.width() > 0) {
      innerWidth = phT.$container.width();
    }
    for (let i = 0; i < phT.aColumns.length; i++) {
      let cell = phT.aColumns[i];
      if (cell.hasOwnProperty('visible') && cell.visible) {
        if (cell.hasOwnProperty('width') && cell.width !== '') {
          nPos = cell.width.indexOf('%');
          if (nPos > -1) {
            nWidth += parseInt(cell.width.replaceAll('%', '')) * innerWidth / 100;
          } else {
            nWidth += parseInt(cell.width.replaceAll('px', '').replaceAll('%', ''));
          }
        }
      }
    }
    return nWidth;
  };

  phT.onChange = function (e) {
    e.preventDefault();
    let vField = $(this).data('field');
    let nRow = $(this).data('row');
    let nCol = $(this).data('col');
    let value = $(this).val();
    if (!phT.aColumns[nCol].hasOwnProperty('autocomplete')
            || (phT.aColumns[nCol].hasOwnProperty('autocomplete')
                    && phT.aColumns[nCol].autocomplete === false
                    )
            ) {
      if (vField !== undefined) {
        phT.aRows[nRow].fields[vField].value = value;
        phT.aRows[nRow].fields[vField].isChanged = true;
      }
    }
    phT.refreshRow(nRow);
    $($(this).data('next')).focus();
  };

  phT.onBlur = function (e) {
    e.preventDefault();
  };

  phT.keyup = function (e) {
    e.preventDefault();
    let keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      $('#' + $(this).data('next')).focus();
      return true;
    }
  };

  phT.onAddRowBtn = function () {
    phT.addEmptyRow();
    phT.render();
  };

  phT.initRows();
  phT.render();
};
