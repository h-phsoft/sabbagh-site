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
 * @update 2024/03/23 10:22
 *
 */

class cCpyToken {

  var $Id;
  var $Gid;
  var $UserId;
  var $StatusId = 1;
  var $Sdate;
  var $Edate;
  var $Adate;
  var $Pvkey;
  var $Pbkey;
  var $Ip;
  var $Port;
  var $Host;
  //
  var $oStatus;
  var $oUser;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `gid`, `user_id`, `status_id`, `sdate`, `edate`, `adate`'
      . ', `pvkey`, `pbkey`, `ip`, `port`, `host`'
      . ' FROM `cpy_token`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `cpy_token`';
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
    $cClass = new cCpyToken();
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
    $cClass = new cCpyToken();
    $cClass->Id = intval($res->fields('id'));
    $cClass->Gid = $res->fields('gid');
    $cClass->UserId = intval($res->fields('user_id'));
    $cClass->StatusId = intval($res->fields('status_id'));
    $cClass->Sdate = $res->fields('sdate');
    $cClass->Edate = $res->fields('edate');
    $cClass->Adate = $res->fields('adate');
    $cClass->Pvkey = $res->fields('pvkey');
    $cClass->Pbkey = $res->fields('pbkey');
    $cClass->Ip = $res->fields('ip');
    $cClass->Port = $res->fields('port');
    $cClass->Host = $res->fields('host');
    //
    $cClass->oStatus = cPhsCode::getInstance(cPhsCode::STATUS, $cClass->StatusId);
    $cClass->oUser = cCpyUser::getInstance($cClass->UserId);
    return $cClass;
  }

  public function save($nUId) {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `cpy_token` ('
        . '  `gid`, `user_id`, `status_id`, `sdate`, `edate`, `adate`, `pvkey`'
        . ', `pbkey`, `ip`, `port`, `host`, `ins_user`'
        . ') VALUES ('
        . '  "' . $this->Gid . '"'
        . ', "' . $this->UserId . '"'
        . ', "' . $this->StatusId . '"'
        . ', STR_TO_DATE("' . $this->Sdate . '","%Y-%m-%d")'
        . ', STR_TO_DATE("' . $this->Edate . '","%Y-%m-%d")'
        . ', STR_TO_DATE("' . $this->Adate . '","%Y-%m-%d")'
        . ', "' . $this->Pvkey . '"'
        . ', "' . $this->Pbkey . '"'
        . ', "' . $this->Ip . '"'
        . ', "' . $this->Port . '"'
        . ', "' . $this->Host . '"'
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
      $vSQL = 'UPDATE `cpy_token` SET'
        . '  `gid`="' . $this->Gid . '"'
        . ', `user_id`="' . $this->UserId . '"'
        . ', `status_id`="' . $this->StatusId . '"'
        . ', `sdate`=STR_TO_DATE("' . $this->Sdate . '","%Y-%m-%d")'
        . ', `edate`=STR_TO_DATE("' . $this->Edate . '","%Y-%m-%d")'
        . ', `adate`=STR_TO_DATE("' . $this->Adate . '","%Y-%m-%d")'
        . ', `pvkey`="' . $this->Pvkey . '"'
        . ', `pbkey`="' . $this->Pbkey . '"'
        . ', `ip`="' . $this->Ip . '"'
        . ', `port`="' . $this->Port . '"'
        . ', `host`="' . $this->Host . '"'
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
    $vSQL = 'DELETE FROM `cpy_token` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }

}

