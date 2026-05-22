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

class cCpyUser {

  var $Id = -999;
  var $BranId = 0;
  var $GrpId;
  var $StatusId = 1;
  var $GenderId = 1;
  var $Name;
  var $Logon;
  var $Password;
  var $Image;
  var $GUID = '';
  //
  var $oGrp;
  var $oStatus;
  var $oGender;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `grp_id`, `status_id`, `gender_id`, `name`, `logon`, `password`, `image`'
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
      $vOrder = '`grp_id`, `Id`';
    }
    $vWhere0 = '(`grp_id`>0)';
    if ($vWhere != '') {
      $vWhere0 .= ' AND (' . $vWhere . ')';
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
    $cClass = new cCpyUser();
    $res = ph_Execute(self::getSelectStatement('(`id`="' . $nId . '")'));
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = self::getFields($res);
      }
      $res->Close();
    }
    return $cClass;
  }

  public static function getInstanceByLogon($vLogon) {
    $cClass = new cCpyUser();
    $res = ph_Execute(self::getSelectStatement('(`logon`="' . $vLogon . '")'));
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = self::getFields($res);
      }
      $res->Close();
    }
    return $cClass;
  }

  public static function checkUserLogin($vLogon, $vPassword) {
    $cClass = new cCpyUser();
    $res = ph_Execute(self::getSelectStatement('(`status_id`=1) AND (UPPER(`logon`)=UPPER("' . $vLogon . '")) AND (`password`="' . $vPassword . '")'));
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = self::getFields($res);
      }
      $res->Close();
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cCpyUser();
    $cClass->Id = intval($res->fields('id'));
    $cClass->GrpId = intval($res->fields('grp_id'));
    $cClass->StatusId = intval($res->fields('status_id'));
    $cClass->GenderId = intval($res->fields('gender_id'));
    $cClass->Name = $res->fields('name');
    $cClass->Logon = $res->fields('logon');
    $cClass->Password = $res->fields('password');
    $cClass->Image = $res->fields('image');
    //
    $cClass->oGrp = cCpyPGrp::getInstance($cClass->GrpId);
    $cClass->oStatus = cPhsCode::getInstance(cPhsCode::STATUS, $cClass->StatusId);
    $cClass->oGender = cPhsCode::getInstance(cPhsCode::GENDER, $cClass->GenderId);
    return $cClass;
  }

  public function changePassword($vOPassword, $vNPassword, $vVPassword) {
    $bResult = false;
    if ($this->Password === ph_EncodePassword($vOPassword) && $vNPassword === $vVPassword) {
      $sSQL = 'UPDATE `cpy_user` SET `password`="' . ph_EncodePassword($vNPassword) . '"'
        . ' WHERE (`id`=' . $this->Id . ')';
      ph_Execute($sSQL);
      $bResult = true;
    }
    return $bResult;
  }

  public function resetPassword($vNPassword, $vVPassword) {
    $bResult = false;
    if ($vNPassword === $vVPassword) {
      $sSQL = 'UPDATE `cpy_user` SET `password`="' . ph_EncodePassword($vNPassword) . '" WHERE (`id`=' . $this->Id . ')';
      ph_ExecuteUpdate($sSQL);
      $bResult = true;
    }
    return $bResult;
  }

  public function save() {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `cpy_user` ('
        . '  `grp_id`, `status_id`, `gender_id`, `name`, `logon`'
        . ') VALUES ('
        . '  "' . $this->GrpId . '"'
        . ', "' . $this->StatusId . '"'
        . ', "' . $this->GenderId . '"'
        . ', "' . $this->Name . '"'
        . ', "' . $this->Logon . '"'
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
      $vSQL = 'UPDATE `cpy_user` SET'
        . '  `grp_id`="' . $this->GrpId . '"'
        . ', `status_id`="' . $this->StatusId . '"'
        . ', `gender_id`="' . $this->GenderId . '"'
        . ', `name`="' . $this->Name . '"'
        . ', `logon`="' . $this->Logon . '"'
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
    $vSQL = 'DELETE FROM `cpy_user` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
