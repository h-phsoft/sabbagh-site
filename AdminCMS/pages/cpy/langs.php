<?php
$vBreadCrumb = Ph_getBreadCrumb($requestProg);
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

  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-3">
          <form id="ph_Form">
            <div class="row pt-1">
              <input id="fldId" class="form-control form-control-sm" type="hidden" value="0" autocomplete="off" required="true" />
              <label for="fldName" class="col-form-label"><?php echo getLabel('lbl.cms.Name'); ?></label>
              <input id="fldName" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
            </div>
            <div class="row pt-1">
              <label for="fldCode" class="col-form-label"><?php echo getLabel('lbl.cms.Code'); ?></label>
              <input id="fldCode" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
            </div>
            <div class="row pt-1">
              <label for="fldDir" class="col-form-label"><?php echo getLabel('lbl.cms.Direction'); ?></label>
              <select id="fldDir" class="form-select form-select-sm">
                <option value="ltr"><?php echo getLabel('lbl.cms.Left To Right'); ?></option>
                <option value="rtl"><?php echo getLabel('lbl.cms.Right To Left'); ?></option>
              </select>
            </div>
            <div class="row pt-1">
              <label for="fldRem" class="col-form-label"><?php echo getLabel('lbl.cms.Remarks'); ?></label>
              <input id="fldRem" class="form-control form-control-sm" type="text" value="" autocomplete="off" />
            </div>
            <div class="row pt-1">
              <div class="col-4 pt-1 pt-sm-0 d-flex align-items-center justify-content-start">
                <?php include "section/btn_submit.php" ?>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-9">
          <div class="table-responsive">
            <table id="result-Table" class="table table-hover">
              <thead>
                <tr>
                  <th class="text-center">Action</th>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Direction</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <!-- .col// -->
      </div>
      <!-- .row // -->
    </div>
    <!-- card body .// -->
  </div>

</section>
