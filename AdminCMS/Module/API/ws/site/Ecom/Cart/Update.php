<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  $nRId = intval($oRest->getParameter('nRId'));
  $nQnt = floatVal($oRest->getParameter('nQnt'));
  if ($nRId == 0) {
    $oInstance = cEcomCart::getInstance($nId);
  } else {
    $oInstance = cEcomCartItem::getInstance($nId);
  }
  $nUCost = 0;
  if ($oInstance->Qnt > 0) {
    $nUCost = $oInstance->Cost / $oInstance->Qnt;
  }
  $oInstance->Qnt = $nQnt;
  $oInstance->Amt = $oInstance->Qnt * $oInstance->CPrice;
  $oInstance->Cost = $oInstance->Qnt * $nUCost;
  $oInstance->Net = $oInstance->Qnt * $oInstance->CPrice;
  try {
    $nSavedId = $oInstance->save($oUser->Id);
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done'
    ));
  } catch (Exception $exc) {
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => false,
      cPhsRest::RESPONSE_KEY_MESSAGE => $exc->getMessage()
    ));
  }
}
