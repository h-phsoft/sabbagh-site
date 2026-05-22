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

class cDistTeam {

  var $Id;
  var $Image;
  var $Name;
  var $Work;
  var $Facebook;
  var $Twitter;
  var $Instagram;
  var $Linkedin;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `image`, `name`, `work`, `facebook`, `twitter`, `instagram`'
      . ', `linkedin`'
      . ' FROM `dist_team`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `dist_team`';
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
    $cClass = new cDistTeam();
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
    $cClass = new cDistTeam();
    $cClass->Id = intval($res->fields('id'));
    $cClass->Image = $res->fields('image');
    $cClass->Name = $res->fields('name');
    $cClass->Work = $res->fields('work');
    $cClass->Facebook = $res->fields('facebook');
    $cClass->Twitter = $res->fields('twitter');
    $cClass->Instagram = $res->fields('instagram');
    $cClass->Linkedin = $res->fields('linkedin');
    //
    return $cClass;
  }

  public function save($nUId) {
    $nId = 0;
    if ($this->Id == 0 || $this->Id == -999) {
      $vSQL = 'INSERT INTO `dist_team` ('
        . '  `image`, `name`, `work`, `facebook`, `twitter`, `instagram`, `linkedin`, `ins_user`'
        . ') VALUES ('
        . '  "' . $this->Image . '"'
        . ', "' . $this->Name . '"'
        . ', "' . $this->Work . '"'
        . ', "' . $this->Facebook . '"'
        . ', "' . $this->Twitter . '"'
        . ', "' . $this->Instagram . '"'
        . ', "' . $this->Linkedin . '"'
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
      $vSQL = 'UPDATE `dist_team` SET'
        . '  `image`="' . $this->Image . '"'
        . ', `name`="' . $this->Name . '"'
        . ', `work`="' . $this->Work . '"'
        . ', `facebook`="' . $this->Facebook . '"'
        . ', `twitter`="' . $this->Twitter . '"'
        . ', `instagram`="' . $this->Instagram . '"'
        . ', `linkedin`="' . $this->Linkedin . '"'
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
    $vSQL = 'DELETE FROM `dist_team` WHERE `id`="' . $this->Id . '"';
    $res = ph_Execute($vSQL);
    if ($res || $res === 0) {

    } else {
      $aMsg = ph_GetMySQLMessageAsArray();
      $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
      throw new Exception($vMsgs);
    }
  }
}
