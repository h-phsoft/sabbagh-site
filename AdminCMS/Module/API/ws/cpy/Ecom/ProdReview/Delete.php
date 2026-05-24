<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Delete) {

    $oInstance = cEcomProdReview::getInstance($oRest->getParameter('nId'));
    try {
      $oInstance->delete();
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
