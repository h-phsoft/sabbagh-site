<?php

if (isset($oRest)) {

  $nId = $oRest->getParameter('nId');
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Update)) {

    $oInstance = cEcomCart::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->CustId = $oRest->getParameter('nCustId');
    $oInstance->Addat = $oRest->getParameter('dAddat');
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    $oInstance->ProdId = $oRest->getParameter('nProdId');
    $oInstance->SizeId = $oRest->getParameter('nSizeId');
    $oInstance->Qnt = $oRest->getParameter('nQnt');
    $oInstance->Price = $oRest->getParameter('nPrice');
    $oInstance->Cprice = $oRest->getParameter('nCprice');
    $oInstance->Amt = $oRest->getParameter('nAmt');
    $oInstance->Disc = $oRest->getParameter('nDisc');
    $oInstance->Net = $oRest->getParameter('nNet');
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
