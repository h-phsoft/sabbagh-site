<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Update)) {

    $oInstance = cDistCategories::getInstance($nId);
    $oInstance->Id = $oRest->getParameter('nId');
    $oInstance->SupplierId = $oRest->getParameter('nSupplierId');
    $oInstance->Name = $oRest->getParameter('vName');
    $oInstance->Image = $oRest->getParameter('vImage');
    if ($oRest->getParameter('vFile')) {
      if ($oRest->getParameter('nId') > 0 && $oInstance->Image) {
        try {
          if (file_exists($vAttacheRootPath . 'Categories/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . 'Categories/' . $oInstance->Image);
          }
        } catch (Exception $exc) {
        }
      }
      $vOrigionName = $oRest->getParameter('vFName');
      $vFName = substr($vOrigionName, 0, strrpos($vOrigionName, '.'));
      $oInstance->Image = base64_to_file($oRest->getParameter('vFile'), 'Categories_' . $vFName, $oRest->getParameter('vFExt'), $vAttacheRootPath . 'Categories');
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
