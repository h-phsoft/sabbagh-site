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
      'nStatusId' => array(
        'Name' => '`status_id`',
        'Cond' => '`status_id`="COND_VALUE"'
      ),
      'vName' => array(
        'Name' => '`name`',
        'Cond' => '`name` LIKE "%COND_VALUE%"'
      ),
      'nRate' => array(
        'Name' => '`rate`',
        'Cond' => '`rate`="COND_VALUE"'
      ),
      'vColor' => array(
        'Name' => '`color`',
        'Cond' => '`color` LIKE "%COND_VALUE%"'
      ),
      'vSymbole' => array(
        'Name' => '`symbole`',
        'Cond' => '`symbole` LIKE "%COND_VALUE%"'
      ),
      'vStatusName' => array(
        'Name' => '`status_id`',
        'Cond' => '`status_id` IN (SELECT `id` FROM `phs_cod_status` WHERE `name` LIKE "%COND_VALUE%")'
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
    $nCount = cEcomCurn::getCount($vWhere);
    if (isset($size) && intval($size) > 0) {
      $nPages = ceil($nCount / $size);
    }
    $aList = cEcomCurn::getArray($vWhere, $vOrder, $page, $size);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'nStatusId' => $element->StatusId,
        'vName' => $element->Name,
        'nRate' => $element->Rate,
        'vColor' => $element->Color,
        'vSymbole' => $element->Symbole,
        'vStatusName' => $element->oStatus->Name,
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
