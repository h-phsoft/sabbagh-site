<?php

if (isset($oRest)) {

  $vWhere = '(id>0 AND snum NOT IN (SELECT serial FROM ecom_sales))';
  $nProdId = $oRest->getParameter('prodId');
  if (isset($nProdId) && intval($nProdId) >= 0) {
    $vWhere .= ' AND (`prod_id`=' . $nProdId . ')';
  }
  $vSearchText = $oRest->getParameter('term');
  if (isset($vSearchText)) {
    $vSearchText = str_replace(" ", "%", $vSearchText);
  }
  if ($vSearchText != '') {
    $vWhere .= ' AND (`snum` LIKE "%' . $vSearchText . '%")';
  }
  $aList = cEcomProdSerial::getArray($vWhere);
  $aData = array();
  $nIdx = 0;
  foreach ($aList as $element) {
    $aData[$nIdx] = array(
      'id' => $element->Id,
      'value' => $element->Snum,
      'label' => $element->Snum
    );
    $nIdx++;
  }
  $oRest->setRowData(array(
    'Status' => true,
    'Message' => getLabel('Done'),
    'Data' => array(
      'vWhere' => $vWhere,
      'List' => $aData
    )
  ));
}
