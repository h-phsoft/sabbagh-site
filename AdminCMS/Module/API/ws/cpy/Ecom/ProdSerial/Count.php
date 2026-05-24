<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $vSearchText = $oRest->getParameter('vText');
    if ($vSearchText) {
      $vSearchText = str_replace(" ", "%", $vSearchText);
    }
    $vWhere = '';
    if ($vSearchText != '') {
      $vWhere .= ''
        . ' (  UPPER(`snum`) LIKE UPPER("%' . $vSearchText . '%")'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE `cat_id` IN (SELECT id FROM ecom_cat WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%")))'
        . ' OR `prod_id` IN (SELECT id FROM ecom_product WHERE `brand_id` IN (SELECT id FROM ecom_brand WHERE UPPER(name1) LIKE UPPER("%' . $vSearchText . '%")))'
        . ')';
    }
    $nCount = intval(cEcomProdSerial::getCount($vWhere));
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'Count' => $nCount
    ));
  }
}
