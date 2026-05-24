<?php

if (isset($oRest)) {

  $vGroup = '`user_name`';
  $dSDate = $oRest->getParameter('dSDate');
  $dEDate = $oRest->getParameter('dEDate');
  $vWhere = '';
  $vAnd = ' WHERE ';
  if ($oUser->GrpId > 0) {
    $vWhere .= $vAnd . '(`bran_id`="' . $oUser->BranId . '")';
    $vAnd = ' AND ';
  }
  if ($dSDate && $dEDate) {
    $vWhere .= vAnd
      . '(STR_TO_DATE(DATE_FORMAT(sdate, "%Y-%m-%d"), "%Y-%m-%d") BETWEEN STR_TO_DATE("' . $dSDate . '", "%Y-%m-%d") AND  STR_TO_DATE("' . $dEDate . '", "%Y-%m-%d"))';
  }
  $vSQL = 'SELECT ' . $vGroup . ' AS vGrp, COUNT(*) AS nCount'
    . ' FROM `ecom_vsales`'
    . $vWhere
    . ' GROUP BY ' . $vGroup
    . ' ORDER BY ' . $vGroup;
  $nTotal = 0;
  $aData = array();
  $nIdx = 0;
  $res = ph_Execute($vSQL);
  if ($res != '') {
    while (!$res->EOF) {
      $vGrpName = $res->fields('vGrp');
      $nCount = intval($res->fields('nCount'));
      $nTotal += $nCount;
      $aData[$nIdx] = array(
        'vGrpName' => $vGrpName,
        'nCount' => $nCount
      );
      $nIdx++;
      $res->MoveNext();
    }
    $res->Close();
  }
  $oRest->setRowData(array(
    'Status' => true,
    'Message' => getLabel('Done'),
    'nTotal' => $nTotal,
    'Data' => $aData
  ));
}
