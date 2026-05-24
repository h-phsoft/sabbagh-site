/* global PhF_Type_Tree, PhF_Action_Update, PhF_Action_New, PhSettings, swal, PhF_Toogle_Execute, PhFOperations, PhF_Toogle_Edite, PhF_Toogle_New, PhF_Type_Form, PhF_Mode_Query, PhF_Type_MstTrn */
let PhForm = function (container, metta, options = {}) {
  let phF = this;
  phF.aData = [];
  phF.aResultData = [];
  phF.aDeletedData = [];
  phF.validated = true;
  phF.tablePageCount = 1;
  phF.tablePageCurrent = 1;
  phF.tableRowCount = 10;
  phF.tableRowDataCount = 0;
  phF.container = container;
  phF.aURL = metta.aURL;
  phF.URL = metta.aURL.Url + metta.aURL.Api;
  if (metta.aURL.hasOwnProperty('VApi')) {
    phF.VURL = metta.aURL.Url + metta.aURL.VApi;
  }
  phF.aQryFlds = metta.aQFields;
  phF.aEntryFlds = metta.aFields;
  phF.phTable = metta.phTable;
  //
  phF.version = '0.1.210602.1145';
  phF.defaultOptions = {
    mode: PhF_Mode_Query,
    type: PhF_Type_Form,
    cols: 2,
    btns: {
      "submit": "ph-submit",
      "execute": "ph-execute",
      "search": "ph-search",
      "delete": "ph-delete",
      "new": "ph-new",
      "addRow": "ph-addRow",
      "reset": "ph-reset",
      "refresh": "ph-refresh",
      "attache": "ph-attache",
      "pnext": "ph-fpager-next",
      "plast": "ph-fpager-last",
      "pprevious": "ph-fpager-previous",
      "pfirst": "ph-fpager-first",
      "tnext": "table-pager-next",
      "tlast": "table-pager-last",
      "tprevious": "table-pager-previous",
      "tfirst": "table-pager-first",
      "tcount": "table-pager-count"
    }
  };
  phF.options = $.extend(phF.defaultOptions, options);
  //
  phF.entryForm = container + 'EntryForm';
  phF.FormAlert = container + 'AlertForm';
  phF.form = container + 'Form';
  phF.queryForm = container + 'QueryForm';
  phF.queryCritirya = container + 'QueryCritirya';
  phF.queryResult = container + 'QueryResult';
  phF.queryTable = container + 'QueryTable';
  phF.TablePager = container + 'TablePager';
  phF.queryTableData = container + 'QueryTableData';

  phF.$entryForm = $('#' + phF.entryForm);
  phF.$formAlert = $('#' + phF.FormAlert);
  phF.$form = $('#' + phF.form);
  phF.$queryForm = $('#' + phF.queryForm);
  phF.$queryCritirya = $('#' + phF.queryCritirya);
  phF.$queryResult = $('#' + phF.queryResult);
  phF.$queryTable = $('#' + phF.queryTable);
  phF.$TablePager = $('#' + phF.TablePager);
  phF.$queryTableData = $('#' + phF.queryTableData);

  phF.renderOperation = function (fld) {
    let vComponent = '';
    vComponent += '<select id="' + phF.container + 'QFld' + fld.element + '" class="form-select form-select-sm QFld">';
    for (let i = 0; i < fld.aOpers.length; i++) {
      let oper = PhFOperations[fld.aOpers[i]];
      vComponent += '  <option value="' + oper.sign + '">' + oper.label + '</option>';
    }
    vComponent += '</select>';
    return vComponent;
  };

  phF.renderInputText = function (fld) {
    let vComponent = '';
    let vClass = '';
    vComponent += '<div class="row mb-1">';
    vComponent += '  <label for="' + phF.container + 'QFld' + fld.element + '" class="col-sm-3  form-label ph-label text-start text-sm-end px-2">' + fld.label + '</label>';
    vComponent += '  <div class="col-sm-3 px-0">';
    vComponent += phF.renderOperation(fld);
    vComponent += '  </div>';
    if (fld.aOpers.includes(PhFOper_BT) || fld.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phF.container + 'QFld' + fld.element).val() === '<>' || $('#' + phF.container + 'QFld' + fld.element).val() === '><') ? '' : 'd-none';
      vComponent += '  <div class="col-sm-3 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.element + '1" class="form-control form-control-sm" type="text" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
      vComponent += '  <div class="col-sm-3 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.element + '2" class="form-control form-control-sm ' + vClass + ' " type="text" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
    } else {
      vComponent += '  <div class="col-sm-6 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.element + '1" class="form-control form-control-sm" type="text" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
    }
    vComponent += '</div>';
    return vComponent;
  };

  phF.renderSelect = function (fld) {
    let vComponent = '';
    vComponent += '<div class="row mb-1">';
    vComponent += '  <label for="' + phF.container + 'QFld' + fld.element + '" class="col-sm-3 form-label ph-label text-start text-sm-end px-2">' + fld.label + '</label>';
    vComponent += '  <div class="col-sm-3 px-0">';
    vComponent += phF.renderOperation(fld);
    vComponent += '  </div>';
    vComponent += '  <div class="col-sm-6 px-0">';
    vComponent += '    <select id="' + phF.container + 'QFld' + fld.element + '1" class="form-select form-select-sm">';
    vComponent += '      <option value="" ' + (fld.defValue === -1 ? 'selected' : '') + '></option>';
    if (fld.hasOwnProperty('options')) {
      for (let i = 0; i < fld.options.length; i++) {
        vComponent += '      <option value="' + fld.options[i].id + '" ' + (fld.defValue === fld.options[i].id ? 'selected' : '') + '>' + fld.options[i].name + '</option>';
      }
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
    vComponent += '  <label for="' + phF.container + 'QFld' + fld.element + '" class="col-sm-3  form-label ph-label text-start text-sm-end px-2">' + fld.label + '</label>';
    vComponent += '  <div class="col-sm-3 px-0">';
    vComponent += phF.renderOperation(fld);
    vComponent += '  </div>';
    if (fld.aOpers.includes(PhFOper_BT) || fld.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phF.container + 'QFld' + fld.element).val() === '<>' || $('#' + phF.container + 'QFld' + fld.element).val() === '><') ? '' : 'd-none';
      vComponent += '  <div class="col-sm-3 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.element + '1" class="form-control form-control-sm" type="number" min="' + fld.minValue + '" step="' + fld.step + '" max="' + fld.maxValue + '" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
      vComponent += '  <div class="col-sm-3 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.element + '2" class="form-control form-control-sm ' + vClass + '" type="number" min="' + fld.minValue + '" step="' + fld.step + '" max="' + fld.maxValue + '" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
    } else {
      vComponent += '  <div class="col-sm-6 px-0">';
      vComponent += '    <input id="' + phF.container + 'QFld' + fld.element + '1" class="form-control form-control-sm" type="number" min="' + fld.minValue + '" step="' + fld.step + '" max="' + fld.maxValue + '" value="' + fld.defValue + '" autocomplete="off" />';
      vComponent += '  </div>';
    }
    vComponent += '</div>';
    return vComponent;
  };

  phF.renderDatePicker = function (fld) {
    let vComponent = '';
    let vClass = '';
    vComponent += '<div class="row mb-1">';
    vComponent += '  <label for="' + phF.container + 'QFld' + fld.element + '" class="col-sm-3  form-label ph-label text-start text-sm-end px-2">' + fld.label + '</label>';
    vComponent += '  <div class="col-sm-3 px-0">';
    vComponent += phF.renderOperation(fld);
    vComponent += '  </div>';
    if (fld.aOpers.includes(PhFOper_BT) || fld.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phF.container + 'QFld' + fld.element).val() === '<>' || $('#' + phF.container + 'QFld' + fld.element).val() === '><') ? '' : 'd-none';
      vComponent += ' <div class="col-sm-3 px-0">';
      vComponent += '   <div class="input-group date">';
      vComponent += '     <input id="' + phF.container + 'QFld' + fld.element + '1" class="form-control form-control-sm ph_datepicker" type="text" value="' + fld.defValue + '" required="true" />';
      vComponent += '     <div class="input-group-append input-group-sm datepicker-btn">';
      vComponent += '       <span class="input-group-text">';
      vComponent += '         <i class="bi bi-calendar4-event fs-"></i>';
      vComponent += '       </span>';
      vComponent += '     </div>';
      vComponent += '   </div>';
      vComponent += ' </div>';
      vComponent += ' <div class="col-sm-3 px-0">';
      vComponent += '   <div class="input-group date">';
      vComponent += '     <input id="' + phF.container + 'QFld' + fld.element + '2" class="form-control form-control-sm ph_datepicker ' + vClass + '" type="text" value="' + fld.defValue + '" required="true" />';
      vComponent += '     <div id="' + phF.container + 'QFld' + fld.element + '3" class="input-group-append input-group-sm datepicker-btn ' + vClass + '">';
      vComponent += '       <span class="input-group-text">';
      vComponent += '         <i class="bi bi-calendar4-event"></i>';
      vComponent += '       </span>';
      vComponent += '     </div>';
      vComponent += '   </div>';
      vComponent += ' </div>';
    } else {
      vComponent += ' <div class="col-sm-6 px-0">';
      vComponent += '   <div class="input-group date">';
      vComponent += '     <input id="' + phF.container + 'QFld' + fld.element + '1" class="form-control form-control-sm ph_datepicker" type="text" value="' + fld.defValue + '" required="true" />';
      vComponent += '     <div class="input-group-append input-group-sm datepicker-btn">';
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
    vComponent += '  <label for="' + phF.container + 'QFld' + fld.element + '" class="col-sm-3  form-label ph-label text-start text-sm-end px-2">' + fld.label + '</label>';
    vComponent += '  <div class="col-sm-3 px-0">';
    vComponent += phF.renderOperation(fld);
    vComponent += '  </div>';
    if (fld.aOpers.includes(PhFOper_BT) || fld.aOpers.includes(PhFOper_NB)) {
      vClass = ($('#' + phF.container + 'QFld' + fld.element).val() === '<>' || $('#' + phF.container + 'QFld' + fld.element).val() === '><') ? '' : ' d-none';
      vComponent += ' <div class="col-sm-3 px-0">';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.element + 'Id1" type="hidden" value=""/>';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.element + '1" class="form-control form-control-sm phAutocomplete" data-acrel="' + phF.container + 'QFld' + fld.element + 'Id1" data-acoperation="' + fld.autoCompleteApi + '" data-params="acParams"   type="text"  value=""/>';
      vComponent += ' </div>';
      vComponent += ' <div class="col-sm-3 px-0">';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.element + 'Id2" type="hidden" value=""/>';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.element + '2" class="form-control form-control-sm phAutocomplete ' + vClass + '" data-acrel="' + phF.container + 'QFld' + fld.element + 'Id2" data-acoperation="' + fld.autoCompleteApi + '" data-params="acParams"   type="text" value=""/>';
      vComponent += ' </div>';
    } else {
      vComponent += ' <div class="col-sm-6 px-0">';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.element + 'Id1" type="hidden" value=""/>';
      vComponent += '   <input id="' + phF.container + 'QFld' + fld.element + '1" class="form-control form-control-sm phAutocomplete" data-acrel="' + phF.container + 'QFld' + fld.element + 'Id1" data-acoperation="' + fld.autoCompleteApi + '" data-params="acParams"   type="text" value=""/>';
      vComponent += ' </div>';
    }
    vComponent += '</div>';
    return vComponent;
  };

  phF.renderQueryMode = function () {
    let vHtml = '';
    vHtml += '<div class="row">';
    vHtml += '  <div class="col-sm-7">';
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
    vHtml += '  </div>';
    vHtml += '</div>';
    return vHtml;
  };

  phF.renderEntryMode = function () {
    let vHtml = '';
    vHtml += '<div class="row">';
    if (phF.options.cols === 1) {
      vHtml += '  <div class="col-sm-10 mx-auto">';
    }
    for (let i = 0; i < phF.aQryFlds.length; i++) {
      let fld = phF.aQryFlds[i];
      if (phF.options.cols === 2) {
        vHtml += '  <div class="col-sm-6">';
      }
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
          break;
      }
      if (phF.options.cols === 2) {
        vHtml += '  </div>';
      }
    }
    if (phF.options.cols === 1) {
      vHtml += '  </div>';
    }
    vHtml += '</div>';
    return vHtml;
  };

  phF.render = function () {
    let vHtml = '';
    if (phF.options.mode === PhF_Mode_Query) {
      vHtml = phF.renderQueryMode();
    } else {
      vHtml = phF.renderEntryMode();
    }
    phF.$queryCritirya.html(vHtml);
    if (phF.options.type === PhF_Type_MstTrn) {
      phF.phTable.phT = new PhTable(phF.phTable.container, phF.phTable.aColumns, [], phF.phTable.options);
      phF.phTable.phT.setHeight(40);
    }
    initPhTApp();
    phAutocomplete();
  };

  phF.jqReady = function () {
    $('#' + phF.options.btns.submit).off('click').on('click', function () {
      if ($('#' + phF.aEntryFlds[0].element).val() <= 0) {
        phF.doSave(PhF_Action_New);
      } else {
        phF.doSave(PhF_Action_Update);
      }
    });
    $("#" + phF.options.btns.new).click(function (e) {
      e.preventDefault();
      if (phF.options.type !== PhF_Type_Tree)
      {
        if (toogleType === PhF_Toogle_New) {
          swal.fire({
            title: getLabel('The Form Will Clear !!'),
            text: getLabel('Are you sure ?'),
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
              phF.openNew();
            } else if (result.dismiss === "cancel") {
            }
          });
        } else {
          phF.openNew();
          toogleType = PhF_Toogle_New;
          phF.toogle(PhF_Toogle_New);
        }
      } else {
        phF.getTreeNode();
      }
    });
    $("#" + phF.options.btns.delete).click(function (e) {
      e.preventDefault();
      swal.fire({
        title: getLabel('The Page Will Delete !!'),
        text: getLabel('Are you sure ?'),
        icon: "error",
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
          phF.doDelete($('#' + phF.aEntryFlds[0].element).val());
        } else if (result.dismiss === "cancel") {
        }
      });
    });
    $("#" + phF.options.btns.search).click(function (e) {
      e.preventDefault();
      phF.tablePageCurrent = 1;
      toogleType = PhF_Toogle_Query;
      phF.toogle(PhF_Toogle_Query);
    });
    $("#" + phF.options.btns.execute).click(function (e) {
      e.preventDefault();
      phF.doSearch();
    });
    $("#" + phF.options.btns.reset).click(function (e) {
      e.preventDefault();
      phF.resetQuery();
      phF.toogle(PhF_Toogle_Query);
    });
    $("#" + phF.options.btns.pnext).click(function (e) {
      e.preventDefault();
      if (phF.tablePageCurrent < phF.tableRowDataCount) {
        phF.tableRowCount = 1;
        phF.tablePageCurrent++;
        phF.doPager();
      }
    });
    $("#" + phF.options.btns.plast).click(function (e) {
      e.preventDefault();
      if (phF.tablePageCurrent !== phF.tableRowDataCount) {
        phF.tableRowCount = 1;
        phF.tablePageCurrent = phF.tableRowDataCount;
        phF.doPager();
      }
    });
    $("#" + phF.options.btns.pprevious).click(function (e) {
      e.preventDefault();
      if (phF.tablePageCurrent !== 1) {
        phF.tableRowCount = 1;
        phF.tablePageCurrent--;
        phF.doPager();
      }
    });
    $("#" + phF.options.btns.pfirst).click(function (e) {
      e.preventDefault();
      if (phF.tablePageCurrent !== 1) {
        phF.tableRowCount = 1;
        phF.tablePageCurrent = 1;
        phF.doPager();
      }
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
    if (phF.options.type === PhF_Type_Tree) {
      $('#fldFilter').on('keyup', function () {
        setTimeout(function () {
          $('#treeView').jstree(true).search($('#fldFilter').val());
        }, 250);
      });
      phF.buildTree();
    } else if (phF.options.type === PhF_Type_MstTrn) {
      $('#' + phF.options.btns.addRow).on('click', function () {
        phF.phTable.phT.addEmptyRow();
        phF.phTable.phT.render();
      });
    }
    phF.renderESelect();
    phF.openNew();
  };

  phF.showSecondField = function (fldId) {
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

  phF.toogle = function (toogleType) {
    if (phF.options.type === PhF_Type_MstTrn || phF.options.type === PhF_Type_Form) {
      if (toogleType === PhF_Toogle_New) {
        $("#" + phF.options.btns.submit).removeClass("d-none");
        $("#" + phF.options.btns.search).removeClass("d-none");
        $("#" + phF.options.btns.execute).addClass("d-none");
        $("#pager").addClass("d-none");
        $("#" + phF.options.btns.delete).addClass("d-none");
        $("#" + phF.options.btns.reset).addClass("d-none");
        $("#" + phF.options.btns.attache).addClass("d-none");
        phF.$entryForm.removeClass("d-none");
        phF.$form.removeClass("d-none");
        phF.$queryForm.addClass("d-none");
        phF.$queryCritirya.addClass("d-none");
        phF.$queryResult.addClass("d-none");
        phF.$queryTable.addClass("d-none");
        phF.$TablePager.addClass("d-none");
        phF.$queryTable.html('');
        phF.$formAlert.html('');
      } else if (toogleType === PhF_Toogle_Query) {
        $("#" + phF.options.btns.submit).addClass("d-none");
        $("#" + phF.options.btns.search).addClass("d-none");
        $("#" + phF.options.btns.execute).removeClass("d-none");
        $("#pager").addClass("d-none");
        $("#" + phF.options.btns.delete).addClass("d-none");
        $("#" + phF.options.btns.reset).removeClass("d-none");
        $("#" + phF.options.btns.attache).addClass("d-none");
        phF.$entryForm.addClass("d-none");
        phF.$form.addClass("d-none");
        phF.$queryForm.removeClass("d-none");
        phF.$queryCritirya.removeClass("d-none");
        phF.$queryResult.addClass("d-none");
        phF.$queryTable.addClass("d-none");
        phF.$TablePager.addClass("d-none");
        $("#ph_divexecute").removeClass("d-none");
        phF.$formAlert.html('');
      } else if (toogleType === PhF_Toogle_Execute) {
        $("#" + phF.options.btns.submit).addClass("d-none");
        $("#" + phF.options.btns.search).addClass("d-none");
        $("#" + phF.options.btns.execute).removeClass("d-none");
        $("#pager").addClass("d-none");
        $("#" + phF.options.btns.delete).addClass("d-none");
        $("#" + phF.options.btns.reset).removeClass("d-none");
        $("#" + phF.options.btns.attache).addClass("d-none");
        phF.$entryForm.addClass("d-none");
        phF.$form.addClass("d-none");
        phF.$queryForm.removeClass("d-none");
        phF.$queryCritirya.removeClass("d-none");
        phF.$queryResult.removeClass("d-none");
        phF.$queryTable.removeClass("d-none");
        phF.$TablePager.removeClass("d-none");
        phF.$formAlert.html('');
      } else if (toogleType === PhF_Toogle_Edite) {
        $("#" + phF.options.btns.submit).removeClass("d-none");
        $("#" + phF.options.btns.search).removeClass("d-none");
        $("#" + phF.options.btns.execute).addClass("d-none");
        $("#pager").removeClass("d-none");
        $("#" + phF.options.btns.delete).removeClass("d-none");
        $("#" + phF.options.btns.reset).addClass("d-none");
        $("#" + phF.options.btns.attache).removeClass("d-none");
        phF.$entryForm.removeClass("d-none");
        phF.$form.removeClass("d-none");
        phF.$queryForm.addClass("d-none");
        phF.$queryCritirya.addClass("d-none");
        phF.$queryResult.addClass("d-none");
        phF.$queryTable.addClass("d-none");
        phF.$TablePager.addClass("d-none");
        phF.$queryTable.html('');
        $("#ph_divdelete").removeClass("d-none");
        phF.formAlert();
      }
    }
  };

  phF.showHeadSpinner = function (show = true) {
    if (show) {
      $('#head-spinner').removeClass('d-none');
    } else {
      $('#head-spinner').addClass('d-none');
  }
  };

  phF.openNew = function () {
    for (let index = 0; index < phF.aEntryFlds.length; index++) {
      if (phF.aEntryFlds[index].hasOwnProperty('options')) {
        $('#' + phF.aEntryFlds[index].element).val($('#' + phF.aEntryFlds[index].element + ' option:first').val());
      } else {
        $('#' + phF.aEntryFlds[index].element).val(phF.aEntryFlds[index].defValue);
      }
      if (phF.aEntryFlds[index].hasOwnProperty("rElement")) {
        $('#' + phF.aEntryFlds[index].rElement).val(phF.aEntryFlds[index].defValue);
      }
    }
    if (phF.options.type === PhF_Type_MstTrn) {
      phF.phTable.phT.setData([]);
    }
    phF.toogle(PhF_Toogle_New);
    if (phF.options.type === PhF_Type_Tree) {
      phF.refreshTree();
    }
  };

  phF.resetQuery = function () {
    for (let index = 0; index < phF.aQryFlds.length; index++) {
      $('#' + phF.container + 'QFld' + phF.aQryFlds[index].element).val($('#' + phF.container + 'QFld' + phF.aQryFlds[index].element + ' :first').val());
      phF.showSecondField(phF.container + 'QFld' + phF.aQryFlds[index].element);
      $('#' + phF.container + 'QFld' + phF.aQryFlds[index].element + '1').val(phF.aQryFlds[index].defValue);
      $('#' + phF.container + 'QFld' + phF.aQryFlds[index].element + '1').val(phF.aQryFlds[index].defValue);
    }
    phF.toogle(PhF_Toogle_Query);
  };

  phF.renderTableQuery = function () {
    let vHtml = '';
    if (phF.aResultData.length !== 0 && phF.aResultData !== undefined && phF.aResultData !== null) {
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
      $(".edit-item").click(function (e) {
        e.preventDefault();
        phF.doGetData(parseInt($(this).data('id')), parseInt($(this).data('index')));
      });
      $("#table-pager-all").html(phF.tablePageCount);
      $("#table-pager-current").html(phF.tablePageCurrent);
      $("#table-pager-dep").html('Total  Records ' + phF.tableRowDataCount);
    } else {
      phF.queryAlert();
    }
  };

  phF.renderTableHeader = function () {
    let vTableHead = '';
    vTableHead += '<tr>';
    vTableHead += ' <td style="width: 4%;">#</td>';
    vTableHead += ' <td style="width: 4%;"></td>';
    let width = parseInt(90 / phF.aEntryFlds.length);
    for (let index = 1; index < phF.aEntryFlds.length; index++) {
      if (phF.aEntryFlds[index].hasOwnProperty('label')) {
        vTableHead += ' <td style="width:' + width + '%;">' + phF.aEntryFlds[index].label + '</td>';
      }
    }
    vTableHead += '</tr>';
    return vTableHead;
  };

  phF.renderTableBody = function () {
    let vTableBady = '';
    for (let index = 0; index < phF.aResultData.length; index++) {
      vTableBady += '<tr>';
      vTableBady += ' <td style="width: 4%;">' + parseInt(index + 1) + '</td>';
      vTableBady += ' <td style="width: 4%;">';
      vTableBady += '   <a href="javascript:;" class="btn btn-primary toolbar-btn btn-sm edit-item" data-id="' + phF.aResultData[index].id + '" data-index="' + index + '">';
      vTableBady += '    <i class="bi bi-pencil"></i>';
      vTableBady += '   </a>';
      vTableBady += ' </td>';
      for (let i = 0; i < phF.aEntryFlds.length; i++) {
        if (phF.aResultData[index].hasOwnProperty(phF.aEntryFlds[i].field)
                && phF.aEntryFlds[i].field !== 'id' && phF.aEntryFlds[i].hasOwnProperty('label')) {
          if (phF.aResultData[index][phF.aEntryFlds[i].field] === null) {
            phF.aResultData[index][phF.aEntryFlds[i].field] = '';
          }
          if (phF.aEntryFlds[i].hasOwnProperty("rField")) {
            vTableBady += ' <td style="width: ' + phF.aEntryFlds[i].tablewidth + '%;">' + phF.aResultData[index][phF.aEntryFlds[i].rField] + '</td>';
          } else {
            vTableBady += ' <td style="width: ' + phF.aEntryFlds[i].tablewidth + '%;">' + phF.aResultData[index][phF.aEntryFlds[i].field] + '</td>';
          }
        }
      }
      vTableBady += '</tr>';
    }
    return vTableBady;
  };

  phF.doSave = function (Action) {
    let method = '';
    let url = '';
    phF.validated = true;
    if (Action === PhF_Action_New) {
      method = phF.aURL.New.Method;
      url = phF.URL + phF.aURL.New.URL;
    } else if (Action === PhF_Action_Update) {
      method = phF.aURL.Update.Method;
      url = phF.URL + phF.aURL.Update.URL;
    }
    phF.aData = phF.getEntryData(Action);
    if (phF.validated) {
      phF.showHeadSpinner(true);
      $.ajax({
        type: method,
        url: url,
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'Authorization': PhSettings.Headers.Authorization
        },
        data: JSON.stringify(phF.aData),
        success: function (response) {
          phF.showHeadSpinner(false);
          if (response.status) {
            if (Action === PhF_Action_New) {
              showToast(getLabel('ADDED'), 'SUCCESS', getLabel(response.message));
              phF.openNew();
            } else if (Action === PhF_Action_Update) {
              showToast(getLabel('UPDATED'), 'SUCCESS', getLabel(response.message));
            }
            if (phF.options.type === PhF_Type_Tree) {
              phF.refreshTree();
            }
            phF.aDeletedData = [];
          } else {
            if (Action === PhF_Action_New) {
              showToast(getLabel('ADD FAILED'), 'DANGER', getLabel(response.message));
            } else if (Action === PhF_Action_Update) {
              showToast(getLabel('UPDATE FAILED'), 'DANGER', getLabel(response.message));
            }
          }
        },
        error: function (response) {
          phF.showHeadSpinner(false);
        }
      });
    }
    ;
  };

  phF.doGetData = function (Id, index) {
    let method = phF.aURL.Get.Method;
    let url = phF.URL + phF.aURL.Get.URL + Id;
    if (phF.aURL.hasOwnProperty('VGet')) {
      url = phF.URL + phF.aURL.VGet.URL + Id;
    } else if (metta.aURL.hasOwnProperty('VApi')) {
      url = phF.VURL + phF.aURL.Get.URL + Id;
    }
    phF.showHeadSpinner(true);
    $.ajax({
      type: method,
      url: url,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': PhSettings.Headers.Authorization
      },
      success: function (response) {
        phF.showHeadSpinner(false);
        if (response.status) {
          phF.aResultData = response.data.Obj;
          if (phF.options.type === PhF_Type_MstTrn) {
            phF.phTable.phT.setData(response.data.Obj.vList);
          }
          phF.cellEditClick(index);
        } else {
          phF.getMessage();
        }
      },
      error: function (response) {
        phF.showHeadSpinner(false);
      }
    });
  };

  phF.doSearch = function () {
    phF.tableRowCount = $('#table-pager-count').val();
    let method = phF.aURL.Search.Method;
    let url = phF.URL + phF.aURL.Search.URL + '?page=' + phF.tablePageCurrent + '&' + 'size=' + phF.tableRowCount;
    if (metta.aURL.hasOwnProperty('VApi')) {
      url = phF.VURL + phF.aURL.Search.URL + '?page=' + phF.tablePageCurrent + '&' + 'size=' + phF.tableRowCount;
    }
    phF.showHeadSpinner(true);
    $.ajax({
      type: method,
      url: url,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': PhSettings.Headers.Authorization
      },
      data: JSON.stringify(
              phF.aData = phF.getQueryData()
              ),
      success: function (response) {
        phF.showHeadSpinner(false);
        if (response.status && parseInt(response.code) === 200) {
          phF.aResultData = response.data.List;
          phF.tableRowDataCount = response.data.Count;
          phF.toogle(PhF_Toogle_Execute);
          phF.renderTableQuery();
        } else {
          phF.queryAlert();
        }
      },
      error: function (response) {
        phF.showHeadSpinner(false);
      }
    });
  };

  phF.doPager = function () {
    let method = phF.aURL.Search.Method;
    let url = phF.URL + phF.aURL.Search.URL + '?page=' + phF.tablePageCurrent + '&' + 'size=' + phF.tableRowCount;
    if (metta.aURL.hasOwnProperty('VApi')) {
      url = phF.VURL + phF.aURL.Search.URL + '?page=' + phF.tablePageCurrent + '&' + 'size=' + phF.tableRowCount;
    }
    phF.showHeadSpinner(true);
    $.ajax({
      type: method,
      url: url,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': PhSettings.Headers.Authorization
      },
      data: JSON.stringify(
              phF.aData = phF.getQueryData()
              ),
      success: function (response) {
        phF.showHeadSpinner(false);
        if (response.status) {
          phF.aResultData = response.data.List[0];
          if (phF.options.type === PhF_Type_MstTrn) {
            phF.phTable.phT.setData(response.data.List[0].vList);
          }
          phF.cellPagerClick(phF.tablePageCurrent - 1);
        } else {
          phF.getMessage();
        }
      },
      error: function (response) {
        phF.showHeadSpinner(false);
      }
    });
  };

  phF.doDelete = function (Id) {
    let method = phF.aURL.Delete.Method;
    let url = phF.URL + phF.aURL.Delete.URL + Id;
    phF.showHeadSpinner(true);
    $.ajax({
      type: method,
      url: url,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': PhSettings.Headers.Authorization
      },
      success: function (response) {
        phF.showHeadSpinner(false);
        if (response.status) {
          showToast(getLabel('DELETED'), 'SUCCESS', getLabel(response.message));
          if (phF.options.type === PhF_Type_Tree) {
            phF.refreshTree();
          }
          phF.openNew();
        } else {
          showToast(getLabel('DELETE FAILED'), 'DANGER', getLabel(response.message));
        }
      },
      error: function (response) {
        phF.showHeadSpinner(false);
      }
    });
  };

  phF.cellEditClick = function (nIndex) {
    for (let index = 0; index < phF.aEntryFlds.length; index++) {
      if (phF.aResultData.hasOwnProperty(phF.aEntryFlds[index].field)) {
        $('#' + phF.aEntryFlds[index].element).val(phF.aResultData[phF.aEntryFlds[index].field]);
        if (phF.aEntryFlds[index].hasOwnProperty("rElement")) {
          $('#' + phF.aEntryFlds[index].rElement).val(phF.aResultData[phF.aEntryFlds[index].rField]);
        }
      }
    }
    phF.tablePageCurrent = (phF.tablePageCurrent - 1) * phF.tableRowCount + nIndex + 1;
    $('#ph-fpager-current').html(phF.tablePageCurrent);
    $('#ph-fpager-all').html(phF.tableRowDataCount);
    phF.toogle(PhF_Toogle_Edite);
    toogleType = PhF_Toogle_New;
  };

  phF.cellPagerClick = function (nIndex) {
    for (let index = 0; index < phF.aEntryFlds.length; index++) {
      $('#' + phF.aEntryFlds[index].element).val(phF.aResultData[phF.aEntryFlds[index].field]);
      if (phF.aEntryFlds[index].hasOwnProperty("rElement")) {
        $('#' + phF.aEntryFlds[index].rElement).val(phF.aResultData[phF.aEntryFlds[index].rField]);
      }
    }
    phF.tablePageCurrent = nIndex + 1;
    $('#ph-fpager-current').html(phF.tablePageCurrent);
    $('#ph-fpager-all').html(phF.tableRowDataCount);
    phF.formAlert();
    phF.toogle(PhF_Toogle_Edite);
    toogleType = PhF_Toogle_New;
  };

  phF.getEntryData = function (Action) {
    let mst = {};
    let form = select('#' + phF.container + 'Form');
    form.classList.remove('was-phF.validated');
    if (isValidForm(phF.container + 'Form')) {
      for (let index = 0; index < phF.aEntryFlds.length; index++) {
        if (phF.aEntryFlds[index].hasOwnProperty('value')) {
          mst[phF.aEntryFlds[index].field] = phF.aEntryFlds[index].value;
        } else {
          mst[phF.aEntryFlds[index].field] = $('#' + phF.aEntryFlds[index].element).val();
        }
      }
      if (phF.options.type === PhF_Type_MstTrn) {
        mst.aList = phF.phTable.phT.getRows();
        if (Action === PhF_Action_Update) {
          mst.forDelete = phF.phTable.phT.getDeleted();
        }
      }
      phF.validated = true;
      return mst;
    } else {
      form.classList.add('was-phF.validated');
      phF.validated = false;
    }
  };

  phF.getQueryData = function () {
    let aQData = [];
    let idx = 0;
    for (let index = 0; index < phF.aQryFlds.length; index++) {
      let fld = phF.aQryFlds[index];
      let fldId = phF.container + 'QFld' + fld.element;
      if ($("#" + fldId + '1').val() !== '' && $("#" + fldId + '1').val() !== null) {
        aQData[idx] = {};
        aQData[idx].fieldName = fld.field;
        aQData[idx].operation = $("#" + fldId).val();
        aQData[idx].value1 = $("#" + fldId + '1').val();
        aQData[idx].value2 = '';
        if (($("#" + fldId).val() === '<>' ||
                $("#" + fldId).val() === '><') &&
                ($("#" + fldId + '2').val() !== '' && $("#" + fldId + '2').val() !== null)) {
          aQData[idx].value2 = $("#" + fldId + '2').val();
        }
        idx++;
      }
    }
    return aQData;
  };

  phF.getMessage = function () {
    swal.fire({
      title: getLabel('Page NOT Found !!'),
      text: getLabel(''),
      icon: "error"
    });
    $('#pager-all').html();
  };

  phF.formAlert = function () {
    let formAlert = '';
    for (let index = 0; index < phF.aEntryFlds.length; index++) {
      if (phF.aEntryFlds[index].hasOwnProperty('alert') &&
              phF.aResultData.hasOwnProperty(phF.aEntryFlds[index].field) &&
              phF.aResultData[phF.aEntryFlds[index].field] === phF.aEntryFlds[index].alert.value) {
        formAlert = phF.aEntryFlds[index].alert.message;
        phF.$formAlert.text(formAlert);
        break;
      }
    }
  };

  phF.queryAlert = function () {
    let queryAlert = '';
    queryAlert = '<h4 class="text-center text-danger">' + getLabel('There are no results matching your search options') + '</h4>';
    phF.toogle(PhF_Toogle_Execute);
    phF.$TablePager.addClass('d-none');
    phF.$queryTable.html(queryAlert);
  };

  phF.buildTree = function () {
    $("#treeView").jstree({
      "core": {
        "themes": {
          "responsive": false
        },
        // so that create works
        "check_callback": true
      },
      "types": {
        "default": {
          "icon": "bi bi-file-earmark text-success"
        },
        "1": {
          "icon": "bi bi-folder2-open text-warning"
        },
        "2": {
          "icon": "bi bi-file-earmark text-success"
        }
      },
      "search": {
        "show_only_matches": true
      },
      "state": {
        "key": "acc"
      },
      "plugins": ["state", "types", "search"]
    }).on("changed.jstree", function (e, jsdata) {
      if (jsdata.selected.length) {
        let data = jsdata.instance.get_node(jsdata.selected[0]).data;
        for (let index = 0; index < phF.aEntryFlds.length; index++) {
          if (data.hasOwnProperty(phF.aEntryFlds[index].field)) {
            $('#' + phF.aEntryFlds[index].element).val(data[phF.aEntryFlds[index].field]);
          }
        }
      }
    });
    phF.refreshTree();
  };

  phF.refreshTree = function () {
    let method = phF.aURL.Tree.Method;
    let url = phF.URL + phF.aURL.Tree.URL;
    $('#loader').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
    $.ajax({
      type: method,
      url: url,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': PhSettings.Headers.Authorization
      },
      success: function (response) {
        if (response.status) {
          $('#loader').html('');
          $('#treeView').jstree(true).settings.core.data = response.data.tree;
          $('#treeView').jstree(true).refresh();
        }
      },
      error: function (response) {
        try {
          $('#loader').html('');
          let res = JSON.parse(response);
          swal.fire({
            text: res.Message,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: getLabel('OK'),
            confirmButtonClass: "btn font-weight-bold btn-light-primary"
          }).then(function () {
            KTUtil.scrollTop();
          });
        } catch (ex) {
        }
      }
    });
  };

  phF.getTreeNode = function () {
    let Id = $('#' + phF.aEntryFlds[0].element).val();
    let method = phF.aURL.NewNum.Method;
    let url = phF.URL + phF.aURL.NewNum.URL + Id;
    $.ajax({
      type: method,
      url: url,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': PhSettings.Headers.Authorization
      },
      success: function (response) {
        if (response.status) {
          phF.aResultData = response.data;
          for (let i = 0; i < phF.aEntryFlds.length; i++) {
            if (phF.aResultData.hasOwnProperty(phF.aEntryFlds[i].field)) {
              $('#' + phF.aEntryFlds[i].element).val(phF.aResultData[phF.aEntryFlds[i].field]);
            } else {
              $('#' + phF.aEntryFlds[i].element).val(phF.aEntryFlds[i].defValue);
            }
          }
        }
      },
      error: function (response) {
      }
    });
  };

  phF.renderESelect = function () {
    let vHtml = '';
    for (var i = 0; i < phF.aEntryFlds.length; i++) {
      if (phF.aEntryFlds[i].hasOwnProperty('options')) {
        vHtml = '';
        for (var j = 0; j < phF.aEntryFlds[i].options.length; j++) {
          vHtml += '<option value="' + phF.aEntryFlds[i].options[j].id + '">' + phF.aEntryFlds[i].options[j].name + '</option>';
        }
        $('#' + phF.aEntryFlds[i].element).html(vHtml);
      }
    }
  };

  phF.render();
  phF.renderESelect();
  phF.jqReady();
};
