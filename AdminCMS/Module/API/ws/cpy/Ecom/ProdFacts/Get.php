<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $instance = cEcomProdFacts::getInstance($oRest->getParameter('nId'));
    $aData = array(
      'nId' => $instance->Id,
      'nOrd' => $instance->Ord,
      'nProdId' => $instance->ProdId,
      'vProdName' => $instance->ProdName,
      'vName1' => $instance->Name1,
      'vName2' => $instance->Name2,
      'vVal1' => $instance->Val2,
      'vVal2' => $instance->Val1
    );
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Done',
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}
