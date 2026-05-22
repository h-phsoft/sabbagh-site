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

class cCpyPGrp {

  var $Id;
  var $Name;
  var $Rem;
  //
  var $aPerms = array();

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `name`, `rem`'
      . ' FROM `cpy_perm_grp`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `cpy_perm_grp`';
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
    $cClass = new cCpyPGrp();
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
    $cClass = new cCpyPGrp();
    $cClass->Id = intval($res->fields('id'));
    $cClass->Name = $res->fields('name');
    $cClass->Rem = $res->fields('rem');
    //
    $cClass->aPerms = cCpyPerm::getArray('grp_id=' . $cClass->Id);
    return $cClass;
  }

  public function getPermission($progId) {
    $cClass = new cCpyPerm();
    if ($this->Id > 0) {
      foreach ($this->aPerms as $perm) {
        if ($perm->ProgId === intval($progId)) {
          $cClass = $perm;
          break;
        }
      }
    } else {
      $cClass->Isok = 1;
      $cClass->Ins = 1;
      $cClass->Upd = 1;
      $cClass->Del = 1;
      $cClass->Qry = 1;
      $cClass->Prt = 1;
      $cClass->Imp = 1;
      $cClass->Exp = 1;
      $cClass->Cmt = 1;
      $cClass->Rvk = 1;
      $cClass->Spc = 1;
      //
      $cClass->Insert = 1;
      $cClass->Update = 1;
      $cClass->Delete = 1;
      $cClass->Query = 1;
      $cClass->Print = 1;
      $cClass->Import = 1;
      $cClass->Export = 1;
      $cClass->Commit = 1;
      $cClass->Revoke = 1;
      $cClass->Special = 1;
      //
      $cClass->IsOK = true;
      $cClass->IsInsert = true;
      $cClass->IsUpdate = true;
      $cClass->IsQuery = true;
      $cClass->IsDelete = true;
      $cClass->IsPrint = true;
      $cClass->IsExport = true;
      $cClass->IsImport = true;
      $cClass->IsCommit = true;
      $cClass->IsRevoke = true;
      $cClass->IsSpecial = true;
    }
    return $cClass;
  }

  public function save() {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `cpy_perm_grp` ('
        . '  `name`, `rem`'
        . ') VALUES ('
        . '  "' . $this->Name . '"'
        . ', "' . $this->Rem . '"'
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
      $vSQL = 'UPDATE `cpy_perm_grp` SET'
        . '  `name`="' . $this->Name . '"'
        . ', `rem`="' . $this->Rem . '"'
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
    $nCount = intval(ph_GetDBValue('count(*)', 'cpy_user', 'grp_id=' . $this->Id));
    if ($nCount == 0) {
      $vSQL = 'DELETE FROM `cpy_perm` WHERE `grp_id`=' . $this->Id;
      $res = ph_Execute($vSQL);
      if ($res || $res === 0) {
        $vSQL = 'DELETE FROM `cpy_perm_grp` WHERE `id`=' . $this->Id;
        $res = ph_Execute($vSQL);
        if ($res || $res === 0) {

        } else {
          $aMsg = ph_GetMySQLMessageAsArray();
          $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
          throw new Exception($vMsgs);
        }
      } else {
        $aMsg = ph_GetMySQLMessageAsArray();
        $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
        throw new Exception($vMsgs);
      }
    } else {
      throw new Exception('Used Group');
    }
  }
}
