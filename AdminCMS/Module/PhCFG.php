<?php

define("PHS_VERSION", '1.5.2617');

// get Environment Valiable from htaccess
define("PHS_ISONLINE", getenv('IS_ONLINE') === 'true');
if (PHS_IS_ONLINE) {
  define("PH_CONN_HOST", 'localhost');
  define("PH_CONN_PORT", 3306);
  define("PH_CONN_USER", 'root');
  define("PH_CONN_PASS", '');
  define("PH_CONN_DB", 'phsoftme_std_sabbagh');

  define('PHS_URI_IDX', 2);
  define('PHS_SITE_URI_IDX', 1);
  define('PHS_SERVER_ROOT_PATH', '../../../assets/media/');
  define('PHS_CMS_ROOT_PATH', '/sabbagh/AdminCMS/');
  define('PHS_SITE_ROOT_PATH', '/sabbagh/');
  define('PHS_CMS_MEDIA_PATH', '../assets/media/');
  define('PHS_SITE_MEDIA_PATH', 'assets/media/');
} else {
  define("PH_CONN_HOST", 'localhost');
  define("PH_CONN_PORT", 3306);
  define("PH_CONN_USER", 'root');
  define("PH_CONN_PASS", 'RootPass');
  define("PH_CONN_DB", 'phsoftme_std_sabbagh');

  define('PHS_URI_IDX', 2);
  define('PHS_SITE_URI_IDX', 1);
  define('PHS_SERVER_ROOT_PATH', '../../../assets/media/');
  define('PHS_CMS_ROOT_PATH', '/sabbagh/AdminCMS/');
  define('PHS_SITE_ROOT_PATH', '/sabbagh/');
  define('PHS_CMS_MEDIA_PATH', '../assets/media/');
  define('PHS_SITE_MEDIA_PATH', 'assets/media/');
}
