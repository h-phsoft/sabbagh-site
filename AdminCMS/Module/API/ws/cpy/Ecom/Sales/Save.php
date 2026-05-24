<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomSales::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->BranId = $oUser->BranId;
    $oInstance->Mdate = $oRest->getParameter('dMDate');
    $oInstance->ProdId = $oRest->getParameter('nProdId');
    $oInstance->Serial = $oRest->getParameter('vSerial');
    $oInstance->Wdays = $oRest->getParameter('nWDays');
    $oInstance->Edate = $oRest->getParameter('dEDate');
    $oInstance->Customer = $oRest->getParameter('vCustomer');
    $oInstance->CAddress = $oRest->getParameter('vCAddress');
    $oInstance->CMobile = $oRest->getParameter('vCMobile');
    try {
      if (isset($oInstance->Serial) && $oInstance->Serial != '') {
        $nSavedId = $oInstance->save($oUser->Id);
        $oRest->setStatus(true);
        $oRest->setMessage('Done');
        $oRest->addRowDataValue('Id', $nSavedId);
      }
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
