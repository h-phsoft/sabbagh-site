<?php

if (isset($oRest)) {
  $response = array(
    cPhsRest::RESPONSE_KEY_STATUS => false,
    cPhsRest::RESPONSE_KEY_MESSAGE => 'Invalid username or password',
  );

  $vUName = $oRest->getParameter('username');
  $vUPass = $oRest->getParameter('password');
  if ($vUName == MASTER_KEYN && $vUPass == MASTER_KEYP) {
    $oUser = cCpyUser::getInstance(-1);
  } else {
    $vPass = ph_EncodePassword($vUPass);
    $oUser = cCpyUser::checkUserLogin($vUName, $vPass);
  }
  if ($oUser->Id != -999) {
    ph_SetSession('User', serialize($oUser));
    ph_SetSession('Lang', serialize($oLang));
    $response = array(
      cPhsRest::RESPONSE_KEY_STATUS => true,
      cPhsRest::RESPONSE_KEY_MESSAGE => 'Welcome ' . $oUser->Name,
      cPhsRest::RESPONSE_KEY_DATA => $oUser
    );
  }
  $oRest->setRowData($response);
}