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
 * @update 2024/03/30 09:18
 *
 */

class cEcomVproductSizes {

  var $BrandId = 0;
  var $BrandStatusId = 1;
  var $BrandName1;
  var $BrandName2;
  var $BrandImage;
  var $CatId = 0;
  var $CatStatusId;
  var $CatOrder = 0;
  var $CatName1;
  var $CatName2;
  var $CatImage;
  var $TagId = 0;
  var $TagStatusId = 1;
  var $TagName;
  var $TagClassname;
  var $ProdId = 0;
  var $ProdMnum = 0;
  var $ProdStatusId = 1;
  var $ProdName1;
  var $ProdName2;
  var $ProdQnt = 0.00;
  var $ProdPrice = 0.00;
  var $ProdCprice = 0.00;
  var $ProdDesc1;
  var $ProdDesc2;
  var $ProdImage;
  var $SizeId = 0;
  var $SizeSnum;
  var $SizeAnum;
  var $SizeName;
  var $SizeBox = 0.00;
  var $SizeQnt = 0.00;
  var $SizePrice = 0.00;
  var $SizeCprice = 0.00;
  var $UnitId = 0;
  var $UnitName;
  var $UnitRem;
  //

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `brand_id`, `brand_status_id`, `brand_name1`, `brand_name2`, `brand_image`, `cat_id`, `cat_status_id`'
      . ', `cat_order`, `cat_name1`, `cat_name2`, `cat_image`, `tag_id`, `tag_status_id`, `tag_name`'
      . ', `tag_classname`, `prod_id`, `prod_mnum`, `prod_status_id`, `prod_name1`, `prod_name2`, `prod_qnt`'
      . ', `prod_price`, `prod_cprice`, `prod_desc1`, `prod_desc2`, `prod_image`, `size_id`, `size_snum`'
      . ', `size_anum`, `size_name`, `size_box`, `size_qnt`, `size_price`, `size_cprice`, `unit_id`'
      . ', `unit_name`, `unit_rem`'
      . ' FROM `ecom_vproduct_sizes`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `ecom_vproduct_sizes`';
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
    $cClass = new cEcomVproductSizes();
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
    $cClass = new cEcomVproductSizes();
    $cClass->BrandId = intval($res->fields('brand_id'));
    $cClass->BrandStatusId = intval($res->fields('brand_status_id'));
    $cClass->BrandName1 = $res->fields('brand_name1');
    $cClass->BrandName2 = $res->fields('brand_name2');
    $cClass->BrandImage = $res->fields('brand_image');
    $cClass->CatId = intval($res->fields('cat_id'));
    $cClass->CatStatusId = intval($res->fields('cat_status_id'));
    $cClass->CatOrder = intval($res->fields('cat_order'));
    $cClass->CatName1 = $res->fields('cat_name1');
    $cClass->CatName2 = $res->fields('cat_name2');
    $cClass->CatImage = $res->fields('cat_image');
    $cClass->TagId = intval($res->fields('tag_id'));
    $cClass->TagStatusId = intval($res->fields('tag_status_id'));
    $cClass->TagName = $res->fields('tag_name');
    $cClass->TagClassname = $res->fields('tag_classname');
    $cClass->ProdId = intval($res->fields('prod_id'));
    $cClass->ProdMnum = intval($res->fields('prod_mnum'));
    $cClass->ProdStatusId = intval($res->fields('prod_status_id'));
    $cClass->ProdName1 = $res->fields('prod_name1');
    $cClass->ProdName2 = $res->fields('prod_name2');
    $cClass->ProdQnt = floatval($res->fields('prod_qnt'));
    $cClass->ProdPrice = floatval($res->fields('prod_price'));
    $cClass->ProdCprice = floatval($res->fields('prod_cprice'));
    $cClass->ProdDesc1 = $res->fields('prod_desc1');
    $cClass->ProdDesc2 = $res->fields('prod_desc2');
    $cClass->ProdImage = $res->fields('prod_image');
    $cClass->SizeId = intval($res->fields('size_id'));
    $cClass->SizeSnum = intval($res->fields('size_snum'));
    $cClass->SizeAnum = intval($res->fields('size_anum'));
    $cClass->SizeName = $res->fields('size_name');
    $cClass->SizeBox = floatval($res->fields('size_box'));
    $cClass->SizeQnt = floatval($res->fields('size_qnt'));
    $cClass->SizePrice = floatval($res->fields('size_price'));
    $cClass->SizeCprice = floatval($res->fields('size_cprice'));
    $cClass->UnitId = intval($res->fields('unit_id'));
    $cClass->UnitName = $res->fields('unit_name');
    $cClass->UnitRem = $res->fields('unit_rem');
    //
    return $cClass;
  }

  public function save($nUId) {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `ecom_vproduct_sizes` ('
        . '  `brand_status_id`, `brand_name1`, `brand_name2`, `brand_image`, `cat_id`, `cat_status_id`, `cat_order`'
        . ', `cat_name1`, `cat_name2`, `cat_image`, `tag_id`, `tag_status_id`, `tag_name`, `tag_classname`'
        . ', `prod_id`, `prod_mnum`, `prod_status_id`, `prod_name1`, `prod_name2`, `prod_qnt`, `prod_price`'
        . ', `prod_cprice`, `prod_desc1`, `prod_desc2`, `prod_image`, `size_id`, `size_snum`, `size_anum`'
        . ', `size_name`, `size_box`, `size_qnt`, `size_price`, `size_cprice`, `unit_id`, `unit_name`'
        . ', `unit_rem`, `ins_user`'
        . ') VALUES ('
        . '  "' . $this->BrandStatusId . '"'
        . ', "' . $this->BrandName1 . '"'
        . ', "' . $this->BrandName2 . '"'
        . ', "' . $this->BrandImage . '"'
        . ', "' . $this->CatId . '"'
        . ', "' . $this->CatStatusId . '"'
        . ', "' . $this->CatOrder . '"'
        . ', "' . $this->CatName1 . '"'
        . ', "' . $this->CatName2 . '"'
        . ', "' . $this->CatImage . '"'
        . ', "' . $this->TagId . '"'
        . ', "' . $this->TagStatusId . '"'
        . ', "' . $this->TagName . '"'
        . ', "' . $this->TagClassname . '"'
        . ', "' . $this->ProdId . '"'
        . ', "' . $this->ProdMnum . '"'
        . ', "' . $this->ProdStatusId . '"'
        . ', "' . $this->ProdName1 . '"'
        . ', "' . $this->ProdName2 . '"'
        . ', "' . $this->ProdQnt . '"'
        . ', "' . $this->ProdPrice . '"'
        . ', "' . $this->ProdCprice . '"'
        . ', "' . $this->ProdDesc1 . '"'
        . ', "' . $this->ProdDesc2 . '"'
        . ', "' . $this->ProdImage . '"'
        . ', "' . $this->SizeId . '"'
        . ', "' . $this->SizeSnum . '"'
        . ', "' . $this->SizeAnum . '"'
        . ', "' . $this->SizeName . '"'
        . ', "' . $this->SizeBox . '"'
        . ', "' . $this->SizeQnt . '"'
        . ', "' . $this->SizePrice . '"'
        . ', "' . $this->SizeCprice . '"'
        . ', "' . $this->UnitId . '"'
        . ', "' . $this->UnitName . '"'
        . ', "' . $this->UnitRem . '"'
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
      $vSQL = 'UPDATE `ecom_vproduct_sizes` SET'
        . '  `brand_status_id`="' . $this->BrandStatusId . '"'
        . ', `brand_name1`="' . $this->BrandName1 . '"'
        . ', `brand_name2`="' . $this->BrandName2 . '"'
        . ', `brand_image`="' . $this->BrandImage . '"'
        . ', `cat_id`="' . $this->CatId . '"'
        . ', `cat_status_id`="' . $this->CatStatusId . '"'
        . ', `cat_order`="' . $this->CatOrder . '"'
        . ', `cat_name1`="' . $this->CatName1 . '"'
        . ', `cat_name2`="' . $this->CatName2 . '"'
        . ', `cat_image`="' . $this->CatImage . '"'
        . ', `tag_id`="' . $this->TagId . '"'
        . ', `tag_status_id`="' . $this->TagStatusId . '"'
        . ', `tag_name`="' . $this->TagName . '"'
        . ', `tag_classname`="' . $this->TagClassname . '"'
        . ', `prod_id`="' . $this->ProdId . '"'
        . ', `prod_mnum`="' . $this->ProdMnum . '"'
        . ', `prod_status_id`="' . $this->ProdStatusId . '"'
        . ', `prod_name1`="' . $this->ProdName1 . '"'
        . ', `prod_name2`="' . $this->ProdName2 . '"'
        . ', `prod_qnt`="' . $this->ProdQnt . '"'
        . ', `prod_price`="' . $this->ProdPrice . '"'
        . ', `prod_cprice`="' . $this->ProdCprice . '"'
        . ', `prod_desc1`="' . $this->ProdDesc1 . '"'
        . ', `prod_desc2`="' . $this->ProdDesc2 . '"'
        . ', `prod_image`="' . $this->ProdImage . '"'
        . ', `size_id`="' . $this->SizeId . '"'
        . ', `size_snum`="' . $this->SizeSnum . '"'
        . ', `size_anum`="' . $this->SizeAnum . '"'
        . ', `size_name`="' . $this->SizeName . '"'
        . ', `size_box`="' . $this->SizeBox . '"'
        . ', `size_qnt`="' . $this->SizeQnt . '"'
        . ', `size_price`="' . $this->SizePrice . '"'
        . ', `size_cprice`="' . $this->SizeCprice . '"'
        . ', `unit_id`="' . $this->UnitId . '"'
        . ', `unit_name`="' . $this->UnitName . '"'
        . ', `unit_rem`="' . $this->UnitRem . '"'
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
    $vSQL = 'DELETE FROM `ecom_vproduct_sizes` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }

}

