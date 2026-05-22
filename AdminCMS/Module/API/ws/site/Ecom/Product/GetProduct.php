<?php

if (isset($oRest)) {

  $nProdId = intval($oRest->getParameter('nId'));
  $instance = cEcomProduct::getInstance($nProdId);
  $nIdx = 0;
  $aComps = array();
  for ($ii = 0; $ii < count($instance->oCat->aComps); $ii++) {
    $catComp = $instance->oCat->aComps[$ii];
    $aProducts = cEcomProduct::getArray('status_id=1 AND id!=' . $nProdId . ' AND (id IN (SELECT prod_id FROM ecom_comp_prods WHERE comp_id="' . $catComp->CompId . '") OR cat_id IN (SELECT cat_id FROM ecom_comp_cats WHERE comp_id="' . $catComp->CompId . '"))');
    $nPIdx = 0;
    $aProds = array();
    foreach ($aProducts as $prod) {
      $aProds[$nPIdx] = array(
        'nId' => $prod->Id,
        'vName' => $prod->Name1,
        'nOPrice' => $prod->OPrice,
        'nCPrice' => $prod->CPrice,
        'nCost' => $prod->Cost,
        'nMOPrice' => $prod->MOPrice,
        'nMCPrice' => $prod->MCPrice,
        'nMCost' => $prod->MCost,
        'vImage' => $prod->Image,
        'nQty' => 0,
        'nAmt' => 0
      );
      $nPIdx++;
    }
    $aComps[$nIdx] = array(
      'nId' => $catComp->CompId,
      'vName' => $catComp->CompName,
      'nOrd' => $catComp->Ord,
      'isRequired' => $catComp->RequiredId === 1,
      'aProds' => $aProds
    );
    $nIdx++;
  }
  $aData = array(
    'nId' => $instance->Id,
    'nOrd' => $instance->Ord,
    'nBrandId' => $instance->BrandId,
    'nStatusId' => $instance->StatusId,
    'nCatId' => $instance->CatId,
    'nTagId' => $instance->TagId,
    'nShopId' => $instance->ShopId,
    'nMenuId' => $instance->MenuId,
    'vName1' => $instance->Name1,
    'vName2' => $instance->Name2,
    'nQnt' => $instance->Qnt,
    'nQty' => 1,
    'nOPrice' => $instance->OPrice,
    'nCPrice' => $instance->CPrice,
    'nCost' => $instance->Cost,
    'nMOPrice' => $instance->MOPrice,
    'nMCPrice' => $instance->MCPrice,
    'nMCost' => $instance->MCost,
    'nAmt' => $instance->CPrice,
    'vDesc1' => $instance->Desc1,
    'vDesc2' => $instance->Desc2,
    'vDesc3' => $instance->Desc3,
    'vDesc4' => $instance->Desc4,
    'vDesc5' => $instance->Desc5,
    'vImage' => $instance->Image,
    'vBrandName' => $instance->oBrand->Name1,
    'vCatName' => $instance->oCat->Name1,
    'vStatusName' => $instance->oStatus->Name,
    'vTagName' => $instance->oTag->Name,
    'vShopName' => $instance->oShop->Name,
    'vMenuName' => $instance->oMenu->Name,
    'vComments' => '',
    //'aImages' => $instance->aImages,
    //'aSizes' => $instance->aSizes,
    'aComps' => $aComps,
  );
  $oRest->setRowData(array(
    cPhsRest::RESPONSE_KEY_STATUS => true,
    cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
    cPhsRest::RESPONSE_KEY_DATA => $aData
  ));
}
