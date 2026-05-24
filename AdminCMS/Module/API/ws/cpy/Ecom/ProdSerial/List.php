<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nStart = intval($oRest->getParameter('start'));
    $nEnd = intval($oRest->getParameter('end'));
    $nPage = intval($oRest->getParameter('page'));
    $nPageSize = intval($oRest->getParameter('perpage'));
    if ($nPageSize === 0) {
      $nPageSize = 25;
    }
    $vSearchText = $oRest->getParameter('vText');
    if ($vSearchText) {
      $vSearchText = str_replace(" ", "%", $vSearchText);
    }
    $vWhere = '';
    if ($vSearchText != '') {
      $vWhere .= ''
        . ' (  UPPER(`snum`) LIKE UPPER("%' . $vSearchText . '%")'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE `cat_id` IN (SELECT id FROM ecom_cat WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%")))'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE `brand_id` IN (SELECT id FROM ecom_brand WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%")))'
        . ')';
    }
    $aList = cEcomProdSerial::getArray($vWhere, 'id', $nPage, $nPageSize);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $product = cEcomProduct::getInstance($element->ProdId);
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nBrandId' => $product->oBrand->Id,
        'vBrandName' => $product->oBrand->Name1,
        'nCatId' => $product->oCat->Id,
        'vCatName' => $product->oCat->Name1,
        'nProdId' => $element->ProdId,
        'vProdName' => $product->Name1,
        'vSerial' => $element->Snum,
      );
      $nIdx++;
    }
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'Data' => $aData
    ));
  }
}
