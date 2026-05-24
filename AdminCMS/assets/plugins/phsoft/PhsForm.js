/* global bootstrap, swal */

const PhsForm = (container, metta) => {
  'use strict';
  /*----------------------------------------------------------------------------------------------------
   * Declare Variables
   ----------------------------------------------------------------------------------------------------*/
  const formId = 'phsForm-' + ((Math.floor(Math.random() * 999) + 100) + Date.now());
  let formModal;
  let viewType = parseInt(metta.viewType);
  /*----------------------------------------------------------------------------------------------------
   * Eazy Selector
   ----------------------------------------------------------------------------------------------------*/
  const select = (el, all = false) => {
    el = el.trim();
    if (all) {
      return [...document.querySelectorAll(el)];
    } else {
      return document.querySelector(el);
  }
  };
  /*----------------------------------------------------------------------------------------------------
   * Easy event listener
   ----------------------------------------------------------------------------------------------------*/
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => {
        e.removeEventListener(type, listener);
        e.addEventListener(type, listener);
      });
    } else {
      select(el, all).removeEventListener(type, listener);
      select(el, all).addEventListener(type, listener);
  }
  };
  /*----------------------------------------------------------------------------------------------------
   * Check is form is validated
   ----------------------------------------------------------------------------------------------------*/
  const isValidForm = (formId) => {
    let isValid = false;
    let form = select('#' + formId);
    if (form) {
      form.classList.remove('was-validated');
      isValid = form.checkValidity();
      if (!isValid) {
        form.classList.add('was-validated');
        let formControl = select('#' + formId + ' .form-control:invalid,.form-select:invalid', true);
        formControl.forEach(formcontrol => {
          formcontrol.classList.add('invalid');
        });
      }
    }
    return isValid;
  };
  /*----------------------------------------------------------------------------------------------------
   * Reset Form
   ----------------------------------------------------------------------------------------------------*/
  const resetFormValid = (formId) => {
    let form = select('#' + formId);
    if (form) {
      form.classList.remove('was-validated');
      let formControl = select('#' + formId + ' .form-control:invalid,.form-select:invalid', true);
      formControl.forEach(formcontrol => {
        formcontrol.classList.remove('invalid');
      });
    }
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Page Toolbar
   ----------------------------------------------------------------------------------------------------*/
  const renderPageToolbar = () => {
    let newBtn = '';
    if (metta.Perms.Insert) {
      newBtn = `<span id="${formId}-ph-new" class="btn btn-warning mx-1" data-toggle="tooltip" data-placement="bottom" title="${getLabel("New")}">
                  <i class="bi bi-file-earmark"></i>
                </span>`;
    }
    return `<div class="pagetitle">
              <div class="row">
                <div class="col-12 col-sm-3">
                  <div class="row">
                    <div class="col-12">
                      <h1>${metta.Title}</h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      ${metta.BreadCrumb}
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-start">
                </div>
                <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center">
                </div>
                <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-end">
                  ${newBtn}
                </div>
              </div>
            </div>`;
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Page Search bar
   ----------------------------------------------------------------------------------------------------*/
  const renderSearchBar = () => {
    let vSearch = '';
    if (metta.Perms.Query) {
      vSearch = `<input id="${formId}-ph-search-text" class="form-control form-control-sm text-center" type="text" value="" autocomplete="off" required="true" />`;
    }
    return `<div class="container">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card card-custom">
                    <div class="card-body">
                      <div class="row mb-2 pb-2 d-flex align-items-center">
                        <div class="col-sm-2 text-center">
                          <!--<span id="${formId}-view-type-0" class="${formId}-view-type btn${viewType === 0 ? ' btn-info' : ''}" ph-viewtype-value="0"><i class="bi bi-grid"></i></span>-->
                          <!--<span id="${formId}-view-type-1" class="${formId}-view-type btn${viewType === 1 ? ' btn-info' : ''}" ph-viewtype-value="1"><i class="bi bi-hdd-stack"></i></span>-->
                          <!--<span id="${formId}-view-type-2" class="${formId}-view-type btn${viewType === 2 ? ' btn-info' : ''}" ph-viewtype-value="2"><i class="bi bi-view-stacked"></i></span>-->
                          <!--<span id="${formId}-view-type-3" class="${formId}-view-type btn${viewType === 3 ? ' btn-info' : ''}" ph-viewtype-value="3"><i class="bi bi-justify"></i></span>-->
                        </div>
                        <div class="col-sm-8 text-center">
                          ${vSearch}
                        </div>
                        <div class="col-sm-2 text-center">
                        </div>
                      </div>
                      <div class="row g-3" id="${formId}-resultData">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>`;
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Page Form
   ----------------------------------------------------------------------------------------------------*/
  const renderForm = () => {
    if (metta.hasImage) {
      return `<form id="${formId}-ph_Form">
                <div class="row">
                  <input id="${formId}-fldId" type="hidden" value="0" required="true" />
                </div>
                <div class="row pt-1">
                  <div class="col-sm-8 py-2">
                    ${renderRows()}
                  </div>
                  <div class="col-sm-4 text-center">
                    ${renderImageField()}
                  </div>
                </div>
              </form>`;
    } else {
      return `<form id="${formId}-ph_Form">
                <div class="row">
                  <input id="${formId}-fldId" type="hidden" value="0" required="true" />
                </div>
                <div class="row pt-1">
                  <div class="col-12 py-2">
                    ${renderRows()}
                  </div>
                </div>
              </form>`;
    }
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Input Element
   ----------------------------------------------------------------------------------------------------*/
  const renderInput = (fld) => {
    return `<div class="col-sm-${fld.FldCols}">
              <input id="${formId}-fld${fld.Fld}" class="form-control form-control-sm" type="text" value="" autocomplete="off" ${fld.Required ? `required="true"` : ``}/>
            </div>`;
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Input Element
   ----------------------------------------------------------------------------------------------------*/
  const renderTextarea = (fld) => {
    return `<div class="col-sm-${fld.FldCols}">
              <textarea id="${formId}-fld${fld.Fld}" class="form-control form-control-sm" type="text" value="" autocomplete="off" ${fld.Required ? `required="true"` : ``} rows="10"></textarea>
            </div>`;
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Select Element
   ----------------------------------------------------------------------------------------------------*/
  const renderSelect = (fld) => {
    return `<div class="col-sm-${fld.FldCols}">
              <select id="${formId}-fld${fld.Fld}" class="form-control form-control-sm form-select">
               ${fld.Options.map(item => `<option value="${item.Id}">${item.Name}</option>`).join('')}
              </select>
            </div>`;
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Image
   ----------------------------------------------------------------------------------------------------*/
  const renderImageField = () => {
    return `<div class="row">
              <div class="col-sm-6 mx-auto p-2">
                <label for="${formId}-fldFile" class="btn btn-primary" data-toggle="tooltip" title="${getLabel('Change Image')}" data-original-title="${getLabel('Change Image')}">
                  ${getLabel('Change Image')} <i class="bi bi-file-image"></i>
                </label>
                <input id="${formId}-fldImage" class="form-control form-control-sm" type="hidden" value="" autocomplete="off" required="true" />
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="w-100 p-0 text-center">
                  <input id="${formId}-fldFile" type="file" class="fileField d-none" accept="image/*" value="" data-previewer="${formId}-fldImagePreview" data-relfld="${formId}-fldAttach" data-filename="${formId}-fldFileName"  data-relname="${formId}-fldFName" data-relext="${formId}-fldFExt" data-folder="${formId}-itemcat">
                  <input id="${formId}-fldFName" type="hidden" value="">
                  <input id="${formId}-fldFileName" type="hidden" value="">
                  <input id="${formId}-fldFExt" type="hidden" value="">
                  <input id="${formId}-fldAttach" type="hidden" value="">
                  <img id="${formId}-fldImagePreview" class="border border-info border-1" src="" width="50%">
                </div>
              </div>
            </div>`;
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Fields
   ----------------------------------------------------------------------------------------------------*/
  const renderFields = (aFlds) => {
    return aFlds.map(fld => {
      let vHTML = ``;
      if (fld.Visible) {
        vHTML = `<label for="${formId}-fldld" class="col-form-label col-sm-${fld.LblCols} text-center text-sm-end ${fld.Classes}">${fld.Label}</label>`;
        if (fld.Component === 'select') {
          vHTML += renderSelect(fld);
        } else if (fld.Component.toString().toLowerCase() === 'textarea'.toString().toLowerCase()) {
          vHTML += renderTextarea(fld);
        } else {
          vHTML += renderInput(fld);
        }
      }
      return vHTML;
    }).join('');
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Rows
   ----------------------------------------------------------------------------------------------------*/
  const renderRows = () => {
    return metta.Rows.map(row => `<div class="row ${row.Classes}">${renderFields(row.aFlds)}</div>`).join('');
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Modal
   ----------------------------------------------------------------------------------------------------*/
  const renderModal = () => {
    return `<div class="modal fade" id="${formId}-ph_Modal" tabindex="-1" role="dialog" aria-labelledby="${formId}-ph_Modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-${metta.ModalSize}" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="${formId}-ph_ModalLabel">${metta.Title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        ${renderForm()}
                      </div>
                    </div>
                  </div>
                  <div class="ph-modal-footer">
                    <div class="row pt-1">
                      <div class="col-4 pt-1 pt-sm-0 d-flex align-items-center justify-content-start">
                        <span id="${formId}-ph-submit" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Save")}">
                          <i class="bi bi-check-lg"></i>
                        </span>
                      </div>
                      <div class="col-4 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-start">
                      </div>
                      <div class="col-4 pt-1 pt-sm-0 d-flex align-items-center justify-content-end justify-content-sm-end">
                        <span class="btn btn-secondary" data-bs-dismiss="modal" aria-label="${getLabel("Close")}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Close")}">
                          <i class="bi bi-box-arrow-left"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>`;
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Page
   ----------------------------------------------------------------------------------------------------*/
  const render = () => {
    select('#' + container).innerHTML = renderPageToolbar() + renderSearchBar() + renderModal();
    formModal = new bootstrap.Modal('#' + formId + '-ph_Modal', {});
  };
  /*----------------------------------------------------------------------------------------------------
   * Render Initial Events
   ----------------------------------------------------------------------------------------------------*/
  const initEvents = () => {

    on('click', '.' + formId + '-view-type', function (e) {
      e.preventDefault();
      let newViewType = this.getAttribute('ph-viewtype-value') ? parseInt(this.getAttribute('ph-viewtype-value')) : 0;
      if (parseInt(viewType) !== parseInt(newViewType)) {
        select('.' + formId + '-view-type', true).forEach(e => e.classList.remove('btn-info'));
        select('#' + formId + '-view-type-' + newViewType).classList.add('btn-info');
        viewType = newViewType;
        search(select('#' + formId + '-ph-search-text').value);
      }
    }, true);
    if (metta.Perms.Query) {
      on('keyup', '#' + formId + '-ph-search-text', function (e) {
        e.preventDefault();
        search(this.value);
      });
    }

    if (metta.Perms.Insert) {
      on('click', '#' + formId + '-ph-new', function (e) {
        e.preventDefault();
        doNew();
        formModal.show();
      });
    }

    if (metta.Perms.Insert || metta.Perms.Update) {
      on('click', '#' + formId + '-ph-submit', function (e) {
        e.preventDefault();
        doSave();
      });
    }

  };
  /*----------------------------------------------------------------------------------------------------
   * Actions
   ----------------------------------------------------------------------------------------------------*/
  const doSave = () => {
    if (isValidForm(formId + '-ph_Form')) {
      let aData = {};
      aData['nId'] = parseInt(select('#' + formId + '-fldId').value);
      metta.Rows.map(row => {
        row.aFlds.map(fld => {
          if (fld.Visible) {
            aData[fld.Param] = select('#' + formId + '-fld' + fld.Fld).value;
          }
        });
      });
      if (metta.hasImage) {
        aData['vFExt'] = select('#' + formId + '-fldFExt').value;
        aData['vFName'] = select('#' + formId + '-fldFName').value;
        aData['vFile'] = select('#' + formId + '-fldAttach').value;
      }
      let vMethod = metta.URLS.Update.Method;
      let vURL = metta.BaseURL + metta.URLS.Update.URL;
      if (aData['nId'] === 0) {
        vMethod = metta.URLS.New.Method;
        vURL = metta.BaseURL + metta.URLS.New.URL;
      }
      $.ajax({
        async: false,
        type: vMethod,
        url: vURL,
        data: aData,
        success: function (response) {
          if (response.Status) {
            doNew();
            search(select('#' + formId + '-ph-search-text').value);
            showToast(getLabel('Save'), 'WARNING', response.Message);
          } else {
            showToast(getLabel('Error'), 'DANGER', response.Message);
          }
        }
      });
    }

  };
  const doNew = () => {
    resetFormValid(formId + '-ph_Form');
    $('#ph_Form').trigger('reset');
    $('#ph_Form').removeClass('was-validated');
    select('#' + formId + '-fldId').value = 0;
    metta.Rows.map(row => {
      row.aFlds.map(fld => {
        if (fld.Visible) {
          select('#' + formId + '-fld' + fld.Fld).value = fld.DefaultValue;
        }
      });
    });
    if (metta.hasImage) {
      select('#' + formId + '-fldFExt').value = '';
      select('#' + formId + '-fldFName').value = '';
      select('#' + formId + '-fldAttach').value = '';
      select('#' + formId + '-fldImagePreview').setAttribute('src', metta.ImagePath + metta.DefaultImage);
    }
  };
  const doEdit = (nId) => {
    if (nId > 0) {
      $.ajax({
        async: false,
        type: metta.URLS.Get.Method,
        url: metta.BaseURL + metta.URLS.Get.URL,
        data: {
          "nId": nId
        },
        success: function (response) {
          if (response.Status) {
            doNew();
            let item = response.Data;
            select('#' + formId + '-fldId').value = item['nId'];
            metta.Rows.map(row => {
              row.aFlds.map(fld => {
                if (fld.Visible) {
                  select('#' + formId + '-fld' + fld.Fld).value = item[fld.Param];
                }
              });
            });
            if (metta.hasImage) {
              select('#' + formId + '-fldImagePreview').setAttribute('src', metta.ImagePath + item.vImage);
            }
            formModal.show();
          } else {
            showToast(getLabel('Error'), 'DANGER', response.Message);
          }
        }
      });
    }
  };
  const doDelete = (nId) => {
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
            type: metta.URLS.Delete.Method,
            url: metta.BaseURL + metta.URLS.Delete.URL,
            data: {
              "nId": nId
            },
            success: function (response) {
              if (response.Status) {
                search(select('#' + formId + '-ph-search-text').value);
                showToast(getLabel('Delete'), 'SUCCESS', response.Message);
              } else {
                showToast(getLabel('Error'), 'DANGER', response.Message);
              }
            }
          });
        } else if (result.dismiss === "cancel") {
        }
      });
    }

  };
  /*----------------------------------------------------------------------------------------------------
   * Render Data List
   ----------------------------------------------------------------------------------------------------*/
  const renderEditBtn = (item) => {
    let editBtn = '';
    if (metta.Perms.Update) {
      editBtn = `<td><span class="btn btn-success ${formId}-btn-edit" ph-rel-id="${item.nId}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Edit")}"><i class="bi bi-pencil"></i></span></td>`;
    }
    return editBtn;
  };
  const renderDeleteBtn = (item) => {
    let deleteBtn = '';
    if (metta.Perms.Delete) {
      deleteBtn = `<td><span class="btn btn-danger ${formId}-btn-delete" ph-rel-id="${item.nId}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("Delete")}"><i class="bi bi-trash"></i></span></td>`;
    }
    return deleteBtn;
  };
  const renderDataAsRow = (item) => {
    let vHTML = `<div class="col-12 p-1 mx-auto">
                  <div class="card card-custom result-card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <table class="table">
                            <thead>
                              <tr>
                                ${metta.Perms.Update ? `<th></th>` : ''}
                                ${metta.ListFlds.map(fld => `<th class="text-center" style="width: ${fld.LineCols}%;">${fld.Label}</th>`).join('')}
                                ${metta.Perms.Delete ? `<th></th>` : ''}
                              </tr>
                            </thead>
                            <tbody>
                                ${aData.map(item =>
      `<tr>
        ${renderEditBtn(item)}
        ${metta.ListFlds.map(fld => `<td class="text-center ${fld.Classes}">${item[fld.Param]}</td>`).join('')}
        ${renderDeleteBtn(item)}
      <tr>`
    ).join('')}
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>`;
    return vHTML;
  };
  const renderDataAsBlock = (item) => {
    let vHTML = `<div class="col-12 p-1 mx-auto">
                  <div class="card card-custom result-card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <table class="table">
                            <thead>
                              <tr>
                                ${metta.Perms.Update ? `<th></th>` : ''}
                                ${metta.ListFlds.map(fld => `<th class="text-center" style="width: ${fld.LineCols}%;">${fld.Label}</th>`).join('')}
                                ${metta.Perms.Delete ? `<th></th>` : ''}
                              </tr>
                            </thead>
                            <tbody>
                                ${aData.map(item =>
      `<tr>
        ${renderEditBtn(item)}
        ${metta.ListFlds.map(fld => `<td class="text-center ${fld.Classes}">${item[fld.Param]}</td>`).join('')}
        ${renderDeleteBtn(item)}
      <tr>`
    ).join('')}
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>`;
    return vHTML;
  };
  const renderDataAsLine = (aData) => {
    let vHTML = `<div class="col-12 p-1 mx-auto">
                  <div class="card card-custom result-card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <table class="table">
                            <thead>
                              <tr>
                                ${metta.Perms.Update ? `<th></th>` : ''}
                                ${metta.ListFlds.map(fld => `<th class="text-center" style="width: ${fld.LineCols}%;">${fld.Label}</th>`).join('')}
                                ${metta.Perms.Delete ? `<th></th>` : ''}
                              </tr>
                            </thead>
                            <tbody>
                                ${aData.map(item =>
      `<tr>
        ${renderEditBtn(item)}
        ${metta.ListFlds.map(fld => `<td class="text-center ${fld.Classes}">${prepareString(item[fld.Param])}</td>`).join('')}
        ${renderDeleteBtn(item)}
      <tr>`
    ).join('')}
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>`;
    return vHTML;
  };
  const renderDataAsCard = (item) => {
    let vHTML = `<div class="col-12 p-1 mx-auto">
                  <div class="card card-custom result-card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <table class="table">
                            <thead>
                              <tr>
                                ${metta.Perms.Update ? `<th></th>` : ''}
                                ${metta.ListFlds.map(fld => `<th class="text-center" style="width: ${fld.LineCols}%;">${fld.Label}</th>`).join('')}
                                ${metta.Perms.Delete ? `<th></th>` : ''}
                              </tr>
                            </thead>
                            <tbody>
                                ${aData.map(item =>
      `<tr>
        ${renderEditBtn(item)}
        ${metta.ListFlds.map(fld => `<td class="text-center ${fld.Classes}">${item[fld.Param]}</td>`).join('')}
        ${renderDeleteBtn(item)}
      <tr>`
    ).join('')}
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>`;
    return vHTML;
  };
  /*----------------------------------------------------------------------------------------------------
   * Do Search
   ----------------------------------------------------------------------------------------------------*/
  const search = (vText) => {
    $.ajax({
      async: false,
      type: metta.URLS.List.Method,
      url: metta.BaseURL + metta.URLS.List.URL,
      data: {
        "vText": vText
      },
      success: function (response) {
        if (response.Status) {
          let vHtml = '';
          switch (parseInt(viewType)) {
            case 1:
              vHtml += renderDataAsRow(response.Data);
              break;
            case 2:
              vHtml += renderDataAsBlock(response.Data);
              break;
            case 3:
              vHtml += renderDataAsLine(response.Data);
              break;
            default:
              vHtml += renderDataAsCard(response.Data);
              break;
          }
          select('#' + formId + '-resultData').innerHTML = vHtml;
          if (metta.Perms.Update) {
            on('click', '.' + formId + '-btn-edit', function (e) {
              e.preventDefault();
              doEdit(this.getAttribute("ph-rel-id"));
            }, true);
          }
          if (metta.Perms.Delete) {
            on('click', '.' + formId + '-btn-delete', function (e) {
              e.preventDefault();
              doDelete(this.getAttribute("ph-rel-id"));
            }, true);
          }
        }
      }
    });
  };
  /*----------------------------------------------------------------------------------------------------
   * Execute Page
   ----------------------------------------------------------------------------------------------------*/
  render();
  initEvents();
  search(select('#' + formId + '-ph-search-text').value);
};
