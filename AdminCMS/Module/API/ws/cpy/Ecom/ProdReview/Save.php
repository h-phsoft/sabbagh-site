<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomProdReview::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->ProdId = $oRest->getParameter('nProdId');
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    $oInstance->Addat = $oRest->getParameter('dAddat');
    $oInstance->Name = $oRest->getParameter('vName');
    $oInstance->Email = $oRest->getParameter('vEmail');
    $oInstance->Text = $oRest->getParameter('vText');
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
