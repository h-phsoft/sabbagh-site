<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update) {

    $oInstance = cEcomTicket::getInstance($nId);
    $oInstance->Id = $oRest->getParameter('nId');
    $oInstance->SaleId = $oRest->getParameter('nSaleId');
    $oInstance->UserId = $oUser->Id;
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    $oInstance->Action = $oRest->getParameter('vAction');
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
