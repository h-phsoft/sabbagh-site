<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update) {

    $oRest->setMessage(getLabel('lbl.cms.Sorry you cannot change password'));
    $vOPassword = $oRest->getParameter('vOPassword');
    $vNPassword = $oRest->getParameter('vNPassword');
    $vVPassword = $oRest->getParameter('vVPassword');
    if ($oUser->changePassword($vOPassword, $vNPassword, $vVPassword)) {
      $oRest->setRowData(array(
        'Status' => true,
        'Message' => 'Done'
      ));
    }
  }
}