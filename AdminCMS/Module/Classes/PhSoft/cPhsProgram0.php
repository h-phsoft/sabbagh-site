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

class cPhsProgram0 {

  var $Id;
  var $ProgId;
  var $SysId = 0;
  var $GrpId = 127;
  var $StatusId = 1;
  var $TypeId = 0;
  var $Open = 0;
  var $Ord = 0;
  var $Name;
  var $Icon;
  var $File;
  var $Css;
  var $Js;
  var $Attributes;
  var $Params;
  //
  var $oProg;
  var $oStatus;
  var $oSys;
  var $oType;

  public static function getSelectStatement($vWhere = '', $vOrder = '', $vLimit = '') {
    $sSQL = 'SELECT `id`, `prog_id`, `sys_id`, `grp_id`, `status_id`, `type_id`, `open`'
      . ', `ord`, `name`, `icon`, `file`, `css`, `js`, `attributes`'
      . ', `params`'
      . ' FROM `phs_program`';
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
    $sSQL = 'SELECT count(*) nCnt FROM `phs_program`';
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
    $cClass = new cPhsProgram();
    $res = ph_Execute(self::getSelectStatement('(`id`="' . $nId . '")'));
    if ($res != '') {
      if (!$res->EOF) {
        $cClass = self::getFields($res);
      }
      $res->Close();
    }
    return $cClass;
  }

  public static function getInstanceByFile($vFile) {
    $cClass = new cPhsProgram();
    if ($vFile != '' && $vFile != null) {
      $res = ph_Execute(cPhsProgram::getSelectStatement('(`file`="' . $vFile . '")'));
      if ($res != '') {
        if (!$res->EOF) {
          $cClass = cPhsProgram::getFields($res);
        }
        $res->Close();
      }
    }
    return $cClass;
  }

  public static function getUserGroupMenu($nGrp, $nParent = 1) {
    $aArray = array();
    $vWhere = '(`prog_id`="' . $nParent . '"';
    if ($nGrp > 0) {
      $vWhere .= ' AND `id` IN (SELECT `prog_id` FROM `cpy_perm` AS `pr` WHERE `pr`.`type_id`="' . $nGrp . '" AND `isok`=1)';
    }
    $vWhere .= ')';
    $res = ph_Execute(cPhsProgram::getSelectStatement($vWhere, '`ord`'));
    if ($res != '') {
      $nIdx = 0;
      while (!$res->EOF) {
        $cClass = new cPhsProgram();
        $cClass->Id = intval($res->fields("id"));
        $cClass->PId = intval($res->fields("prog_id"));
        $cClass->nGrp = intval($res->fields("grp_id"));
        $cClass->nType = intval($res->fields("type_id"));
        $cClass->vType = $res->fields("type_name");
        $cClass->Name = $res->fields("name");
        $cClass->Open = intval($res->fields("open"));
        $cClass->Order = intval($res->fields("ord"));
        $cClass->Icon = $res->fields("icon");
        $cClass->File = $res->fields("file");
        $cClass->CSS = $res->fields("css");
        $cClass->JS = $res->fields("js");
        $cClass->Attributes = $res->fields("attributes");
        $cClass->aSub = cPhsProgram::getUserGroupMenu($nGrp, $cClass->Id);
        $aArray[$nIdx] = $cClass;
        $nIdx++;
        $res->MoveNext();
      }
      $res->Close();
    }
    return $aArray;
  }

  public static function getFields($res) {
    $cClass = new cPhsProgram();
    $cClass->Id = intval($res->fields('id'));
    $cClass->ProgId = intval($res->fields('prog_id'));
    $cClass->SysId = intval($res->fields('sys_id'));
    $cClass->GrpId = intval($res->fields('grp_id'));
    $cClass->StatusId = intval($res->fields('status_id'));
    $cClass->TypeId = intval($res->fields('type_id'));
    $cClass->Open = intval($res->fields('open'));
    $cClass->Ord = intval($res->fields('ord'));
    $cClass->Name = $res->fields('name');
    $cClass->Icon = $res->fields('icon');
    $cClass->File = $res->fields('file');
    $cClass->Css = $res->fields('css');
    $cClass->Js = $res->fields('js');
    $cClass->Attributes = $res->fields('attributes');
    $cClass->Params = $res->fields('params');
    //
    $cClass->oProg = cPhsProgram::getInstance($cClass->ProgId);
    $cClass->oStatus = cPhsCode::getInstance(cPhsCode::STATUS, $cClass->StatusId);
    $cClass->oSys = cPhsSystem::getInstance($cClass->SysId);
    $cClass->oType = cPhsProgramType::getInstance($cClass->TypeId);
    return $cClass;
  }

