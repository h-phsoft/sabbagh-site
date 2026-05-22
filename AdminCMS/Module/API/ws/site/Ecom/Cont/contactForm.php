<?php

if (isset($oRest)) {

  $vName = $oRest->getParameter('name');
  $vSubject = $oRest->getParameter('subject');
  $vEmail = $oRest->getParameter('email');
  $vPhone = $oRest->getParameter('phone');
  $vMessage = $oRest->getParameter('message');
  $vBody = "Name: " . $vName . "\r\n"
    . "Email: " . $vEmail . "\r\n"
    . "Phone: " . $vPhone . "\r\n"
    . "Subject: " . $vSubject . "\r\n"
    . "Message: " . $vMessage;
  try {
    if ($vEmail) {
      $to = cPhsPref::getPref('SITE_CONTACT_EMAIL');
      if (!$to) {
        $to = "h.phsoft@gmail.com";
      }
      $headers = "From: " . $vEmail;
      mail($to, $vSubject, $vBody, $headers);
    }
  } catch (Exception $exc) {
    $oRest->setStatus(false);
    $oRest->setMessage($exc->getMessage());
  }
}
