<?php
$vBreadCrumb = Ph_getBreadCrumb($requestProg);
?>
<section class="content-main">
  <div class="contaner-fluid mb-3">
    <div class="row">
      <div class="col-sm-6">
        <h2 class="content-title">
          <i class="icon-xxl <?php echo $requestProg->Icon; ?>"></i>
          <?php echo getLabel($requestProg->Name); ?>
        </h2>
        <div>
          <?php echo $vBreadCrumb; ?>
        </div>
      </div>
      <div class="col-6 col-sm-3 text-start">

      </div>
      <div class="col-6 col-sm-3 text-end">

      </div>
    </div>
  </div>

  <div class="card card-custom">
    <div class="card-body">
      <div class="row pt-1">
        <div class="col-md-2 pe-0">
          <input id="fldSDate" class="form-control form-control-sm" type="date" value="<?php echo date('Y') . '-01-01'; ?>" max="<?php echo ph_GetCurrentDate(); ?>" required="true" />
        </div>
        <div class="col-md-2 ps-0">
          <input id="fldEDate" class="form-control form-control-sm" type="date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo ph_GetCurrentDate(); ?>" required="true" />
        </div>
        <div class="col-md-3">
          <select id="fldStudy" class="form-select form-select-sm danger-select">
            <option value="1"><?php echo getLabel('lbl.cms.Orders By Year') ?></option>
            <option value="2"><?php echo getLabel('lbl.cms.Orders By Month') ?></option>
            <option value="3"><?php echo getLabel('lbl.cms.Orders By Week') ?></option>
            <option value="4"><?php echo getLabel('lbl.cms.Orders By Week Day') ?></option>
            <option value="5"><?php echo getLabel('lbl.cms.Orders By Month Day') ?></option>
            <option value="6"><?php echo getLabel('lbl.cms.Orders By Time') ?></option>
            <option value="7"><?php echo getLabel('lbl.cms.Orders By Status') ?></option>
          </select>
        </div>
        <div class="col-md-2 ps-0">
          <?php
          include "section/btn_execute.php";
          ?>
        </div>
      </div>
    </div>
  </div>

  <div id="result-card" class="card card-custom d-none">
    <div class="card-body">
      <div class="row pt-2">
        <div class="col-12 text-center">
          <div id="pagingTop" class="pagination d-flex justify-content-center"></div>
        </div>
      </div>
      <div class="row pt-2 g-3">
        <div class="table-responsive">
          <table id="result-Table" class="table table-hover">
            <thead>
              <tr>
                <th><?php echo getLabel('lbl.cms.Group') ?></th>
                <th><?php echo getLabel('lbl.cms.Count') ?></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="row pt-2">
        <div class="col-12 text-center">
          <div id="pagingBottom" class="pagination d-flex justify-content-center"></div>
        </div>
      </div>
    </div>
  </div>

</section>
