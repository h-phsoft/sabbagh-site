/* global PhSettings, PhUtility, swal, KTUtil */
var resultType = 0;
var resultId = 0;
var resultData = [];
var mettaData = {};

jQuery(document).ready(function () {

  mettaData.URLS = {
    "Save": {
      "URL": PhSettings.serviceURL + "/Orders",
      "Method": "POST"
    },
    "Get": {
      "URL": PhSettings.serviceURL + "/Orders",
      "Method": "GET"
    },
    "Delete": {
      "URL": PhSettings.serviceURL + "/Orders",
      "Method": "DELETE"
    },
    "Count": {
      "URL": PhSettings.serviceURL + "/Orders",
      "Method": "PUT"
    },
    "List": {
      "URL": PhSettings.serviceURL + "/Orders",
      "Method": "OPTIONS"
    }
  };
  mettaData.ImagePath = '../assets/media/imgs/products/';
  mettaData.DefaultImage = 'vendor-0.png';

  $('.result-type').off('click').on('click', function () {
    $('.result-type').removeClass('btn-warning');
    $('.result-type').addClass('btn-outline-warning');
    $(this).removeClass('btn-outline-warning');
    $(this).addClass('btn-warning');
    resultType = parseInt($(this).data('val'));
    phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
  });

  $('#ph-search-text').off('keyup').on('keyup', function () {
    phsDoSearch($('#ph-search-text').val(), mettaData, getPage);
  });

  setResultType(2);
  phsDoSearch($('#ph-search-text').val(), mettaData, getPage);

});

function setResultType(nType) {
  $('.result-type').removeClass('btn-warning');
  $('.result-type').addClass('btn-outline-warning');
  $('#result-type-' + nType).removeClass('btn-outline-warning');
  $('#result-type-' + nType).addClass('btn-warning');
  resultType = parseInt($('#result-type-' + nType).data('val'));
}

function getPage(vText, nStart, nEnd, nPage, nPerPage) {

  if (PhSettings.Perms.Query) {
    $('#resultData').html('');
    $.ajax({
      async: false,
      type: mettaData.URLS.List.Method,
      url: mettaData.URLS.List.URL,
      headers: PhSettings.Headers,
      data: {
        start: nStart,
        end: nEnd,
        page: nPage,
        perpage: nPerPage,
        "vText": vText
      },
      success: function (response) {
        if (response.Status) {
          resultData = response.Data;
          switch (resultType) {
            case 0:
              renderCards();
              break;
            case 1:
              renderLines();
              break;
            case 2:
              renderTable();
              break;
            default:
              renderCards();
              break;
          }
          $('.btn-view').off('click').on('click', function (e) {
            e.preventDefault();
            resultId = parseInt($(this).data('rid'));
            showDetails(resultId);
          });
        }
      }
    });
  }
}

function showDetails(nIdx) {

  resetFormValid('ph_Form');
  let order = resultData[nIdx];
  let vHeadHtml = '';
  let vItemHtml = '';
  vHeadHtml += `<div class="row pt-2">
                  <div class="col-6">
                    <div class="row pt-2">
                      <h2><i class="bi bi-file-person"></i> ${order.vCustName}</h2>
                    </div>
                    <div class="row pt-2">
                      <h5><i class="bi bi-calculator"></i> ${order.vCustOrgnum}</h5>
                    </div>
                  </div>
                  <div class="col-2">
                    <h2 class="text-success"><strong>${order.aItemCounts[0].Qnt}</strong></h2>
                  </div>
                  <div class="col-2">
                  </div>
                  <div class="col-2">
                    <h2 class="text-success"><strong>${numberWithCommas(order.aItemCounts[0].Amt)}</strong></h2>
                  </div>
                </div>
                <div class="row p-2">
                  <div class="col-4">
                    ${getLabel('Brand Name')} / ${getLabel('Product Name')}
                  </div>
                  <div class="col-2">
                    ${getLabel('UNIT')}
                  </div>
                  <div class="col-2">
                    ${getLabel('QTY')}
                  </div>
                  <div class="col-2">
                    ${getLabel('Price')}
                  </div>
                  <div class="col-2">
                    ${getLabel('Amount')}
                  </div>
                </div>`;
  $('#order-header').html(vHeadHtml);
  vItemHtml = `<div class="mx-4">`;
  for (var i = 0; i < order.aItems.length; i++) {
    let item = order.aItems[i];
    vItemHtml += `<div class="card mb-2">
                <div class="row p-2">
                  <div class="col-1">
                    <img src="${mettaData.ImagePath}${item.ProdImage}" width="100%"/>
                  </div>
                  <div class="col-3">
                    <div class="row p-2">
                      <h4>${item.BrandName1}</h4>
                    </div>
                    <div class="row p-2">
                      <h4>${item.ProdName1}</h4>
                    </div>
                  </div>
                  <div class="col-2">
                    <h3>${item.ItemNet + ' ' + item.UnitName}</h3>
                  </div>
                  <div class="col-2">
                    <h2>${numberWithCommas(item.ItemQnt)}</h2>
                  </div>
                  <div class="col-2">
                    <h2>${numberWithCommas(item.ItemCprice)}</h2>
                  </div>
                  <div class="col-2">
                    <h2>${numberWithCommas(item.ItemAmt)}</h2>
                  </div>
                </div>
              </div>`;
  }
  vItemHtml += `</div>`;
  $('#order-items').html(vItemHtml);
  $('#ph_Modal').modal('show');
}

