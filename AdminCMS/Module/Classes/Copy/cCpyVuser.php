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
 * @update 2024/06/12 22:52
 *
 */

class cCpyVuser {

  var $Id = 0;
  var $Rid = 0;
  var $BranId = 0;
  var $BranName;
  var $TypeId = 0;
  var $GrpId;
  var $StatusId = 1;
  var $GenderId = 1;
  var $Name;
  var $Logon;
  var $Password;
  var $Image;
  //

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `rid`, `bran_id`, `bran_name`, `type_id`, `grp_id`, `status_id`'
      . ', `gender_id`, `name`, `logon`, `password`, `image`'
      . ' FROM `cpy_vuser`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `cpy_vuser`';
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
    $cClass = new cCpyVuser();
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
    $cClass = new cCpyVuser();
    $cClass->Id = intval($res->fields('id'));
    $cClass->Rid = intval($res->fields('rid'));
    $cClass->BranId = intval($res->fields('bran_id'));
    $cClass->BranName = $res->fields('bran_name');
    $cClass->TypeId = intval($res->fields('type_id'));
    $cClass->GrpId = intval($res->fields('grp_id'));
    $cClass->StatusId = intval($res->fields('status_id'));
    $cClass->GenderId = intval($res->fields('gender_id'));
    $cClass->Name = $res->fields('name');
    $cClass->Logon = $res->fields('logon');
    $cClass->Password = $res->fields('password');
    $cClass->Image = $res->fields('image');
    //
    return $cClass;
  }

  public function save($nUId) {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `cpy_vuser` ('
        . '  `rid`, `bran_id`, `bran_name`, `type_id`, `grp_id`, `status_id`, `gender_id`'
        . ', `name`, `logon`, `password`, `image`, `ins_user`'
        . ') VALUES ('
        . '  "' . $this->Rid . '"'
        . ', "' . $this->BranId . '"'
        . ', "' . $this->BranName . '"'
        . ', "' . $this->TypeId . '"'
        . ', "' . $this->GrpId . '"'
        . ', "' . $this->StatusId . '"'
        . ', "' . $this->GenderId . '"'
        . ', "' . $this->Name . '"'
        . ', "' . $this->Logon . '"'
        . ', "' . $this->Password . '"'
        . ', "' . $this->Image . '"'
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
      $vSQL = 'UPDATE `cpy_vuser` SET'
        . '  `rid`="' . $this->Rid . '"'
        . ', `bran_id`="' . $this->BranId . '"'
        . ', `bran_name`="' . $this->BranName . '"'
        . ', `type_id`="' . $this->TypeId . '"'
        . ', `grp_id`="' . $this->GrpId . '"'
        . ', `status_id`="' . $this->StatusId . '"'
        . ', `gender_id`="' . $this->GenderId . '"'
        . ', `name`="' . $this->Name . '"'
        . ', `logon`="' . $this->Logon . '"'
        . ', `password`="' . $this->Password . '"'
        . ', `image`="' . $this->Image . '"'
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
    $vSQL = 'DELETE FROM `cpy_vuser` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }

}

