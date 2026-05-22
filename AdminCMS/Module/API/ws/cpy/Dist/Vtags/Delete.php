<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getParameter('progId'))->Delete) {
    $oInstance = cDistVtags::getInstance(intval($oRest->getParameter('nId')));

    try {
      if ($oInstance->Id > 1) {
        $oInstance->delete();
        $oRest->setStatus(true);
        $oRest->setMessage('Done');
      } else {
        $oRest->setStatus(false);
        $oRest->setMessage('Cannot Delete Main Record');
      }
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
