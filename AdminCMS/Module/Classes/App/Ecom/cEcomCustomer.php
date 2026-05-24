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

class cEcomCustomer {

  var $Id;
  var $StatusId = 2;
  var $Name;
  var $Orgnum;
  var $Logon;
  var $Pwd;
  var $Mobile;
  var $Phone;
  var $Address;
  //
  var $oStatus;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `status_id`, `name`, `orgnum`, `logon`, `pwd`, `mobile`, `phone`, `address`'
      . ' FROM `ecom_customer`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `ecom_customer`';
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
    $cClass = new cEcomCustomer();
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
    $cClass = new cEcomCustomer();
    $cClass->Id = intval($res->fields('id'));
    $cClass->StatusId = intval($res->fields('status_id'));
    $cClass->Name = $res->fields('name');
    $cClass->Orgnum = $res->fields('orgnum');
    $cClass->Logon = $res->fields('logon');
    $cClass->Pwd = $res->fields('pwd');
    $cClass->Mobile = $res->fields('mobile');
    $cClass->Phone = $res->fields('phone');
    $cClass->Address = $res->fields('address');
    //
    $cClass->oStatus = cPhsCode::getInstance(cPhsCode::STATUS, $cClass->StatusId);
    return $cClass;
  }

  public function changePassword($vOPassword, $vNPassword, $vVPassword) {
    $bResult = false;
    if ($this->Password === ph_EncodePassword($vOPassword) && $vNPassword === $vVPassword) {
      $sSQL = 'UPDATE `ecom_customer` SET `pwd`="' . ph_EncodePassword($vNPassword) . '"'
        . ' WHERE (`id`=' . $this->Id . ')';
      ph_Execute($sSQL);
      $bResult = true;
    }
    return $bResult;
  }

  public function resetPassword($vNPassword, $vVPassword) {
    $bResult = false;
    if ($vNPassword === $vVPassword) {
      $sSQL = 'UPDATE `ecom_customer` SET `pwd`="' . ph_EncodePassword($vNPassword) . '"'
        . ' WHERE (`id`=' . $this->Id . ')';
      ph_Execute($sSQL);
      $bResult = true;
    }
    return $bResult;
  }

  public function save() {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `ecom_customer` ('
        . '  `status_id`, `name`, `orgnum`, `logon`, `pwd`, `mobile`, `phone`, `address`'
        . ') VALUES ('
        . '  "' . $this->StatusId . '"'
        . ', "' . $this->Name . '"'
        . ', "' . $this->Orgnum . '"'
        . ', "' . $this->Logon . '"'
        . ', "' . $this->Pwd . '"'
        . ', "' . $this->Mobile . '"'
        . ', "' . $this->Phone . '"'
        . ', "' . $this->Address . '"'
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
      $vSQL = 'UPDATE `ecom_customer` SET'
        . '  `status_id`="' . $this->StatusId . '"'
        . ', `name`="' . $this->Name . '"'
        . ', `orgnum`="' . $this->Orgnum . '"'
        . ', `logon`="' . $this->Logon . '"'
        . ', `mobile`="' . $this->Mobile . '"'
        . ', `phone`="' . $this->Phone . '"'
        . ', `address`="' . $this->Address . '"'
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
    $vSQL = 'DELETE FROM `ecom_customer` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
