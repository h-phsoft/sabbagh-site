<?php

if (isset($oRest)) {

  $element = cEcomSales::getInstanceBySerialMobile($oRest->getParameter('Serial'), $oRest->getParameter('Mobile'));
  if (intval($element->Id) > 0) {
    $nBranch = ph_GetDBValue('bran_id', 'cpy_user', 'id="' . $element->InsUser . '"');
    $vBranchName = ph_GetDBValue('name', 'cpy_branch', 'id="' . $nBranch . '"');
    $vBranchAddress = ph_GetDBValue('address', 'cpy_branch', 'id="' . $element->BranId . '"');
    $vBranchPhone = ph_GetDBValue('phone', 'cpy_branch', 'id="' . $element->BranId . '"');
    $nBrand = ph_GetDBValue('brand_id', 'ecom_product', 'id="' . $element->ProdId . '"');
    $vBrandName = ph_GetDBValue('name1', 'ecom_brand', 'id="' . $nBrand . '"');
    $nCat = ph_GetDBValue('cat_id', 'ecom_product', 'id="' . $element->ProdId . '"');
    $vCatName = ph_GetDBValue('name1', 'ecom_cat', 'id="' . $nCat . '"');
    $vCatDesc = ph_GetDBValue('descrip', 'ecom_cat', 'id="' . $nCat . '"');
    $vProdName = ph_GetDBValue('name1', 'ecom_product', 'id="' . $element->ProdId . '"');
    $vSalesman = ph_GetDBValue('name', 'cpy_user', 'id="' . $element->InsUser . '"');
    $aTickets = cEcomTicket::getArray("sale_id=" . $element->Id);
    $aData = array(
      'nId' => $element->Id,
      'dMDate' => ph_FormatDate($element->Mdate, 'Y-m-d'),
      'vBranchName' => $vBranchName,
      'vBranchAddress' => $vBranchAddress,
      'vBranchPhone' => $vBranchPhone,
      'vBrandName' => $vBrandName,
      'vCatName' => $vCatName,
      'nProdId' => $element->ProdId,
      'vProdName' => $vProdName,
      'vSerial' => $element->Serial,
      'nWDays' => $element->Wdays,
      'dEDate' => ph_FormatDate($element->Edate, 'Y-m-d'),
      'vCustomer' => $element->Customer,
      'vCAddress' => $element->CAddress,
      'vCMobile' => $element->CMobile,
      'vDescription' => $vCatDesc,
      'vSalesman' => $vSalesman,
      'aTickets' => $aTickets
    );
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'Data' => $aData
    ));
  } else {
    $oRest->setRowData(array(
      'Status' => false,
      'Message' => getLabel('Serial Not Found')
    ));
  }
}
