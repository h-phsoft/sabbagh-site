<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Import) {

    $aData = $oRest->getParameter('aData');
    if (isset($aData) && is_array($aData)) {
      $nOk = 0;
      $nErr = 0;
      for ($index = 0; $index < count($aData); $index++) {
        $row = $aData[$index];
        if (isset($row['productName'])) {
          $nProdId = intval(ph_GetDBValue("id", "ecom_product", "name1='" . $row['productName'] . "'"));
          if (isset($nProdId) && $nProdId > 0) {
            $oInstance = new cEcomProdSerial();
            $oInstance->Id = 0;
            $oInstance->ProdId = $nProdId;
            $oInstance->Snum = $row['serial'];
            try {
              $nSavedId = $oInstance->save($oUser->Id);
              $nOk++;
            } catch (Exception $exc) {
              $nErr++;
            }
          }
        }
      }
      try {
        if ($nOk > 0) {
          ph_CommitTransaction();
          $oRest->setStatus(true);
          $oRest->setMessage(getLabel('Done'));
          $oRest->addRowDataValue('OK', $nOk);
          $oRest->addRowDataValue('Error', $nErr);
        }
      } catch (Exception $exc) {
        ph_RollbackTransaction();
        $oRest->setStatus(false);
        $oRest->setMessage($exc->getMessage());
      }
    }
  }
}
