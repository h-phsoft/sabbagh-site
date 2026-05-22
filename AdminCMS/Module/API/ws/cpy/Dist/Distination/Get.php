<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = intval($oRest->getParameter('nId'));
    $element = cDistDistination::getInstance($oRest->getParameter('nId'));
    $aData[$nIdx] = array(
      'nId' => $element->Id,
      'nCountryId' => $element->CountryId,
      'vName' => $element->Name,
      'vImage' => $element->Image,
      'vCountryName' => $element->oCountry->Name,
    );
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('lbl.cms.Done'),
      'Data' => $aData
    ));
  }}
