<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cCpyUser::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    $oInstance->GenderId = $oRest->getParameter('nGenderId');
    $oInstance->GrpId = $oRest->getParameter('nTypeId');
    $oInstance->BranId = $oRest->getParameter('nBranId');
    $oInstance->Name = $oRest->getParameter('vName');
    $oInstance->Logon = $oRest->getParameter('vLogon');
    try {
      $nSavedId = $oInstance->save();
      $oRest->addRowDataValue('Id', $nSavedId);
      if ($nSavedId > 0) {
        if ($nId == 0) {
          $oNewUser = cCpyUser::getInstance($nSavedId);
          $vNPassword = $oRest->getParameter('vNPassword');
          $vVPassword = $oRest->getParameter('vVPassword');
          $oNewUser->resetPassword($vNPassword, $vVPassword);
        }
        $oRest->setStatus(true);
        $oRest->setMessage('Done');
        $oRest->addRowDataValue('Id', $nSavedId);
      }
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
