<?php

if (isset($oRest)) {

  $vWhere = 'id>0';
  $aCatList = cEcomCat::getArray('status_id=1 AND id IN (SELECT `cat_id` FROM `ecom_product`)');
  $aData = array();
  $nCatIdx = 0;
  foreach ($aCatList as $cat) {
    $aBrands = array();
    $nBrandIdx = 0;
    $aBrandList = cEcomBrand::getArray('status_id=1 AND id IN (SELECT `brand_id` FROM `ecom_product` WHERE `cat_id`="' . $cat->Id . '")');
    foreach ($aBrandList as $brand) {
      $aProducts = array();
      $nProductIdx = 0;
      $aProducList = cEcomProduct::getArray('status_id=1 AND `cat_id`="' . $cat->Id . '" AND `brand_id`="' . $brand->Id . '"');
      foreach ($aProducList as $product) {
        $aProducts[$nProductIdx] = array(
          'nId' => $product->Id,
          'nOrd' => $product->Ord,
          'nBrandId' => $product->BrandId,
          'nStatusId' => $product->StatusId,
          'nCatId' => $product->CatId,
          'nTagId' => $product->TagId,
          'vName1' => $product->Name1,
          'vName2' => $product->Name2,
          'nQnt' => $product->Qnt,
          'nOPrice' => $product->OPrice,
          'nCPrice' => $product->CPrice,
          'nMOPrice' => $product->MOPrice,
          'nMCPrice' => $product->MCPrice,
          'vDesc1' => $product->Desc1,
          'vDesc2' => $product->Desc2,
          'vImage' => $product->Image,
          'vBrandName' => $product->oBrand->Name1,
          'vCatName' => $product->oCat->Name1,
          'vStatusName' => $product->oStatus->Name,
          'vTagName' => $product->oTag->Name,
          'vShopName' => $product->oShop->Name,
          'vMenuName' => $product->oMenu->Name,
        );
        $nProductIdx++;
      }
      $aBrands[$nBrandIdx] = array(
        'nId' => $brand->Id,
        'Name' => $brand->Name1,
        'Products' => $aProducts
      );
      $nBrandIdx++;
    }
    $aData[$nCatIdx] = array(
      'nId' => $cat->Id,
      'Name' => $cat->Name1,
      'WDays' => $cat->WDays,
      'Brands' => $aBrands
    );
    $nCatIdx++;
  }
  $oRest->setRowData(array(
    'Status' => true,
    'Message' => getLabel('lbl.cms.Done'),
    'Data' => $aData
  ));
}
