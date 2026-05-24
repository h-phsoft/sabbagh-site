<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update) {

    $oRest->setMessage(getLabel('Sorry you cannot change password'));
    $nUId = $oRest->getParameter('nId');
    $vNPassword = $oRest->getParameter('vNPassword');
    $vVPassword = $oRest->getParameter('vVPassword');
    $oTargetUser = cEcomCustomer::getInstance($nUId);
    if ($oTargetUser->Id > 0) {
      if ($oTargetUser->resetPassword($vNPassword, $vVPassword)) {
        $oRest->setRowData(array(
          'Status' => true,
          'Message' => 'Done'
        ));
      }
    }
  }
}
