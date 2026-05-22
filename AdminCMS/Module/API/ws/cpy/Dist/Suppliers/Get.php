<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = intval($oRest->getParameter('nId'));
    $element = cDistSuppliers::getInstance($oRest->getParameter('nId'));
    $aData[$nIdx] = array(
      'nId' => $element->Id,
      'nGroupId' => $element->GroupId,
      'nCountryId' => $element->CountryId,
      'vName' => $element->Name,
      'vImage' => $element->Image,
      'vParagraph' => $element->Paragraph,
      'vCountryName' => $element->CountryName,
      'vGroupName' => $element->GroupName,
    );
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('lbl.cms.Done'),
      'Data' => $aData
    ));
  }
}
