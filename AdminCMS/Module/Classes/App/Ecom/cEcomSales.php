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
 * @update 2024/06/11 18:19
 *
 */

class cEcomSales {

  var $Id;
  var $BranId;
  var $Mdate;
  var $ProdId;
  var $Serial;
  var $Wdays = 0;
  var $Edate;
  var $Customer;
  var $CAddress;
  var $CMobile;
  var $InsUser;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `bran_id`, `mdate`, `prod_id`, `serial`, `wdays`, `edate`, `customer`, `caddress`, `cmobile`, `ins_user`'
      . ' FROM `ecom_sales`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `ecom_sales`';
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
      $vOrder = '`mdate` desc';
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

  public static function getInstanceBySerial($vSerial) {
    $cClass = new cEcomSales();
    $res = ph_Execute(self::getSelectStatement('(`serial`="' . $vSerial . '")'));
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = self::getFields($res);
      }
      $res->Close();
    }
    return $cClass;
  }

  public static function getInstanceBySerialMobile($vSerial, $vMobile) {
    $cClass = new cEcomSales();
    $res = ph_Execute(self::getSelectStatement('(`serial`="' . $vSerial . '" AND cmobile="' . $vMobile . '")'));
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = self::getFields($res);
      }
      $res->Close();
    }
    return $cClass;
  }

  public static function getInstance($nId) {
    $cClass = new cEcomSales();
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
    $cClass = new cEcomSales();
    $cClass->Id = intval($res->fields('id'));
    $cClass->BranId = intval($res->fields('bran_id'));
    $cClass->Mdate = $res->fields('mdate');
    $cClass->ProdId = intval($res->fields('prod_id'));
    $cClass->Serial = $res->fields('serial');
    $cClass->Wdays = intval($res->fields('wdays'));
    $cClass->Edate = $res->fields('edate');
    $cClass->Customer = $res->fields('customer');
    $cClass->CAddress = $res->fields('caddress');
    $cClass->CMobile = $res->fields('cmobile');
    $cClass->InsUser = $res->fields('ins_user');
    //
    return $cClass;
  }

  public function save($nUId) {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `ecom_sales` ('
        . '  `bran_id`, `prod_id`, `serial`, `wdays`, `mdate`, `edate`, `customer`, `caddress`, `cmobile`, `ins_user`'
        . ') VALUES ('
        . '  "' . $this->BranId . '"'
        . ', "' . $this->ProdId . '"'
        . ', "' . $this->Serial . '"'
        . ', "' . $this->Wdays . '"'
        . ', STR_TO_DATE("' . $this->Mdate . '","%Y-%m-%d")'
        . ', STR_TO_DATE("' . $this->Edate . '","%Y-%m-%d")'
        . ', "' . $this->Customer . '"'
        . ', "' . $this->CAddress . '"'
        . ', "' . $this->CMobile . '"'
        . ', "' . $nUId . '"'
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
      $vSQL = 'UPDATE `ecom_sales` SET'
        . '  `mdate`=STR_TO_DATE("' . $this->Mdate . '","%Y-%m-%d %H:%i")'
        //. ', `bran_id`="' . $this->BranId . '"'
        . ', `prod_id`="' . $this->ProdId . '"'
        . ', `serial`="' . $this->Serial . '"'
        . ', `wdays`="' . $this->Wdays . '"'
        . ', `edate`=STR_TO_DATE("' . $this->Edate . '","%Y-%m-%d %H:%i")'
        . ', `customer`="' . $this->Customer . '"'
        . ', `caddress`="' . $this->CAddress . '"'
        . ', `cmobile`="' . $this->CMobile . '"'
        . ', `upd_user`="' . $nUId . '"'
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
    $vSQL = 'DELETE FROM `ecom_sales` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
