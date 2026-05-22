<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = intval($oRest->getParameter('nId'));
    $element = cDistVtags::getInstance($oRest->getParameter('nId'));
    $aData[$nIdx] = array(
      'nTagId' => $element->TagId,
      'vTagName' => $element->TagName,
      'nColorId' => $element->ColorId,
      'vColorName' => $element->ColorName,
    );
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('lbl.cms.Done'),
      'Data' => $aData
    ));
  }}
