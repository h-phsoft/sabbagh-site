<?php

if (isset($oRest)) {

  $oLang = cPhsLang::getInstanceByCode($oRest->getParameter('language'));
  ph_SetSession('Lang', serialize($oLang));
  $oRest->setRowData(array(
    'Status' => true,
    'Message' => 'Done'
  ));
}