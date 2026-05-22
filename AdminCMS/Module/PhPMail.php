<?php

if (!function_exists('sendEMail')) {

  function sendEMail($aMails, $vSubject, $vBody) {
    $to = "h.phsoft@gmail.com";
    if (isset($aMails['to'])) {
      $to = $aMails['to'];
    }
    $headers = "";
    if (isset($aMails['from'])) {
      $headers = "From: " . $aMails['from'];
    }
    mail($to, $vSubject, $vBody, $headers);
  }

}
