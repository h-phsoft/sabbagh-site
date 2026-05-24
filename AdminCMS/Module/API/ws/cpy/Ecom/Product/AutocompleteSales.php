<?php

if (isset($oRest)) {

  $vWhere = '(id>0 AND id IN (SELECT prod_id From ecom_prod_serial WHERE snum NOT IN (SELECT serial FROM ecom_sales)))';
  $nCatId = $oRest->getParameter('catId');
  if (isset($nCatId) && intval($nCatId) >= 0) {
    $vWhere .= ' AND (`cat_id`=' . $nCatId . ')';
  }
  $nBrandId = $oRest->getParameter('brandId');
  if (isset($nBrandId) && intval($nBrandId) >= 0) {
    $vWhere .= ' AND (`brand_id`=' . $nBrandId . ')';
  }
  $vSearchText = $oRest->getParameter('term');
  if (isset($vSearchText)) {
    $vSearchText = str_replace(" ", "%", $vSearchText);
  }
  if ($vSearchText != '') {
    $vWhere .= ' AND (`name1` LIKE "%' . $vSearchText . '%")';
  }
  $aList = cEcomProduct::getArray($vWhere);
  $aData = array();
  $nIdx = 0;
  foreach ($aList as $element) {
    $aData[$nIdx] = array(
      'id' => $element->Id,
      'value' => $element->Id,
      'label' => $element->Name1
    );
    $nIdx++;
  }
  $oRest->setRowData(array(
    'Status' => true,
    'Message' => getLabel('Done'),
    'Data' => array(
      'List' => $aData
    )
  ));
}
