<?php

if (isset($oRest)) {

  $vFile = $oRest->getParameter('vFile');
  $vFileName = $oRest->getParameter('vFileName');
  $vType = $oRest->getParameter('vType');
  $vExtention = $oRest->getParameter('vExt');
  $vFolder = $oRest->getParameter('vFolder');
  $fileName = base64_to_file($vFile, 'cpy_Attache', $vExtention, $vAttacheRootPath . $vFolder);

  $oRest->setStatus(true);
  $oRest->setMessage('Done');
  $oRest->addRowDataValue('Filename', $fileName);
}
