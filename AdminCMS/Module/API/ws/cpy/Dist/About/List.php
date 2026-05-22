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
    $vWhere = getCondition($vSearchText, $vSearchFld, 'cDistAbout');
    $aList = cDistAbout::getArray($vWhere, '', $nPage, $nPageSize);
    $aData = array();
    $nIdx = 0;
    foreach ($aList as $element) {
      $aData[$nIdx] = array(
        'nId' => $element->Id,
        'vTitle' => $element->Title,
        'vParagraph' => $element->Paragraph,
        'vImage' => $element->Image,
      );
      $nIdx++;
    }
    $oRest->setRowData(array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => getLabel('lbl.cms.Done'),
      cPhsRest::RESPONSE_KEY_DATA => $aData
    ));
  }
}

