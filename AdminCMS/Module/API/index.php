<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Pragma: no-cache");
?>
<?php

if (session_id() == "") {
  @session_start();
}
?>
<?php include_once "../Classes/PhSoft/cPhsRestBase.php" ?>
<?php include_once "../Classes/PhSoft/cPhsRest.php" ?>
<?php include_once "../PhCFG.php" ?>
<?php include_once "../MySQL.php" ?>
<?php include_once "../PhFunctions.php" ?>
<?php include_once "../CpyFunctions.php" ?>
<?php include_once "../CpyRouter.php" ?>
<?php

ph_PrepareGets();
ph_PreparePosts();
ph_PrepareRequests();

$oRest = new cPhsRest(PHS_URI_IDX + 1);
if ($oRest->isOK) {
  cPhsPref::$Prefs = cPhsPref::loadDBKeys();
  $vLang = cPhsPref::getPref('Def_Language');
  $oLang = cPhsLang::getInstanceByCode($vLang);
  include_once "../PhLabels-" . $oLang->Code . ".php";
  initLabels();
  //
  if ($oRest->URL[cPhsRest::URL_KEY_AUTH]) {
    $oRest->setMessage(getLabel('Invalid User Status'));
    $oUser = unserialize(ph_Session('User'));
    $oLang = unserialize(ph_Session('Lang'));
    $oRest->isOK = $oUser->StatusId == 1;
    include_once "../PhLabels-" . $oLang->Code . ".php";
    initLabels();
  }
  if ($oRest->isOK) {
    $vMediaPath = PHS_MEDIA_PATH;
    $vAttacheRootPath = PHS_SERVER_ROOT_PATH;
    if (!file_exists($vAttacheRootPath)) {
      mkdir($vAttacheRootPath);
    }
    $serviceName = 'ws/' . $oRest->URL[cPhsRest::URL_KEY_URL] . '.php';
    $oRest->setMessage(getLabel('Unknown Service') . ' Path=[' . $oRest->URL[cPhsRest::URL_KEY_PATH] . '] Method=[' . $oRest->URL[cPhsRest::URL_KEY_METHOD] . '] URL=[' . $serviceName . ']');
    if (file_exists($serviceName)) {
      $oRest->setMessage(getLabel('No Permission') . ' Path=[' . $oRest->URL[cPhsRest::URL_KEY_PATH] . '] Method=[' . $oRest->URL[cPhsRest::URL_KEY_METHOD] . '] URL=[' . $serviceName . ']');
      include $serviceName;
    }
  }
}
$oRest->returnResponse();
