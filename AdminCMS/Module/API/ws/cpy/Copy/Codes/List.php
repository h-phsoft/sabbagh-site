<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $vCode = $oRest->getParameter('code');
    $aList = cCpyCode::getArray($vCode, 'id>0');
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'Id' => $element->Id,
        'Name' => $element->Name,
        'Rem' => $element->Rem
      );
      $nIdx++;
    }
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => 'Done',
      'Data' => $aData
    ));
  }
}