<?php

if (session_id() == "") {
  @session_start();
}
?>
<?php include_once "Module/PhCFG.php" ?>
<?php include_once "Module/MySQL.php" ?>
<?php include_once "Module/PhFunctions.php" ?>
<?php include_once "Module/CpyFunctions.php" ?>
<?php

ph_PrepareGets();
ph_PreparePosts();
/*
  $vPass = ph_EncodePassword('admin123');
  $oUser = cCpyUser::checkUserLogin('admin', $vPass);
  ph_SetSession('User', serialize($oUser));
 */
$vAppVersion = PHS_VERSION;

cPhsPref::getDBKeys();
$vLang = cPhsPref::getPref('Def_Language');
$vDir = cPhsPref::getPref('Def_Direction');
$aPhLables = array();

$vLangCode = $vLang;
$oLang = cPhsLang::getInstanceByCode($vLang);
if ($oLang->Code) {
  $vLangCode = $oLang->Code;
}
if ($oLang->Dir) {
  $vDir = strtolower($oLang->Dir);
}
$vLabelsFile = "Module/PhLabels-" . $vLangCode . ".php";
if (!file_exists($vLabelsFile)) {
  $vLabelsFile = "Module/PhLabels-en.php";
  $vDir = 'ltr';
  $nDir = 0;
}
include_once $vLabelsFile;
initLabels();

$vHTMLDirection = 'lang="' . $vLang . '" style="direction: ' . $vDir . ';"';

$vRootPath = PHS_CMS_ROOT_PATH;
$vMediaPath = PHS_CMS_MEDIA_PATH;
$vSiteMediaPath = PHS_SITE_MEDIA_PATH;
$aURI = getURIArray();
//
$requestPage = getRequestPage(PHS_URI_IDX);
$requestProg = cPhsProgram::getInstance(0);
if ($requestPage) {
  $requestProg = cPhsProgram::getInstanceByFile($requestPage);
} else {
  $vDefProg = cPhsPref::getPref('Default_Program');
  if ($vDefProg) {
    $requestProg = cPhsProgram::getInstance(intval($vDefProg));
    $requestPage = $requestProg->File;
  }
}
$vPage = 'pages/' . $requestPage . '.php';
$isPageExist = file_exists($vPage);
$vPageCSS = 'assets/css/pages/' . $requestPage . '.css';
$isCssExist = file_exists($vPageCSS);
$vPageJS = 'assets/js/pages/' . $requestPage . '.js';
$isJSExist = file_exists($vPageJS);
$vReqId = $requestProg->Id;
//
$aLangs = cPhsLang::getArray();
$nDir = 0;
$vMainPage = 'login.php';
if (ph_Session('User')) {
  $oUser = unserialize(ph_Session('User'));
  if ($oUser != null && $oUser->Id !== -999) {
    if ($requestPage === 'logout') {
      ph_SetSession('User');
      ph_SetSession('Lang');
    } else {
      $perms = $oUser->oGrp->getPermission($requestProg->Id);
      if (!isset($perms)) {
        $perms = new cCpyPerm();
      }
      if (ph_Session('Lang')) {
        $oLang = unserialize(ph_Session('Lang'));
        $vLangCode = $oLang->Code;
        $vDir = strtolower($oLang->Dir);
      }
      if ($vDir == 'rtl') {
        $nDir = 1;
      }
      $vHTMLDirection = 'lang="' . $vLang . '" style="direction: ' . $vDir . ';"';
      $vLabelsFile = "Module/PhLabels-" . $vLangCode . ".php";
      if (!file_exists($vLabelsFile)) {
        $vLabelsFile = "Module/PhLabels-en.php";
        $vDir = 'ltr';
        $nDir = 0;
      }
      include_once $vLabelsFile;
      initLabels();
      //
      $vMainPage = 'main.php';
    }
  }
}
include $vMainPage;
