<?php

if (isset($oRest)) {

  $nId = ph_Get_Post('nId');
  if (($nId == 0 && $oUser->oGrp->getPermission(ph_Get_Post('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission(ph_Get_Post('progId'))->Update)) {

    $oInstance = cEcomUnit::getInstance($nId);
    $oInstance->Id = ph_Get_Post('nId');
    $oInstance->Name = ph_Get_Post('vName');
    $oInstance->Rem = ph_Get_Post('vRem');
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
            $oTInstance = cEcomUnit::getInstance(intval($row['nId']));
            $oTInstance->MstId = $nSavedId;
            if ($row['isDeleted'] === true || $row['isDeleted'] === 'true') {
              $oTInstance->delete();
            } else {
              $oTInstance->Id = intval($row['nId']);
              $oTInstance->Name = $row['vName'];
              $oTInstance->Rem = $row['vRem'];
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
