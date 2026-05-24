<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomWishlist::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->Token = $oRest->getParameter('vToken');
    $oInstance->Addat = $oRest->getParameter('dAddat');
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    $oInstance->ProdId = $oRest->getParameter('nProdId');
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
