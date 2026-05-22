<?php

if (isset($oRest)) {
  $nSupplierId = $oRest->getParameter("nSupplier");
  $nBrandId = $oRest->getParameter("nBrand");
  $aList = cDistCategories::getArray('id IN (SELECT category_id FROM dist_products WHERE supplier_id=' . $nSupplierId . ' AND brand_id=' . $nBrandId . ')');
  $aData = array();
  $nIdx = 0;
  foreach ($aList as $element) {
    $aProds = cDistProducts::getArray('category_id=' . $element->Id . ' AND supplier_id=' . $nSupplierId . ' AND brand_id=' . $nBrandId);
    $aData[$nIdx] = array(
      'nId' => $element->Id,
      'nOrd' => $element->Ord,
      'vName' => $element->Name,
      'vImage' => $element->Image,
      'aProducts' => $aProds
    );
    $nIdx++;
  }
  $oRest->setRowData(array(
    cPhsRest::RESPONSE_KEY_STATUS => true,
    cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
    cPhsRest::RESPONSE_KEY_DATA => $aData
  ));
}
