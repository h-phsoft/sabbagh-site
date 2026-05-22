<?php
if ($oUser != null) {
  $vSubWhere = '`grp_id`>=' . $oUser->GrpId;
  $vWhere = '`prog_id`=0 AND `grp_id`>=' . $oUser->GrpId;
  if ($oUser->GrpId > 0) {
    $vSubWhere = '`grp_id`>=' . $oUser->GrpId . ' AND id IN (SELECT p.prog_id FROM `cpy_perm_grp` AS g, `cpy_perm` AS p WHERE p.grp_id=g.id AND grp_id=' . $oUser->GrpId . ' AND isok=1)';
    $vWhere = '`prog_id`=0 AND `grp_id`>=' . $oUser->GrpId . ' AND id IN (SELECT p.prog_id FROM `cpy_perm_grp` AS g, `cpy_perm` AS p WHERE p.grp_id=g.id AND grp_id=' . $oUser->GrpId . ' AND isok=1)';
  }
  $aMenu = cPhsProgram::getArray($vWhere, $vSubWhere, '`ord`');
  if (!isset($vReqId) || $vReqId == null || $vReqId == '') {
    $vReqId = '';
  }
  ?>
  <?php
}
?>
<aside class="navbar-aside" id="offcanvas_aside">
  <div class="aside-top">
    <div></div>
    <a href="<?php echo $vRootPath; ?>" class="brand-wrap">
      <img src="assets/media/logos/logo.png" class="logo" alt="Nest Dashboard" />
    </a>
    <div>
      <button class="btn btn-icon btn-aside-minimize"><i class="icon bi bi-text-indent-right"></i></button>
    </div>
  </div>
  <nav>
    <ul class="menu-aside">
      <?php
      echo cPhsProgram::getSideMenu($aMenu, $oUser, $vReqId);
      ?>
    </ul>
  </nav>
</aside>
