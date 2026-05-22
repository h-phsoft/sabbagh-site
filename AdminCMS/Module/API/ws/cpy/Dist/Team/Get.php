<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = intval($oRest->getParameter('nId'));
    $element = cDistTeam::getInstance($oRest->getParameter('nId'));
    $aData[$nIdx] = array(
      'nId' => $element->Id,
      'vImage' => $element->Image,
      'vName' => $element->Name,
      'vWork' => $element->Work,
      'vFacebook' => $element->Facebook,
      'vTwitter' => $element->Twitter,
      'vInstagram' => $element->Instagram,
      'vLinkedin' => $element->Linkedin,
    );
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('lbl.cms.Done'),
      'Data' => $aData
    ));
  }
}
