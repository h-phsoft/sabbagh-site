<?php
$vModulePath = "AdminCMS/Module/";
include_once $vModulePath . "PhCFG_SITE.php";
include_once $vModulePath . "MySQL.php";
include_once $vModulePath . "PhFunctions.php";
include_once $vModulePath . "CpyFunctions.php";
include_once $vModulePath . "Data.php";

$vRootPath = PHS_ROOT_PATH;
$vMediaPath = PHS_MEDIA_PATH;

$vLang = 'en';

$aURI = getURIArray();
$vPage = 'main';
$nQId = 0;
if (is_array($aURI) && count($aURI) > 0 && count($aURI) >= PHS_URI_IDX) {

  if (isset($aURI[PHS_URI_IDX])) {
    $vPage = $aURI[PHS_URI_IDX];
  }
  if (isset($aURI[PHS_URI_IDX + 1])) {
    $nQId = intval($aURI[PHS_URI_IDX + 1]);
  }
}
if (!file_exists('page/page-' . $vPage . '.php')) {
  $vPage = 'main';
}
$aCats = cEcomCat::getArray('id>0');
$aProducts = cEcomProduct::getArray();
?>
<!DOCTYPE html>
<html lang="en">
  <base href="<?= PHS_ROOT_PATH ?>">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabbagh - Manufacturing Beauty & Personal Care Products</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/media/img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/media/img/logo.png">
    <link rel="apple-touch-icon" href="assets/media/img/logo.png">

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.ltr.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap/ph-bootstrap-colors.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  </head>
  <body>
    <?php include_once 'section/section-header.php'; ?>
    <div class="container-fluid position-relative p-0">
      <?php
      include_once 'page/page-' . $vPage . '.php';
      ?>
    </div>
    <?php include_once 'section/section-footer.php'; ?>
    <script>
      var aCats = <?= json_encode($aCats ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>;
    </script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/JS/app.js"></script>
  </body>
</html>