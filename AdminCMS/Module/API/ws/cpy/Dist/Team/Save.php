<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getParameter('progId'))->Update)) {

    $oInstance = cDistTeam::getInstance($nId);
    $oInstance->Id = $oRest->getParameter('nId');
    $oInstance->Image = $oRest->getParameter('vImage');
    $oInstance->Name = $oRest->getParameter('vName');
    $oInstance->Work = $oRest->getParameter('vWork');
    $oInstance->Facebook = $oRest->getParameter('vFacebook');
    $oInstance->Twitter = $oRest->getParameter('vTwitter');
    $oInstance->Instagram = $oRest->getParameter('vInstagram');
    $oInstance->Linkedin = $oRest->getParameter('vLinkedin');
    if ($oRest->getParameter('vFile')) {
      if ($oRest->getParameter('nId') > 0 && $oInstance->Image) {
        try {
          if (file_exists($vAttacheRootPath . 'Team/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . 'Team/' . $oInstance->Image);
          }
        } catch (Exception $exc) {

        }
      }
      $vOrigionName = $oRest->getParameter('vFName');
      $vFName = substr($vOrigionName, 0, strrpos($vOrigionName, '.'));
      $oInstance->Image = base64_to_file($oRest->getParameter('vFile'), 'Team_' . $vFName, $oRest->getParameter('vFExt'), $vAttacheRootPath . 'Team');
    }
    try {
      $nSavedId = $oInstance->save($oUser->Id);
      $oRest->setStatus(true);
      $oRest->setMessage(getLabel('lbl.cms.Done'));
      $oRest->addRowDataValue('Id', $nSavedId);
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
