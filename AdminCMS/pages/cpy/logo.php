<?php
$vBreadCrumb = Ph_getBreadCrumb($requestProg);
$aStatuss = cPhsCode::getArray(cPhsCode::STATUS);
?>
<script>
<?php
$vComma = '';
echo 'aStatus = [';
foreach ($aStatuss as $element) {
  echo $vComma . '{"Id": "' . $element->Id . '", "Name": "' . $element->Name . '"}';
  $vComma = ',';
}
echo '];';
?>
</script>
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

  <div class="container">
    <div class="row pt-2">
      <div class="col-sm-4 mx-auto p-2 card card-custom">
        <form id="ph_Form">
          <div class="row">
            <div class="col-sm-10 mx-auto text-center">
              <label for="fldFile" class="btn btn-primary" data-toggle="tooltip" title="Change image" data-original-title="<?php echo getLabel("lbl.cms.Change Image"); ?>">
                <i class="bi bi-file-image"></i> <?php echo getLabel("lbl.cms.Change Logo"); ?>
              </label>
              <input id="fldImage" class="form-control form-control-sm" type="hidden" value="" autocomplete="off" required="true" />
            </div>
          </div>
          <div class="row pt-5">
            <div class="col-12">
              <div class="w-100 p-0 text-center">
                <input id="fldFile" type="file" class="fileField d-none" accept="image/*" value="" data-previewer="fldImagePreview" data-relfld="fldAttach" data-filename="fldFileName"  data-relname="fldFName" data-relext="fldFExt" data-folder="itemcat">
                <input id="fldFName" type="hidden" value="">
                <input id="fldFileName" type="hidden" value="">
                <input id="fldFExt" type="hidden" value="">
                <input id="fldAttach" type="hidden" value="">
                <img id="fldImagePreview" class="border border-info border-1" src="" width="50%">
              </div>
            </div>
          </div>
          <div class="row pt-5">
            <div class="col-4 mx-auto text-center">
              <?php
              if ($perms->Insert === 1 || $perms->Update === 1) {
                include "section/btn_submit.php";
              }
              ?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
