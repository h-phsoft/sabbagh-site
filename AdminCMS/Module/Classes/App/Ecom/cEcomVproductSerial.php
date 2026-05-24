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
 * @update 2024/07/11 19:03
 *
 */

class cEcomVproductSerial {

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
  var $CatWdays = 365;
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
  var $SerialId = 0;
  var $SerialSnum;
  var $SizeQnt = 1.00;
  var $SizeCqnt = 1.00;

  //

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `brand_id`, `brand_status_id`, `brand_name1`, `brand_name2`, `brand_image`, `cat_id`, `cat_status_id`'
      . ', `cat_order`, `cat_name1`, `cat_name2`, `cat_image`, `cat_wdays`, `tag_id`, `tag_status_id`'
      . ', `tag_name`, `tag_classname`, `prod_id`, `prod_mnum`, `prod_status_id`, `prod_name1`, `prod_name2`'
      . ', `prod_qnt`, `prod_price`, `prod_cprice`, `prod_desc1`, `prod_desc2`, `prod_image`, `serial_id`'
      . ', `serial_snum`, `size_qnt`, `size_cqnt`'
      . ' FROM `ecom_vproduct_serial`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `ecom_vproduct_serial`';
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
      $vOrder = '`serial_snum`';
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
    $cClass = new cEcomVproductSerial();
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
    $cClass = new cEcomVproductSerial();
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
    $cClass->CatWdays = intval($res->fields('cat_wdays'));
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
    $cClass->SerialId = intval($res->fields('serial_id'));
    $cClass->SerialSnum = $res->fields('serial_snum');
    $cClass->SizeQnt = floatval($res->fields('size_qnt'));
    $cClass->SizeCqnt = floatval($res->fields('size_cqnt'));
    //
    return $cClass;
  }

  public function save($nUId) {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `ecom_vproduct_serial` ('
        . '  `brand_status_id`, `brand_name1`, `brand_name2`, `brand_image`, `cat_id`, `cat_status_id`, `cat_order`'
        . ', `cat_name1`, `cat_name2`, `cat_image`, `cat_wdays`, `tag_id`, `tag_status_id`, `tag_name`'
        . ', `tag_classname`, `prod_id`, `prod_mnum`, `prod_status_id`, `prod_name1`, `prod_name2`, `prod_qnt`'
        . ', `prod_price`, `prod_cprice`, `prod_desc1`, `prod_desc2`, `prod_image`, `serial_id`, `serial_snum`'
        . ', `size_qnt`, `size_cqnt`, `ins_user`'
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
        . ', "' . $this->CatWdays . '"'
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
        . ', "' . $this->SerialId . '"'
        . ', "' . $this->SerialSnum . '"'
        . ', "' . $this->SizeQnt . '"'
        . ', "' . $this->SizeCqnt . '"'
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
      $vSQL = 'UPDATE `ecom_vproduct_serial` SET'
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
        . ', `cat_wdays`="' . $this->CatWdays . '"'
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
        . ', `serial_id`="' . $this->SerialId . '"'
        . ', `serial_snum`="' . $this->SerialSnum . '"'
        . ', `size_qnt`="' . $this->SizeQnt . '"'
        . ', `size_cqnt`="' . $this->SizeCqnt . '"'
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
    $vSQL = 'DELETE FROM `ecom_vproduct_serial` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
