<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = $oRest->getParameter('nId');
    $aData = array();
    $aList = cEcomOrder::getArray('`mst_id`="' . $nId . '"');
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nCustId' => $element->CustId,
        'nCurnId' => $element->CurnId,
        'nRate' => $element->Rate,
        'dAddat' => ph_FormatDate($element->Addat, 'Y-m-d H:s'),
        'nStatusId' => $element->StatusId,
        'vCurnName' => $element->oCurn->Name,
        'vCustName' => $element->oCust->Name,
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
