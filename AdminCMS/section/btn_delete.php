<?php
if ($perms->Delete) {
  ?>
  <span id="ph-delete" class="btn btn-danger mx-1 d-none" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("Delete"); ?>">
    <i class="bi bi-trash"></i>
  </span>
  <?php
}
