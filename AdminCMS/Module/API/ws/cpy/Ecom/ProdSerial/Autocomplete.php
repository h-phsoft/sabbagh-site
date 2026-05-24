<?php

if (isset($oRest)) {

  $vWhere = '(serial_snum NOT IN (SELECT serial FROM ecom_sales))';
  $vSearchText = $oRest->getParameter('term');
  if (isset($vSearchText)) {
    $vSearchText = str_replace(" ", "%", $vSearchText);
  }
  if ($vSearchText != '') {
    $vWhere .= ' AND (`serial_snum` LIKE "%' . $vSearchText . '%")';
  }
  $aList = cEcomVproductSerial::getArray($vWhere);
  $aData = array();
  $nIdx = 0;
  foreach ($aList as $element) {
    $aData[$nIdx] = array(
      'id' => $element->SerialId,
      'value' => $element->SerialSnum,
      'label' => $element->SerialSnum,
      'nBrandId' => $element->BrandId,
      'vBrandName1' => $element->BrandName1,
      'nCatId' => $element->CatId,
      'vCatName1' => $element->CatName1,
      'nCatWdays' => $element->CatWdays,
      'nProdId' => $element->ProdId,
      'vProdName1' => $element->ProdName1,
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
