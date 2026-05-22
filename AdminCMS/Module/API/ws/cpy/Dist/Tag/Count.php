<?php

if (isset($oRest)) {

  if ($oUser->oGrp->getPermission($oRest->getHeaderParameter('progId'))->Query) {
    $nStart = intval($oRest->getParameter('start'));
    $nEnd = intval($oRest->getParameter('end'));
    $nPage = intval($oRest->getParameter('page'));
    $nPageSize = intval($oRest->getParameter('perpage'));
    if ($nPageSize === 0) {
      $nPageSize = 25;
    }
    $vSearchFld = $oRest->getParameter('vSFld');
    $vSearchText = $oRest->getParameter('vText');
    if ($vSearchText) {
      $vSearchText = str_replace(" ", "%", $vSearchText);
    }
    $vWhere = getCondition($vSearchText, $vSearchFld, 'cDistTag');
    $nCount = intval(cDistTag::getCount($vWhere));
    $oRest->setStatus(true);
    $oRest->setMessage('lbl.cms.Done');
    $oRest->addRowDataValue('Count', $nCount);
  }
}
