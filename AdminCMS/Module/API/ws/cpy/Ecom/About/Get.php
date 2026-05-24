<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEcomAbout::getArray('`id`="' . $oRest->getParameter('nId') . '"');
    $aData = array(
      'nId' => $instance->Id,
      'vImage' => $instance->Image,
      'vText1' => $instance->Text1,
      'vText2' => $instance->Text2,
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
