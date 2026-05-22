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

class cDistProducts {

  var $Id;
  var $Ord;
  var $GroupId;
  var $SupplierId;
  var $BrandId;
  var $CategoryId;
  var $Name;
  var $Image;
  var $Price;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `ord`, `group_id`, `supplier_id`, `brand_id`, `category_id`, `name`, `image`, `price`'
      . ' FROM `dist_products`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `dist_products`';
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
      $vOrder = '`ord`, `group_id`, `supplier_id`, `brand_id`, `category_id`, `name`';
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
    $cClass = new cDistProducts();
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
    $cClass = new cDistProducts();
    $cClass->Id = intval($res->fields('id'));
    $cClass->Ord = intval($res->fields('ord'));
    $cClass->GroupId = intval($res->fields('group_id'));
    $cClass->SupplierId = intval($res->fields('supplier_id'));
    $cClass->BrandId = intval($res->fields('brand_id'));
    $cClass->CategoryId = intval($res->fields('category_id'));
    $cClass->Name = $res->fields('name');
    $cClass->Image = $res->fields('image');
    $cClass->Price = $res->fields('price');
    return $cClass;
  }

  public function save($nUId) {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `dist_products` ('
        . '  `ord`, `group_id`, `supplier_id`, `brand_id`, `category_id`, `name`, `image`, `price`, `ins_user`'
        . ') VALUES ('
        . '  "' . $this->Ord . '"'
        . ', "' . $this->GroupId . '"'
        . ', "' . $this->SupplierId . '"'
        . ', "' . $this->BrandId . '"'
        . ', "' . $this->CategoryId . '"'
        . ', "' . $this->Name . '"'
        . ', "' . $this->Image . '"'
        . ', "' . $this->Price . '"'
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
      $vSQL = 'UPDATE `dist_products` SET'
        . '  `ord`="' . $this->Ord . '"'
        . ', `group_id`="' . $this->GroupId . '"'
        . ', `supplier_id`="' . $this->SupplierId . '"'
        . ', `brand_id`="' . $this->BrandId . '"'
        . ', `category_id`="' . $this->CategoryId . '"'
        . ', `name`="' . $this->Name . '"'
        . ', `image`="' . $this->Image . '"'
        . ', `price`="' . $this->Price . '"'
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
    $vSQL = 'DELETE FROM `dist_products` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
