<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomProdFacts::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->ProdId = $oRest->getParameter('nProdId');
    $oInstance->Ord = intval($oRest->getParameter('nOrd'));
    $oInstance->Name1 = $oRest->getParameter('vName1');
    $oInstance->Name2 = $oRest->getParameter('vName2');
    $oInstance->Val1 = $oRest->getParameter('vVal1');
    $oInstance->Val2 = $oRest->getParameter('vVal2');
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
