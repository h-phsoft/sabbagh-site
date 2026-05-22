<?php

if (isset($oRest)) {
  $response = array(
    cPhsRest::RESPONSE_KEY_STATUS => false,
    cPhsRest::RESPONSE_KEY_MESSAGE => 'Invalid username or password',
  );

  $vKeys = $oRest->getParameter("Keys");
  $oUser = cCpyUser::getInstance($oRest->getParameter("UserId"));
  $oUser->Password = '';
  $oUser->GUID = $oRest->getParameter("GUID");
  $oLang = cPhsLang::getInstance($oRest->getParameter("LangId"));
  if ($oUser->Id != -999) {
    ph_SetSession('User', serialize($oUser));
    ph_SetSession('Lang', serialize($oLang));
    $oRest->setStatus(true);
    $oRest->setMessage('Done');
    $oRest->addRowDataValue('User', $oUser);
    $oRest->addRowDataValue('Lang', $oLang);
  } else {
    $oRest->setRowData($response);
  }
}