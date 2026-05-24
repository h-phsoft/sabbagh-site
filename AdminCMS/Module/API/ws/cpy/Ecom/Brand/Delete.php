<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Delete) {

    $oInstance = cEcomBrand::getInstance($oRest->getParameter('nId'));
    try {
      $oInstance->delete();
      try {
        if ($oInstance->Image) {
          if (file_exists($vAttacheRootPath . '/imgs/brand/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . '/imgs/brand/' . $oInstance->Image);
          }
        }
      } catch (Exception $exc) {

      }
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
