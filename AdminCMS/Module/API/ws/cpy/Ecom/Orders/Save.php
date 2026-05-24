<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomOrder::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->CustId = $oRest->getParameter('nCustId');
    $oInstance->CurnId = $oRest->getParameter('nCurnId');
    $oInstance->Rate = $oRest->getParameter('nRate');
    $oInstance->Addat = $oRest->getParameter('dAddat');
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    try {
      $nSavedId = $oInstance->save($oUser->Id);
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
      $oRest->addRowDataValue('Id', $nSavedId);
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
