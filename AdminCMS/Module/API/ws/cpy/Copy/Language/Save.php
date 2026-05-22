<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cPhsLang::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->Name = $oRest->getParameter('vName');
    $oInstance->Code = $oRest->getParameter('vCode');
    $oInstance->Dir = $oRest->getParameter('vDir');
    $oInstance->Rem = $oRest->getParameter('vRem');
    try {
      $nSavedId = $oInstance->save();
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
      $oRest->addRowDataValue('Id', $nSavedId);
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
