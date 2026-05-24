<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $element = cCpyBranch::getInstance($oRest->getParameter('nId'));
    $aData = array(
      'nId' => $element->Id,
      'vName' => $element->Name,
      'vAddress' => $element->Address,
      'vPhone' => $element->Phone,
    );
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'Data' => $aData
    ));
  }
}