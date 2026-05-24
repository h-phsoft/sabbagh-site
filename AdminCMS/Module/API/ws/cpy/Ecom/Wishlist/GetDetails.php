<?php

if (isset($oRest)) {

  $nId = ph_Get_Post('id');
  $aData = array();
  $aList = cEcomWishlist::getArray('`mst_id`="' . $nId . '"');
  $nIdx = 0;
  foreach ($aList as $element) {
    $aData[$nIdx] = array(
      'nId' => $element->Id,
      'vToken' => $element->Token,
      'dAddat' => ph_FormatDate($element->Addat, 'Y-m-d H:s'),
      'nStatusId' => $element->StatusId,
      'nProdId' => $element->ProdId,
      'vProdName' => $element->oProd->Name,
    );
    $nIdx++;
  }
  $oRest->setRowData(array(
    'Status' => true,
    'Message' => getLabel('Done'),
    'Data' => $aData
  ));
}
