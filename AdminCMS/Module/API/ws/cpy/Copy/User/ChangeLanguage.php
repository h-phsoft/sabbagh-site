<?php

if (isset($oRest)) {

  $oRest->setMessage(getLabel('lbl.cms.Sorry you cannot change language'));
  $nLangId = intval($oRest->getParameter('language'));
  $oLang = cPhsLang::getInstance($nLangId);
  ph_SetSession('Lang', serialize($oLang));
  $oRest->setRowData(array(
    'Status' => true,
    'Message' => 'Done'
  ));
}