<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {

    $nId = $oRest->getParameter('id');
    $element = cEcomTicket::getInstance($nId);
    $oSales = cEcomSales::getInstance($element->SaleId);
    $aData = array(
      'nId' => $element->Id,
      'nSaleId' => $element->SaleId,
      'vSaleName' => $oSales->Name,
      //
      'dMdate' => ph_FormatDate($oSales > Mdate, 'Y-m-d H:s'),
      'nProdId' => $oSales->ProdId,
      'vSerial' => $oSales->Serial,
      'nWdays' => $$oSales->oSales->Wdays,
      'dEdate' => ph_FormatDate($oSales->Edate, 'Y-m-d'),
      'vCustomer' => $oSales->Customer,
      'vCAddress' => $oSales->CAddress,
      'vCMobile' => $oSales->CMobile,
      //
      'nUserId' => $element->UserId,
      'vUserName' => $element->oUser->Name,
      //
      'nStatusId' => $element->StatusId,
      'vStatusName' => $element->oStatus->Name,
      //
      'dDate' => ph_FormatDate($element->Date, 'Y-m-d H:s'),
      'dRdate' => ph_FormatDate($element->Rdate, 'Y-m-d H:s'),
      'vDescrib' => $element->Describ,
      'vAction' => $element->Action,
    );
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'Data' => $aData
    ));
  }
}
