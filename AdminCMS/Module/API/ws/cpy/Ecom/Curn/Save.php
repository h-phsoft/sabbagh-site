<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomCurn::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    $oInstance->Name = $oRest->getParameter('vName');
    $oInstance->Rate = $oRest->getParameter('nRate');
    $oInstance->Color = $oRest->getParameter('vColor');
    $oInstance->Symbole = $oRest->getParameter('vSymbole');
    try {
      $nSavedId = $oInstance->save($oUser->Id);
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
      $oRest->addRowDataValue('Id', $nSavedId);
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
