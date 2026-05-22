<?php

if (isset($oRest)) {
  $nId = $oRest->getParameter('nId');
  if ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Delete) {
    $oInstance = cCpyPGrp::getInstance($nId);
    try {
      $oInstance->delete();
      $oRest->setMessage('Done');
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}

