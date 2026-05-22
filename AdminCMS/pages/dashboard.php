<?php
$vBreadCrumb = Ph_getBreadCrumb($requestProg);
$nProdCounts = ph_GetDBValue('count(*)', 'ecom_product', 'status_id=1');
$nCategories = ph_GetDBValue('count(*)', 'ecom_cat', 'status_id=1');
$nOrders = ph_GetDBValue('count(*)', 'ecom_order', '`status_id`=0 and `addat`<DATE_ADD(CURDATE(), INTERVAL 1 DAY) and `addat`>DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
$n7DaysRevenue = ph_GetDBValue('CEIL(sum(item_amt-item_cost))', 'ecom_vorder_items', '`ord_status_id`=2 and `ord_addat`<DATE_ADD(CURDATE(), INTERVAL 1 DAY) and `ord_addat`>=DATE_SUB(CURDATE(), INTERVAL 7  DAY)');
$nMonthRevenue = ph_GetDBValue('CEIL(sum(item_amt-item_cost))', 'ecom_vorder_items', '`ord_status_id`=2 and `ord_addat`<DATE_ADD(CURDATE(), INTERVAL 1 DAY) and `ord_addat`>=DATE_SUB(CURDATE(), INTERVAL 30 DAY)');
if (!$n7DaysRevenue) {
  $n7DaysRevenue = 0;
}
if (!$nMonthRevenue) {
  $nMonthRevenue = 0;
}
?>
<section class="content-main">
  <div class="content-header">
    <div>
      <h2 class="content-title">
        <i class="icon-xxl <?php echo $requestProg->Icon; ?>"></i>
        <?php echo getLabel($requestProg->Name); ?>
      </h2>
      <div>
        <?php echo $vBreadCrumb; ?>
      </div>
    </div>
    <div>
      <!--<a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a>-->
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3">
      <div class="card card-body mb-4">
        <article class="icontext">
          <span class="icon icon-sm rounded-circle bg-primary-light">
            <i class="hz-icon-color icon-xxl bi bi-currency-dollar"></i>
          </span>
          <div class="text">
            <h6 class="mb-1 card-title">Revenue Last 7 Days</h6>
            <span><?php echo $n7DaysRevenue; ?></span>
            <span class="text-sm"> Done orders </span>
          </div>
        </article>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card card-body mb-4">
        <article class="icontext">
          <span class="icon icon-sm rounded-circle bg-primary-light">
            <i class="hz-icon-color icon-xxl bi bi-truck"></i>
          </span>
          <div class="text">
            <h6 class="mb-1 card-title">Orders</h6>
            <span><?php echo $nOrders; ?></span>
            <span class="text-sm"> New orders </span>
          </div>
        </article>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card card-body mb-4">
        <article class="icontext">
          <span class="icon icon-sm rounded-circle bg-primary-light">
            <i class="hz-icon-color icon-xxl bi bi-qr-code-scan"></i>
          </span>
          <div class="text">
            <h6 class="mb-1 card-title">Products</h6>
            <span><?php echo $nProdCounts; ?></span>
            <span class="text-sm"> In <?php echo $nCategories; ?> Categories </span>
          </div>
        </article>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card card-body mb-4">
        <article class="icontext">
          <span class="icon icon-sm rounded-circle bg-primary-light">
            <i class="hz-icon-color icon-xxl bi bi-basket"></i>
          </span>
          <div class="text">
            <h6 class="mb-1 card-title">Earning Last 30 Days</h6>
            <span><?php echo $nMonthRevenue; ?></span>
            <span class="text-sm"> Done orders </span>
          </div>
        </article>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <article class="card-body">
          <h5 class="card-title">Sale Last Year</h5>
          <canvas id="lineChartSales" width="100%" height="25vh"></canvas>
        </article>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-4 col-lg-12">
      <div class="card mb-4">
        <article class="card-body">
          <h5 class="card-title">Sales Last Year By Brands</h5>
          <canvas id="barChartBrands" width="100%"></canvas>
        </article>
      </div>
    </div>
    <div class="col-xl-4 col-lg-12">
      <div class="card mb-4">
        <article class="card-body">
          <h5 class="card-title">Sales Last Year By Category</h5>
          <canvas id="barChartCats" width="100%"></canvas>
        </article>
      </div>
    </div>
    <div class="col-xl-4 col-lg-12">
      <div class="card mb-4">
        <article class="card-body">
          <h5 class="card-title">Sales Last Year By Tags</h5>
          <canvas id="barChartTags" width="100%"></canvas>
        </article>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-4 col-lg-12">
      <div class="card mb-4">
        <article class="card-body">
          <h5 class="card-title">Sales Last Year By Months</h5>
          <canvas id="barChartMonths" width="100%"></canvas>
        </article>
      </div>
    </div>
    <div class="col-xl-4 col-lg-12">
      <div class="card mb-4">
        <article class="card-body">
          <h5 class="card-title">Sales Last Year By Week Days</h5>
          <canvas id="barChartWeekDays" width="100%"></canvas>
        </article>
      </div>
    </div>
    <div class="col-xl-4 col-lg-12">
      <div class="card mb-4">
        <article class="card-body">
          <h5 class="card-title">Sales Last Year By Hours</h5>
          <canvas id="barChartHours" width="100%"></canvas>
        </article>
      </div>
    </div>
  </div>
</section>
