<?php
$vModulePath = "AdminCMS/Module/";
include_once $vModulePath . "PhCFG.php";
include_once $vModulePath . "MySQL.php";
include_once $vModulePath . "PhFunctions.php";
include_once $vModulePath . "CpyFunctions.php";
include_once $vModulePath . "Data.php";

$vRootPath = PHS_SITE_ROOT_PATH;
$vMediaPath = PHS_SITE_MEDIA_PATH;

$aURI = getURIArray();
$vPage = 'main';
$nQId = 0;
if (is_array($aURI) && count($aURI) > 0 && count($aURI) >= PHS_SITE_URI_IDX) {

  if (isset($aURI[PHS_SITE_URI_IDX])) {
    $vPage = $aURI[PHS_SITE_URI_IDX];
  }
  if (isset($aURI[PHS_SITE_URI_IDX + 1])) {
    $nQId = intval($aURI[PHS_SITE_URI_IDX + 1]);
  }
}
if (!file_exists('page/page-' . $vPage . '.php')) {
  $vPage = 'main';
}
?>
<!DOCTYPE html>
<html lang="en">
  <base href="<?= PHS_SITE_ROOT_PATH ?>">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabbagh - Manufacturing Beauty & Personal Care Products</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.ltr.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap/ph-bootstrap-colors.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/media/img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/media/img/logo.png">
    <link rel="apple-touch-icon" href="assets/media/img/logo.png">
  </head>
  <body>
    <?php include_once 'section/section-header.php'; ?>
    <div class="container-fluid position-relative p-0">
      <?php
      include_once 'page/page-' . $vPage . '.php';
      ?>
    </div>
    <?php include_once 'section/section-footer.php'; ?>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/JS/app.js"></script>
  </body>
</html>