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
          <div class="col-md-2">
            <label class="form-label"><input class="form-check-input" type="checkbox" value="" id="chk-cnt" checked=""> <?php echo getLabel('lbl.cms.Count'); ?> </label>
          </div>
          <div class="col-md-2">
            <label class="form-label"><input class="form-check-input" type="checkbox" value="" id="chk-sum" checked=""> <?php echo getLabel('lbl.cms.Sum'); ?> </label>
          </div>
          <div class="col-md-2">
            <label class="form-label"><input class="form-check-input" type="checkbox" value="" id="chk-min" checked=""> <?php echo getLabel('lbl.cms.Min'); ?> </label>
          </div>
          <div class="col-md-2">
            <label class="form-label"><input class="form-check-input" type="checkbox" value="" id="chk-avg" checked=""> <?php echo getLabel('lbl.cms.Avg'); ?> </label>
          </div>
          <div class="col-md-1">
            <label class="form-label"><input class="form-check-input" type="checkbox" value="" id="chk-max" checked=""> <?php echo getLabel('lbl.cms.Max'); ?> </label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <label class="form-label"><input class="form-check-input" type="checkbox" value="" id="chk-qnt" checked=""> <?php echo getLabel('lbl.cms.Qnt'); ?> </label>
          </div>
          <div class="col-md-2">
            <label class="form-label"><input class="form-check-input" type="checkbox" value="" id="chk-cost" checked=""> <?php echo getLabel('lbl.cms.Cost'); ?> </label>
          </div>
          <div class="col-md-2">
            <label class="form-label"><input class="form-check-input" type="checkbox" value="" id="chk-prc" checked=""> <?php echo getLabel('lbl.cms.Price'); ?> </label>
          </div>
          <div class="col-md-2">
            <label class="form-label"><input class="form-check-input" type="checkbox" value="" id="chk-net" checked=""> <?php echo getLabel('lbl.cms.Amount'); ?> </label>
          </div>
          <div class="col-md-2">
            <label class="form-label"><input class="form-check-input" type="checkbox" value="" id="chk-grs" checked=""> <?php echo getLabel('lbl.cms.Gross Profit'); ?> </label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <select id="fldStudy" class="form-select form-select-sm danger-select">
              <option value="1"><?php echo getLabel('lbl.cms.By Year') ?></option>
              <option value="2"><?php echo getLabel('lbl.cms.By Month') ?></option>
              <option value="3"><?php echo getLabel('lbl.cms.By Week') ?></option>
              <option value="4"><?php echo getLabel('lbl.cms.By Week Day') ?></option>
              <option value="5"><?php echo getLabel('lbl.cms.By Month Day') ?></option>
              <option value="6"><?php echo getLabel('lbl.cms.By Time') ?></option>
              <option value="13"><?php echo getLabel('lbl.cms.By Products') ?></option>
            </select>
          </div>
          <div class="col-md-2 ps-0">
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
              <th><?php echo getLabel('lbl.cms.Qnt') ?></th>
              <th><?php echo getLabel('lbl.cms.Min Qnt') ?></th>
              <th><?php echo getLabel('lbl.cms.Avg Qnt') ?></th>
              <th><?php echo getLabel('lbl.cms.Max Qnt') ?></th>
              <th><?php echo getLabel('lbl.cms.Cost') ?></th>
              <th><?php echo getLabel('lbl.cms.Min Cost') ?></th>
              <th><?php echo getLabel('lbl.cms.Avg Cost') ?></th>
              <th><?php echo getLabel('lbl.cms.Max cost') ?></th>
              <th><?php echo getLabel('lbl.cms.Amount') ?></th>
              <th><?php echo getLabel('lbl.cms.Min Amount') ?></th>
              <th><?php echo getLabel('lbl.cms.Avg Amount') ?></th>
              <th><?php echo getLabel('lbl.cms.Max Amount') ?></th>
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
