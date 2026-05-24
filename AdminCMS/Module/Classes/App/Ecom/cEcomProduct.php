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
 * @update 2024/03/23 14:51
 *
 */

class cEcomProduct {

  var $Id;
  var $Mnum = 0;
  var $BrandId = 0;
  var $StatusId = 1;
  var $CatId = 0;
  var $TagId = 0;
  var $Name1;
  var $Name2;
  var $Qnt = 0.00;
  var $Price = 0.00;
  var $Cprice = 0.00;
  var $Desc1;
  var $Desc2;
  var $Desc3;
  var $Desc4;
  var $Desc5;
  var $Image;
  //
  var $oBrand;
  var $oCat;
  var $oStatus;
  var $oTag;
  var $aImages;
  var $aSizes;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `mnum`, `brand_id`, `status_id`, `cat_id`, `tag_id`, `name1`'
      . ', `name2`, `qnt`, `price`, `cprice`, `desc1`, `desc2`, `desc3`, `desc4`, `desc5`, `image`'
      . ' FROM `ecom_product`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `ecom_product`';
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
    $cClass = new cEcomProduct();
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
    $cClass = new cEcomProduct();
    $cClass->Id = intval($res->fields('id'));
    $cClass->Mnum = intval($res->fields('mnum'));
    $cClass->BrandId = intval($res->fields('brand_id'));
    $cClass->StatusId = intval($res->fields('status_id'));
    $cClass->CatId = intval($res->fields('cat_id'));
    $cClass->TagId = intval($res->fields('tag_id'));
    $cClass->Name1 = $res->fields('name1');
    $cClass->Name2 = $res->fields('name2');
    $cClass->Qnt = floatval($res->fields('qnt'));
    $cClass->Price = floatval($res->fields('price'));
    $cClass->Cprice = floatval($res->fields('cprice'));
    $cClass->Desc1 = $res->fields('desc1');
    $cClass->Desc2 = $res->fields('desc2');
    $cClass->Desc3 = $res->fields('desc3');
    $cClass->Desc4 = $res->fields('desc4');
    $cClass->Desc5 = $res->fields('desc5');
    $cClass->Image = $res->fields('image');
    //
    $cClass->Desc1 = ($cClass->Desc1 == 'null' || $cClass->Desc1 == null) ? '' : $cClass->Desc1;
    $cClass->Desc2 = ($cClass->Desc2 == 'null' || $cClass->Desc2 == null) ? '' : $cClass->Desc2;
    $cClass->Desc3 = ($cClass->Desc3 == 'null' || $cClass->Desc3 == null) ? '' : $cClass->Desc3;
    $cClass->Desc4 = ($cClass->Desc4 == 'null' || $cClass->Desc4 == null) ? '' : $cClass->Desc4;
    //
    $cClass->oBrand = cEcomBrand::getInstance($cClass->BrandId);
    $cClass->oCat = cEcomCat::getInstance($cClass->CatId);
    $cClass->oStatus = cPhsCode::getInstance(cPhsCode::STATUS, $cClass->StatusId);
    $cClass->oTag = cEcomTag::getInstance($cClass->TagId);
    //
    $cClass->aImages = cEcomProdImage::getArray('prod_id=' . $cClass->Id);
    $cClass->aSizes = cEcomProdSize::getArray('prod_id=' . $cClass->Id);
    return $cClass;
  }

  public function save() {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `ecom_product` ('
        . '  `mnum`, `brand_id`, `status_id`, `cat_id`, `tag_id`, `name1`, `name2`'
        . ', `qnt`, `price`, `cprice`, `desc1`, `desc2`, `desc3`, `desc4`, `desc5`, `image`'
        . ') VALUES ('
        . '  "' . $this->Mnum . '"'
        . ', "' . $this->BrandId . '"'
        . ', "' . $this->StatusId . '"'
        . ', "' . $this->CatId . '"'
        . ', "' . $this->TagId . '"'
        . ', "' . $this->Name1 . '"'
        . ', "' . $this->Name2 . '"'
        . ', "' . $this->Qnt . '"'
        . ', "' . $this->Price . '"'
        . ', "' . $this->Cprice . '"'
        . ', "' . $this->Desc1 . '"'
        . ', "' . $this->Desc2 . '"'
        . ', "' . $this->Desc3 . '"'
        . ', "' . $this->Desc4 . '"'
        . ', "' . $this->Desc5 . '"'
        . ', "' . $this->Image . '"'
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
      $vSQL = 'UPDATE `ecom_product` SET'
        . '  `mnum`="' . $this->Mnum . '"'
        . ', `brand_id`="' . $this->BrandId . '"'
        . ', `status_id`="' . $this->StatusId . '"'
        . ', `cat_id`="' . $this->CatId . '"'
        . ', `tag_id`="' . $this->TagId . '"'
        . ', `name1`="' . $this->Name1 . '"'
        . ', `name2`="' . $this->Name2 . '"'
        . ', `qnt`="' . $this->Qnt . '"'
        . ', `price`="' . $this->Price . '"'
        . ', `cprice`="' . $this->Cprice . '"'
        . ', `desc1`="' . $this->Desc1 . '"'
        . ', `desc2`="' . $this->Desc2 . '"'
        . ', `desc3`="' . $this->Desc3 . '"'
        . ', `desc4`="' . $this->Desc4 . '"'
        . ', `desc5`="' . $this->Desc5 . '"'
        . ', `image`="' . $this->Image . '"'
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
    $vSQL = 'DELETE FROM `ecom_product` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
