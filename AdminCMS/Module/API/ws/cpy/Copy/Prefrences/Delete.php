<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Delete) {

    $oInstance = cCpyPref::getInstance($oRest->getParameter('nId'));
    try {
      $oInstance->delete();
      $oRest->setMessage('Done');
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
