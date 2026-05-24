/* global PhSettings, Labels, swal, Swal, Toast, TOAST_STATUS */
const select = (el, all = false) => {
  el = el.trim();
  if (all) {
    return [...document.querySelectorAll(el)];
  } else {
    return document.querySelector(el);
}
};

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

const prepareString = (vString) => {
  let vRet = vString;
  if (vString) {
    vRet = vString.toString().replaceAll('\n', '<br/>');
  }
  return vRet;
};

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

function initPhTApp() {
  var arrows;
  var isRtl = true;
  if (PhSettings.display.direction === 'ltr') {
    isRtl = false;
    arrows = {
      leftArrow: '<i class="bi bi-arrow-right-short"></i>',
      rightArrow: '<i class="bi bi-arrow-left-short"></i>'
    };
  } else {
    arrows = {
      leftArrow: '<i class="bi bi-arrow-left-short"></i>',
      rightArrow: '<i class="bi bi-arrow-right-short"></i>'
    };
  }
  $('.ph_datepicker').datepicker({
    isRTL: isRtl,
    dateFormat: 'dd-mm-yy',
    minDate: new Date(2023, 0, 1),
    maxDate: new Date(2023, 11, 31),
    changeMonth: true,
    changeYear: true,
    showOtherMonths: true,
    selectOtherMonths: true
  });
  $('.datepicker-btn').off('click').on('click', function () {
    $(this).prev('.ph_datepicker').datepicker('show');
  });

  $('.logout').off('click').on('click', function (e) {
    e.preventDefault();
    $.ajax({
      type: PhSettings.logout.Method,
      async: false,
      url: PhSettings.logout.URL,
      success: function (response) {
        location.reload();
      }
    });
  });

  attacheImageFile();
}

const on = (type, el, listener, all = false) => {
  if (all) {
    select(el, all).forEach(e => e.addEventListener(type, listener));
  } else {
    select(el, all).addEventListener(type, listener);
}
};

