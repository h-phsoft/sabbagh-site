<?php
if ($perms->IsDelete) {
  ?>
  <span id="ph-delete" class="btn btn-danger mx-1 d-none" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("lbl.cms.Delete"); ?>">
    <i class="bi bi-trash"></i>&nbsp;<?php echo getLabel('lbl.cms.Delete'); ?>
  </span>
  <?php
}
