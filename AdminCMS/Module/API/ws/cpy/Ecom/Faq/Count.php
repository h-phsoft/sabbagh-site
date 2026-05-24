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
    $vSearchText = $oRest->getParameter('vText');
    if ($vSearchText) {
      $vSearchText = str_replace(" ", "%", $vSearchText);
    }
    $vWhere = '';
    if ($vSearchText != '') {
      $vWhere = '(`name1` LIKE "%' . $vSearchText . '%" OR `name2` LIKE "%' . $vSearchText . '%")';
    }
    $nCount = intval(cEcomFaq::getCount($vWhere));
    $oRest->setRowData(array(
      'Status' => true,
      'Message' => getLabel('Done'),
      'Count' => $nCount
    ));
  }
}