  public static function getTopButtons($vCopyURL, $aMenu) {
    $vHtmlMenu = '';
    if (count($aMenu) > 0) {
      foreach ($aMenu as $menu) {
        $vHtmlMenu .= '<div class="topbar-item">';
        $vHtmlMenu .= '  <div id="' . $menu->Id . '" class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-4" data-toggle="tooltip" title="' . getLabel($menu->Name) . '">';
        $vHtmlMenu .= '    <span class="text-dark-50 font-weight-bolder font-size-base topbar-item-link" data-id="' . $menu->Id . '" data-file="' . $vCopyURL . '/' . $menu->File . '" ' . $menu->Attributes . '>';
        $vHtmlMenu .= '      <i class="icon-lg ' . $menu->Icon . '"></i>';
        $vHtmlMenu .= '    </span>';
        $vHtmlMenu .= '  </div>';
        $vHtmlMenu .= '</div>';
      }
    }
    return $vHtmlMenu;
  }

  public static function getUserMenu($vCopyURL, $aMenu) {
    $vHtmlMenu = '';
    if (count($aMenu) > 0) {
      foreach ($aMenu as $menu) {
        if (count($menu->aSub) <= 0) {
          if ($menu->nType === 4) {
            $vHtmlMenu .= '<div class="topbar-item">';
            $vHtmlMenu .= '  <div id="' . $menu->Id . '" class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-4" data-toggle="tooltip" title="' . getLabel($menu->Name) . '">';
            $vHtmlMenu .= '    <span class="text-dark-50 font-weight-bolder font-size-base topbar-item-link" data-id="' . $menu->Id . '" data-file="' . $vCopyURL . '/' . $menu->File . '" ' . $menu->Attributes . '>';
            $vHtmlMenu .= '      <i class="icon-lg ' . $menu->Icon . '"></i>';
            $vHtmlMenu .= '    </span>';
            $vHtmlMenu .= '  </div>';
            $vHtmlMenu .= '</div>';
          } else if ($menu->nType === 5) {
            $vHtmlMenu .= '<li class="navi-item">';
            $vHtmlMenu .= '  <a href="javascipt:;" class="navi-link">';
            $vHtmlMenu .= '    <i class="icon-lg ' . $menu->Icon . '"></i>';
            $vHtmlMenu .= '    <span class="menu-text" ' . $menu->Attributes . '>&nbsp;&nbsp;&nbsp;' . getLabel($menu->Name) . '</span>';
            $vHtmlMenu .= '  </a>';
            $vHtmlMenu .= '</li>';
          } else {
            $vHtmlMenu .= '<li class="navi-item">';
            $vHtmlMenu .= '  <a href="' . $vCopyURL . '/' . $menu->File . '" class="navi-link">';
            $vHtmlMenu .= '    <i class="icon-lg ' . $menu->Icon . '"></i>';
            $vHtmlMenu .= '    <span class="menu-text">&nbsp;&nbsp;&nbsp;' . getLabel($menu->Name) . '</span>';
            $vHtmlMenu .= '  </a>';
            $vHtmlMenu .= '</li>';
          }
        } else if (count($menu->aSub) > 0) {
          $vHtmlMenu .= '<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">';
          $vHtmlMenu .= '  <a href="javascript:;" class="menu-link menu-toggle">';
          $vHtmlMenu .= '    <span class="menu-text">' . getLabel($menu->Name) . '</span>';
          $vHtmlMenu .= '    <span class="menu-desc"></span>';
          $vHtmlMenu .= '    <i class="menu-arrow"></i>';
          $vHtmlMenu .= '  </a>';
          $vHtmlMenu .= '  <div class="menu-submenu menu-submenu-classic menu-submenu-left py-0">';
          $vHtmlMenu .= '    <ul class="menu-subnav">';
          $vHtmlMenu .= '      ' . cPhsProgram::getUserMenu($vCopyURL, $menu->aSub);
          $vHtmlMenu .= '    </ul>';
          $vHtmlMenu .= '  </div>';
          $vHtmlMenu .= '</li>';
        }
      }
    }
    return $vHtmlMenu;
  }

