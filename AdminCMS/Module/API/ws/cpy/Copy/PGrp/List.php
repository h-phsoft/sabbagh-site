<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $aList = cCpyPGrp::getArray('id>0', '`name`');
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'vName' => $element->Name,
        'vRem' => $element->Rem
      );
      $nIdx++;
    }
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
