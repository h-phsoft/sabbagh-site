<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = intval($oRest->getParameter('nId'));
    if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
      ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

      $oInstance = cEcomCustomer::getInstance($nId);
      $oInstance->Id = $nId;
      $oInstance->StatusId = $oRest->getParameter('nStatusId');
      $oInstance->Name = $oRest->getParameter('vName');
      $oInstance->Orgnum = $oRest->getParameter('vOrgnum');
      $oInstance->Logon = $oRest->getParameter('vLogon');
      $oInstance->Mobile = $oRest->getParameter('vMobile');
      $oInstance->Phone = $oRest->getParameter('vPhone');
      $oInstance->Address = $oRest->getParameter('vAddress');
      try {
        $nSavedId = $oInstance->save();
        $oRest->addRowDataValue('Id', $nSavedId);
        if ($nSavedId > 0) {
          if ($nId == 0) {
            $oNewUser = cEcomCustomer::getInstance($nSavedId);
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
}
