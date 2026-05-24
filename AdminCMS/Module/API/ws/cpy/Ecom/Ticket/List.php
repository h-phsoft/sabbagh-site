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
    $vWhere = 'ticket_id>0';
    if ($oUser->GrpId > 0) {
      $vWhere .= ' AND `bran_id`="' . $oUser->BranId . '" AND `status_id`=1';
    }
    if ($vSearchText != '') {
      $vWhere .= ' AND '
        . ' (  UPPER(`customer`) LIKE UPPER("%' . $vSearchText . '%")'
        . ' OR UPPER(`serial`) LIKE UPPER("%' . $vSearchText . '%")'
        . ' OR UPPER(bran_name) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR UPPER(user_name) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR UPPER(prod_name) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR UPPER(cat_name) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR UPPER(brand_name) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR UPPER(cmobile) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR UPPER(status_name) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR UPPER(support_name) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR UPPER(ticket_rtext) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR UPPER(ticket_stext) LIKE UPPER("%' . $vSearchText . '%"))'
        . ')';
    }
    $vSQL = 'SELECT '
      . ' `sale_id`, `sale_wdays`,'
      . ' `sale_sdate`, `sale_syear`, `sale_smonth`, `sale_sday`,'
      . ' `sale_edate`, `sale_eyear`, `sale_emonth`, `sale_eday`,'
      . ' `bran_id`, `bran_name`, `user_id`, `user_name`,'
      . ' `prod_id`, `prod_name`, `cat_id`, `cat_name`, '
      . ' `brand_id`, `brand_name`,'
      . ' `serial`, `customer`, `caddress`, `cmobile`,'
      . ' `ticket_id`,'
      . ' `status_id`, `status_name`,'
      . ' `support_id`, `support_name`,'
      . ' `ticket_tdate`, `ticket_udate`, `ticket_rtext`, `ticket_stext`'
      . ' FROM `ecom_vtickets`'
      . ' WHERE ' . $vWhere
      . ' ORDER BY `ticket_tdate` DESC';
    $res = ph_Execute($vSQL);
    $aData = array();
    $nIdx = 0;
    if ($res != '') {
      while (!$res->EOF) {
        $aData[$nIdx] = array(
          'nId' => $res->fields('ticket_id'),
          'nSaleId' => $res->fields('sale_id'),
          'nWDays' => $res->fields('sale_wdays'),
          'dMDate' => ph_FormatDate($res->fields('sale_sdate'), 'Y-m-d'),
          'dEDate' => ph_FormatDate($res->fields('sale_edate'), 'Y-m-d'),
          'dDate' => ph_FormatDate($res->fields('ticket_tdate'), 'Y-m-d H:s'),
          'dRdate' => ph_FormatDate($res->fields('ticket_udate'), 'Y-m-d H:s'),
          'vSerial' => $res->fields('serial'),
          'vBranchName' => $res->fields('bran_name'),
          'vBrandName' => $res->fields('brand_name'),
          'vCatName' => $res->fields('cat_name'),
          'vProdName' => $res->fields('prod_name'),
          'vCustomer' => $res->fields('customer'),
          'vCMobile' => $res->fields('cmobile'),
          'vCAddress' => $res->fields('caddress'),
          'nStatusId' => $res->fields('status_id'),
          'vStatusName' => $res->fields('status_name'),
          'nSupportId' => $res->fields('support_id'),
          'vSupportName' => $res->fields('support_name'),
          'vRText' => $res->fields('ticket_rtext'),
          'vSText' => $res->fields('ticket_stext'),
        );
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'Data' => $aData
    ));
  }
}
