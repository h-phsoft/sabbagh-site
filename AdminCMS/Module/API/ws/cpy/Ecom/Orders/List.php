<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $vSearchText = $oRest->getParameter('vText');
    $vWhere = '';
    if ($vSearchText != '') {
      $vWhere = '(`cust_name` LIKE "%' . $vSearchText . '%" OR `cust_orgnum` LIKE "%' . $vSearchText . '%")';
    }
    $aList = cEcomVorders::getArray($vWhere);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aItems = cEcomVorderItems::getArray('ord_id=' . $element->OrdId);
      $aServices = cEcomOrderService::getArray('order_id=' . $element->OrdId);
      $aItemCounts = ph_GetData('SELECT Count(*) AS Cnt, Sum(`qnt`) AS Qnt, Sum(`amt`) AS Amt FROM `ecom_order_item` WHERE `order_id`=' . $element->OrdId);
      $aData[$nIdx] = array(
        'nOrdId' => $element->OrdId,
        'nOrdCurnRate' => $element->OrdCurnRate,
        'dOrdAddat' => ph_FormatDate($element->OrdAddat, 'Y-m-d H:s'),
        'nStatusId' => $element->StatusId,
        'vStatusName' => $element->StatusName,
        'nCurnId' => $element->CurnId,
        'vCurnName' => $element->CurnName,
        'nCurnStatusId' => $element->CurnStatusId,
        'nCurnRate' => $element->CurnRate,
        'vCurnColor' => $element->CurnColor,
        'vCurnSymbole' => $element->CurnSymbole,
        'nCustId' => $element->CustId,
        'nCustStatusId' => $element->CustStatusId,
        'vCustName' => $element->CustName,
        'vCustOrgnum' => $element->CustOrgnum,
        'vCustLogon' => $element->CustLogon,
        'vCustMobile' => $element->CustMobile,
        'vCustPhone' => $element->CustPhone,
        'vCustAddress' => $element->CustAddress,
        'aItemCounts' => $aItemCounts,
        'aItems' => $aItems,
        'aServices' => $aServices
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
