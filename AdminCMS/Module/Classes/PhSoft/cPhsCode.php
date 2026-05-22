<?php

class cPhsCode {

  var $Id = -999;
  var $Name = '';
  var $Rem = '';
  var $vTable = '';
  public static $aCodes = array(
    'status' => 'phs_cod_status',
    'gender' => 'phs_cod_gender',
    'yesno' => 'phs_cod_yes_no',
    'data-type' => 'phs_cod_data_type',
  );

  const STATUS = 'status';
  const GENDER = 'gender';
  const YESNO = 'yesno';
  const DATA_TYPE = 'data-type';

  public static function getSelectStatement($vTableName, $vWhere = '', $vOrder = '') {
    $sSQL = 'SELECT id, name, rem'
      . ' FROM ' . cPhsCode::$aCodes[strtolower($vTableName)];
    if ($vWhere != '') {
      $sSQL .= ' WHERE (' . $vWhere . ') ';
    }
    if ($vOrder != '') {
      $vOrder = ' ORDER BY ' . $vOrder;
    }
    $sSQL .= $vOrder;

    return $sSQL;
  }

  public static function getArray($vTableName, $vWhere = '') {
    $aArray = array();
    $nIdx = 0;
    $res = ph_Execute(cPhsCode::getSelectStatement($vTableName, $vWhere, 'id, name'));
    if ($res != '') {
      while (!$res->EOF) {
        $aArray[$nIdx] = cPhsCode::getFields($vTableName, $res);
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getInstance($vTableName, $nId) {
    $cClass = new cPhsCode();
    $res = ph_Execute(cPhsCode::getSelectStatement($vTableName, '(id="' . $nId . '")'));
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = cPhsCode::getFields($vTableName, $res);
      }
      $res->Close();
    }
    return $cClass;
  }

  public static function getFields($vTableName, $res) {
    $cClass = new cPhsCode();
    $cClass->vTable = $vTableName;
    $cClass->Id = intval($res->fields("id"));
    $cClass->Name = getLabel($res->fields("name"));
    $cClass->Rem = $res->fields("rem");
    return $cClass;
  }

  public function save() {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO ' . cPhsCode::$aCodes[strtolower($this->vTable)] . ' (name, rem)'
        . ' VALUES ("' . $this->Name . '", "' . $this->Rem . '")';
      $res = ph_ExecuteInsert($vSQL);
      if ($res || $res === 0) {
        $nId = ph_InsertedId();
      } else {
        $aMsg = ph_GetMySQLMessageAsArray();
        $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
        throw new Exception($vMsgs);
      }
    } else {
      $vSQL = 'UPDATE ' . cPhsCode::$aCodes[strtolower($this->vTable)] . ' SET'
        . '  name = "' . $this->Name . '"'
        . ', rem = "' . $this->Rem . '"'
        . ' WHERE id = "' . $this->Id . '"';
      $res = ph_ExecuteUpdate($vSQL);
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
    $vSQL = 'DELETE FROM ' . cPhsCode::$aCodes[strtolower($this->vTable)]
      . ' WHERE id = "' . $this->Id . '"';
    $res = ph_ExecuteUpdate($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
