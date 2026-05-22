<?php

if (isset($oRest)) {

  $nId = $oRest->getParameter('nId');
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {
    $vCode = $oRest->getParameter('code');
    $nId = $oRest->getParameter('nId');
    $vName = $oRest->getParameter('vName');
    $vRem = $oRest->getParameter('vRem');

    $oInstance = cCpyCode::getInstance($vCode, $nId);
    $oInstance->vTable = $vCode;
    $oInstance->Id = $nId;
    $oInstance->Name = $vName;
    $oInstance->Rem = $vRem;
    try {
      $oInstance->save($oUser->Id);
      $oRest->setRowData(array(
        'Status' => true,
        'Message' => 'Done',
        'Id' => $nSavedId
      ));
    } catch (Exception $exc) {
      $oRest->setRowData(array(
        'Status' => false,
        'Message' => $exc->getTraceAsString()
      ));
    }
  }
}