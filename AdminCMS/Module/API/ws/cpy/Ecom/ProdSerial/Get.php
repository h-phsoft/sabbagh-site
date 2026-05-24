<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEcomVproductSerial::getInstanceBySerial($oRest->getParameter('vSerial'));
    $aData = array(
      'nBrandId' => $instance->BrandId,
      'nBrandStatusId' => $instance->BrandStatusId,
      'vBrandName1' => $instance->BrandName1,
      'vBrandName2' => $instance->BrandName2,
      'vBrandImage' => $instance->BrandImage,
      'nCatId' => $instance->CatId,
      'nCatStatusId' => $instance->CatStatusId,
      'nCatOrder' => $instance->CatOrder,
      'vCatName1' => $instance->CatName1,
      'vCatName2' => $instance->CatName2,
      'vCatImage' => $instance->CatImage,
      'nCatWdays' => $instance->CatWdays,
      'nTagId' => $instance->TagId,
      'nTagStatusId' => $instance->TagStatusId,
      'vTagName' => $instance->TagName,
      'vTagClassname' => $instance->TagClassname,
      'nProdId' => $instance->ProdId,
      'nProdMnum' => $instance->ProdMnum,
      'nProdStatusId' => $instance->ProdStatusId,
      'vProdName1' => $instance->ProdName1,
      'vProdName2' => $instance->ProdName2,
      'nProdQnt' => $instance->ProdQnt,
      'nProdPrice' => $instance->ProdPrice,
      'nProdCprice' => $instance->ProdCprice,
      'vProdDesc1' => $instance->ProdDesc1,
      'vProdDesc2' => $instance->ProdDesc2,
      'vProdImage' => $instance->ProdImage,
      'nSerialId' => $instance->SerialId,
      'vSerialSnum' => $instance->SerialSnum,
      'nSizeQnt' => $instance->SizeQnt,
      'nSizeCqnt' => $instance->SizeCqnt,
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
