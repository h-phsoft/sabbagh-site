<?php

if (isset($oRest)) {

  $nCount = 0;
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
    if ($oUser->GrpId > 0) {
      $vWhere .= ' AND `bran_id`="' . $oUser->BranId . '"';
    }
    if ($vSearchText != '') {
      $vWhere .= ' AND'
        . ' (  UPPER(`customer`) LIKE UPPER("%' . $vSearchText . '%")'
        . ' OR UPPER(`serial`) LIKE UPPER("%' . $vSearchText . '%")'
        . ' OR `ins_user` IN (SELECT id FROM cpy_user WHERE UPPER(name) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE `cat_id` IN (SELECT id FROM ecom_cat WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%")))'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE `brand_id` IN (SELECT id FROM ecom_brand WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%")))'
        . ' OR UPPER(`serial`) LIKE UPPER("%' . $vSearchText . '%")'
        . ')';
    }
    $nCount = intval(cEcomSales::getCount($vWhere));
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'Count' => $nCount
    ));
  }
}
