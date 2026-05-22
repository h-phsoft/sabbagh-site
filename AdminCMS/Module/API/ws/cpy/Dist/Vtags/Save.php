<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Update)) {

    $oInstance = cDistVtags::getInstance($nId);
    $oInstance->TagId = $oRest->getParameter('nTagId');
    $oInstance->TagName = $oRest->getParameter('vTagName');
    $oInstance->ColorId = $oRest->getParameter('nColorId');
    $oInstance->ColorName = $oRest->getParameter('vColorName');
    if ($oRest->getParameter('vFile')) {
      if ($oRest->getParameter('nId') > 0 && $oInstance->Image) {
        try {
          if (file_exists($vAttacheRootPath . 'Vtags/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . 'Vtags/' . $oInstance->Image);
          }
        } catch (Exception $exc) {
        }
      }
      $vOrigionName = $oRest->getParameter('vFName');
      $vFName = substr($vOrigionName, 0, strrpos($vOrigionName, '.'));
      $oInstance->Image = base64_to_file($oRest->getParameter('vFile'), 'Vtags_' . $vFName, $oRest->getParameter('vFExt'), $vAttacheRootPath . 'Vtags');
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
