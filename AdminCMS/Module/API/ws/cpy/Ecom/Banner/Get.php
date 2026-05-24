<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEComBanner::getInstance($oRest->getParameter('nId'));
    $aData = array(
      'nId' => $instance->Id,
      'nOrder' => $instance->Order,
      'vName' => $instance->Name,
      'vImage' => $instance->Image
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
