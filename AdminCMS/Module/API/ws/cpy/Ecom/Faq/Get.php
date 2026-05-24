<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEcomFaq::getInstance('`id`="' . $oRest->getParameter('nId') . '"');
    $aData = array(
      'nId' => $element->Id,
      'nOrd' => $element->Ord,
      'vQtext' => $element->Qtext,
      'vAtext' => $element->Atext,
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
