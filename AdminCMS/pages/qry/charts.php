<?php
$vBreadCrumb = Ph_getBreadCrumb($requestProg);
$aStatuss = cPhsCode::getArray(cPhsCode::STATUS);
$aYesNo = cPhsCode::getArray(cPhsCode::YESNO);
?>
<section class="content-main">
  <div class="content-header">
    <div>
      <div class="row">
        <h2 class="content-title">
          <i class="icon-xxl <?php echo $requestProg->Icon; ?>"></i>
          <?php echo getLabel($requestProg->Name); ?>
        </h2>
        <div>
          <?php echo $vBreadCrumb; ?>
        </div>
      </div>
    </div>
  </div>


  <div class="card card-custom">
    <div class="card-body">
      <?php
      if ($perms->Query) {
        ?>
        <div class="row py-2">
          <div class="col-sm-8 ps-0">
            <input id="ph-search-text" class="form-control form-control-sm text-center" type="text" value="" autocomplete="off" required="true" />
          </div>
          <div class="col-md-2 pe-0">
            <input id="fldSDate" class="form-control form-control-sm" type="date" value="<?php echo date('Y') . '-01-01'; ?>" max="<?php echo ph_GetCurrentDate(); ?>" required="true" />
          </div>
          <div class="col-md-2 ps-0">
            <input id="fldEDate" class="form-control form-control-sm" type="date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo ph_GetCurrentDate(); ?>" required="true" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-1 pe-0">
            <select id="ph-search-list-aggr" class="form-control">
              <option value="0"><?php echo getLabel('lbl.cms.Count'); ?></option>
              <option value="1"><?php echo getLabel('lbl.cms.Sum'); ?></option>
              <option value="2"><?php echo getLabel('lbl.cms.Min'); ?></option>
              <option value="3"><?php echo getLabel('lbl.cms.Avg'); ?></option>
              <option value="4"><?php echo getLabel('lbl.cms.Max'); ?></option>
            </select>
          </div>
          <div class="col-md-1 ps-0 pe-0">
            <select id="ph-search-list-value" class="form-control">
              <option value="1"><?php echo getLabel('lbl.cms.Qnt'); ?></option>
              <option value="2"><?php echo getLabel('lbl.cms.Cost'); ?></option>
              <option value="3"><?php echo getLabel('lbl.cms.Price'); ?></option>
              <option value="4"><?php echo getLabel('lbl.cms.Amount'); ?></option>
              <option value="5"><?php echo getLabel('lbl.cms.Gross Profit'); ?></option>
            </select>
          </div>
          <div class="col-md-2">
            <?php
            include "section/btn_execute.php";
            ?>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</div>

<div id="result-card" class="card card-custom d-none">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-4">
          <article class="card-body">
            <h5 id="lineChartDatesTitle" class="card-title"></h5>
            <canvas id="lineChartDates" width="100%" height="25vh"></canvas>
          </article>
        </div>
      </div>
    </div>
    <div id="chartsWrapper" class="row g-2">

    </div>
  </div>
</div>

</section>
