<?php
if ($perms->Insert || $perms->Update) {
  ?>
  <span id="ph-submit" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("Save"); ?>">
    <i class="bi bi-check-lg"></i>
  </span>
  <?php
}
