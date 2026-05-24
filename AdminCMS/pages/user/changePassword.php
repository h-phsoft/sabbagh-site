<?php
$vBreadCrumb = Ph_getBreadCrumb($requestProg);
?>
<div class="pagetitle">
  <div class="row">
    <div class="col-12 col-sm-3">
      <div class="row">
        <div class="col-12">
          <h1><?php echo getLabel($requestProg->Name); ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <span><?php echo getLabel("user") . " > " . getLabel("Change Password"); ?></span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-start">
    </div>
    <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center">

    </div>
    <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-end">
    </div>
  </div>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-sm-5 mx-auto">
      <div class="card card-custom">
        <div class="card-body">
          <div class="row pb-2">
            <div class="col-12 text-center">
              <label id="Status" class="text-center text-danger"></label>
            </div>
          </div>
          <form>
            <div class="row">
              <label for="fldOld" class="col-sm-4 text-end" data-label="Num"><?php echo getLabel('Current Password') ?></label>
              <div class="col-sm-8">
                <input id="fldOld" class="form-control form-control-sm" type="text">
              </div>
            </div>
            <div class="row my-1">
              <label for="fldNew" class="col-sm-4 text-end" data-label="Num"><?php echo getLabel('New Password') ?></label>
              <div class="col-sm-8">
                <input id="fldNew" class="form-control form-control-sm" type="text">
              </div>
            </div>
            <div class="row">
              <label for="fldVerify" class="col-sm-4 text-end" data-label="Num"><?php echo getLabel('Verify Password') ?></label>
              <div class="col-sm-8">
                <input id="fldVerify" class="form-control form-control-sm" type="text">
              </div>
            </div>
            <div class="row my-2">
              <div class="col-sm-4 text-end">
              </div>
              <div class="col-sm-8 text-start">
                <?php include 'section/btn_submit.php'; ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
