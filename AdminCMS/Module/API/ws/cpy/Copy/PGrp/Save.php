<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $vName = $oRest->getParameter('vName');
    $oInstance = cCpyPGrp::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->Name = $vName;
    try {
      $nSavedId = $oInstance->save();
      if ($nId > 0) {

      } else {
        cCpyPerm::refreshPermissions($nSavedId);
      }
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
      $oRest->addRowDataValue('Id', $nSavedId);
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
