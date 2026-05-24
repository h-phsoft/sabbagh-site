<!DOCTYPE html>
<html <?php echo $vHTMLDirection; ?>  data-bs-theme="auto">

  <head>
    <base href="<?php echo $vRootPath; ?>">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo cPhsPref::getPrefValue('Copy_Title'); ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/media/logos/folly.png" rel="icon">
    <link href="assets/media/logos/folly.png" rel="apple-touch-icon">

    <!-- Highcharts CSS Files -->
    <link rel="stylesheet" href="assets/plugins/highcharts/css/highcharts.css">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.<?php echo $vDir ?>.min.css" id="bootstrap">
    <link rel="stylesheet" href="assets/plugins/bootstrap/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/plugins/jquery/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="assets/plugins/jstree/themes/default/style.css">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style-<?php echo $vDir ?>.css" id="app-style">
    <?php
    if ($isCssExist) {
      ?>
      <link rel="stylesheet" href="<?php echo $vPageCSS; ?>">
      <?php
    }
    ?>
  </head>

  <body class="">

    <!-- Header -->
    <?php include 'section/header.php'; ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php include 'section/sidebar.php'; ?>
    <!-- End Sidebar-->

    <!-- ======= Main ======= -->
    <main id="main" class="main">
      <div class="container-fluid">
        <div class="row">

          <?php
          if ($requestPage) {
            if ($isPageExist) {
              include $vPage;
            } else {
              include "pages/404.php";
            }
          }
          ?>
        </div>
      </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include 'section/footer.php'; ?>
    <!-- End Footer -->

    <!-- ======= Back to Top ======= -->
    <?php include 'section/back_to_top.php'; ?>
    <!-- End Back to Top -->

    <!-- ======= Setting ======= -->
    <?php include 'section/settingsbar.php'; ?>
    <!-- End Setting -->

    <script>
      var PhSettings = {
        "Headers": {
          "Authorization": "",
          "progId": "<?php echo $requestProg->Id; ?>"
        },
        "apiURL": "Module/API",
        "serviceURL": "Module/API",
        "logout": {
          "Method": "DELETE",
          "URL": "Module/API/Authentication"
        },
        "ChangeLanguage": {
          "Method": "POST",
          "URL": "Module/API/User/ChangeLanguage"
        },
        "changePassword": {
          "Method": "POST",
          "URL": "Module/API/User/ChangePassword"
        },
        "rootPath": "<?php echo $vRootPath; ?>",
        "token": "0",
        "Perms": {
          "Query": <?php echo $perms->Query === 1 ? 'true' : 'false'; ?>,
          "Insert": <?php echo $perms->Insert === 1 ? 'true' : 'false'; ?>,
          "Update": <?php echo $perms->Update === 1 ? 'true' : 'false'; ?>,
          "Delete": <?php echo $perms->Delete === 1 ? 'true' : 'false'; ?>,
          "Print": <?php echo $perms->Print === 1 ? 'true' : 'false'; ?>,
          "Commit": <?php echo $perms->Commit === 1 ? 'true' : 'false'; ?>,
          "Revoke": <?php echo $perms->Revoke === 1 ? 'true' : 'false'; ?>,
          "Import": <?php echo $perms->Import === 1 ? 'true' : 'false'; ?>,
          "Export": <?php echo $perms->Export === 1 ? 'true' : 'false'; ?>,
          "Special": <?php echo $perms->Special === 1 ? 'true' : 'false'; ?>
        },
        "oUser": {
          "Id": "<?php echo $oUser->Id; ?>",
          "Name": "<?php echo $oUser->Name; ?>",
          "Login": "<?php echo $oUser->Logon; ?>",
          "GrpId": "<?php echo $oUser->oGrp->Id; ?>",
          "GrpName": "<?php echo $oUser->oGrp->Name; ?>",
          "BranId": "<?php echo $oUser->oBranch->Id; ?>",
          "BranName": "<?php echo $oUser->oBranch->Name; ?>"
        },
        "display": {
          "lang": "<?php echo $vLangCode ?>",
          "direction": "<?php echo $vDir ?>",
          "nDirection": "<?php echo $nDir ?>",
          "PageTitle": "<?php echo getLabel($requestProg->Name); ?>",
          "BreadCrumb": "<?php echo Ph_getBreadCrumb($requestProg); ?>"
        },
        "Labels": <?php echo json_encode($aPhLables) ?>
      };
    </script>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/jquery/jquery-ui/jquery-ui.js"></script>
    <script src="assets/plugins/jquery/jquery.redirect.js"></script>
    <script src="assets/plugins/jquery/jquery-paging/jquery.paging.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/bootstrap/color-modes.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap-toaster/bootstrap-toaster.js"></script>
    <script src="assets/plugins/jstree/jstree.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert2.min.js"></script>
    <script src="assets/plugins/excel/xlsx.full.min.js"></script>

    <script src="assets/plugins/highcharts/highcharts.js"></script>
    <script src="assets/plugins/highcharts/highcharts-3d.js"></script>
    <script src="assets/plugins/highcharts/highcharts-more.js"></script>

    <script src="assets/plugins/highcharts/modules/series-label.js"></script>
    <script src="assets/plugins/highcharts/modules/data.js"></script>
    <script src="assets/plugins/highcharts/modules/exporting.js"></script>
    <script src="assets/plugins/highcharts/modules/export-data.js"></script>
    <script src="assets/plugins/highcharts/modules/sonification.js"></script>
    <script src="assets/plugins/highcharts/modules/accessibility.js"></script>

    <script src="assets/plugins/miscellaneous/toastr.js"></script>

    <script src="assets/js/template.main.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/plugins/phsoft/PhsForm.js"></script>
    <script src="assets/plugins/phsoft/PhsImportExcel.js"></script>
    <?php
    if ($isJSExist) {
      ?>
      <script src="<?php echo $vPageJS; ?>"></script>
      <?php
    }
    ?>

  </body>

</html>
