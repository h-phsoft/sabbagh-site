/* global Highcharts */
var mettaData = {};

jQuery(document).ready(function () {

  mettaData.URLS = {
    "URL": PhSettings.serviceURL + "/Query/Sales",
    "Method": "OPTIONS"
  };

  $('#ph-execute').removeClass('d-none');
  $('#ph-execute').off('click').on('click', function (event) {
    var $btn = $(this);
    $btn.attr('disabled', true);
    $btn.find('.spinner-border').removeClass('d-none');
    setTimeout(function () {
      $.when(render(parseInt($('#fldStudy').val())))
        .always(function () {
          $btn.attr('disabled', false);
          $btn.find('.spinner-border').addClass('d-none');
        });
    }, 1);
  });

});

function render(nStudy) {
  if (nStudy > 0) {
    $.ajax({
      async: false,
      type: mettaData.URLS.Method,
      url: mettaData.URLS.URL,
      headers: PhSettings.Headers,
      data: {
        "nStudy": nStudy,
        "vText": $('#ph-search-text').val(),
        "nBrand": $('#ph-search-list-brand').val(),
        "nCat": $('#ph-search-list-cat').val(),
        "nTag": $('#ph-search-list-tag').val(),
        "nShop": $('#ph-search-list-shop').val(),
        "nMenu": $('#ph-search-list-menu').val(),
        "dSDate": $('#fldSDate').val(),
        "dEDate": $('#fldEDate').val()
      },
      success: function (response) {
        console.log(response);
        if (response.Status) {
          let aRows = response.Data;
          let aTotals = response.aTotals;
          $('#result-card').removeClass('d-none');
          let $vHtml;
          for (var i = 0; i < aRows.length; i++) {
            $vHtml += `<tr>
                         <td>${aRows[i].vGrpName}</td>
                         ${$('#chk-cnt').is(':checked') ? `<td>${aRows[i].nCount}</td>` : ``}
                         ${$('#chk-sum').is(':checked') && $('#chk-qnt').is(':checked') ? `<td>${aRows[i].nTotQnt}</td>` : ``}
                         ${$('#chk-min').is(':checked') && $('#chk-qnt').is(':checked') ? `<td>${aRows[i].nMinQnt}</td>` : ``}
                         ${$('#chk-avg').is(':checked') && $('#chk-qnt').is(':checked') ? `<td>${aRows[i].nAvgQnt}</td>` : ``}
                         ${$('#chk-max').is(':checked') && $('#chk-qnt').is(':checked') ? `<td>${aRows[i].nMaxQnt}</td>` : ``}
                         ${$('#chk-sum').is(':checked') && $('#chk-cost').is(':checked') ? `<td>${aRows[i].nTotCost}</td>` : ``}
                         ${$('#chk-min').is(':checked') && $('#chk-cost').is(':checked') ? `<td>${aRows[i].nMinCost}</td>` : ``}
                         ${$('#chk-avg').is(':checked') && $('#chk-cost').is(':checked') ? `<td>${aRows[i].nAvgCost}</td>` : ``}
                         ${$('#chk-max').is(':checked') && $('#chk-cost').is(':checked') ? `<td>${aRows[i].nMaxCost}</td>` : ``}
                         ${$('#chk-min').is(':checked') && $('#chk-prc').is(':checked') ? `<td>${aRows[i].nMinPrice}</td>` : ``}
                         ${$('#chk-avg').is(':checked') && $('#chk-prc').is(':checked') ? `<td>${aRows[i].nAvgPrice}</td>` : ``}
                         ${$('#chk-max').is(':checked') && $('#chk-prc').is(':checked') ? `<td>${aRows[i].nMaxPrice}</td>` : ``}
                         ${$('#chk-sum').is(':checked') && $('#chk-net').is(':checked') ? `<td>${aRows[i].nTotNet}</td>` : ``}
                         ${$('#chk-min').is(':checked') && $('#chk-net').is(':checked') ? `<td>${aRows[i].nMinNet}</td>` : ``}
                         ${$('#chk-avg').is(':checked') && $('#chk-net').is(':checked') ? `<td>${aRows[i].nAvgNet}</td>` : ``}
                         ${$('#chk-max').is(':checked') && $('#chk-net').is(':checked') ? `<td>${aRows[i].nMaxNet}</td>` : ``}
                         ${$('#chk-sum').is(':checked') && $('#chk-grs').is(':checked') ? `<td>${aRows[i].nTotGross}</td>` : ``}
                         ${$('#chk-min').is(':checked') && $('#chk-grs').is(':checked') ? `<td>${aRows[i].nMinGross}</td>` : ``}
                         ${$('#chk-avg').is(':checked') && $('#chk-grs').is(':checked') ? `<td>${aRows[i].nAvgGross}</td>` : ``}
                         ${$('#chk-max').is(':checked') && $('#chk-grs').is(':checked') ? `<td>${aRows[i].nMaxGross}</td>` : ``}
                       </tr>`;
          }
          $vHtml += `<tr>
                         <td>${getLabel('Totals')}</td>
                         ${$('#chk-cnt').is(':checked') ? `<td>${aTotals[0].nCount}</td>` : ``}
                         ${$('#chk-sum').is(':checked') && $('#chk-qnt').is(':checked') ? `<td>${aTotals[0].nTotQnt}</td>` : ``}
                         ${$('#chk-min').is(':checked') && $('#chk-qnt').is(':checked') ? `<td>${aTotals[0].nMinQnt}</td>` : ``}
                         ${$('#chk-avg').is(':checked') && $('#chk-qnt').is(':checked') ? `<td>${aTotals[0].nAvgQnt}</td>` : ``}
                         ${$('#chk-max').is(':checked') && $('#chk-qnt').is(':checked') ? `<td>${aTotals[0].nMaxQnt}</td>` : ``}
                         ${$('#chk-sum').is(':checked') && $('#chk-cost').is(':checked') ? `<td>${aTotals[0].nTotCost}</td>` : ``}
                         ${$('#chk-min').is(':checked') && $('#chk-cost').is(':checked') ? `<td>${aTotals[0].nMinCost}</td>` : ``}
                         ${$('#chk-avg').is(':checked') && $('#chk-cost').is(':checked') ? `<td>${aTotals[0].nAvgCost}</td>` : ``}
                         ${$('#chk-max').is(':checked') && $('#chk-cost').is(':checked') ? `<td>${aTotals[0].nMaxCost}</td>` : ``}
                         ${$('#chk-min').is(':checked') && $('#chk-prc').is(':checked') ? `<td>${aTotals[0].nMinPrice}</td>` : ``}
                         ${$('#chk-avg').is(':checked') && $('#chk-prc').is(':checked') ? `<td>${aTotals[0].nAvgPrice}</td>` : ``}
                         ${$('#chk-max').is(':checked') && $('#chk-prc').is(':checked') ? `<td>${aTotals[0].nMaxPrice}</td>` : ``}
                         ${$('#chk-sum').is(':checked') && $('#chk-net').is(':checked') ? `<td>${aTotals[0].nTotNet}</td>` : ``}
                         ${$('#chk-min').is(':checked') && $('#chk-net').is(':checked') ? `<td>${aTotals[0].nMinNet}</td>` : ``}
                         ${$('#chk-avg').is(':checked') && $('#chk-net').is(':checked') ? `<td>${aTotals[0].nAvgNet}</td>` : ``}
                         ${$('#chk-max').is(':checked') && $('#chk-net').is(':checked') ? `<td>${aTotals[0].nMaxNet}</td>` : ``}
                         ${$('#chk-sum').is(':checked') && $('#chk-grs').is(':checked') ? `<td>${aTotals[0].nTotGross}</td>` : ``}
                         ${$('#chk-min').is(':checked') && $('#chk-grs').is(':checked') ? `<td>${aTotals[0].nMinGross}</td>` : ``}
                         ${$('#chk-avg').is(':checked') && $('#chk-grs').is(':checked') ? `<td>${aTotals[0].nAvgGross}</td>` : ``}
                         ${$('#chk-max').is(':checked') && $('#chk-grs').is(':checked') ? `<td>${aTotals[0].nMaxGross}</td>` : ``}
                       </tr>`;
          $('#result-Table tbody').html($vHtml);
          $vHtml = `<tr>
                       <th>${getLabel('lbl.cms.Group')}</th>
                        ${$('#chk-cnt').is(':checked') ? `<th>${getLabel('lbl.cms.Count')}</th>` : ``}
                        ${$('#chk-sum').is(':checked') && $('#chk-qnt').is(':checked') ? `<th>${getLabel('lbl.cms.Qnt')}</th>` : ``}
                        ${$('#chk-min').is(':checked') && $('#chk-qnt').is(':checked') ? `<th>${getLabel('lbl.cms.Min Qnt')}</th>` : ``}
                        ${$('#chk-avg').is(':checked') && $('#chk-qnt').is(':checked') ? `<th>${getLabel('lbl.cms.Avg Qnt')}</th>` : ``}
                        ${$('#chk-max').is(':checked') && $('#chk-qnt').is(':checked') ? `<th>${getLabel('lbl.cms.Max Qnt')}</th>` : ``}
                        ${$('#chk-sum').is(':checked') && $('#chk-cost').is(':checked') ? `<th>${getLabel('lbl.cms.Cost')}</th>` : ``}
                        ${$('#chk-min').is(':checked') && $('#chk-cost').is(':checked') ? `<th>${getLabel('lbl.cms.Min Cost')}</th>` : ``}
                        ${$('#chk-avg').is(':checked') && $('#chk-cost').is(':checked') ? `<th>${getLabel('lbl.cms.Avg Cost')}</th>` : ``}
                        ${$('#chk-max').is(':checked') && $('#chk-cost').is(':checked') ? `<th>${getLabel('lbl.cms.Max cost')}</th>` : ``}
                        ${$('#chk-min').is(':checked') && $('#chk-prc').is(':checked') ? `<th>${getLabel('lbl.cms.Min Price')}</th>` : ``}
                        ${$('#chk-avg').is(':checked') && $('#chk-prc').is(':checked') ? `<th>${getLabel('lbl.cms.Avg Price')}</th>` : ``}
                        ${$('#chk-max').is(':checked') && $('#chk-prc').is(':checked') ? `<th>${getLabel('lbl.cms.Max Price')}</th>` : ``}
                        ${$('#chk-sum').is(':checked') && $('#chk-net').is(':checked') ? `<th>${getLabel('lbl.cms.Amount')}</th>` : ``}
                        ${$('#chk-min').is(':checked') && $('#chk-net').is(':checked') ? `<th>${getLabel('lbl.cms.Min Amount')}</th>` : ``}
                        ${$('#chk-avg').is(':checked') && $('#chk-net').is(':checked') ? `<th>${getLabel('lbl.cms.Avg Amount')}</th>` : ``}
                        ${$('#chk-max').is(':checked') && $('#chk-net').is(':checked') ? `<th>${getLabel('lbl.cms.Max Amount')}</th>` : ``}
                        ${$('#chk-sum').is(':checked') && $('#chk-grs').is(':checked') ? `<th>${getLabel('lbl.cms.Gross Profit')}</th>` : ``}
                        ${$('#chk-min').is(':checked') && $('#chk-grs').is(':checked') ? `<th>${getLabel('lbl.cms.Min Gross Profit')}</th>` : ``}
                        ${$('#chk-avg').is(':checked') && $('#chk-grs').is(':checked') ? `<th>${getLabel('lbl.cms.Avg Gross Profit')}</th>` : ``}
                        ${$('#chk-max').is(':checked') && $('#chk-grs').is(':checked') ? `<th>${getLabel('lbl.cms.Max Gross Profit')}</th>` : ``}
                     </tr>`;
          $('#result-Table thead').html($vHtml);
        }
      }
    });
  }
}
