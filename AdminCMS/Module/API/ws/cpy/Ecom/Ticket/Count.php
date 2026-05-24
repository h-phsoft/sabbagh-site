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
      $vWhere .= ' AND `bran_id`="' . $oUser->BranId . '"';
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
    $nCount = intval(ph_GetDBValue('count(*)', 'ecom_vtickets', $vWhere));
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'vWhere' => $vWhere,
      'Count' => $nCount
    ));
  }
}
