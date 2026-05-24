<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $vSearchText = $oRest->getParameter('vText');
    if ($vSearchText) {
      $vSearchText = str_replace(" ", "%", $vSearchText);
    }
    $vWhere = 'id>0';
    if ($vSearchText != '') {
      $vWhere .= ' AND (`name` LIKE "%' . $vSearchText . '%" OR `classname` LIKE "%' . $vSearchText . '%")';
    }
    $aList = cEcomTag::getArray($vWhere);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nStatusId' => $element->StatusId,
        'vName' => $element->Name,
        'vClassname' => $element->Classname,
        'vStatusName' => $element->oStatus->Name,
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
