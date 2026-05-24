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
    $vWhere = 'id>0';
    if ($oUser->GrpId > 0) {
      $vWhere .= ' AND `bran_id`="' . $oUser->BranId . '"';
    }
    if ($vSearchText != '') {
      $vWhere .= ' AND'
        . ' (  UPPER(`customer`) LIKE UPPER("%' . $vSearchText . '%")'
        . ' OR UPPER(`serial`) LIKE UPPER("%' . $vSearchText . '%")'
        . ' OR `ins_user` IN (SELECT id FROM cpy_user WHERE UPPER(name) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE `cat_id` IN (SELECT id FROM ecom_cat WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%")))'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE `brand_id` IN (SELECT id FROM ecom_brand WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%")))'
        . ' OR UPPER(`serial`) LIKE UPPER("%' . $vSearchText . '%")'
        . ')';
    }
    $aList = cEcomSales::getArray($vWhere, '', $nPage, $nPageSize);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $vBranchName = ph_GetDBValue('name', 'cpy_branch', 'id="' . $element->BranId . '"');
      $vBranchAddress = ph_GetDBValue('address', 'cpy_branch', 'id="' . $element->BranId . '"');
      $vBranchPhone = ph_GetDBValue('phone', 'cpy_branch', 'id="' . $element->BranId . '"');
      $nBrand = ph_GetDBValue('brand_id', 'ecom_product', 'id="' . $element->ProdId . '"');
      $vBrandName = ph_GetDBValue('name1', 'ecom_brand', 'id="' . $nBrand . '"');
      $nCat = ph_GetDBValue('cat_id', 'ecom_product', 'id="' . $element->ProdId . '"');
      $vCatName = ph_GetDBValue('name1', 'ecom_cat', 'id="' . $nCat . '"');
      $vProdName = ph_GetDBValue('name1', 'ecom_product', 'id="' . $element->ProdId . '"');
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'dMDate' => ph_FormatDate($element->Mdate, 'Y-m-d'),
        'nBranchId' => $element->BranId,
        'vBranchName' => $vBranchName,
        'vBranchAddress' => $vBranchAddress,
        'vBranchPhone' => $vBranchPhone,
        'nBrandId' => $nBrand,
        'vBrandName' => $vBrandName,
        'nCatId' => $nCat,
        'vCatName' => $vCatName,
        'nProdId' => $element->ProdId,
        'vProdName' => $vProdName,
        'vSerial' => $element->Serial,
        'nWDays' => $element->Wdays,
        'dEDate' => ph_FormatDate($element->Edate, 'Y-m-d'),
        'vCustomer' => $element->Customer,
        'vCAddress' => $element->CAddress,
        'vCMobile' => $element->CMobile,
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
