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
 * @update 2024/04/02 06:07
 *
 */

class cEcomVorders {

  var $OrdId = 0;
  var $OrdCurnRate = 1.00000;
  var $OrdAddat;
  var $StatusId;
  var $StatusName;
  var $CurnId = 0;
  var $CurnName;
  var $CurnStatusId = 1;
  var $CurnRate = 1.00;
  var $CurnColor;
  var $CurnSymbole;
  var $CustId = 0;
  var $CustStatusId = 2;
  var $CustName;
  var $CustOrgnum;
  var $CustLogon;
  var $CustMobile;
  var $CustPhone;
  var $CustAddress;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `ord_id`, `ord_curn_rate`, `ord_addat`, `status_id`, `status_name`, `curn_id`, `curn_name`'
      . ', `curn_status_id`, `curn_rate`, `curn_color`, `curn_symbole`, `cust_id`, `cust_status_id`, `cust_name`'
      . ', `cust_orgnum`, `cust_logon`, `cust_mobile`, `cust_phone`, `cust_address`'
      . ' FROM `ecom_vorders`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `ecom_vorders`';
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
      $vOrder = '`ord_addat` DESC';
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
    $cClass = new cEcomVorders();
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
    $cClass = new cEcomVorders();
    $cClass->OrdId = intval($res->fields('ord_id'));
    $cClass->OrdCurnRate = floatval($res->fields('ord_curn_rate'));
    $cClass->OrdAddat = $res->fields('ord_addat');
    $cClass->StatusId = intval($res->fields('status_id'));
    $cClass->StatusName = $res->fields('status_name');
    $cClass->CurnId = intval($res->fields('curn_id'));
    $cClass->CurnName = $res->fields('curn_name');
    $cClass->CurnStatusId = intval($res->fields('curn_status_id'));
    $cClass->CurnRate = floatval($res->fields('curn_rate'));
    $cClass->CurnColor = $res->fields('curn_color');
    $cClass->CurnSymbole = $res->fields('curn_symbole');
    $cClass->CustId = intval($res->fields('cust_id'));
    $cClass->CustStatusId = intval($res->fields('cust_status_id'));
    $cClass->CustName = $res->fields('cust_name');
    $cClass->CustOrgnum = $res->fields('cust_orgnum');
    $cClass->CustLogon = $res->fields('cust_logon');
    $cClass->CustMobile = $res->fields('cust_mobile');
    $cClass->CustPhone = $res->fields('cust_phone');
    $cClass->CustAddress = $res->fields('cust_address');
    //
    return $cClass;
  }

  public function save($nUId) {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `ecom_vorders` ('
        . '  `ord_curn_rate`, `ord_addat`, `status_id`, `status_name`, `curn_id`, `curn_name`, `curn_status_id`'
        . ', `curn_rate`, `curn_color`, `curn_symbole`, `cust_id`, `cust_status_id`, `cust_name`, `cust_orgnum`'
        . ', `cust_logon`, `cust_mobile`, `cust_phone`, `cust_address`, `ins_user`'
        . ') VALUES ('
        . '  "' . $this->OrdCurnRate . '"'
        . ', STR_TO_DATE("' . $this->OrdAddat . '","%Y-%m-%d")'
        . ', "' . $this->StatusId . '"'
        . ', "' . $this->StatusName . '"'
        . ', "' . $this->CurnId . '"'
        . ', "' . $this->CurnName . '"'
        . ', "' . $this->CurnStatusId . '"'
        . ', "' . $this->CurnRate . '"'
        . ', "' . $this->CurnColor . '"'
        . ', "' . $this->CurnSymbole . '"'
        . ', "' . $this->CustId . '"'
        . ', "' . $this->CustStatusId . '"'
        . ', "' . $this->CustName . '"'
        . ', "' . $this->CustOrgnum . '"'
        . ', "' . $this->CustLogon . '"'
        . ', "' . $this->CustMobile . '"'
        . ', "' . $this->CustPhone . '"'
        . ', "' . $this->CustAddress . '"'
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
      $vSQL = 'UPDATE `ecom_vorders` SET'
        . '  `ord_curn_rate`="' . $this->OrdCurnRate . '"'
        . ', `ord_addat`=STR_TO_DATE("' . $this->OrdAddat . '","%Y-%m-%d")'
        . ', `status_id`="' . $this->StatusId . '"'
        . ', `status_name`="' . $this->StatusName . '"'
        . ', `curn_id`="' . $this->CurnId . '"'
        . ', `curn_name`="' . $this->CurnName . '"'
        . ', `curn_status_id`="' . $this->CurnStatusId . '"'
        . ', `curn_rate`="' . $this->CurnRate . '"'
        . ', `curn_color`="' . $this->CurnColor . '"'
        . ', `curn_symbole`="' . $this->CurnSymbole . '"'
        . ', `cust_id`="' . $this->CustId . '"'
        . ', `cust_status_id`="' . $this->CustStatusId . '"'
        . ', `cust_name`="' . $this->CustName . '"'
        . ', `cust_orgnum`="' . $this->CustOrgnum . '"'
        . ', `cust_logon`="' . $this->CustLogon . '"'
        . ', `cust_mobile`="' . $this->CustMobile . '"'
        . ', `cust_phone`="' . $this->CustPhone . '"'
        . ', `cust_address`="' . $this->CustAddress . '"'
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
    $vSQL = 'DELETE FROM `ecom_vorders` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
