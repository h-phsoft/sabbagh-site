<?php

if (isset($oRest)) {

  $vCode = $oRest->getParameter('code');
  $nId = $oRest->getParameter('nId');
  $vName = $oRest->getParameter('vName');
  $vRem = $oRest->getParameter('vRem');

  $oCurrency = new cPhsCode();
  $oCurrency->vTable = $vCode;
  $oCurrency->Id = $nId;
  $oCurrency->Name = $vName;
  $oCurrency->Rem = $vRem;
  $oCurrency->save();

  $oRest->setRowData(array(
    'Status' => true,
    'Message' => 'Done'
  ));
}