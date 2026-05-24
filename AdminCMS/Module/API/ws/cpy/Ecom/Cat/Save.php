<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomCat::getInstance($oRest->getParameter('nId'));
    $oInstance->Id = $nId;
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    $oInstance->Order = intval($oRest->getParameter('nOrder'));
    $oInstance->WDays = $oRest->getParameter('nWDays');
    $oInstance->Name1 = $oRest->getParameter('vName1');
    $oInstance->Name2 = $oRest->getParameter('vName2');
    $oInstance->Description = $oRest->getParameter('vDescription');
    if ($oRest->getParameter('vFile')) {
      if ($oRest->getParameter('nId') > 0 && $oInstance->Image) {
        try {
          if (file_exists($vAttacheRootPath . '/imgs/category/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . '/imgs/category/' . $oInstance->Image);
          }
        } catch (Exception $exc) {

        }
      }
      $oInstance->Image = base64_to_file($oRest->getParameter('vFile'), 'Cat', $oRest->getParameter('vFExt'), $vAttacheRootPath . '/imgs/category');
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
