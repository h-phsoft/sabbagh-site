<?php ?>
<!DOCTYPE html>
<html  <?php echo $vHTMLDirection; ?>>
  <!--begin::Head-->
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
    <link rel="stylesheet" href="assets/plugins/highcharts/css/highcharts.css" >
    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.<?php echo $vDir ?>.min.css" id="bootstrap">
    <link rel="stylesheet" href="assets/plugins/bootstrap/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/plugins/jquery/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="assets/plugins/jstree/themes/default/style.css">
    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style-<?php echo $vDir ?>.css" id="app-style">
    <link rel="stylesheet" href="assets/css/style-theme.css" id="app-mode">
  </head>
  <body data-bs-theme="light">

    <main style="overflow-y: auto;">

      <!-- ======= Main ======= -->
      <div class="container-fluid mt-5">
        <div class="row">
          <div class="col-10 mx-auto d-flex align-items-center justify-content-center">
            <div class="card card-login-custom" style="min-width: 25vw; max-width: 60vw">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 text-center">
                    <img  src="assets/media/logos/logo.png" alt="Logo" style="max-width: 200px; max-height: 200px;">
                  </div>
                </div>
                <form id="login-form" class="needs-validation" novalidate="">
                  <div class="row py-1">
                    <div class="col-112">
                      <label id="loginStatus" class="text-danger"></label>
                    </div>
                  </div>
                  <div class="row py-1">
                    <div class="col-10 mx-auto">
                      <!--<label for="username">Username</label>-->
                      <input type="text" class="form-control form-control-sm" id="username" placeholder="<?php echo getLabel("username") ?>" required="">
                      <div class="invalid-feedback">
                        <?php echo getLabel("Please enter a username.") ?>
                      </div>
                    </div>
                  </div>
                  <div class="row py-1">
                    <div class="col-10 mx-auto">
                      <!--<label for="password">Password</label>-->
                      <input type="password" class="form-control form-control-sm" id="password" placeholder="<?php echo getLabel("Password") ?>" required="">
                      <div class="invalid-feedback">
                        <?php echo getLabel("Please enter a password") ?>
                      </div>
                    </div>
                  </div>
                  <div class="row py-1">
                    <div class="col-10 mx-auto">
                      <button id="ph-login" class="w-100 btn btn-sm btn-primary"><?php echo getLabel("Login") ?></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include "section/footer.php" ?>
    <!-- End Footer -->
    <script>
      var PhSettings = {
        "Headers": {"Authorization": ""},
        "serviceURL": "Module/API/",
        "apiURL": "Module/API/",
        "login": {"Method": "POST", "URL": "Module/API/Authentication"},
        "logout": {"Method": "DELETE", "URL": "Module/API/Authentication"},
        "changeLanguage": {"Method": "GET", "URL": "Module/API/changeLanguage"},
        "getLabels": {"Method": "GET", "URL": "Module/API/getLabels"},
        "rootPath": "<?php echo $vRootPath; ?>",
        "token": "0",
        "display": {
          "lang": "<?php echo $vLangCode ?>",
          "direction": "<?php echo $vDir ?>",
          "nDirection": "<?php echo $nDir ?>"
        }
      };
    </script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap-toaster/bootstrap-toaster.js"></script>
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/jquery/jquery-ui/jquery-ui.js"></script>
    <script src="assets/plugins/jquery/jquery.validate.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert2.min.js"></script>

    <script src="assets/js/template.main.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/pages/cpy/login.js"></script>
  </body>
</html>
