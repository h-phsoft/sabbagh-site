<?php
if ($perms->IsImport) {
  ?>
  <span id="ph-import" class="btn btn-info mx-1" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("lbl.cms.Import Excel File"); ?>">
    <i class="bi bi-upload"></i>&nbsp;<?php echo getLabel('lbl.cms.Upload'); ?>
  </span>
  <?php
}
