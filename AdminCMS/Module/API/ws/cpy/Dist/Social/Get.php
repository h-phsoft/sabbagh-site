<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = intval($oRest->getParameter('nId'));
    $element = cDistSocial::getInstance($oRest->getParameter('nId'));
    $aData[$nIdx] = array(
      'nId' => $element->Id,
      'vName' => $element->Name,
      'vIcon' => $element->Icon,
      'vLink' => $element->Link,
    );
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('lbl.cms.Done'),
      'Data' => $aData
    ));
  }}
