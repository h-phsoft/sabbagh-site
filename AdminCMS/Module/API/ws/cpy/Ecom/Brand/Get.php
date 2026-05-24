<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEcomBrand::getInstance($oRest->getParameter('nId'));
    $aData = array(
      'nId' => $instance->Id,
      'nStatusId' => $instance->StatusId,
      'vName1' => $instance->Name1,
      'vName2' => $instance->Name2,
      'vImage' => $instance->Image,
      'vStatusName' => $instance->oStatus->Name,
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
