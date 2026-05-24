<?php

if (isset($oRest)) {

  $vWhere = '';
  $vSearchText = $oRest->getParameter('term');
  if (isset($vSearchText)) {
    $vSearchText = str_replace(" ", "%", $vSearchText);
  }
  if ($vSearchText != '') {
    $vWhere = '(UPPER(`name1`) LIKE UPPER("%' . $vSearchText . '%") OR UPPER(`name2`) LIKE UPPER("%' . $vSearchText . '%"))';
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
