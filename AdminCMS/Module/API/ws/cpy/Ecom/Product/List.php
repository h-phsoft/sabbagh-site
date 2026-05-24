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
      $vWhere .= ' AND '
        . '(`name1` LIKE "%' . $vSearchText . '%"'
        . ' OR `name2` LIKE "%' . $vSearchText . '%"'
        . ' OR cat_id IN (SELECT id FROM `ecom_cat` WHERE UPPER(`name1`) LIKE UPPER("%' . $vSearchText . '%"))'
        . ' OR brand_id IN (SELECT id FROM `ecom_brand` WHERE UPPER(`name1`) LIKE UPPER("%' . $vSearchText . '%"))'
        . ')';
    }
    $aList = cEcomProduct::getArray($vWhere, '', $nPage, $nPageSize);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nMnum' => $element->Mnum,
        'nBrandId' => $element->BrandId,
        'nStatusId' => $element->StatusId,
        'nCatId' => $element->CatId,
        'nTagId' => $element->TagId,
        'vName1' => $element->Name1,
        'vName2' => $element->Name2,
        'nQnt' => $element->Qnt,
        'nPrice' => $element->Price,
        'nCprice' => $element->Cprice,
        'vDesc1' => $element->Desc1,
        'vDesc2' => $element->Desc2,
        'vDesc3' => $element->Desc3,
        'vDesc4' => $element->Desc4,
        'vDesc5' => $element->Desc5,
        'vImage' => $element->Image,
        'vBrandName' => $element->oBrand->Name1,
        'vCatName' => $element->oCat->Name1,
        'vStatusName' => $element->oStatus->Name,
        'vTagName' => $element->oTag->Name,
      );
      $nIdx++;
    }
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'Data' => $aData
    ));
  }
}
