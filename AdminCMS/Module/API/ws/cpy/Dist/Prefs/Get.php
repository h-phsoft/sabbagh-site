<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = intval($oRest->getParameter('nId'));
    $element = cDistPrefs::getInstance($oRest->getParameter('nId'));
    $aData[$nIdx] = array(
      'nId' => $element->Id,
      'vName' => $element->Name,
      'vVal' => $element->Val,
    );
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('lbl.cms.Done'),
      'Data' => $aData
    ));
  }}
