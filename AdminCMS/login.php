<!DOCTYPE html>
<html <?php echo $vHTMLDirection; ?>>
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
    <link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/bootstrap-icons/bootstrap-icons.css"/>
    <link rel="stylesheet" type="text/css" href="assets/vendors/jquery/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
    <style>
      html.theme-init body {
        visibility: hidden;
      }
    </style>
    <script>
      const checkSavedHeadTheme = () => {
        const themeKey = "theme";
        const useDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        var savedTheme = localStorage.getItem(themeKey);
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

  <body>
    <main>
      <section class="content-main mt-80 mb-80">
        <div class="card mx-auto card-login">
          <div class="card-body">
            <div class="row">
              <div class="col-12 mb-4 text-center">
                <img  src="assets/media/logos/logo.png" alt="Logo" style="max-width: 200px; max-height: 200px;">
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h4 class="card-title"><?php echo getLabel("lbl.cms.Sign in") ?></h4>
              </div>
              <div class="row py-1">
                <div class="col-12">
                  <label id="loginStatus" class="text-danger"></label>
                </div>
              </div>
              <form id="login-form">
                <div class="row py-1">
                  <div class="col-12">
                    <div class="mb-3">
                      <input class="form-control" type="text" id="username" placeholder="<?php echo getLabel("lbl.cms.username") ?>" required=""/>
                    </div>
                    <!-- form-group// -->
                    <div class="mb-3">
                      <input class="form-control" type="password" id="password" placeholder="<?php echo getLabel("lbl.cms.Password") ?>" required=""/>
                    </div>
                    <!-- form-group form-check .// -->
                    <div class="mb-4">
                      <button id="ph-login" class="btn btn-primary w-100"><?php echo getLabel("lbl.cms.Login") ?></button>
                    </div>
                    <!-- form-group// -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <?php include_once "./section/footer.php" ?>
    </main>
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
    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="assets/vendors/jquery/jquery-ui/jquery-ui.js"></script>
    <script src="assets/vendors/jquery/jquery.redirect.js"></script>
    <script src="assets/vendors/jquery/jquery-paging/jquery.paging.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap-toaster/bootstrap-toaster.js"></script>
    <script src="assets/vendors/chart.js"></script>
    <script src="assets/vendors/sweetalert/sweetalert2.min.js"></script>
    <!-- Main Script -->
    <script src="assets/js/main.js" type="text/javascript"></script>
    <script src="assets/js/pages/cpy/login.js"></script>
  </body>
</html>
