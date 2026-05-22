<?php

if (isset($oRest)) {

  $nCategory = intval($oRest->getParameter('nCategory'));
  $vSearchText = $oRest->getParameter('vText');
  if ($vSearchText) {
    $vSearchText = str_replace(" ", "%", $vSearchText);
  }
  $vWhere = '';
  $vAnd = '';
  if ($nCategory > 0) {
    $vWhere .= $vAnd . 'cat_id=' . $nCategory;
    $vAnd = ' AND ';
  }
  if ($vSearchText) {
    $vWhere .= $vAnd . 'UPPER(name1) LIKE UPPER("%' . $vSearchText . '%")';
    $vAnd = ' AND ';
  }
  $aList = cEcomProduct::getArray($vWhere);
  $oRest->setRowData(array(
    'Status' => true,
    'Message' => getLabel('lbl.cms.Done'),
    'vWhere' => $vWhere,
    'Data' => $aList
  ));
}
