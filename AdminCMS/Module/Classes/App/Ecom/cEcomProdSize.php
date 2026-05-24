<?php

/*
 * PhSoft(R) 1989-2022
 * Copyrights(c) 2022
 *
 * PhSoft Framework Code Generator
 * PhGenPHPAPIs
 * 2.1.22.0705.1022
 *
 * @author Haytham
 * @version 2.1.22.0705.1022
 * @update 2024/03/23 14:51
 *
 */

class cEcomProdSize {

  var $Id;
  var $ProdId;
  var $UnitId = 0;
  var $Snum;
  var $Anum;
  var $Name;
  var $Box = 0.00;
  var $Qnt = 0.00;
  var $Price = 0.00;
  var $Cprice = 0.00;
  //
  var $oUnit;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `prod_id`, `unit_id`, `snum`, `anum`, `name`, `box`'
      . ', `qnt`, `price`, `cprice`'
      . ' FROM `ecom_prod_size`';
    if ($vWhere != '') {
      $sSQL .= ' WHERE (' . $vWhere . ') ';
    }
    if ($vOrder != '') {
      $sSQL .= ' ORDER BY ' . $vOrder;
    }
    if ($vLimit != '') {
      $sSQL .= ' LIMIT ' . $vLimit;
    }
    return $sSQL;
  }

  public static function getCount($vWhere = '') {
    $nCount = 0;
    $sSQL = 'SELECT count(*) nCnt FROM `ecom_prod_size`';
    if ($vWhere != '') {
      $sSQL .= ' WHERE (' . $vWhere . ') ';
    }
    $res = ph_Execute($sSQL);
    if ($res != '' && !$res->EOF) {
      $nCount = intval($res->fields('nCnt'));
      $res->Close();
    }
    return $nCount;
  }

  public static function getArray($vWhere = '', $vOrder = '', $nPage = 0, $nPageSize = 0) {
    $aArray = array();
    $nIdx = 0;
    $vLimit = '';
    if ($nPage != 0 && $nPageSize != 0) {
      $vLimit = ((($nPage - 1) * $nPageSize)) . ', ' . $nPageSize;
    }
    if ($vOrder == '') {
      $vOrder = '`id`';
    }
    $res = ph_Execute(self::getSelectStatement($vWhere, $vOrder, $vLimit));
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = self::getFields($res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($nId) {
    $cClass = new cEcomProdSize();
    $res = ph_Execute(self::getSelectStatement('(`id`="' . $nId . '")'));
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = self::getFields($res);
      }
      $res->Close();
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cEcomProdSize();
    $cClass->Id = intval($res->fields('id'));
    $cClass->ProdId = intval($res->fields('prod_id'));
    $cClass->UnitId = intval($res->fields('unit_id'));
    $cClass->Snum = intval($res->fields('snum'));
    $cClass->Anum = intval($res->fields('anum'));
    $cClass->Name = $res->fields('name');
    $cClass->Box = floatval($res->fields('box'));
    $cClass->Qnt = floatval($res->fields('qnt'));
    $cClass->Price = floatval($res->fields('price'));
    $cClass->Cprice = floatval($res->fields('cprice'));
    //
    $cClass->oUnit = cEcomUnit::getInstance($cClass->UnitId);
    return $cClass;
  }

  public function save() {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `ecom_prod_size` ('
        . '  `prod_id`, `unit_id`, `snum`, `anum`, `name`, `box`, `qnt`'
        . ', `price`, `cprice`'
        . ') VALUES ('
        . '  "' . $this->ProdId . '"'
        . ', "' . $this->UnitId . '"'
        . ', "' . $this->Snum . '"'
        . ', "' . $this->Anum . '"'
        . ', "' . $this->Name . '"'
        . ', "' . $this->Box . '"'
        . ', "' . $this->Qnt . '"'
        . ', "' . $this->Price . '"'
        . ', "' . $this->Cprice . '"'
        . ')';
      $res = ph_Execute($vSQL);
      if ($res || $res === 0) {
        $nId = ph_InsertedId();
      } else {
        $aMsg = ph_GetMySQLMessageAsArray();
        $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
        throw new Exception($vMsgs);
      }
    } else {
      $nId = $this->Id;
      $vSQL = 'UPDATE `ecom_prod_size` SET'
        . '  `prod_id`="' . $this->ProdId . '"'
        . ', `unit_id`="' . $this->UnitId . '"'
        . ', `snum`="' . $this->Snum . '"'
        . ', `anum`="' . $this->Anum . '"'
        . ', `name`="' . $this->Name . '"'
        . ', `box`="' . $this->Box . '"'
        . ', `qnt`="' . $this->Qnt . '"'
        . ', `price`="' . $this->Price . '"'
        . ', `cprice`="' . $this->Cprice . '"'
        . ' WHERE `id`="' . $this->Id . '"';
      $res = ph_Execute($vSQL);
      if ($res || $res === 0) {

      } else {
        $aMsg = ph_GetMySQLMessageAsArray();
        $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
        throw new Exception($vMsgs);
      }
    }
    return $nId;
  }

  public function delete() {
    $vSQL = 'DELETE FROM `ecom_prod_size` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
