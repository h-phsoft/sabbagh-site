<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEcomTag::getInstance('`id`="' . $oRest->getParameter('nId') . '"');
    $aData = array(
      'nId' => $instance->Id,
      'nStatusId' => $instance->StatusId,
      'vName' => $instance->Name,
      'vClassname' => $instance->Classname,
      'vStatusName' => $instance->oStatus->Name,
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
