<?php

if (isset($oRest)) {

  if (($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    if ($oRest->getParameter('vFile')) {
      try {
        if (file_exists($vAttacheRootPath . '/logos/logo.png')) {
          unlink($vAttacheRootPath . '/logos/logo.png');
        }
      } catch (Exception $exc) {

      }
      $data = explode(',', $oRest->getParameter('vFile'));
      try {
        if (!file_exists($vAttacheRootPath . '/logos')) {
          mkdir($vAttacheRootPath . '/logos');
        }
        file_put_contents($vAttacheRootPath . '/logos/logo.png', base64_decode($data[1]));
        $oRest->setStatus(true);
        $oRest->setMessage('Done');
      } catch (Exception $exc) {
        $oRest->setStatus(false);
        $oRest->setMessage($exc->getMessage());
      }
    }
  }
}
