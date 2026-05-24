<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $page = $oRest->getParameter('page');
    $size = $oRest->getParameter('size');
    $sorters = $oRest->getParameter('sorters');
    $filter = $oRest->getParameter('filters');
    $aFields = array(
      'nId' => array(
        'Name' => '`id`',
        'Cond' => '`id`="COND_VALUE"'
      ),
      'nProdId' => array(
        'Name' => '`prod_id`',
        'Cond' => '`prod_id`="COND_VALUE"'
      ),
      'nUnitId' => array(
        'Name' => '`unit_id`',
        'Cond' => '`unit_id`="COND_VALUE"'
      ),
      'nSnum' => array(
        'Name' => '`snum`',
        'Cond' => '`snum`="COND_VALUE"'
      ),
      'nAnum' => array(
        'Name' => '`anum`',
        'Cond' => '`anum`="COND_VALUE"'
      ),
      'vName' => array(
        'Name' => '`name`',
        'Cond' => '`name` LIKE "%COND_VALUE%"'
      ),
      'nBox' => array(
        'Name' => '`box`',
        'Cond' => '`box`="COND_VALUE"'
      ),
      'nQnt' => array(
        'Name' => '`qnt`',
        'Cond' => '`qnt`="COND_VALUE"'
      ),
      'nPrice' => array(
        'Name' => '`price`',
        'Cond' => '`price`="COND_VALUE"'
      ),
      'nCprice' => array(
        'Name' => '`cprice`',
        'Cond' => '`cprice`="COND_VALUE"'
      ),
      'vProdName' => array(
        'Name' => '`prod_id`',
        'Cond' => '`prod_id` IN (SELECT `id` FROM `ecom_product` WHERE `name` LIKE "%COND_VALUE%")'
      ),
      'vUnitName' => array(
        'Name' => '`unit_id`',
        'Cond' => '`unit_id` IN (SELECT `id` FROM `ecom_unit` WHERE `name` LIKE "%COND_VALUE%")'
      ),
    );
    $vWhere = '';
    $vAnd = '';
    if (isset($filter) && is_array($filter)) {
      foreach ($filter as $field) {
        if (isset($aFields[$field['field']])) {
          $vWhere .= $vAnd . str_replace('COND_VALUE', $field['value'], $aFields[$field['field']]['Cond']);
          $vAnd = ' AND ';
        }
      }
    }
    $vOrder = '';
    $vComma = '';
    if (isset($sorters) && is_array($sorters)) {
      foreach ($sorters as $field) {
        if (isset($aFields[$field['field']])) {
          $vOrder .= $vComma . $aFields[$field['field']]['Name'] . ' ' . strtoupper($field['dir']);
          $vComma = ', ';
        }
      }
    }
    $nPages = 0;
    $nCount = cEcomProdSize::getCount($vWhere);
    if (isset($size) && intval($size) > 0) {
      $nPages = ceil($nCount / $size);
    }
    $aList = cEcomProdSize::getArray($vWhere, $vOrder, $page, $size);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nProdId' => $element->ProdId,
        'nUnitId' => $element->UnitId,
        'nSnum' => $element->Snum,
        'nAnum' => $element->Anum,
        'vName' => $element->Name,
        'nBox' => $element->Box,
        'nQnt' => $element->Qnt,
        'nPrice' => $element->Price,
        'nCprice' => $element->Cprice,
        'vProdName' => $element->oProd->Name,
        'vUnitName' => $element->oUnit->Name,
      );
      $nIdx++;
    }
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'Data' => array(
        'last_page' => $nPages,
        'data' => $aData
      )
    ));
  }
}
