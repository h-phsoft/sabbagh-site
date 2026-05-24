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

class cCpyPerm {

  var $Id;
  var $GrpId;
  var $ProgId;
  var $Isok = 0;
  var $Ins = 0;
  var $Upd = 0;
  var $Qry = 0;
  var $Del = 0;
  var $Prt = 0;
  var $Exp = 0;
  var $Imp = 0;
  var $Cmt = 0;
  var $Rvk = 0;
  var $Spc = 0;
  var $Insert = 0;
  var $Update = 0;
  var $Query = 0;
  var $Delete = 0;
  var $Print = 0;
  var $Export = 0;
  var $Import = 0;
  var $Commit = 0;
  var $Revoke = 0;
  var $Special = 0;
  //
  var $oProg;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `grp_id`, `prog_id`, `isok`, `ins`, `upd`, `qry`, `del`, `prt`, `exp`, `imp`, `cmt`, `rvk`, `spc`'
      . ' FROM `cpy_perm`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `cpy_perm`';
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
      $vOrder = '`grp_id`, `prog_id`, `id`';
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
    $cClass = new cCpyPerm();
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
    $cClass = new cCpyPerm();
    $cClass->Id = intval($res->fields('id'));
    $cClass->GrpId = intval($res->fields('grp_id'));
    $cClass->ProgId = intval($res->fields('prog_id'));
    $cClass->Isok = intval($res->fields('isok'));
    $cClass->Ins = intval($res->fields('ins'));
    $cClass->Upd = intval($res->fields('upd'));
    $cClass->Qry = intval($res->fields('qry'));
    $cClass->Del = intval($res->fields('del'));
    $cClass->Prt = intval($res->fields('prt'));
    $cClass->Exp = intval($res->fields('exp'));
    $cClass->Imp = intval($res->fields('imp'));
    $cClass->Cmt = intval($res->fields('cmt'));
    $cClass->Rvk = intval($res->fields('rvk'));
    $cClass->Spc = intval($res->fields('spc'));
    //
    $cClass->Insert = $cClass->Ins;
    $cClass->Update = $cClass->Upd;
    $cClass->Query = $cClass->Qry;
    $cClass->Delete = $cClass->Del;
    $cClass->Print = $cClass->Prt;
    $cClass->Export = $cClass->Exp;
    $cClass->Import = $cClass->Imp;
    $cClass->Commit = $cClass->Cmt;
    $cClass->Revoke = $cClass->Rvk;
    $cClass->Special = $cClass->Spc;
    //
    $cClass->oProg = cPhsProgram::getInstance($cClass->ProgId);
    return $cClass;
  }

  public static function getGroupPermissions($vWhere = '') {
    $aArray = array();
    $res = ph_Execute(cCpyPerm::getSelectStatement($vWhere, 'prog_id'));
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[intval($res->fields("prog_id"))] = cCpyPerm::getFields($res);
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function refreshPermissions($nPGrpId) {
    $vSQL = 'INSERT INTO cpy_perm (grp_id, prog_id)'
      . ' SELECT ' . $nPGrpId . ', id'
      . ' FROM phs_vprogram'
      . ' WHERE status_id=1'
      . '   AND sys_id!=9909'
      . '   AND grp_id>0'
      . '   AND id NOT IN (SELECT prog_id FROM cpy_perm WHERE grp_id="' . $nPGrpId . '")';
    ph_Execute($vSQL);
  }

  public function save() {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `cpy_perm` ('
        . '  `grp_id`, `prog_id`, `isok`, `ins`, `upd`, `qry`, `del`'
        . ', `prt`, `exp`, `imp`, `cmt`, `rvk`, `spc`'
        . ') VALUES ('
        . '  "' . $this->GrpId . '"'
        . ', "' . $this->ProgId . '"'
        . ', "' . $this->Isok . '"'
        . ', "' . $this->Ins . '"'
        . ', "' . $this->Upd . '"'
        . ', "' . $this->Qry . '"'
        . ', "' . $this->Del . '"'
        . ', "' . $this->Prt . '"'
        . ', "' . $this->Exp . '"'
        . ', "' . $this->Imp . '"'
        . ', "' . $this->Cmt . '"'
        . ', "' . $this->Rvk . '"'
        . ', "' . $this->Spc . '"'
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
      $vSQL = 'UPDATE `cpy_perm` SET'
        . '  `grp_id`="' . $this->GrpId . '"'
        . ', `prog_id`="' . $this->ProgId . '"'
        . ', `isok`="' . $this->Isok . '"'
        . ', `ins`="' . $this->Ins . '"'
        . ', `upd`="' . $this->Upd . '"'
        . ', `qry`="' . $this->Qry . '"'
        . ', `del`="' . $this->Del . '"'
        . ', `prt`="' . $this->Prt . '"'
        . ', `exp`="' . $this->Exp . '"'
        . ', `imp`="' . $this->Imp . '"'
        . ', `cmt`="' . $this->Cmt . '"'
        . ', `rvk`="' . $this->Rvk . '"'
        . ', `spc`="' . $this->Spc . '"'
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
    $vSQL = 'DELETE FROM `cpy_perm` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
