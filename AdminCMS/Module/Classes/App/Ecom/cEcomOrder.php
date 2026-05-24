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

class cEcomOrder {

  var $Id;
  var $CustId;
  var $CurnId;
  var $Rate = 1.00000;
  var $Addat;
  var $StatusId = 0;
  //
  var $oCurn;
  var $oCust;
  var $oStatus;
  //
  var $aOrderItems = array();
  var $aOrderServices = array();

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `cust_id`, `curn_id`, `rate`, `addat`, `status_id`'
      . ' FROM `ecom_order`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `ecom_order`';
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
    $cClass = new cEcomOrder();
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
    $cClass = new cEcomOrder();
    $cClass->Id = intval($res->fields('id'));
    $cClass->CustId = intval($res->fields('cust_id'));
    $cClass->CurnId = intval($res->fields('curn_id'));
    $cClass->StatusId = intval($res->fields('status_id'));
    $cClass->Rate = floatval($res->fields('rate'));
    $cClass->Addat = $res->fields('addat');
    //
    $cClass->oCurn = cEcomCurn::getInstance($cClass->CurnId);
    $cClass->oCust = cEcomCustomer::getInstance($cClass->CustId);
    $cClass->oStatus = cEcomOrderStatus::getInstance($cClass->StatusId);
    //
    $cClass->aOrderItems = cEcomOrderItem::getArray('order_id=' . $cClass->CustId);
    $cClass->aOrderServices = cEcomOrderService::getArray("order_id=" . $cClass->Id);
    return $cClass;
  }

  public function save() {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `ecom_order` ('
        . '  `cust_id`, `curn_id`, `rate`, `addat`, `status_id`'
        . ') VALUES ('
        . '  "' . $this->CustId . '"'
        . ', "' . $this->CurnId . '"'
        . ', "' . $this->Rate . '"'
        . ', STR_TO_DATE("' . $this->Addat . '","%Y-%m-%d")'
        . ', "' . $this->StatusId . '"'
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
      $vSQL = 'UPDATE `ecom_order` SET'
        . '  `cust_id`="' . $this->CustId . '"'
        . ', `curn_id`="' . $this->CurnId . '"'
        . ', `rate`="' . $this->Rate . '"'
        . ', `addat`=STR_TO_DATE("' . $this->Addat . '","%Y-%m-%d")'
        . ', `status_id`="' . $this->StatusId . '"'
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
    $vSQL = 'DELETE FROM `ecom_order_item` WHERE `order_id`="' . $this->Id . '"';
    ph_Execute($vSQL);
    $vSQL = 'DELETE FROM `ecom_order_service` WHERE `order_id`="' . $this->Id . '"';
    ph_Execute($vSQL);
    $vSQL = 'DELETE FROM `ecom_order` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
