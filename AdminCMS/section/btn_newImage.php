<?php
if ($perms->IsInsert) {
  ?>
  <span id="ph-new-image" class="btn btn-warning mx-1" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("lbl.cms.New"); ?>">
    <i class="bi bi-file-earmark-plus"></i>&nbsp;<?php echo getLabel('lbl.cms.New'); ?>
  </span>
  <?php
}
