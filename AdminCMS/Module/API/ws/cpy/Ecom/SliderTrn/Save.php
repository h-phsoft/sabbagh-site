<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomSliderTrn::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->SlidId = $oRest->getParameter('nSlidId');
    $oInstance->Order = $oRest->getParameter('nOrder');
    $oInstance->Header = $oRest->getParameter('vHeader');
    $oInstance->Text = $oRest->getParameter('vText');
    $oInstance->Image = $oRest->getParameter('vImage');
    $oInstance->Link = $oRest->getParameter('vLink');
    $oInstance->Label = $oRest->getParameter('vLabel');
    try {
      $nSavedId = $oInstance->save($oUser->Id);
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
      $oRest->addRowDataValue('Id', $nSavedId);
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
