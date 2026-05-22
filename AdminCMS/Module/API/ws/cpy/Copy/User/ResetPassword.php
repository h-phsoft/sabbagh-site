<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update) {

    $oRest->setMessage(getLabel('lbl.cms.Sorry you cannot change password'));
    $vNPassword = $oRest->getParameter('vNPassword');
    $vVPassword = $oRest->getParameter('vVPassword');
    $oTargetUser = cCpyUser::getInstance(intval($oRest->getParameter('nId')));
    if ($oTargetUser->Id > 0) {
      $oRest->setMessage(getLabel('lbl.cms.Sorry you cannot change password') . ' [' . $vNPassword . '] [' . $vVPassword . '] [' . $oRest->getParameter('nId') . '] [' . $oTargetUser->Id . ']');
      if ($oTargetUser->resetPassword($vNPassword, $vVPassword)) {
        $oRest->setRowData(array(
          'Status' => true,
          'Message' => 'Done'
        ));
      }
    }
  }
}
