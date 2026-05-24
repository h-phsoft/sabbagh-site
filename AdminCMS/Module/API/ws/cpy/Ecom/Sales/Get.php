<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = $oRest->getParameter('id');
    $aData = array();
    $aList = cEcomSales::getArray('`mst_id`="' . $nId . '"');
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'dMdate' => ph_FormatDate($element->Mdate, 'Y-m-d H:s'),
        'nProdId' => $element->ProdId,
        'vSerial' => $element->Serial,
        'nWdays' => $element->Wdays,
        'dEdate' => ph_FormatDate($element->Edate, 'Y-m-d'),
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
