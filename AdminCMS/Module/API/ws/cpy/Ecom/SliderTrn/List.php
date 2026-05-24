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
      'nSlidId' => array(
        'Name' => '`slid_id`',
        'Cond' => '`slid_id`="COND_VALUE"'
      ),
      'nOrder' => array(
        'Name' => '`order`',
        'Cond' => '`order`="COND_VALUE"'
      ),
      'vHeader' => array(
        'Name' => '`header`',
        'Cond' => '`header` LIKE "%COND_VALUE%"'
      ),
      'vText' => array(
        'Name' => '`text`',
        'Cond' => '`text` LIKE "%COND_VALUE%"'
      ),
      'vImage' => array(
        'Name' => '`image`',
        'Cond' => '`image` LIKE "%COND_VALUE%"'
      ),
      'vLink' => array(
        'Name' => '`link`',
        'Cond' => '`link` LIKE "%COND_VALUE%"'
      ),
      'vLabel' => array(
        'Name' => '`label`',
        'Cond' => '`label` LIKE "%COND_VALUE%"'
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
    $nCount = cEcomSliderTrn::getCount($vWhere);
    if (isset($size) && intval($size) > 0) {
      $nPages = ceil($nCount / $size);
    }
    $aList = cEcomSliderTrn::getArray($vWhere, $vOrder, $page, $size);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nSlidId' => $element->SlidId,
        'nOrder' => $element->Order,
        'vHeader' => $element->Header,
        'vText' => $element->Text,
        'vImage' => $element->Image,
        'vLink' => $element->Link,
        'vLabel' => $element->Label,
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
