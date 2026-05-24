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
    $vWhere = '';
    if ($vSearchText != '') {
      $vWhere .= ''
        . '(   UPPER(`name1`) LIKE UPPER("%' . $vSearchText . '%")'
        . ' OR UPPER(`name2`) LIKE UPPER("%' . $vSearchText . '%")'
        . ' OR prod_id IN (SELECT id'
        . '                  FROM `ecom_product`'
        . '                 WHERE (UPPER(`name1`) LIKE UPPER("%' . $vSearchText . '%")'
        . '                     OR UPPER(`name2`) LIKE UPPER("%' . $vSearchText . '%")'
        . '                       )'
        . '               )'
        . ')';
    }
    $aList = cEcomProdFacts::getArray($vWhere, '', $nPage, $nPageSize);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nOrd' => $element->Ord,
        'nProdId' => $element->ProdId,
        'vProdName' => $element->ProdName,
        'vName1' => $element->Name1,
        'vName2' => $element->Name2,
        'vVal1' => $element->Val1,
        'vVal2' => $element->Val2
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