function renderCards() {
  let vHtml = '';
  for (var i = 0; i < resultData.length; i++) {
    let order = resultData[i];
    vHtml +=
      `<div class="col-sm-3 p-2 mx-auto">
        <div id="item-${order.nId}" class="card card-custom result-card h-100">
          <div class="card-header">
            <div class="row pt-2">
              <div class="col-12">
                <h4><i class="bi bi-file-person"></i> ${order.vCustName}</h4>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <h5><i class="bi bi-calculator"></i> ${order.vCustOrgnum}</h5>
                <h6><i class="bi bi-check-all"></i> ${order.vStatusName + ' @' + order.dOrdAddat}</h6>
                <h6><i class="bi bi-minecart-loaded"></i> ${order.aItemCounts[0].Cnt}</h6>
                <h6><i class="bi bi-cart-check"></i> ${order.aItemCounts[0].Qnt}</h6>
                <h6><i class="bi bi-coin"></i> ${numberWithCommas(order.aItemCounts[0].Amt)}</h6>
              </div>
              <div class="col-4">
                <table class="w-100">
                  <tbody>`;
    for (var j = 0; j < order.aServices.length; j++) {
      vHtml += `<tr>
                <td class="text-center">${order.aServices[j].oService.Name1}</td>
                <td class="text-right">${order.aServices[j].Amt}</td>
              </tr>`;
    }
    vHtml += `      </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row pt-2">
              <div class="col-6 text-start"">
                <span class="btn btn-success btn-view" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("View")}"><i class="bi bi-eye"></i></span>
              </div>
              <div class="col-6 text-end">
              </div>
            </div>
          </div>
        </div>
      </div>`;
  }
  $('#resultData').html(vHtml);
}

function renderTable() {
  let vHtml = '';
  vHtml += `
<div class="col-12 p-2 mx-auto">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <td width="2%"></td>
        <td width="10%"><i class="bi bi-file-person"></i> ${getLabel('Customer')}</td>
        <td width="10%"><i class="bi bi-calculator"></i> ${getLabel('Orgnum')}</td>
        <td width="10%"><i class="bi bi-check-all"></i> ${getLabel('Status')}</td>
        <td width="10%">@ ${getLabel('Addat')}</td>
        <td width="10%"><i class="bi bi-minecart-loaded"></i> ${getLabel('Items')}</td>
        <td width="10%"><i class="bi bi-cart-check"></i> ${getLabel('Qnt')}</td>
        <td width="10%"><i class="bi bi-coin"></i> ${getLabel('Amt')}</td>
        <td>${getLabel('Services')}</td>
      </tr>
    <thead>
    <tbody>`;
  for (var i = 0; i < resultData.length; i++) {
    let order = resultData[i];
    vHtml += `
<tr>
  <td class="text-start"><span class="btn btn-success btn-view" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("View")}"><i class="bi bi-eye"></i></span></td>
  <td>${order.vCustName}</td>
  <td>${order.vCustOrgnum}</td>
  <td>${order.vStatusName}</td>
  <td>${order.dOrdAddat}</td>
  <td>${order.aItemCounts[0].Cnt}</td>
  <td>${order.aItemCounts[0].Qnt}</td>
  <td>${numberWithCommas(order.aItemCounts[0].Amt)}</td>
  <td>
                <table class="w-100">
                  <tbody>`;
    for (var j = 0; j < order.aServices.length; j++) {
      vHtml += `<tr>
                <td class="text-start">${order.aServices[j].oService.Name1}</td>
                <td class="text-start">${order.aServices[j].Amt}</td>
              </tr>`;
    }
    vHtml += `      </tbody>
                </table>
  </td>
</tr>`;
  }
  vHtml += `
  </tbody>
</table>`;
  $('#resultData').html(vHtml);
}

function renderLines() {
  let vHtml = '';
  for (var i = 0; i < resultData.length; i++) {
    let order = resultData[i];
    vHtml += `
<div class="col-12 mx-auto">
  <div id="item-${order.nId}" class="card card-custom result-card p-2">
    <div class="row">
      <div class="col-1 text-start">
        <span class="btn btn-success btn-view" data-rid="${i}" data-toggle="tooltip" data-placement="bottom" title="${getLabel("View")}"><i class="bi bi-eye"></i></span>
      </div>
      <div class="col-11">
        <div class="row">
          <div class="col-8">
            <div class="row g-1">
              <div class="col-6">
                <h5><i class="bi bi-calculator"></i> ${order.vCustOrgnum}</h5>
              </div>
              <div class="col-6">
                <h6><i class="bi bi-check-all"></i> ${order.vStatusName + ' @' + order.dOrdAddat}</h6>
              </div>
              <div class="col-6">
                <h6><i class="bi bi-minecart-loaded"></i> ${order.aItemCounts[0].Cnt}</h6>
              </div>
              <div class="col-6">
                <h6><i class="bi bi-cart-check"></i> ${order.aItemCounts[0].Qnt}</h6>
              </div>
              <div class="col-6">
                <h6><i class="bi bi-coin"></i> ${numberWithCommas(order.aItemCounts[0].Amt)}</h6>
              </div>
            </div>
          </div>
          <div class="col-4">
            <table class="w-100">
              <tbody>`;
    for (var j = 0; j < order.aServices.length; j++) {
      vHtml += `<tr>
                <td class="text-center">${order.aServices[j].oService.Name1}</td>
                <td class="text-right">${order.aServices[j].Amt}</td>
              </tr>`;
    }
    vHtml += `   </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>`;
  }
  $('#resultData').html(vHtml);
}
