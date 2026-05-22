/* global PhSettings, Labels, swal, Toast, TOAST_STATUS, TOAST_PLACEMENT */
const isSmallScreen = window.matchMedia && window.matchMedia('(max-width: 1023.5px)').matches;

const checkSavedTheme = () => {
  const themeKey = "theme";
  const useDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  var savedTheme = localStorage.getItem(themeKey);
  if (savedTheme === 'dark') {
    //document.documentElement.classList.add('dark');
    document.body.classList.add("dark");
  } else if (savedTheme === 'light') {
    //document.documentElement.classList.remove('dark');
    document.body.classList.remove("dark");
  }
};

const select = (el, all = false) => {
  el = el.trim();
  if (all) {
    return [...document.querySelectorAll(el)];
  } else {
    return document.querySelector(el);
}
};

const on = (type, el, listener, all = false) => {
  if (all) {
    select(el, all).forEach(e => e.addEventListener(type, listener));
  } else {
    select(el, all).addEventListener(type, listener);
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

const toDataURL = url => fetch(url)
    .then(response => response.blob())
    .then(blob => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onloadend = () => resolve(reader.result);
        reader.onerror = reject;
        reader.readAsDataURL(blob);
      }));

async function loadFromURL(url, vCallback) {
  let bFile;
  let promise = fetch(url)
    .then(response => response.blob())
    .then(blob => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onloadend = () => {
          resolve(reader.result);
          vCallback(reader.result);
        };
        reader.onerror = reject;
        reader.readAsDataURL(blob);
      }));
  bFile = await promise;
  return bFile;
}

const toggleTheme = () => {
  const themeKey = "theme";
  const savedTheme = localStorage.getItem(themeKey);
  if (savedTheme === "dark") {
    document.body.classList.remove("dark");
    document.documentElement.classList.remove('dark');
    localStorage.setItem(themeKey, "light");
  } else {
    document.body.classList.add("dark");
    document.documentElement.classList.add('dark');
    localStorage.setItem(themeKey, "dark");
  }
};

const formatDate = (date, format) => {
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
};

const currentTime = () => {
  return formatDate(new Date(), 'hh:ii');
};

const currentDate = () => {
  return formatDate(new Date(), 'dd-mm-yyyy');
};

let Labels = [];
let direction = {
  dir: ['ltr', 'rtl'],
  css: ['assets/css/style-ltr.css', 'assets/css/style-rtl.css'],
  bootstrap: ['assets/vendors/bootstrap/css/bootstrap.ltr.css', 'assets/vendors/bootstrap/css/bootstrap.rtl.css'],
  nDir: 0
};
if (select('.change-language', true)) {
  on('click', '.change-language', function (e) {
    e.preventDefault();
    if (e.target.dataset.dir === 'ltr') {
      direction.nDir = 0;
    } else {
      direction.nDir = 1;
    }
    select(".change-language", true).forEach((element) => {
      element.classList.remove('active');
    });
    e.target.classList.add('active');
    document.body.classList.remove('ltr');
    document.body.classList.remove('rtl');
    select("#bootstrap").setAttribute("href", direction.bootstrap[direction.nDir]);
    document.body.setAttribute('lang', e.target.dataset.code);
    document.body.setAttribute('dir', e.target.dataset.dir);
    document.body.classList.add(e.target.dataset.dir);
    $.ajax({
      type: PhSettings.changeLanguage.Method,
      async: false,
      url: PhSettings.changeLanguage.URL,
      data: {
        "language": e.target.dataset.value
      },
      success: function (response) {
        location.reload();
      }
    });
  }, true);
}
const getLabel = (vKey) => {
  let vRet = vKey;
  let sKey = vKey.toLowerCase().replaceAll(" ", ".");
  if (PhSettings.Labels.hasOwnProperty(sKey)) {
    vRet = PhSettings.Labels[sKey];
  }
  return (vRet);
};


const swalToast = (message, icon, position) => {
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
//    theme: TOAST_THEME[localStorage.getItem(savedTheme).toUpperCase()],
    timer: 1500
  });
};

const showToast = (title, color, message) => {
  /*
   * position: top-left, top-center, top-eight,
   *           middle-left, middle-center, middle-right
   *           bottom-left, bottom-center, bottom-right
   */
  let toast = {
    title: title,
    message: message,
    status: TOAST_STATUS[color],
//    theme: localStorage.getItem(savedTheme).toUpperCase(),
    timeout: 2000
  };
  Toast.enableQueue(true);
  Toast.setPlacement(TOAST_PLACEMENT.BOTTOM_RIGHT);
  Toast.create(toast);
};

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
 * Begin Pager
 --------------------------------------------------*/
