<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Delete) {
    $oInstance = cPhsLang::getInstance($oRest->getParameter('nId'));
    try {
      if ($oInstance->Id > 1) {
        $oInstance->delete();
        $oRest->setStatus(true);
        $oRest->setMessage('Done');
      } else {
        $oRest->setStatus(false);
        $oRest->setMessage('Cannot Delete Main Language');
      }
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
