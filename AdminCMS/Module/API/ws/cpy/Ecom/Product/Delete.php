<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Delete) {

    $oInstance = cEcomProduct::getInstance($oRest->getParameter('nId'));
    try {
      $oInstance->delete();
      try {
        if ($oInstance->Image) {
          if (file_exists($vAttacheRootPath . '/imgs/products/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . '/imgs/products/' . $oInstance->Image);
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
