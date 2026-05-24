<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomAbout::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->Text1 = $oRest->getParameter('vText1');
    $oInstance->Text2 = $oRest->getParameter('vText2');
    if ($oRest->getParameter('nId') > 0 && $oInstance->Image) {
      try {
        unlink($vAttacheRootPath . '/imgs/about/' . $oInstance->Image);
      } catch (Exception $exc) {

      }
    }
    $oInstance->Image = base64_to_file($oRest->getParameter('vFile'), 'Cat', $oRest->getParameter('vFExt'), $vAttacheRootPath . '/imgs/about');
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
