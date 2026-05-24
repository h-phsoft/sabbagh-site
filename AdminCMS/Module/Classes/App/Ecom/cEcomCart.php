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

class cEcomCart {

  var $Id;
  var $CustId;
  var $Addat;
  var $StatusId = 1;
  var $ProdId;
  var $SizeId;
  var $Qnt = 1.00;
  var $Price = 0.00;
  var $Cprice = 0.00;
  var $Amt = 0.00;
  var $Disc = 0.00;
  var $Net = 0.00;
  //
  var $oCust;
  var $oProd;
  var $oSize;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `cust_id`, `addat`, `status_id`, `prod_id`, `size_id`, `qnt`'
      . ', `price`, `cprice`, `amt`, `disc`, `net`'
      . ' FROM `ecom_cart`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `ecom_cart`';
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
    $cClass = new cEcomCart();
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
    $cClass = new cEcomCart();
    $cClass->Id = intval($res->fields('id'));
    $cClass->CustId = intval($res->fields('cust_id'));
    $cClass->Addat = $res->fields('addat');
    $cClass->StatusId = intval($res->fields('status_id'));
    $cClass->ProdId = intval($res->fields('prod_id'));
    $cClass->SizeId = intval($res->fields('size_id'));
    $cClass->Qnt = floatval($res->fields('qnt'));
    $cClass->Price = floatval($res->fields('price'));
    $cClass->Cprice = floatval($res->fields('cprice'));
    $cClass->Amt = floatval($res->fields('amt'));
    $cClass->Disc = floatval($res->fields('disc'));
    $cClass->Net = floatval($res->fields('net'));
    //
    $cClass->oCust = cEcomCustomer::getInstance($cClass->CustId);
    $cClass->oProd = cEcomProduct::getInstance($cClass->ProdId);
    $cClass->oSize = cEcomProdSize::getInstance($cClass->SizeId);
    return $cClass;
  }

  public function save($nUId) {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `ecom_cart` ('
        . '  `cust_id`, `addat`, `status_id`, `prod_id`, `size_id`, `qnt`, `price`'
        . ', `cprice`, `amt`, `disc`, `net`, `ins_user`'
        . ') VALUES ('
        . '  "' . $this->CustId . '"'
        . ', STR_TO_DATE("' . $this->Addat . '","%Y-%m-%d")'
        . ', "' . $this->StatusId . '"'
        . ', "' . $this->ProdId . '"'
        . ', "' . $this->SizeId . '"'
        . ', "' . $this->Qnt . '"'
        . ', "' . $this->Price . '"'
        . ', "' . $this->Cprice . '"'
        . ', "' . $this->Amt . '"'
        . ', "' . $this->Disc . '"'
        . ', "' . $this->Net . '"'
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
      $vSQL = 'UPDATE `ecom_cart` SET'
        . '  `cust_id`="' . $this->CustId . '"'
        . ', `addat`=STR_TO_DATE("' . $this->Addat . '","%Y-%m-%d")'
        . ', `status_id`="' . $this->StatusId . '"'
        . ', `prod_id`="' . $this->ProdId . '"'
        . ', `size_id`="' . $this->SizeId . '"'
        . ', `qnt`="' . $this->Qnt . '"'
        . ', `price`="' . $this->Price . '"'
        . ', `cprice`="' . $this->Cprice . '"'
        . ', `amt`="' . $this->Amt . '"'
        . ', `disc`="' . $this->Disc . '"'
        . ', `net`="' . $this->Net . '"'
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
    $vSQL = 'DELETE FROM `ecom_cart` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }

}

