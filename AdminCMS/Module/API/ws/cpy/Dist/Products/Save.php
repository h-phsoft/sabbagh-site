<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Update)) {

    $oInstance = cDistProducts::getInstance($nId);
    $oInstance->Id = $oRest->getParameter('nId');
    $oInstance->CategoryId = $oRest->getParameter('nCategoryId');
    $oInstance->Name = $oRest->getParameter('vName');
    $oInstance->Price = $oRest->getParameter('nPrice');
    if ($oRest->getParameter('vFile')) {
      if ($oRest->getParameter('nId') > 0 && $oInstance->Image) {
        try {
          if (file_exists($vAttacheRootPath . 'Products/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . 'Products/' . $oInstance->Image);
          }
        } catch (Exception $exc) {

        }
      }
      $vOrigionName = $oRest->getParameter('vFName');
      $vFName = substr($vOrigionName, 0, strrpos($vOrigionName, '.'));
      $oInstance->Image = base64_to_file($oRest->getParameter('vFile'), 'Products_' . $vFName, $oRest->getParameter('vFExt'), $vAttacheRootPath . 'Products');
    }
    try {
      $nSavedId = $oInstance->save($oUser->Id);
      $oRest->setStatus(true);
      $oRest->setMessage(getLabel('lbl.cms.Done'));
      $oRest->addRowDataValue('Id', $nSavedId);
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
