<?php

if (isset($oRest)) {

  $oProd = (object) $oRest->getParameter('oProd');
  $oCartInstance = new cEcomCart();
  $oCartInstance->ProdId = $oProd->nId;
  $oCartInstance->GUID = $oUser->GUID;
  $oCartInstance->Qnt = $oProd->nQty;
  $oCartInstance->OPrice = $oProd->nOPrice;
  $oCartInstance->CPrice = $oProd->nCPrice;
  $oCartInstance->Amt = $oProd->nQty * $oProd->nCPrice;
  $oCartInstance->Cost = $oProd->nQty * $oProd->nCost;
  $oCartInstance->Disc = 0;
  $oCartInstance->Net = $oProd->nQty * $oProd->nCPrice;
  $oCartInstance->Rem = $oProd->vComments;
  try {
    $nSavedId = $oCartInstance->save($oUser->Id);
    if (isset($oProd->aComps) && is_array($oProd->aComps)) {
      foreach ($oProd->aComps as $oComp) {
        $aProds = is_array($oComp) ? $oComp['aProds'] : $oComp->aProds;
        foreach ($aProds as $oIIProd) {
          $oIProd = (object) $oIIProd;
          if (floatval($oIProd->nQty) > 0) {
            $oCartItemInstance = new cEcomCartItem();
            $oCartItemInstance->CartId = $nSavedId;
            $oCartItemInstance->ProdId = $oIProd->nId;
            $oCartItemInstance->Qnt = $oIProd->nQty;
            $oCartItemInstance->OPrice = $oIProd->nOPrice;
            $oCartItemInstance->CPrice = $oIProd->nCPrice;
            $oCartItemInstance->Amt = $oIProd->nQty * $oIProd->nCPrice;
            $oCartItemInstance->Cost = $oIProd->nQty * $oIProd->nCost;
            $oCartItemInstance->Disc = 0;
            $oCartItemInstance->Net = $oIProd->nQty * $oIProd->nCPrice;
            $oCartItemInstance->save($oUser->Id);
          }
        }
      }
    }
    $nCarTCount = ph_GetDBValue('count(*)', 'ecom_cart', '`guid`="' . $oUser->GUID . '"');
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $nCarTCount
    ));
  } catch (Exception $exc) {
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => false,
      cPhsRest::RESPONSE_KEY_MESSAGE => $exc->getMessage()
    ));
  }
}
