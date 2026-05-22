<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update) {

    $nId = $oRest->getParameter('nId');
    $aPerms = $oRest->getParameter('permissions');
    foreach ($aPerms as $perms) {
      $vSQL = 'UPDATE `cpy_perm` SET'
        . ' `isOK`="' . $perms['Isok'] . '"'
        . ',`ins`="' . $perms['Ins'] . '"'
        . ',`upd`="' . $perms['Upd'] . '"'
        . ',`del`="' . $perms['Del'] . '"'
        . ',`qry`="' . $perms['Qry'] . '"'
        . ',`prt`="' . $perms['Prt'] . '"'
        . ',`cmt`="' . $perms['Cmt'] . '"'
        . ',`rvk`="' . $perms['Rvk'] . '"'
        . ',`exp`="' . $perms['Exp'] . '"'
        . ',`imp`="' . $perms['Imp'] . '"'
        . ',`spc`="' . $perms['Spc'] . '"'
        . ' WHERE (`id`="' . $perms['Id'] . '")';
      $res = ph_ExecuteUpdate($vSQL);
      if ($res || $res === 0) {
        $oRest->setMessage('Done');
      } else {
        $aMsg = ph_GetMySQLMessageAsArray();
        $vMsgs = $aMsg['ErrCod'] . ': ' . $aMsg['ErrMsg'];
        $oRest->setMessage($vMsgs);
      }
    }
  }
}
