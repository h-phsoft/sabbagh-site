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
 * @update 2024/03/23 12:27
 *
 */

class cPhsPref {

  var $Id;
  var $CmsId = 2;
  var $TypeId = 2;
  var $Key;
  var $Name;
  var $Value;
  var $Rem;
  //
  public static $Prefs = array();

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `cms_id`, `type_id`, `key`, `name`, `value`, `rem`'
      . ' FROM `phs_pref`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `phs_pref`';
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
    $cClass = new cPhsPref();
    $res = ph_Execute(self::getSelectStatement('(`id`="' . $nId . '")'));
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = self::getFields($res);
      }
      $res->Close();
    }
    return $cClass;
  }

  public static function getInstanceByKey($sKey) {
    $cClass = new cPhsPref();
    $res = ph_Execute(self::getSelectStatement('(`UPPER(`key`)=UPPER("' . $sKey . '"))'));
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cPhsPref::getFields($res);
      }
      $res->Close();
    }
    return $cClass;
  }

  public static function getFields($res) {
    $cClass = new cPhsPref();
    $cClass->Id = intval($res->fields('id'));
    $cClass->CmsId = $res->fields('cms_id');
    $cClass->TypeId = $res->fields('type_id');
    $cClass->Key = $res->fields('key');
    $cClass->Name = $res->fields('name');
    $cClass->Value = $res->fields('value');
    $cClass->Rem = $res->fields('rem');
    //
    return $cClass;
  }

  public function save() {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `phs_pref` ('
        . '  `cms_id`, `type_id`, `key`, `name`, `value`, `rem`'
        . ') VALUES ('
        . '  "' . $this->CmsId . '"'
        . '  "' . $this->TypeId . '"'
        . '  "' . $this->Key . '"'
        . ', "' . $this->Name . '"'
        . ', "' . $this->Value . '"'
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
      $vSQL = 'UPDATE `phs_pref` SET'
        . '  `cms_id`="' . $this->CmsId . '"'
        . ', `type_id`="' . $this->TypeId . '"'
        . ', `key`="' . $this->Key . '"'
        . ', `name`="' . $this->Name . '"'
        . ', `value`="' . $this->Value . '"'
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
    $vSQL = 'DELETE FROM `phs_pref` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }

  public static function getDBKeys() {
    return self::loadDBKeys();
  }

  public static function loadDBKeys() {
    $aKeys = array();
    $sSQL = 'SELECT `id`, `cms_id`, `type_id`, `key`, `name`, `value`, `rem`'
      . ' FROM `phs_pref`';
    $res = ph_Execute($sSQL);
    if ($res != '') {
      while (!$res->EOF) {
        $aKeys[strtoupper($res->fields("key"))] = $res->fields("value");
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aKeys;
  }

  // Get DB Keys Value from Array
  public static function getPref($sKey) {
    $sUKey = strtoupper($sKey);
    $sRetVar = $sKey;
    if (!isset(cPhsPref::$Prefs)) {
      self::$Prefs = self::loadDBKeys();
    }
    if (array_key_exists($sUKey, self::$Prefs)) {
      $sRetVar = self::$Prefs[$sUKey];
    } else {
      $sRetVar = self::getPrefValue($sKey);
      if ($sRetVar == "") {
        $sRetVar = $sKey;
      }
    }
    return $sRetVar;
  }

  public static function getPrefValue($sKey) {
    return ph_GetDBValue('value', 'phs_pref', '(UPPER(`key`)=UPPER("' . $sKey . '"))');
  }

  public static function setPrefValue($sKey, $vValue) {
    $sSQL = 'UPDATE `phs_pref` SET `value`="' . $vValue . '" WHERE (UPPER(`key`)=UPPER("' . $sKey . '"))';
    $res = ph_Execute($sSQL);
    return $res;
  }

  public static function isPref($sKey) {
    $sRetVar = self::getPrefValue($sKey);
    $bRet = false;
    if (intval($sRetVar) === 1 || strtolower($sRetVar) === 'true') {
      $bRet = true;
    }
    return $bRet;
  }
}
