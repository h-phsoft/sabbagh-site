<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomProdSize::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->ProdId = $oRest->getParameter('nProdId');
    $oInstance->UnitId = $oRest->getParameter('nUnitId');
    $oInstance->Snum = $oRest->getParameter('nSnum');
    $oInstance->Anum = $oRest->getParameter('nAnum');
    $oInstance->Name = $oRest->getParameter('vName');
    $oInstance->Box = $oRest->getParameter('nBox');
    $oInstance->Qnt = $oRest->getParameter('nQnt');
    $oInstance->Price = $oRest->getParameter('nPrice');
    $oInstance->Cprice = $oRest->getParameter('nCprice');
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
