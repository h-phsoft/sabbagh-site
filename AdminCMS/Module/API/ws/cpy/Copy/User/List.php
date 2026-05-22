<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nStart = intval($oRest->getParameter('start'));
    $nEnd = intval($oRest->getParameter('end'));
    $nPage = intval($oRest->getParameter('page'));
    $nPageSize = intval($oRest->getParameter('perpage'));
    if ($nPageSize === 0) {
      $nPageSize = 25;
    }
    $vSearchText = $oRest->getParameter('vText');
    if ($vSearchText) {
      $vSearchText = str_replace(" ", "%", $vSearchText);
    }
    $vWhere = 'id>0';
    if ($vSearchText != '') {
      $vWhere .= ' AND (`name` LIKE "%' . $vSearchText . '%" OR `logon` LIKE "%' . $vSearchText . '%")';
    }
    $aList = cCpyUser::getArray($vWhere, '', $nPage, $nPageSize);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nBranId' => $element->oBranch->Id,
        'vBranName' => $element->oBranch->Name,
        'vName' => $element->Name,
        'vLogon' => $element->Logon,
        'nType' => $element->oGrp->Id,
        'vTypeName' => $element->oGrp->Name,
        'vImage' => $element->Image,
        'nGender' => $element->oGender->Id,
        'vGenderName' => $element->oGender->Name,
        'nStatus' => $element->oStatus->Id,
        'vStatusName' => $element->oStatus->Name
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
