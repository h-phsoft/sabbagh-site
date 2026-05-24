<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEcomProduct::getInstance($oRest->getParameter('nId'));
    $aData = array(
      'nId' => $instance->Id,
      'nMnum' => $instance->Mnum,
      'nBrandId' => $instance->BrandId,
      'nStatusId' => $instance->StatusId,
      'nCatId' => $instance->CatId,
      'nTagId' => $instance->TagId,
      'vName1' => $instance->Name1,
      'vName2' => $instance->Name2,
      'nQnt' => $instance->Qnt,
      'nPrice' => $instance->Price,
      'nCprice' => $instance->Cprice,
      'vDesc1' => $instance->Desc1,
      'vDesc2' => $instance->Desc2,
      'vImage' => $instance->Image,
      'vBrandName' => $instance->oBrand->Name1,
      'vCatName' => $instance->oCat->Name1,
      'vStatusName' => $instance->oStatus->Name,
      'vTagName' => $instance->oTag->Name,
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