  public static function getTopMenu($vCopyURL, $aMenu) {
    $vHtmlMenu = '';
    if (count($aMenu) > 0) {
      foreach ($aMenu as $menu) {
        if (count($menu->aSub) <= 0) {
          if ($menu->nType === 4) {
            $vHtmlMenu .= '<div class="topbar-item">';
            $vHtmlMenu .= '  <div id="' . $menu->Id . '" class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-4" data-toggle="tooltip" title="' . getLabel($menu->Name) . '">';
            $vHtmlMenu .= '    <span class="text-dark-50 font-weight-bolder font-size-base topbar-item-link" data-id="' . $menu->Id . '" data-file="' . $vCopyURL . '/' . $menu->File . '" ' . $menu->Attributes . '>';
            $vHtmlMenu .= '      <i class="icon-lg ' . $menu->Icon . '"></i>';
            $vHtmlMenu .= '    </span>';
            $vHtmlMenu .= '  </div>';
            $vHtmlMenu .= '</div>';
          } else {
            $vHtmlMenu .= '<li class="menu-item" aria-haspopup="true">';
            $vHtmlMenu .= '  <a href="' . $vCopyURL . '/' . $menu->File . '" class="menu-link">';
            $vHtmlMenu .= '    <span class="menu-text">' . getLabel($menu->Name) . '</span>';
            $vHtmlMenu .= '  </a>';
            $vHtmlMenu .= '</li>';
          }
        } else if (count($menu->aSub) > 0) {
          $vHtmlMenu .= '<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">';
          $vHtmlMenu .= '  <a href="javascript:;" class="menu-link menu-toggle">';
          $vHtmlMenu .= '    <span class="menu-text">' . getLabel($menu->Name) . '</span>';
          $vHtmlMenu .= '    <span class="menu-desc"></span>';
          $vHtmlMenu .= '    <i class="menu-arrow"></i>';
          $vHtmlMenu .= '  </a>';
          $vHtmlMenu .= '  <div class="menu-submenu menu-submenu-classic menu-submenu-left py-0">';
          $vHtmlMenu .= '    <ul class="menu-subnav">';
          $vHtmlMenu .= '      ' . cPhsProgram::getTopMenu($vCopyURL, $menu->aSub);
          $vHtmlMenu .= '    </ul>';
          $vHtmlMenu .= '  </div>';
          $vHtmlMenu .= '</li>';
        }
      }
    }
    return $vHtmlMenu;
  }

  public static function getASideMenu($aMenu, $oUser, $vReqId) {
    $vHtmlMenu = '';
    if (count($aMenu) > 0) {
      foreach ($aMenu as $menu) {
        if (count($menu->aSub) <= 0) {
          $activ = '';
          /*
            if ($menu->File == $requestPage) {
            $activ = 'menu-item-active';
            }
           */
          $vHtmlMenu .= '<li class="nav-item ' . $activ . '">';
          $vHtmlMenu .= '  <a class="nav-link" href="' . $menu->File . '">';
          $vHtmlMenu .= '    <i class="' . $menu->Icon . '"></i>';
          $vHtmlMenu .= '    <span>' . getLabel($menu->Name) . '</span>';
          $vHtmlMenu .= '  </a>';
          $vHtmlMenu .= '</li>';
        } else if (count($menu->aSub) > 0) {
          $vParent = '';
          if (substr($vReqId, 0, strlen($menu->Id)) == strval($menu->Id)) {
            $vParent = 'menu-item-open menu-item-here';
          }
          $vHtmlMenu .= '<li class="nav-item">';
          $vHtmlMenu .= '  <a class="nav-link d-flex align-items-center justify-content-between collapsed ' . $vParent . '" data-bs-target="#PhsProg-' . $menu->Id . '" data-bs-toggle="collapse" href="#">';
          $vHtmlMenu .= '    <span>';
          $vHtmlMenu .= '      <i class="' . $menu->Icon . '"></i>';
          $vHtmlMenu .= '      <span>' . getLabel($menu->Name) . '</span>';
          $vHtmlMenu .= '    </span>';
          $vHtmlMenu .= '    <i class="bi bi-chevron-down"></i>';
          $vHtmlMenu .= '  </a>';
          $vHtmlMenu .= '  <ul id="PhsProg-' . $menu->Id . '" class="nav-content collapse ">';
          $vHtmlMenu .= '    ' . cPhsProgram::getASideMenu($menu->aSub, $oUser, $vReqId);
          $vHtmlMenu .= '  </ul>';
          $vHtmlMenu .= '</li>';
        }
      }
    }
    return $vHtmlMenu;
  }
}
