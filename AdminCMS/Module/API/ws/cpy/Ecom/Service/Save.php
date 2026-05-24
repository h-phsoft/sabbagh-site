<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomService::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->Name1 = $oRest->getParameter('vName1');
    $oInstance->Name2 = $oRest->getParameter('vName2');
    $oInstance->TypeId = $oRest->getParameter('nTypeId');
    $oInstance->Amtperc = $oRest->getParameter('nAmtperc');
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
