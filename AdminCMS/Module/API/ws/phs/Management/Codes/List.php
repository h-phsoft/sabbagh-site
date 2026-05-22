<?php

if (isset($oRest)) {

  $vCode = $oRest->getParameter('code');
  $aList = cPhsCode::getArray($vCode);
  $aData = array();
  $nIdx = 0;
  foreach ($aList as $element) {
    $aData[$nIdx] = array(
      'Id' => $element->Id,
      'Name' => $element->Name,
      'value' => $element->Id,
      'label' => $element->Name,
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
