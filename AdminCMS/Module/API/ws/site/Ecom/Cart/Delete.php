<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  $nRId = intval($oRest->getParameter('nRId'));
  if ($nRId == 0) {
    $oInstance = cEcomCart::getInstance($nId);
  } else {
    $oInstance = cEcomCartItem::getInstance($nId);
  }
  try {
    $oInstance->delete();
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
