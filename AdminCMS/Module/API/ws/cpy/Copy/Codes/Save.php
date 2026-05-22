<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $vCode = $oRest->getParameter('code');
    $vName = $oRest->getParameter('vName');
    $vRem = $oRest->getParameter('vRem');

    $oInstance = cCpyCode::getInstance($vCode, $nId);
    $oInstance->vTable = $vCode;
    $oInstance->Id = $nId;
    $oInstance->Name = $vName;
    $oInstance->Rem = $vRem;
    try {
      $oInstance->save($oUser->Id);
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
      $oRest->addRowDataValue('Id', $nSavedId);
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
