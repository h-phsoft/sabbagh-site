<?php
if ($perms->IsInsert || $perms->IsUpdate) {
  ?>
  <span id="ph-submit-sizes" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("lbl.cms.Save"); ?>">
    <span class="btn-text"><i class="bi bi-check-lg"></i>&nbsp;<?php echo getLabel('lbl.cms.Save'); ?></span>
    <span class="ms-2 spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
  </span>
  <?php
}