function phsDoSearch(vText, mettaData, vCallback, curPage = 1, perPage = 10) {
  $('#resultData').html('');
  $('#resultCount').text('0');
  $(".pagination").html('');
  let nCount = 0;
  if (PhSettings.Perms.Query) {
    $.ajax({
      async: false,
      type: mettaData.URLS.Count.Method,
      url: mettaData.URLS.Count.URL,
      headers: PhSettings.Headers,
      data: {
        "vText": vText,
        "vSFld": $('#search-fld').val()
      },
      success: function (response) {
        if (response.Status) {
          nCount = response.Count;
          $('#resultCount').text(getLabel('lbl.cms.Results') + ' ' + nCount);
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
                page: curPage,
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
  let vLeft = 'left';
  let vRight = 'right';
  if (PhSettings.display.lang !== 'en') {
    vLeft = 'right';
    vRight = 'left';
  }
  switch (type) {
    case 'block':
      if (!isActive) {
        return '<a class="btn btn-default border ms-2" href="#">' + value + '</a>';
      } else if (value !== page) {
        return '<a class="btn btn-default border ms-2" href="#">' + value + '</a>';
      }
      return '<a class="active btn btn-secondary bg-my-primary my-btn-text border ms-2" href="#">' + value + '</a>';
    case 'first':
      if (isActive) {
        return '<a class="first btn btn-default border ms-2" href="#" title="First"><i class="bi bi-chevron-bar-' + vLeft + '"></i></a>';
      }
      return '<a class="first disabled btn btn-default border ms-2" href="#" title="First"><i class="bi bi-chevron-bar-' + vLeft + '"></i></a>';
    case 'prev':
      if (isActive) {
        return '<a class="prev btn btn-default border ms-2" href="#" title="Previous"><i class="bi bi-chevron-' + vLeft + '"></i></a>';
      }
      return '<a class="prev disabled btn btn-default border ms-2" href="#" title="Previous"><i class="bi bi-chevron-' + vLeft + '"></i></a>';
    case 'next':
      if (isActive) {
        return '<a class="next btn btn-default border ms-2" href="#" title="Next"><i class="bi bi-chevron-' + vRight + '"></i></a>';
      }
      return '<a class="next disabled btn btn-default border ms-2" href="#" title="Next"><i class="bi bi-chevron-' + vRight + '"></i></a>';
    case 'last':
      if (isActive) {
        return '<a class="last btn btn-default border ms-2" href="#" title="Last"><i class="bi bi-chevron-bar-' + vRight + '"></i></a>';
      }
      return '<a class="last disabled btn btn-default border ms-2" href="#" title="Last"><i class="bi bi-chevron-bar-' + vRight + '"></i></a>';
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

(function ($) {
  "use strict";

  // Toggle submenu visibility
  $(".menu-item.has-submenu .menu-link").on("click", function (e) {
    e.preventDefault();
    // Hide other open submenus
    if ($(this).next(".submenu").is(":hidden")) {
      $(this)
        .parent(".has-submenu")
        .siblings()
        .find(".submenu")
        .slideUp(200);
    }
    // Toggle this submenu
    $(this).next(".submenu").slideToggle(200);
  });

  // Offcanvas menu trigger
  $("[data-trigger]").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    var target = $(this).attr("data-trigger");
    $(target).toggleClass("show");
    $("body").toggleClass("offcanvas-active");
    $(".screen-overlay").toggleClass("show");
  });

  // Close offcanvas and overlay
  $(".screen-overlay, .btn-close").click(function (e) {
    $(".screen-overlay").removeClass("show");
    $(".mobile-offcanvas, .show").removeClass("show");
    $("body").removeClass("offcanvas-active");
  });

  // Aside minimize button
  $(".btn-aside-minimize").on("click", function () {
    if (window.innerWidth < 768) {
      $("body").removeClass("aside-mini");
      $(".screen-overlay").removeClass("show");
      $(".navbar-aside").removeClass("show");
      $("body").removeClass("offcanvas-active");
    } else {
      $("body").toggleClass("aside-mini");
    }
  });

  // Initialize select2 if .select-nice exists
  if ($(".select-nice").length) {
    $(".select-nice").select2();
  }

  // Dark mode toggle
  $(".darkmode").on("click", function () {
    toggleTheme();
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
  checkSavedTheme();
  phAutocomplete();

})(jQuery);


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
