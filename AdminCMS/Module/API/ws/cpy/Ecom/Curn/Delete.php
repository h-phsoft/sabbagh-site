<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getParameter('progId'))->Delete) {

    $oInstance = cEcomCurn::getInstance($oRest->getParameter('nId'));
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
