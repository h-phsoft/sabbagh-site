<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = $oRest->getParameter('id');
    cCpyPerm::refreshPermissions($nId);
    $instance = cCpyPGrp::getInstance($nId);
    $aData = array(
      'nId' => $instance->Id,
      'vName' => $instance->Name,
      'vRem' => $instance->Rem,
      'aPerms' => $instance->aPerms
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