const integerFormat = function (nValue) {
  return nValue;
  return (new Intl.NumberFormat('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 0}).format(nValue));
};

const decimalFormat = function (nValue) {
  return nValue;
  return (new Intl.NumberFormat('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(nValue));
};

const numberWithCommas = (x) => x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

function addDays(date, days) {
  let newDate = new Date(date);
  newDate.setDate(newDate.getDate() + parseInt(days));
  return newDate;
}
function currentTime() {
  return formatDate(new Date(), 'hh:ii');
}

function currentDate() {
  return formatDate(new Date(), 'dd-mm-yyyy');
}

function currentDateFormated(format) {
  return formatDate(new Date(), format);
}

function currentDateTime() {
  return formatDate(new Date(), 'dd-mm-yyyy hh:ii');
}

function formatDate(date, format) {
  const map = {
    mm: String(date.getMonth() + 1).padStart(2, '0'),
    dd: String(date.getDate()).padStart(2, '0'),
    yy: date.getFullYear().toString().slice(-2),
    yyyy: date.getFullYear().toString(),
    hh: String(date.getHours()).padStart(2, '0'),
    ii: String(date.getMinutes()).padStart(2, '0'),
    ss: String(date.getSeconds()).padStart(2, '0')
  };
  return format.replace(/mm|dd|yyyy|yy|hh|ii|ss/gi, matched => map[matched]);
}

function getLabel(vKey) {
  let vRet = vKey;
  let sKey = vKey.toLowerCase().replaceAll(" ", ".");
  if (PhSettings.Labels.hasOwnProperty(sKey)) {
    vRet = PhSettings.Labels[sKey];
  }
  return (vRet);
}

function swalToast(message, icon, position) {
  /*
   * icon: success, error, warning, info, question
   * position: top-start, top, top-end,
   *           center-start, center, center-end
   *           bottom-start, bottom, bottom-end
   */
  if (position === undefined) {
    position = 'bottom-end';
  }
  swal.fire({
    position: position,
    icon: icon,
    title: message,
    showConfirmButton: false,
    timer: 1500
  });
}

function showToast(title, color, message) {
  /*
   * position: top-left, top-center, top-eight,
   *           middle-left, middle-center, middle-right
   *           bottom-left, bottom-center, bottom-right
   */
  let toast = {
    title: title,
    message: message,
    status: TOAST_STATUS[color],
    timeout: 2000
  };
  Toast.enableQueue(true);
  Toast.setPlacement(TOAST_PLACEMENT.BOTTOM_RIGHT);
  Toast.create(toast);
}

function phAutocomplete() {
  $('.phAutocomplete').each(function (i, el) {
    var $this = $(el);
    var vOperation = $this.data('acoperation');
    var vCallback = $this.data('callback');
    var vParams = $this.data('params');
    var vField = $this.data('acrel');
    $this.autocomplete({
      source: function (request, response) {
        var oAjaxData = {};
        if (vParams !== "") {
          if (typeof window[vParams] === "function") {
            oAjaxData = window[vParams]();
          }
        }
        oAjaxData.term = request.term;
        $.ajax({
          type: 'POST',
          async: false,
          url: PhSettings.apiURL + vOperation,
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': PhSettings.Headers.Authorization
          },
          data: JSON.stringify(oAjaxData),
          success: function (ajaxResponse) {
            response(ajaxResponse.Data.List);
          }
        });
      },
      minLength: 0,
      autoFocus: true,
      focus: function (event, ui) {
        return false;
      },
      select: function (event, ui) {
        $(this).val(ui.item.label);
        if (vField !== undefined) {
          $('#' + vField).val(ui.item.value);
          if (vCallback !== "") {
            if (typeof window[vCallback] === "function") {
              window[vCallback](event, ui);
            }
          }
        }
        return false;
      }
    });
    $this.off('focus').on('focus', function () {
      if ($this.val() === '') {
        $this.autocomplete("search");
      }
    });
    $this.off('blur').on('blur', function () {
      if ($this.val() === '') {
        $('#' + vField).val('');
      }
    });
  });
}

function showAlert(message) {
  swal.fire({
    title: getLabel('تنبيه'),
    text: message,
    icon: "danger",
    confirmButtonText: "<i class='flaticon2-check-mark'></i> " + getLabel('نعم'),
    customClass: {
      confirmButton: "btn btn-danger"
    }
  });
}

function showMessage(newOptions) {
  let defaultOptions = {
    title: getLabel('Warning'),
    message: getLabel('Are.You.Sure.?'),
    yesLabel: getLabel('Yes'),
    noLabel: getLabel('No'),
    successCallback: null,
    successParameters: null,
    cancelCallback: null,
    cancelParameters: null
  };
  let options = $.extend(defaultOptions, newOptions);
  swal.fire({
    title: options.title,
    text: options.message,
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "<i class='flaticon2-check-mark'></i> " + options.yesLabel,
    cancelButtonText: "<i class='flaticon2-cross'></i> " + options.noLabel,
    reverseButtons: true,
    customClass: {
      confirmButton: "btn btn-danger",
      cancelButton: "btn btn-default"
    }
  }).then(function (result) {
    if (result.value) {
      if (options.successCallback) {
        if (typeof options.successCallback === "function") {
          options.successCallback(options.successParameters);
        }
      }
    } else if (result.dismiss === "cancel") {
      if (options.cancelCallback) {
        if (typeof options.cancelCallback === "function") {
          options.cancelCallback(options.cancelParameters);
        }
      }
    }
  });
}

function attacheFile() {
  $("body").on("change", ".fileField", function () {
    var acceptedFileSize = (1024 * 1024 * 10);
    var vRelField = $(this).data('relfld');
    var vNameField = $(this).data('relname');
    var bFile = $(this)[0].files[0];
    var fSize = $(this)[0].files[0].size;
    if (bFile && fSize <= acceptedFileSize) {
      var fileReader = new FileReader();
      fileReader.addEventListener("load", function (e) {

        $('#' + vRelField).val(e.target.result);
        $('#' + vNameField).val(bFile.name);
      });
      fileReader.readAsDataURL(bFile);
    }
  });
}

const attacheImageFile = () => {
  $("body").on("change", ".fileField", function () {
    var acceptedFileSize = (1024 * 1024 * 10);
    var vPreviewer = $(this).data('previewer');
    var vRelField = $(this).data('relfld');
    var vNameField = $(this).data('relname');
    var vExtField = $(this).data('relext');
    var bFile = $(this)[0].files[0];
    var fSize = $(this)[0].files[0].size;
    if (bFile && fSize <= acceptedFileSize) {
      var fileReader = new FileReader();
      fileReader.addEventListener("load", function (e) {
        $('#' + vPreviewer).attr('src', e.target.result);
        $('#' + vRelField).val(e.target.result);
        $('#' + vNameField).val(bFile.name);
        $('#' + vExtField).val(bFile.name.substr(bFile.name.lastIndexOf('.') + 1));
      });
      fileReader.readAsDataURL(bFile);
    }
  });
};
/*--------------------------------------------------
 * Begin initForm
 --------------------------------------------------*/
function initForm(metta) {
  $('#ph-new').on('click', function () {
    metta.Actions.New();
    $('#ph_Modal').modal('show');
  });

  $('#ph-search-text').off('keyup').on('keyup', function () {
    doSearch($('#ph-search-text').val(), metta.URLS.List.Method, metta.URLS.List.URL);
  });

  $('#ph-submit').off('click').on('click', function () {
    metta.Actions.Submit();
  });

  $('.view-type').off('click').on('click', function (e) {
    e.preventDefault();
    let currentViewType = $('#view-type').val();
    let viewType = $(this).data('viewtype') ? parseInt($(this).data('viewtype')) : 0;
    if (parseInt(currentViewType) !== parseInt(viewType)) {
      $('.view-type').removeClass('btn-dark');
      $('#view-type-' + viewType).addClass('btn-dark');
      $('#view-type').val(viewType);
      doSearch($('#ph-search-text').val(), metta);
    }
  });

  metta.Actions.New();
  if (PhSettings.Perms.Query) {
    doSearch($('#ph-search-text').val(), metta);
  }
}

function doSearch(vText, metta) {
  let viewType = $('#view-type').val();
  $.ajax({
    async: false,
    type: metta.URLS.List.Method,
    url: metta.URLS.List.URL,
    headers: PhSettings.Headers,
    data: {
      "vText": vText
    },
    success: function (response) {
      if (response.Status) {
        let resultData = response.Data;
        let vHtml = '';
        for (var i = 0; i < resultData.length; i++) {
          switch (parseInt(viewType)) {
            case 1:
              vHtml += getRow(resultData[i]);
              break;
            case 2:
              vHtml += getBlock(resultData[i]);
              break;
            case 3:
              vHtml += getLine(resultData[i]);
              break;
            default:
              vHtml += getCard(resultData[i]);
              break;
          }
        }
        $('#resultData').html(vHtml);
        $('.btn-edit').off('click').on('click', function (e) {
          e.preventDefault();
          metta.Actions.Edit(parseInt($(this).data('rid')));
        });
        $('.btn-delete').off('click').on('click', function (e) {
          e.preventDefault();
          metta.Actions.Delete(parseInt($(this).data('rid')));
        });
        $('.btn-reset').off('click').on('click', function (e) {
          e.preventDefault();
          metta.Actions.Reset(parseInt($(this).data('rid')));
        });
        $('.btn-image').off('click').on('click', function (e) {
          e.preventDefault();
          metta.Actions.Image(parseInt($(this).data('rid')));
          swal.fire({
            title: getLabel('Images'),
            text: getLabel('Under Construction')
          });
        });
        $('.btn-size').off('click').on('click', function (e) {
          e.preventDefault();
          metta.Actions.Size(parseInt($(this).data('rid')));
          swal.fire({
            title: getLabel('Sizes'),
            text: getLabel('Under Construction')
          });
        });
      }
    }
  });
}
/*--------------------------------------------------
 * End initForm
 --------------------------------------------------*/

/*--------------------------------------------------
 * Begin Pager
 --------------------------------------------------*/
function phsDoSearch(vText, mettaData, vCallback) {
  $(".pagination").html('');
  let perPage = 12;
  if (PhSettings.Perms.Query) {
    $.ajax({
      async: false,
      type: mettaData.URLS.Count.Method,
      url: mettaData.URLS.Count.URL,
      headers: PhSettings.Headers,
      data: {
        "vText": vText
      },
      success: function (response) {
        if (response.Status) {
          let nCount = response.Count;
          if (nCount > 0) {
            if ((nCount <= perPage) || (perPage === 0)) {
              $(".pagination").hide();
              if (perPage === 0) {
                perPage = 9999999999;
              }
              if (vCallback !== "") {
                vCallback(vText, 0, nCount, 1, perPage);
              }
            } else {
              $(".pagination").show();
              $(".pagination").paging(nCount, {
                format: "[< nncnn >]",
                perpage: perPage,
                lapping: 0,
                page: 1,
                onSelect: function (page) {
                  if (vCallback !== "") {
                    vCallback(vText, this.slice[0], this.slice[1], page, perPage);
                  }
                },
                onFormat: function (type) {
                  return formatPager(type, this.page, this.value, this.active);
                }
              });
            }
          }
        }
      }
    });
  }
}

function formatPager(type, page, value, isActive) {
  switch (type) {
    case 'block':
      if (!isActive) {
        return '<a class="btn btn-default border" href="#">' + value + '</a>';
      } else if (value !== page) {
        return '<a class="btn btn-default border" href="#">' + value + '</a>';
      }
      return '<a class="active btn btn-secondary border" href="#">' + value + '</a>';
    case 'first':
      if (isActive) {
        return '<a class="first btn btn-default border" href="#" title="First"><i class="bi bi-chevron-bar-right"></i></a>';
      }
      return '<a class="first disabled btn btn-default border" href="#" title="First"><i class="bi bi-chevron-bar-right"></i></a>';
    case 'prev':
      if (isActive) {
        return '<a class="prev btn btn-default border" href="#" title="Previous"><i class="bi bi-chevron-right"></i></a>';
      }
      return '<a class="prev disabled btn btn-default border" href="#" title="Previous"><i class="bi bi-chevron-right"></i></a>';
    case 'next':
      if (isActive) {
        return '<a class="next btn btn-default border" href="#" title="Next"><i class="bi bi-chevron-left"></i></a>';
      }
      return '<a class="next disabled btn btn-default border" href="#" title="Next"><i class="bi bi-chevron-left"></i></a>';
    case 'last':
      if (isActive) {
        return '<a class="last btn btn-default border" href="#" title="Last"><i class="bi bi-chevron-bar-left"></i></a>';
      }
      return '<a class="last disabled btn btn-default border" href="#" title="Last"><i class="bi bi-chevron-bar-left"></i></a>';
    case "leap":
      if (isActive) {
        return "";
      }
      return "";
    case 'fill':
      if (isActive) {
        return '';
      }
      return "";
  }
}
/*--------------------------------------------------
 * End Pager
 --------------------------------------------------*/

initPhTApp();
phAutocomplete();
