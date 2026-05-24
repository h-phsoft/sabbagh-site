<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomBrand::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    $oInstance->Name1 = $oRest->getParameter('vName1');
    $oInstance->Name2 = $oRest->getParameter('vName2');
    if ($oRest->getParameter('vFile')) {
      if ($oRest->getParameter('nId') > 0 && $oInstance->Image) {
        try {
          if (file_exists($vAttacheRootPath . '/imgs/brand/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . '/imgs/brand/' . $oInstance->Image);
          }
        } catch (Exception $exc) {

        }
      }
      $oInstance->Image = base64_to_file($oRest->getParameter('vFile'), 'Brand', $oRest->getParameter('vFExt'), $vAttacheRootPath . '/imgs/brand/');
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
