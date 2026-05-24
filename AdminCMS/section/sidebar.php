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
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <?php
      echo cPhsProgram::getASideMenu($aMenu, $oUser, $vReqId);
      ?>
    </ul>

  </aside><!-- End Sidebar-->
  <div class="sidebar-backdrop d-none"></div>
  <?php
}
