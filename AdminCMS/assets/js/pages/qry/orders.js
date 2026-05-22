/* global Highcharts */
var mettaData = {};

jQuery(document).ready(function () {

  mettaData.URLS = {
    "URL": PhSettings.serviceURL + "/Query/Orders",
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
        "dSDate": $('#fldSDate').val(),
        "dEDate": $('#fldEDate').val()
      },
      success: function (response) {
        console.log(response);
        if (response.Status) {
          let aRows = response.Data;
          let nTotal = response.nTotal;
          $('#result-card').removeClass('d-none');
          let $vHtml;
          for (var i = 0; i < aRows.length; i++) {
            $vHtml += `<tr><td>${aRows[i].vGrpName}</td><td>${aRows[i].nCount}</td></tr>`;
          }
          $vHtml += `<tr class="bg-secondary"><td>${getLabel('Totals')}</td><td>${nTotal}</td></tr>`;
          $('#result-Table tbody').html($vHtml);

        }
      }
    });
  }
}
