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

class cEcomOrderItem {

  var $Id;
  var $OrderId;
  var $ProdId;
  var $SizeId;
  var $Qnt = 0.00;
  var $Price = 0.00;
  var $Cprice = 0.00;
  var $Amt = 0.00;
  var $Disc = 0.00;
  var $Net = 0.00;
  //
  var $oOrder;
  var $oProd;
  var $oSize;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `order_id`, `prod_id`, `size_id`, `qnt`, `price`, `cprice`'
      . ', `amt`, `disc`, `net`'
      . ' FROM `ecom_order_item`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `ecom_order_item`';
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
    $cClass = new cEcomOrderItem();
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
    $cClass = new cEcomOrderItem();
    $cClass->Id = intval($res->fields('id'));
    $cClass->OrderId = intval($res->fields('order_id'));
    $cClass->ProdId = intval($res->fields('prod_id'));
    $cClass->SizeId = intval($res->fields('size_id'));
    $cClass->Qnt = floatval($res->fields('qnt'));
    $cClass->Price = floatval($res->fields('price'));
    $cClass->Cprice = floatval($res->fields('cprice'));
    $cClass->Amt = floatval($res->fields('amt'));
    $cClass->Disc = floatval($res->fields('disc'));
    $cClass->Net = floatval($res->fields('net'));
    //
    $cClass->oOrder = cEcomOrder::getInstance($cClass->OrderId);
    $cClass->oProd = cEcomProduct::getInstance($cClass->ProdId);
    $cClass->oSize = cEcomProdSize::getInstance($cClass->SizeId);
    return $cClass;
  }

  public function save() {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `ecom_order_item` ('
        . '  `order_id`, `prod_id`, `size_id`, `qnt`, `price`, `cprice`, `amt`'
        . ', `disc`, `net`'
        . ') VALUES ('
        . '  "' . $this->OrderId . '"'
        . ', "' . $this->ProdId . '"'
        . ', "' . $this->SizeId . '"'
        . ', "' . $this->Qnt . '"'
        . ', "' . $this->Price . '"'
        . ', "' . $this->Cprice . '"'
        . ', "' . $this->Amt . '"'
        . ', "' . $this->Disc . '"'
        . ', "' . $this->Net . '"'
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
      $vSQL = 'UPDATE `ecom_order_item` SET'
        . '  `order_id`="' . $this->OrderId . '"'
        . ', `prod_id`="' . $this->ProdId . '"'
        . ', `size_id`="' . $this->SizeId . '"'
        . ', `qnt`="' . $this->Qnt . '"'
        . ', `price`="' . $this->Price . '"'
        . ', `cprice`="' . $this->Cprice . '"'
        . ', `amt`="' . $this->Amt . '"'
        . ', `disc`="' . $this->Disc . '"'
        . ', `net`="' . $this->Net . '"'
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
    $vSQL = 'DELETE FROM `ecom_order_item` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
