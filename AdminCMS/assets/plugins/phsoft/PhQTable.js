/* global Intl, KTUtil */

// Initializing a class definition
let IdGenerator = function () {
  let nLastId = (Math.floor(Math.random() * 999) + 100) + Date.now();
  this.genId = function () {
    return nLastId++;
  };
};
let IdGen = new IdGenerator();

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
let PhQTable = function (vContainer, aCols, aData, options = {}) {
  let phT = this;
  phT.vContainer = vContainer;
  phT.aCols = aCols;
  phT.aData = aData;
  phT.options = options;
  //
  phT.id = IdGen.genId();
  phT.version = '0.2.220207.1145';
  phT.defaultOptions = {
    widthType: PhTable_WIDTH_VARIABLE,
    nRowWidth: 0
  };
  phT.options = $.extend(phT.defaultOptions, phT.options);
  phT.tableHeaderId = 'phTableHeader-' + phT.id;
  phT.tableBodyId = 'phTableBody-' + phT.id;
  phT.tableFooterId = 'phTableFooter-' + phT.id;
  phT.$container = $('#' + vContainer);
  phT.aOriginalData = aData;
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
        componentAttr: {},
        format: '',
        classes: '',
        attr: '',
        action: ''
      }, phT.aCols[nColumn]);
  }

  phT.setWidthType = function (nType = PhTable_WIDTH_VARIABLE) {
    phT.options.widthType = nType;
    phT.render();
  };

  phT.getField = function (nRow, vField) {
    return phT.aRows[nRow].fields[vField];
  };

  phT.getFieldValue = function (nRow, vField) {
    return phT.aRows[nRow].fields[vField].value;
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

  phT.initRows = function () {
    let oColumn = {};
    let vLabel = '';
    let vValue = '';
    phT.nRows = 0;
    phT.aRows = [];
    if (phT.aOriginalData.length > 0) {
      for (let nRowNum = 0; nRowNum < phT.aOriginalData.length; nRowNum++) {
        phT.aRows[nRowNum] = {
          fields: {}
        };
        for (const [key, value] of Object.entries(phT.aOriginalData[nRowNum])) {
          vValue = value;
          vLabel = value;
          if (vLabel === null || vLabel === 'null') {
            vLabel = '';
            vValue = '';
          }
          if (phT.aOriginalData[nRowNum][key] !== null) {
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
            label: vLabel
          };
        }
        phT.nRows++;
      }
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

  phT.refreshRow = function (nRowNum) {
    let cell;
    let vValue;
    let vLabel = '';
    let vId = '';
    for (let nColNum = 0; nColNum < phT.aColumns.length; nColNum++) {
      vId = phT.id + '-' + nRowNum + '-' + nColNum;
      cell = phT.aColumns[nColNum];
      if (cell.hasOwnProperty('visible') && cell.visible) {
        vValue = '';
        vLabel = '';
        if (phT.aRows[nRowNum].fields.hasOwnProperty(cell.field)) {
          vValue = phT.aRows[nRowNum].fields[cell.field].value;
          vLabel = phT.aRows[nRowNum].fields[cell.field].label;
        }
        if (cell !== '') {
          $('#' + vId).text(vLabel);
        }
      }
    }
    phT.refreshFooter();
  };

  phT.renderRow = function (nRowNum) {
    let vHtml = '';
    let cell;
    let vComponent;
    let vWidth;
    let vValue;
    for (let nColNum = 0; nColNum < phT.aColumns.length; nColNum++) {
      let typeId = phT.id + '-' + nRowNum + '-' + nColNum;
      phT.nTabIndex++;
      cell = phT.aColumns[nColNum];
      if (cell.hasOwnProperty('visible') && cell.visible) {
        vComponent = '';
        vWidth = '';
        if (cell.hasOwnProperty('width') && cell.width !== '') {
          vWidth = 'width: ' + cell.width + ';';
        }
        if (cell !== '') {
          vValue = '';
          try {
            vValue = phT.getFieldValue(nRowNum, cell.field);
          } catch (e) {

          }
          vComponent = '<span class="form-control ' + cell.classes + ' ' + cell.field + ' cell-' + phT.id + ' col-' + phT.id + '-' + nColNum + '" id="' + typeId + '" ' + cell.attr + ' data-field="' + cell.field + '" data-tid="' + phT.id + '" data-row="' + nRowNum + '" data-col="' + nColNum + '">' + vValue + '</span>';
        }
        vHtml += '<div style="' + vWidth + '" class="ph-table-cell">' + vComponent + '</div>';
      }
    }
    vHtml = '<div class="ph-table-row ' + ((nRowNum % 2 === 0) ? 'ph-table-row-even' : 'ph-table-row-odd Number') + ' align-items-center" style="width: 100%; display: flex;">' + vHtml + '</div>';
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
    vHtml = '<div class="ph-table-header" style="width: 100%; display: flex;">' + vHtml + '</div>';
    return vHtml;
  };

  phT.renderBody = function () {
    let vHtml = '';
    vHtml += '<div class="ph-table-body" style="width: 100%;">';
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
            vValue = parseFloat(vValue);
            vValue = decimalFormat(vValue);
          } else if (cell.datatype === 'integer') {
            vValue = parseInt(vValue);
            vValue = integerFormat(vValue);
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
            vValue = parseFloat(vValue);
            vValue = decimalFormat(vValue);
          } else if (cell.datatype === 'integer') {
            vValue = parseInt(vValue);
            vValue = integerFormat(vValue);
          }
        }
        vHtml += '<div id="foot-' + phT.id + '-' + i + '" style="' + vWidth + '" class="ph-table-col float-left border border-1 p-1">' + vValue + '</div>';
      }
    }
    vHtml = '<div class="ph-table-footer" style="width: 100%; display: flex;">' + vHtml + '</div>';
    return vHtml;
  };

  phT.render = function () {
    let vHtml = '';
    phT.options.nRowWidth = phT.getRowWidth();
    vHtml += phT.renderHeader();
    vHtml += phT.renderBody();
    vHtml += phT.renderFooter();
    phT.$container.html(vHtml);
    $('.selectpicker').selectpicker('refresh');
    $('.selectpicker').selectpicker('render');
    let arrows;
    if (KTUtil.isRTL()) {
      arrows = {
        leftArrow: '<i class="la la-angle-right"></i>',
        rightArrow: '<i class="la la-angle-left"></i>'
      };
    } else {
      arrows = {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
      };
    }
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

  phT.initRows();
  phT.render();
};
