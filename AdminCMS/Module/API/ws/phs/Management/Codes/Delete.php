<?php

if (isset($oRest)) {

  $vCode = $oRest->getParameter('code');
  $nId = $oRest->getParameter('id');
  $oObject = cPhsCode::getInstance($vCode, $nId);
  $oObject->delete();
  $oRest->setRowData(array(
    'Status' => true,
    'Message' => 'Done'
  ));
}