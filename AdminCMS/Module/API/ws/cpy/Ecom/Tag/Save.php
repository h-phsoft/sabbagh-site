<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomTag::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    $oInstance->Text1 = $oRest->getParameter('vText1');
    $oInstance->Text2 = $oRest->getParameter('vText2');
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
