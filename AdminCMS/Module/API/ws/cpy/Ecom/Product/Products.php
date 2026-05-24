<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

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
          $aSerials = cEcomProdSerial::getArray('`prod_id`=' . $product->Id . ' AND `snum` NOT IN (SELECT `serial` FROM `ecom_sales` WHERE `prod_id`=' . $product->Id . ')');
          $aProducts[$nProductIdx] = array(
            'nId' => $product->Id,
            'nMnum' => $product->Mnum,
            'nBrandId' => $product->BrandId,
            'nStatusId' => $product->StatusId,
            'nCatId' => $product->CatId,
            'nTagId' => $product->TagId,
            'vName1' => $product->Name1,
            'vName2' => $product->Name2,
            'nQnt' => $product->Qnt,
            'nPrice' => $product->Price,
            'nCprice' => $product->Cprice,
            'vDesc1' => $product->Desc1,
            'vDesc2' => $product->Desc2,
            'vImage' => $product->Image,
            'vBrandName' => $product->oBrand->Name1,
            'vCatName' => $product->oCat->Name1,
            'vStatusName' => $product->oStatus->Name,
            'vTagName' => $product->oTag->Name,
            'aSerials' => $aSerials
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
      'Message' => getLabel('Done'),
      'Data' => $aData
    ));
  }
}
