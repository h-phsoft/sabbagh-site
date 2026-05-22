<?php

if (isset($oRest)) {

  try {
    $vGUID = $oRest->getParameter('GUID');
    $aCart = cEcomCart::getArray('guid="' . $vGUID . '"');
    foreach ($aCart as $cart) {
      $cart->delete();
    }
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
