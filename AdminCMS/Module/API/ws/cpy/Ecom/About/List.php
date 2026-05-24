<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $vSearchText = $oRest->getParameter('vText');
    if ($vSearchText) {
      $vSearchText = str_replace(" ", "%", $vSearchText);
    }
    $vWhere = 'id=1';
    if ($vSearchText != '') {
      $vWhere .= ' AND (`vText1` LIKE "%' . $vSearchText . '%" OR `vText2` LIKE "%' . $vSearchText . '%")';
    }
    $aList = cEcomAbout::getArray($vWhere);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'vImage' => $element->Image,
        'vText1' => $element->Text1,
        'vText2' => $element->Text2,
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