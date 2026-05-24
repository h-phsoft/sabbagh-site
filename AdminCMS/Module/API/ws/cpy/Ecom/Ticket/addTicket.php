<?php

if (isset($oRest)) {

  $oInstance = new cEcomTicket();
  $oInstance->Id = 0;
  $oInstance->SaleId = $oRest->getParameter('nSaleId');
  $oInstance->Describ = $oRest->getParameter('vTicket');
  try {
    $nSavedId = $oInstance->save();
    $oRest->setStatus(true);
    $oRest->setMessage('Done');
    $oRest->addRowDataValue('Id', $nSavedId);
  } catch (Exception $exc) {
    $oRest->setStatus(false);
    $oRest->setMessage($exc->getMessage());
  }
}
