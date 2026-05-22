<?php
if ($perms->IsInsert) {
  ?>
  <span id="ph-new" class="btn btn-primary text-black mx-1" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("lbl.cms.New"); ?>">
    <i class="bi bi-file-earmark"></i>&nbsp;<?php echo getLabel('lbl.cms.New'); ?>
  </span>
  <?php
}
