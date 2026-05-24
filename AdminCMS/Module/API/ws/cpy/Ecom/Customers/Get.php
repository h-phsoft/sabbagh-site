<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEcomCustomer::getInstance('`id`="' . $oRest->getParameter('nId') . '"');
    $aData = array(
      'nId' => $element->Id,
      'nStatusId' => $element->StatusId,
      'vName' => $element->Name,
      'vOrgnum' => $element->Orgnum,
      'vLogon' => $element->Logon,
      'vPwd' => $element->Pwd,
      'vMobile' => $element->Mobile,
      'vPhone' => $element->Phone,
      'vAddress' => $element->Address,
      'vStatusName' => $element->oStatus->Name,
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
