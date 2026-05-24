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
      'vImage' => array(
        'Name' => '`image`',
        'Cond' => '`image` LIKE "%COND_VALUE%"'
      ),
      'vProdName' => array(
        'Name' => '`prod_id`',
        'Cond' => '`prod_id` IN (SELECT `id` FROM `ecom_product` WHERE `name` LIKE "%COND_VALUE%")'
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
    $nCount = cEcomProdImage::getCount($vWhere);
    if (isset($size) && intval($size) > 0) {
      $nPages = ceil($nCount / $size);
    }
    $aList = cEcomProdImage::getArray($vWhere, $vOrder, $page, $size);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nProdId' => $element->ProdId,
        'vImage' => $element->Image,
        'vProdName' => $element->oProd->Name,
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
