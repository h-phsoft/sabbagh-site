<?php

if (isset($oRest)) {

  $nId = intval($oRest->getParameter('nId'));
  if (($nId == 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Insert) ||
    ($nId > 0 && $oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Update)) {

    $oInstance = cEcomProduct::getInstance($nId);
    $oInstance->Id = $nId;
    $oInstance->Mnum = intval($oRest->getParameter('nMnum'));
    $oInstance->BrandId = $oRest->getParameter('nBrandId');
    $oInstance->StatusId = $oRest->getParameter('nStatusId');
    $oInstance->CatId = $oRest->getParameter('nCatId');
    $oInstance->TagId = $oRest->getParameter('nTagId');
    $oInstance->Name1 = $oRest->getParameter('vName1');
    $oInstance->Name2 = $oRest->getParameter('vName2');
    $oInstance->Qnt = floatval($oRest->getParameter('nQnt'));
    $oInstance->Price = floatval($oRest->getParameter('nPrice'));
    $oInstance->Cprice = floatval($oRest->getParameter('nCprice'));
    $oInstance->Desc1 = $oRest->getParameter('vDesc1');
    $oInstance->Desc2 = $oRest->getParameter('vDesc2');
    $oInstance->Desc3 = $oRest->getParameter('vDesc3');
    $oInstance->Desc4 = $oRest->getParameter('vDesc4');
    $oInstance->Desc5 = $oRest->getParameter('vDesc5');
    if ($oRest->getParameter('vFile')) {
      if ($oRest->getParameter('nId') > 0 && $oInstance->Image) {
        try {
          if (file_exists($vAttacheRootPath . '/imgs/products/' . $oInstance->Image)) {
            unlink($vAttacheRootPath . '/imgs/products/' . $oInstance->Image);
          }
        } catch (Exception $exc) {

        }
      }
      $oInstance->Image = base64_to_file($oRest->getParameter('vFile'), 'Prod', $oRest->getParameter('vFExt'), $vAttacheRootPath . '/imgs/products');
    }
    try {
      $nSavedId = $oInstance->save($oUser->Id);
      $oRest->setStatus(true);
      $oRest->setMessage('Done');
      $oRest->addRowDataValue('Id', $nSavedId);
    } catch (Exception $exc) {
      $oRest->setStatus(false);
      $oRest->setMessage($exc->getMessage());
    }
  }
}
