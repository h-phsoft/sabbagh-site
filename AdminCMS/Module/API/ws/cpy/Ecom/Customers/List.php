<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $vSearchText = $oRest->getParameter('vText');
    if ($vSearchText) {
      $vSearchText = str_replace(" ", "%", $vSearchText);
    }
    $vWhere = 'id>0';
    if ($vSearchText != '') {
      $vWhere .= ' AND ('
        . '`name` LIKE "%' . $vSearchText . '%"'
        . ' OR `logon` LIKE "%' . $vSearchText . '%"'
        . ' OR `orgnum` LIKE "%' . $vSearchText . '%"'
        . ' OR `mobile` LIKE "%' . $vSearchText . '%"'
        . ' OR `phone` LIKE "%' . $vSearchText . '%"'
        . ' OR `address` LIKE "%' . $vSearchText . '%"'
        . ')';
    }
    $aList = cEcomCustomer::getArray($vWhere);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nStatusId' => $element->StatusId,
        'vName' => $element->Name,
        'vOrgnum' => $element->Orgnum,
        'vLogon' => $element->Logon,
        'vMobile' => $element->Mobile,
        'vPhone' => $element->Phone == null ? '' : $element->Phone,
        'vAddress' => $element->Address == null ? '' : $element->Address,
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
