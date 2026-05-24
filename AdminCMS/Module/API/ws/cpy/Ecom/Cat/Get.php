<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEcomCat::getInstance($oRest->getParameter('nId'));
    $aData = array(
      'nId' => $instance->Id,
      'nStatusId' => $instance->StatusId,
      'nOrder' => $instance->Order,
      'nWDays' => $instance->WDays,
      'vName1' => $instance->Name1,
      'vName2' => $instance->Name2,
      'vDescription' => $instance->Description,
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
