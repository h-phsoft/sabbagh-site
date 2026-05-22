
const newBarChart = (ctx, aLabels, aDatasets) => {
  return new Chart(ctx, {
    type: 'bar',
    data: {
      labels: aLabels,
      datasets: aDatasets
    },
    options: {
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

(function ($) {
  "use strict";
  $.ajax({
    type: 'POST',
    async: false,
    url: PhSettings.serviceURL + '/Dashboard/Orders',
    data: {},
    success: function (response) {
      var ctx = document.getElementById('lineChartSales').getContext('2d');
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
  });

  $.ajax({
    type: 'POST',
    async: false,
    url: PhSettings.serviceURL + '/Dashboard/OrdersByCategory',
    data: {},
    success: function (response) {
      let aLabels = [];
      let aData = [];
      let aColor = [];
      for (var i = 0; i < response.Data.length; i++) {
        aLabels[i] = response.Data[i].Name;
        aData[i] = response.Data[i].nTotAmt;
        aColor[i] = response.Data[i].bgColor;
      }
      var ctx = document.getElementById("barChartCats");
      newBarChart(ctx, aLabels, [{
          label: 'Sales',
          data: aData,
          backgroundColor: aColor,
          borderWidth: 1
        }]);
    }
  });

  $.ajax({
    type: 'POST',
    async: false,
    url: PhSettings.serviceURL + '/Dashboard/OrdersByBrand',
    data: {},
    success: function (response) {
      let aLabels = [];
      let aData = [];
      let aColor = [];
      for (var i = 0; i < response.Data.length; i++) {
        aLabels[i] = response.Data[i].Name;
        aData[i] = response.Data[i].nTotAmt;
        aColor[i] = response.Data[i].bgColor;
      }
      var ctx = document.getElementById("barChartBrands");
      newBarChart(ctx, aLabels, [{
          label: 'Sales',
          data: aData,
          backgroundColor: aColor,
          borderWidth: 1
        }]);
    }
  });

  $.ajax({
    type: 'POST',
    async: false,
    url: PhSettings.serviceURL + '/Dashboard/OrdersByTag',
    data: {},
    success: function (response) {
      let aLabels = [];
      let aData = [];
      let aColor = [];
      for (var i = 0; i < response.Data.length; i++) {
        aLabels[i] = response.Data[i].Name;
        aData[i] = response.Data[i].nTotAmt;
        aColor[i] = response.Data[i].bgColor;
      }
      var ctx = document.getElementById("barChartTags");
      newBarChart(ctx, aLabels, [{
          label: 'Sales',
          data: aData,
          backgroundColor: aColor,
          borderWidth: 1
        }]);
    }
  });

  $.ajax({
    type: 'POST',
    async: false,
    url: PhSettings.serviceURL + '/Dashboard/OrdersByMonths',
    data: {},
    success: function (response) {
      let aLabels = [];
      let aData = [];
      let aColor = [];
      for (var i = 0; i < response.Data.length; i++) {
        aLabels[i] = response.Data[i].Name;
        aData[i] = response.Data[i].nTotAmt;
        aColor[i] = response.Data[i].bgColor;
      }
      var ctx = document.getElementById("barChartMonths");
      newBarChart(ctx, aLabels, [{
          label: 'Sales',
          data: aData,
          backgroundColor: aColor,
          borderWidth: 1
        }]);
    }
  });

  $.ajax({
    type: 'POST',
    async: false,
    url: PhSettings.serviceURL + '/Dashboard/OrdersByWeekDays',
    data: {},
    success: function (response) {
      let aLabels = [];
      let aData = [];
      let aColor = [];
      for (var i = 0; i < response.Data.length; i++) {
        aLabels[i] = response.Data[i].Name;
        aData[i] = response.Data[i].nTotAmt;
        aColor[i] = response.Data[i].bgColor;
      }
      var ctx = document.getElementById("barChartWeekDays");
      newBarChart(ctx, aLabels, [{
          label: 'Sales',
          data: aData,
          backgroundColor: aColor,
          borderWidth: 1
        }]);
    }
  });

  $.ajax({
    type: 'POST',
    async: false,
    url: PhSettings.serviceURL + '/Dashboard/OrdersByHours',
    data: {},
    success: function (response) {
      let aLabels = [];
      let aData = [];
      let aColor = [];
      for (var i = 0; i < response.Data.length; i++) {
        aLabels[i] = response.Data[i].Name;
        aData[i] = response.Data[i].nTotAmt;
        aColor[i] = response.Data[i].bgColor;
      }
      var ctx = document.getElementById("barChartHours");
      newBarChart(ctx, aLabels, [{
          label: 'Sales',
          data: aData,
          backgroundColor: aColor,
          borderWidth: 1
        }]);
    }
  });

}
)(jQuery);
