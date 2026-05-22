/* global Highcharts */
var mettaData = {};
var aRepsortNames = [
  getLabel('lbl.cms.By Year'),
  getLabel('lbl.cms.By Month'),
  getLabel('lbl.cms.By Week'),
  getLabel('lbl.cms.By Week Day'),
  getLabel('lbl.cms.By Month Day'),
  getLabel('lbl.cms.By Time'),
  getLabel('lbl.cms.By Status'),
  getLabel('lbl.cms.By Brands'),
  getLabel('lbl.cms.By Categories'),
  getLabel('lbl.cms.By Tags'),
  getLabel('lbl.cms.By Shop'),
  getLabel('lbl.cms.By Menu'),
  getLabel('lbl.cms.By Products'),
  getLabel('lbl.cms.By Year Day'),
  getLabel('lbl.cms.By Date')
];

var aValueLabels = [
  getLabel('lbl.cms.Count'),
  getLabel('lbl.cms.Sum'),
  getLabel('lbl.cms.Min'),
  getLabel('lbl.cms.Avg'),
  getLabel('lbl.cms.Max')
];
var aFieldLabels = [
  '',
  getLabel('lbl.cms.Qnt'),
  getLabel('lbl.cms.Cost'),
  getLabel('lbl.cms.Price'),
  getLabel('lbl.cms.Amount'),
  getLabel('lbl.cms.Gross Profit')
];
var aValue = [
  'nCount',
  'nTot',
  'nMin',
  'nAvg',
  'nMax'
];
var aField = [
  '',
  'Qnt',
  'Cost',
  'Price',
  'Net',
  'Gross'
];
var dateChart;
var catsChart;

const newChart = (ctx, aLabels, aDatasets, vType = 'bar') => {
  return new Chart(ctx, {
    type: vType,
    data: {
      labels: aLabels,
      datasets: aDatasets
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false,
          labels: {
            usePointStyle: false
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
};

const newLineChart = (ctx, aLabels, aDatasets) => {
  return new Chart(ctx, {
    type: 'line',
    data: {
      labels: aLabels,
      datasets: aDatasets
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          labels: {
            usePointStyle: true
          }
        }
      }
    }
  });
};

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
      $.when(render())
        .always(function () {
          $btn.attr('disabled', false);
          $btn.find('.spinner-border').addClass('d-none');
        });
    }, 1);
  });

});

