<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEcomService::getInstance($oRest->getParameter('nId'));
    $aData = array(
      'nId' => $element->Id,
      'vName1' => $element->Name1,
      'vName2' => $element->Name2,
      'nTypeId' => $element->TypeId,
      'nAmtperc' => $element->Amtperc,
      'vTypeName' => $element->oType->Name,
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
