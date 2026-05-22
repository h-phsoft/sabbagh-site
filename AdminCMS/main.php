<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="<?php echo $vRootPath; ?>">
    <meta charset="utf-8" />
    <title><?php echo cPhsPref::getPrefValue('Copy_Title'); ?></title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="PhSoft, Content Management" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="PhSoft Content Management" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/media/logos/favicon.png" />
    <!-- Template CSS -->
    <link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/css/bootstrap.<?php echo $vDir ?>.css" id="bootstrap"/>
    <link rel="stylesheet" type="text/css" href="assets/css/ph-bootstrap-colors.css"/>
    <link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/bootstrap-icons/bootstrap-icons.css"/>
    <link rel="stylesheet" type="text/css" href="assets/vendors/jquery/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
    <?php
    if ($isCssExist) {
      ?>
      <link rel="stylesheet" href="<?php echo $vPageCSS; ?>">
      <?php
    }
    ?>
    <style>
      html.theme-init body {
        visibility: hidden;
      }
    </style>
    <script>
      var savedTheme = 'light';
      const checkSavedHeadTheme = () => {
        const themeKey = "theme";
        const useDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (savedTheme === 'dark') {
          document.documentElement.classList.add('dark');
        } else if (savedTheme === 'light') {
          document.documentElement.classList.remove('dark');
        }
      };
      checkSavedHeadTheme();
      document.documentElement.classList.add('theme-init');
      (function () {
        var themeKey = "theme";
        var savedTheme = localStorage.getItem(themeKey);
        function applyTheme() {
          if (savedTheme === "dark" || (!savedTheme && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
            document.body.classList.add("dark");
          } else {
            document.body.classList.remove("dark");
          }
          document.documentElement.classList.remove('theme-init');
        }
        if (document.readyState === "loading") {
          document.addEventListener("DOMContentLoaded", applyTheme);
        } else {
          applyTheme();
        }
      })();
    </script>
  </head>

  <body class="<?php echo $vDir ?>">
    <div class="screen-overlay"></div>
    <?php include_once "./section/sidebar.php" ?>
    <main class="main-wrap" style="min-height: 100vh">
      <?php include_once "./section/header.php" ?>
      <?php
      if ($requestPage) {
        if ($isPageExist) {
          include $vPage;
        } else {
          include "pages/404.php";
        }
      }
      ?>
      <?php include_once "./section/footer.php" ?>
    </main>

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
        "changePassword": {
          "Method": "POST",
          "URL": "Module/API/User/ChangePassword"
        },
        "changeLanguage": {
          "Method": "POST",
          "URL": "Module/API/User/ChangeLanguage"
        },
        "rootPath": "<?php echo $vRootPath; ?>",
        "mediaPath": "<?php echo $vMediaPath; ?>",
        "siteMediaPath": "<?php echo $vSiteMediaPath; ?>",
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
    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="assets/vendors/jquery/jquery-ui/jquery-ui.js"></script>
    <script src="assets/vendors/jquery/jquery.redirect.js"></script>
    <script src="assets/vendors/jquery/jquery-paging/jquery.paging.min.js"></script>
    <script src="assets/vendors/jquery/jquery.fullscreen.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap-toaster/bootstrap-toaster.js"></script>
    <script src="assets/vendors/chart.js"></script>
    <script src="assets/vendors/sweetalert/sweetalert2.min.js"></script>
    <!-- Main Script -->
    <script src="assets/js/main.js?v=1.7.1822" type="text/javascript"></script>
    <?php
    if ($isJSExist) {
      ?>
      <script src="<?php echo $vPageJS; ?>?v=1.7.1822"></script>
      <?php
    }
    ?>
  </body>
</html>
