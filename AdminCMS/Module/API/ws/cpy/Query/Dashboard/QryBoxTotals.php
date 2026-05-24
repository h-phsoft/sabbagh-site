<?php

if (isset($oRest)) {

  $oRest->setStatus(true);
  $oRest->setMessage('Done');
  $oRest->addRowDataValue('Data', cFundDiary::getTotals(date("Y-m-d")));
}
