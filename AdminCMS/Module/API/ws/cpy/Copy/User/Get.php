<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cCpyUser::getInstance($oRest->getParameter('id'));
    $aData = array(
      'nId' => $element->Id,
      'vName' => $element->Name,
      'vLogon' => $element->Logon,
      'nType' => $element->oGrp->Id,
      'vTypeName' => $element->oGrp->Name,
      'vImage' => $element->Image,
      'nGender' => $element->oGender->Id,
      'vGenderName' => $element->oGender->Name,
      'nStatus' => $element->oStatus->Id,
      'vStatusName' => $element->oStatus->Name
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