function render() {
  let vFld = aValue[$('#ph-search-list-aggr').val()] + aField[$('#ph-search-list-value').val()];
  let vLbl = aValueLabels[$('#ph-search-list-aggr').val()] + ' ' + aFieldLabels[$('#ph-search-list-value').val()];
  if ((parseInt($('#ph-search-list-aggr').val()) === 0) || (parseInt($('#ph-search-list-value').val()) === 3 && parseInt($('#ph-search-list-aggr').val()) === 1)) {
    vFld = aValue[0];
    vLbl = aValueLabels[0];
    $('#ph-search-list-aggr').val(0);
    $('#ph-search-list-value').val(1);
  }

  $('#result-card').removeClass('d-none');
  $('#chartsWrapper').html('');
  aRepsortNames.forEach((report, idx) => {
    $.ajax({
      async: false,
      type: mettaData.URLS.Method,
      url: mettaData.URLS.URL,
      headers: PhSettings.Headers,
      data: {
        "nStudy": idx + 1,
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
        if (response.Status) {
          let aLabels = [];
          let aData = [];
          let aColor = [];
          let aRows = response.Data;
          for (var i = 0; i < aRows.length; i++) {
            aLabels[i] = aRows[i].vGrpName;
            aData[i] = aRows[i][vFld];
            aColor[i] = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`;
          }
          const $div = $(`<div class="${aRows.length > 10 ? (aRows.length > 20 ? (aRows.length > 25 ? 'col-md-12' : 'col-md-6') : 'col-md-3') : 'col-md-3'}"></div>`);
          $div.append(`<h4 class="text-center">${vLbl + ' ' + report}</h4>`);
          const $canvas = $('<canvas style="width: 100%; max-height: 25vh;"></canvas>').attr('id', 'chart' + idx);
          $div.append($canvas);
          $('#chartsWrapper').append($div);
          const ctx = document.getElementById('chart' + idx).getContext('2d');
          newChart(ctx, aLabels, [{
              label: vLbl,
              data: aData,
              backgroundColor: aRows.length > 25 ? `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})` : aColor,
              borderColor: `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`,
              borderWidth: 1
            }],
            aRows.length > 10 ? (aRows.length > 20 ? (aRows.length > 25 ? 'line' : 'bar') : 'pie') : 'pie'
            );
        }
      }
    });
  });

  const chartsData = [
    {labels: ['Jan', 'Feb', 'Mar'], data: [10, 20, 30], type: 'bar'},
    {labels: ['Apr', 'May', 'Jun'], data: [5, 15, 25], type: 'line'},
    {labels: ['Jul', 'Aug', 'Sep'], data: [12, 22, 32], type: 'pie'}
  ];

  chartsData.forEach((chartInfo, index) => {
    const $div = $('<div></div>').addClass('col-xl-4 col-lg-12');
    const $canvas = $('<canvas></canvas>').attr('id', 'chart' + index);
    $div.append($canvas);
    $('#chartsWrapper').append($div);
    const ctx = document.getElementById('chart' + index).getContext('2d');
    new Chart(ctx, {
      type: chartInfo.type,
      data: {
        labels: chartInfo.labels,
        datasets: [{
            label: 'Dataset ' + (index + 1),
            data: chartInfo.data,
            backgroundColor: `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`,
            borderColor: `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`,
            borderWidth: 1
          }]
      },
      options: {
        responsive: true
      }
    });
  });

}

const renderDates = (vFld, vLbl) => {
  if (catsChart) {
    catsChart.destroy();
  }
  $.ajax({
    async: false,
    type: mettaData.URLS.Method,
    url: mettaData.URLS.URL,
    headers: PhSettings.Headers,
    data: {
      "nStudy": 9,
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
      $('#result-card').removeClass('d-none');
      if (response.Status) {
        let aLabels = [];
        let aData = [];
        let aColor = [];
        let aRows = response.Data;
        for (var i = 0; i < aRows.length; i++) {
          aLabels[i] = aRows[i].vGrpName;
          aData[i] = aRows[i][vFld];
          aColor[i] = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`;
        }
        var ctx = document.getElementById('lineChartDates').getContext('2d');
        newLineChart(ctx, response.Labels, [{
            label: 'Sales',
            tension: 0.3,
            fill: true,
            backgroundColor: 'rgba(44, 120, 220, 0.2)',
            borderColor: 'rgba(44, 120, 220)',
            data: response.Sales
          },
          {
            label: 'Cost',
            tension: 0.3,
            fill: true,
            backgroundColor: 'rgba(4, 209, 130, 0.2)',
            borderColor: 'rgb(4, 209, 130)',
            data: response.Costs
          }
        ]);
      }
    }
  });
};

const renderChart = (nStudy, vFld, vLbl) => {
  if (catsChart) {
    catsChart.destroy();
  }
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
      $('#result-card').removeClass('d-none');
      if (response.Status) {
        let aLabels = [];
        let aData = [];
        let aColor = [];
        let aRows = response.Data;
        for (var i = 0; i < aRows.length; i++) {
          aLabels[i] = aRows[i].vGrpName;
          aData[i] = aRows[i][vFld];
          aColor[i] = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`;
        }
        var ctx = document.getElementById("barChartCats").getContext('2d');
        catsChart = newBarChart(ctx, aLabels, [{
            label: vLbl,
            data: aData,
            backgroundColor: aColor,
            borderWidth: 1
          }]);
      }
    }
  });
};
