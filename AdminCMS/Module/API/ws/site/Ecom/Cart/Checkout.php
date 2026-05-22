<?php

if (isset($oRest)) {

  $vGUID = $oRest->getParameter('GUID');
  $aCart = cEcomCart::getArray('guid="' . $vGUID . '"');
  try {
    $oOInstance = new cEcomOrder();
    $oOInstance->GUID = $vGUID;
    $oOInstance->Mobile = rand(9876543210, 9999999999);
    $oOInstance->CurnId = 1;
    $nSavedId = $oOInstance->save($oUser->Id);
    foreach ($aCart as $oCart) {
      $oOIInstance = new cEcomOrderItem();
      $oOIInstance->OrderId = $nSavedId;
      $oOIInstance->CompId = 2;
      $oOIInstance->CartPId = $oCart->Id;
      $oOIInstance->ProdId = $oCart->ProdId;
      $oOIInstance->Qnt = $oCart->Qnt;
      $oOIInstance->OPrice = $oCart->OPrice;
      $oOIInstance->CPrice = $oCart->CPrice;
      $oOIInstance->Amt = $oCart->Amt;
      $oOIInstance->Cost = $oCart->Cost;
      $oOIInstance->Disc = $oCart->Disc;
      $oOIInstance->Net = $oCart->Net;
      $oOIInstance->Rem = $oCart->Rem;
      $oOIInstance->save($oUser->Id);
      foreach ($oCart->aCartItems as $oCartItem) {
        $oOIInstance = new cEcomOrderItem();
        $oOIInstance->OrderId = $nSavedId;
        $oOIInstance->CompId = 1;
        $oOIInstance->CartPId = $oCart->Id;
        //$oOIInstance->CartIId = intval($oCartItem->Id);
        $oOIInstance->ProdId = $oCartItem->ProdId;
        $oOIInstance->Qnt = $oCartItem->Qnt;
        $oOIInstance->OPrice = $oCartItem->OPrice;
        $oOIInstance->CPrice = $oCartItem->CPrice;
        $oOIInstance->Amt = $oCartItem->Amt;
        $oOIInstance->Cost = $oCartItem->Cost;
        $oOIInstance->Disc = $oCartItem->Disc;
        $oOIInstance->Net = $oCartItem->Net;
        $oOIInstance->Rem = $oCartItem->Rem;
        $oOIInstance->save($oUser->Id);
      }
      $oCart->delete();
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
