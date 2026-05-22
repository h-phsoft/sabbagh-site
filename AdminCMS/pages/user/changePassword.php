<?php
$vBreadCrumb = Ph_getBreadCrumb($requestProg);
?>
<section class="content-main">
  <div class="content-header">
    <div>
      <h2 class="content-title"><?php echo getLabel($requestProg->Name); ?></h2>
      <p><?php echo $vBreadCrumb; ?></p>
    </div>
    <div>
      <?php echo $vBreadCrumb; ?>
    </div>
  </div>
  <div class="card mb-4">
    <header class="card-header">
      <h4>Card header</h4>
    </header>
    <div class="card-body">
      <div class="row pb-2">
        <div class="col-12 text-center">
          <label id="Status" class="text-center text-danger"></label>
        </div>
      </div>
      <form>
        <div class="row">
          <label for="fldOld" class="col-sm-4 text-end" data-label="Num"><?php echo getLabel('lbl.cms.Current Password') ?></label>
          <div class="col-sm-4">
            <input id="fldOld" class="form-control form-control-sm" type="password">
          </div>
        </div>
        <div class="row my-1">
          <label for="fldNew" class="col-sm-4 text-end" data-label="Num"><?php echo getLabel('lbl.cms.New Password') ?></label>
          <div class="col-sm-4">
            <input id="fldNew" class="form-control form-control-sm" type="password">
          </div>
        </div>
        <div class="row">
          <label for="fldVerify" class="col-sm-4 text-end" data-label="Num"><?php echo getLabel('lbl.cms.Verify Password') ?></label>
          <div class="col-sm-4">
            <input id="fldVerify" class="form-control form-control-sm" type="password">
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
    <header class="card-footer">
      <h4>Card footer</h4>
    </header>
  </div>
  <!-- card end// -->
</section>
