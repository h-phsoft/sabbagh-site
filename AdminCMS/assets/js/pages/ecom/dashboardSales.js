/* global Highcharts */
var resultType = 0;

jQuery(document).ready(function () {

  let aBlocks = [
    {"Title": getLabel('Sales Per') + ' ' + getLabel('Brands'),
      "STitle": getLabel('Brand'),
      "Cols": "3",
      "Color": "success",
      "Method": "OPTIONS",
      "URL": PhSettings.serviceURL + "/Dashboard/BrandSales",
      "nTotal": 0,
      "Data": [],
      "hData": []
    },
    {"Title": getLabel('Sales Per') + ' ' + getLabel('Categories'),
      "STitle": getLabel('Category'),
      "Cols": "3",
      "Color": "warning",
      "Method": "OPTIONS",
      "URL": PhSettings.serviceURL + "/Dashboard/CategorySales",
      "nTotal": 0,
      "Data": [],
      "hData": []
    },
    {"Title": getLabel('Sales Per') + ' ' + getLabel('Branches'),
      "STitle": getLabel('Brand'),
      "Cols": "3",
      "Color": "info",
      "Method": "OPTIONS",
      "URL": PhSettings.serviceURL + "/Dashboard/BranchSales",
      "nTotal": 0,
      "Data": [],
      "hData": []
    },
    {"Title": getLabel('Sales Per') + ' ' + getLabel('Products'),
      "STitle": getLabel('Product'),
      "Cols": "3",
      "Color": "primary",
      "Method": "OPTIONS",
      "URL": PhSettings.serviceURL + "/Dashboard/ProductSales",
      "nTotal": 0,
      "Data": [],
      "hData": []
    }
  ];

  for (var i = 0; i < aBlocks.length; i++) {
    let oBlock = aBlocks[i];
    $.ajax({
      async: false,
      type: oBlock.Method,
      url: oBlock.URL,
      headers: PhSettings.Headers,
      success: function (response) {
        if (response.Status) {
          let hData = [];
          for (var j = 0; j < response.Data.length; j++) {
            let grp = response.Data[j];
            hData[j] = {};
            hData[j].name = grp.vGrpName;
            hData[j].y = 0;
            if (response.nTotal > 0) {
              hData[j].y = Math.round((grp.nCount / response.nTotal) * 100);
            }
          }
          aBlocks[i].nTotal = response.nTotal;
          aBlocks[i].Data = response.Data;
          aBlocks[i].hData = hData;
          //vHtml += renderSmallMultiprogress(oBlock, response.nTotal, response.Data);
        }
      }
    });
  }
  let vHtml = `<div class="container">
                <div class="row g-2">`;
  for (var i = 0; i < aBlocks.length; i++) {
    let oBlock = aBlocks[i];
    vHtml += renderSmallMultiprogress(oBlock, oBlock.nTotal, oBlock.Data);
  }
  vHtml += `  </div>
              <div class="row g-2">`;
  for (var i = 0; i < aBlocks.length; i++) {
    vHtml += `  <div class="col-sm-6 p-3"><div id="hChart-${i}" class="card"></div></div>`;
  }
  vHtml += `  </div>
            </div>`;
  $('#dashboard-content').html(vHtml);
  for (var i = 0; i < aBlocks.length; i++) {
    let oBlock = aBlocks[i];
    renderPIEChart(oBlock, 'hChart-' + i);
  }

});

function renderSmallMultiprogress(oBlock, nTotal, aData) {
  if (!nTotal || nTotal < 0) {
    nTotal = 1;
  }
  let vHtml = `<div class="col-sm-${oBlock.Cols}">
                 <div class="card">
                   <div class="card-body ">
                     <h3 class="card-title"> ${oBlock.Title} </h3>`;
  for (let i = 0; i < aData.length; i++) {
    let grp = aData[i];
    let nPercent = Math.round((grp.nCount / nTotal) * 100);
    vHtml += `<div class="row">
                <label class="col-8 px-3 py-1"> ${grp.vGrpName} </label>
                <label class="col-2 text-start py-1">${grp.nCount}</label>
                <label class="col-2 text-start py-1">${nPercent}%</label>
              </div>
              <div class="progress" style="height: 8px">
                <div class="progress-bar bg-${oBlock.Color}" role="progressbar" style="width:${nPercent}%" aria-valuenow="" aria-valuemin="0" aria-valuemax=""></div>
              </div>`;
  }
  vHtml += `    </div>
              </div>
            </div>`;
  return vHtml;
}

function renderPIEChart(oBlock, vContainer) {
  Highcharts.chart(vContainer, {
    credits: "",
    exporting: {
      enabled: false
    },
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: oBlock.Title,
      align: 'center'
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b>: {point.percentage:.1f} %'
        }
      }
    },
    series: [{
        name: oBlock.STitle,
        colorByPoint: true,
        data: oBlock.hData
      }]
  });
}