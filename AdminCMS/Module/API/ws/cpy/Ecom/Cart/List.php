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
      'nCustId' => array(
        'Name' => '`cust_id`',
        'Cond' => '`cust_id`="COND_VALUE"'
      ),
      'dAddat' => array(
        'Name' => '`addat`',
        'Cond' => '`addat`=STR_TO_DATE("COND_VALUE", "%Y-%m-%d")'
      ),
      'nStatusId' => array(
        'Name' => '`status_id`',
        'Cond' => '`status_id`="COND_VALUE"'
      ),
      'nProdId' => array(
        'Name' => '`prod_id`',
        'Cond' => '`prod_id`="COND_VALUE"'
      ),
      'nSizeId' => array(
        'Name' => '`size_id`',
        'Cond' => '`size_id`="COND_VALUE"'
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
      'nAmt' => array(
        'Name' => '`amt`',
        'Cond' => '`amt`="COND_VALUE"'
      ),
      'nDisc' => array(
        'Name' => '`disc`',
        'Cond' => '`disc`="COND_VALUE"'
      ),
      'nNet' => array(
        'Name' => '`net`',
        'Cond' => '`net`="COND_VALUE"'
      ),
      'vCustName' => array(
        'Name' => '`cust_id`',
        'Cond' => '`cust_id` IN (SELECT `id` FROM `ecom_customer` WHERE `name` LIKE "%COND_VALUE%")'
      ),
      'vProdName' => array(
        'Name' => '`prod_id`',
        'Cond' => '`prod_id` IN (SELECT `id` FROM `ecom_product` WHERE `name` LIKE "%COND_VALUE%")'
      ),
      'vSizeName' => array(
        'Name' => '`size_id`',
        'Cond' => '`size_id` IN (SELECT `id` FROM `ecom_prod_size` WHERE `name` LIKE "%COND_VALUE%")'
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
    $nCount = cEcomCart::getCount($vWhere);
    if (isset($size) && intval($size) > 0) {
      $nPages = ceil($nCount / $size);
    }
    $aList = cEcomCart::getArray($vWhere, $vOrder, $page, $size);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nCustId' => $element->CustId,
        'dAddat' => ph_FormatDate($element->Addat, 'Y-m-d H:s'),
        'nStatusId' => $element->StatusId,
        'nProdId' => $element->ProdId,
        'nSizeId' => $element->SizeId,
        'nQnt' => $element->Qnt,
        'nPrice' => $element->Price,
        'nCprice' => $element->Cprice,
        'nAmt' => $element->Amt,
        'nDisc' => $element->Disc,
        'nNet' => $element->Net,
        'vCustName' => $element->oCust->Name,
        'vProdName' => $element->oProd->Name,
        'vSizeName' => $element->oSize->Name,
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
