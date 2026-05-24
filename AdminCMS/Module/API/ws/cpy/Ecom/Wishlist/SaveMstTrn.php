<?php

if (isset($oRest)) {

  $nId = ph_Get_Post('nId');
  if (($nId == 0 && $oUser->oGrp->getPermission(ph_Get_Post('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission(ph_Get_Post('progId'))->Update)) {

    $oInstance = cEcomWishlist::getInstance($nId);
    $oInstance->Id = ph_Get_Post('nId');
    $oInstance->Token = ph_Get_Post('vToken');
    $oInstance->Addat = ph_Get_Post('dAddat');
    $oInstance->StatusId = ph_Get_Post('nStatusId');
    $oInstance->ProdId = ph_Get_Post('nProdId');
    try {
      $oRest->setMessage(getLabel('Master Not Saved'));
      $nSavedId = $oInstance->save($oUser->Id);
      $oRest->addRowDataValue('Id', $nSavedId);
      if ($nSavedId > 0) {
        $aRows = ph_Get_Post('aRows');
        $oRest->setMessage(getLabel('No Details'));
        if (is_array($aRows) && count($aRows) > 0) {
          for ($ii = 0; $ii < count($aRows); $ii++) {
            $row = $aRows[$ii];
            $oTInstance = cEcomWishlist::getInstance(intval($row['fields']['nId']['value']));
            $oTInstance->MstId = $nSavedId;
            if ($row['isDeleted'] === true || $row['isDeleted'] === 'true') {
              $oTInstance->delete();
            } else {
              $oTInstance->Id = intval($row['fields']['nId']['value']);
              $oTInstance->Token = $row['fields']['vToken']['value'];
              $oTInstance->Addat = $row['fields']['dAddat']['value'];
              $oTInstance->StatusId = intval($row['fields']['nStatusId']['value']);
              $oTInstance->ProdId = intval($row['fields']['nProdId']['value']);
              $oTInstance->save($oUser->Id);
            }
          }
        }
        ph_CommitTransaction();
        $oRest->setStatus(true);
        $oRest->setMessage(getLabel('Done'));
      }
    } catch (Exception $exc) {
      ph_RollbackTransaction();
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
