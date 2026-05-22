<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $element = cPhsLang::getInstance($oRest->getParameter('nId'));
    $aData = array(
      'nId' => $element->Id,
      'vName' => $element->Name,
      'vCode' => $element->Code,
      'vDir' => $element->Dir,
      'vRem' => $element->Rem,
    );
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('lbl.cms.Done'),
      'Data' => $aData
    ));
  }
}