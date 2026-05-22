<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Delete) {
    $nId = $oRest->getParameter('nId');
    $vCode = $oRest->getParameter('code');
    $oInstance = cCpyCode::getInstance($vCode, $nId);
    try {
      $oInstance->delete();
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
