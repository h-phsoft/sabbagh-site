<?php

/*
 * PhSoft(R) 1989-2025
 * Copyrights(c) 2025
 *
 * PhSoft Framework Code Generator
 * PhGenPHPCodes
 * 3.25.9.412
 *
 * @author Haytham
 * @version 3.25.9.412
 * @update 2025/09/08 18:51
 *
 */

class cDistSuppliers {

  var $Id;
  var $Ord;
  var $CountryId;
  var $CountryName;
  var $Name;
  var $Image;
  var $Paragraph;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `ord`, `country_id`, `name`, `image`, `paragraph`'
      . ' FROM `dist_suppliers`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `dist_suppliers`';
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
      $vOrder = '`ord`, `name`';
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
    $cClass = new cDistSuppliers();
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
    $cClass = new cDistSuppliers();
    $cClass->Id = intval($res->fields('id'));
    $cClass->Ord = intval($res->fields('ord'));
    $cClass->CountryId = intval($res->fields('country_id'));
    $cClass->Name = $res->fields('name');
    $cClass->Image = $res->fields('image');
    $cClass->Paragraph = $res->fields('paragraph');
    //
    $cClass->CountryName = ph_GetDBValue('name', 'dist_country', 'id=' . $cClass->CountryId);
    return $cClass;
  }

  public function save($nUId) {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `dist_suppliers` ('
        . '  `ord`, `country_id`, `name`, `image`, `paragraph`, `ins_user`'
        . ') VALUES ('
        . '  "' . $this->Ord . '"'
        . ', "' . $this->CountryId . '"'
        . ', "' . $this->Name . '"'
        . ', "' . $this->Image . '"'
        . ', "' . $this->Paragraph . '"'
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
      $vSQL = 'UPDATE `dist_suppliers` SET'
        . '  `ord`="' . $this->Ord . '"'
        . ', `country_id`="' . $this->CountryId . '"'
        . ', `name`="' . $this->Name . '"'
        . ', `image`="' . $this->Image . '"'
        . ', `paragraph`="' . $this->Paragraph . '"'
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
    $vSQL = 'DELETE FROM `dist_suppliers` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
