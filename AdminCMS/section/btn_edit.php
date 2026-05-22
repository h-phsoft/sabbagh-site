<?php
if ($perms->IsUpdate) {
  ?>
  <span id="ph-edit" class="btn btn-primary d-none" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("lbl.cms.Edit"); ?>">
    <i class="bi bi-pencil"></i>&nbsp;<?php echo getLabel('lbl.cms.Edit'); ?>
  </span>
  <?php
}
