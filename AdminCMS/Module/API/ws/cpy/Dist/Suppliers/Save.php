<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Update)) {

    $oInstance = cDistSuppliers::getInstance($nId);
    $oInstance->Id = $oRest->getParameter('nId');
    $oInstance->GroupId = $oRest->getParameter('nGroupId');
    $oInstance->CountryId = $oRest->getParameter('nCountryId');
    $oInstance->Name = $oRest->getParameter('vName');
    $oInstance->Paragraph = $oRest->getParameter('vParagraph');
    if ($oRest->getParameter('vFile')) {
      if ($oRest->getParameter('nId') > 0 && $oInstance->Image) {
        try {
          if (file_exists($vAttacheRootPath . 'Suppliers/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . 'Suppliers/' . $oInstance->Image);
          }
        } catch (Exception $exc) {

        }
      }
      $vOrigionName = $oRest->getParameter('vFName');
      $vFName = substr($vOrigionName, 0, strrpos($vOrigionName, '.'));
      $oInstance->Image = base64_to_file($oRest->getParameter('vFile'), 'Suppliers_' . $vFName, $oRest->getParameter('vFExt'), $vAttacheRootPath . 'Suppliers');
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
