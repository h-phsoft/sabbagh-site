<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEComBanner::getInstance($oRest->getParameter('nId'));
    $oInstance->Id = $nId;
    $oInstance->Order = intval($oRest->getParameter('nOrder'));
    $oInstance->Name = $oRest->getParameter('vName');
    if ($oRest->getParameter('vFile')) {
      if ($oRest->getParameter('nId') > 0 && $oInstance->Image) {
        try {
          if (file_exists($vAttacheRootPath . '/imgs/banner/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . '/imgs/banner/' . $oInstance->Image);
          }
        } catch (Exception $exc) {

        }
      }
      $oInstance->Image = base64_to_file($oRest->getParameter('vFile'), 'Banner', $oRest->getParameter('vFExt'), $vAttacheRootPath . '/imgs/banner');
    }
    try {
      $nSavedId = $oInstance->save();
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
      $oRest->addRowDataValue('Id', $nSavedId);
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
