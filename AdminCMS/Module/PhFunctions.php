<?php include_once "Classes/PhSoft/cPhsCode.php" ?>
<?php include_once "Classes/PhSoft/cPhsProgram.php" ?>
<?php include_once "Classes/PhSoft/cPhsPref.php" ?>
<?php include_once "Classes/PhSoft/cPhsLang.php" ?>
<?php

/**
 * PhSoft Common classes and functions
 * (C) 2000-2024 PhSoft.
 */
//date_default_timezone_set('+3:00');
date_default_timezone_set('Asia/Damascus');

if (!function_exists('isMoble')) {

  function isMoble() {
    $bisModile = false;
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) ||
      preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
      $bisModile = true;
    }
    return $bisModile;
  }

}

if (!function_exists('getLabel')) {

  function getLabel($vKey) {
    global $aPhLables;
    $sRetVar = $vKey;
    if ($vKey) {
      $key = str_replace(" ", ".", strtolower($vKey));
      if (is_array($aPhLables) && array_key_exists($key, $aPhLables)) {
        $sRetVar = $aPhLables[$key];
      }
    }
    return $sRetVar;
  }

}

if (!function_exists('initLabels')) {

  function initLabels() {
    global $aPhLables;
    $aLbls = array();
    foreach ($aPhLables as $key => $value) {
      $vKey = str_replace(" ", ".", strtolower($key));
      $aLbls[$vKey] = $value;
    }
    $aPhLables = $aLbls;
  }

}

if (!function_exists('Ph_getBreadCrumb')) {

  function Ph_getBreadCrumb($mprg) {
    $vBreadCrumb = '';
    if ($mprg) {
      $parentPrg = cPhsProgram::getInstance($mprg->PId);
      $vBreadCrumb = getLabel($parentPrg->Name) . ' > ' . getLabel($mprg->Name);
    }
    return $vBreadCrumb;
  }

}

if (!function_exists('ph_FormatDate')) {

  function ph_FormatDate($dDate, $vFormat = 'Y-m-d') {
    $objDateTime = new DateTime($dDate);
    return $objDateTime->format($vFormat);
  }

}

if (!function_exists('ph_DateFormat')) {

  function ph_DateFormat($dDate, $vFormat = 'Y-m-d') {
    return date_format(date_create($dDate), $vFormat);
  }

}

if (!function_exists('ph_GetDateYMD')) {

  function ph_GetDateYMD() {
    $objDateTime = new DateTime('NOW');
    return $objDateTime->format('Ymd');
  }

}

if (!function_exists('ph_GetCurrentDate')) {

  function ph_GetCurrentDate() {
    $objDateTime = new DateTime('NOW');
    return $objDateTime->format('Y-m-d');
  }

}

if (!function_exists('ph_GetCurrentDateTime')) {

  function ph_GetCurrentDateTime() {
    $objDateTime = new DateTime('NOW');
    return $objDateTime->format('Y-m-d H:i');
  }

}

if (!function_exists('ph_GetAge')) {

  function ph_GetAge($birthday) {
    $objDateTime = new DateTime($birthday);
    return $objDateTime->diff(new DateTime('NOW'))->format('%yy %mm %dd');
  }

}

if (!function_exists('getGUID')) {

  function getGUID() {
    $vGUID = '';
    if (function_exists('com_create_guid')) {
      $vGUID = strtolower(com_create_guid());
    } else {
      mt_srand((int) (microtime(true) * 10000)); //optional for php 4.2.0 and up.
      $charid = strtolower(md5(uniqid(rand(), true)));
      $hyphen = chr(45); // "-"
      $vGUID = chr(123)// "{"
        . substr($charid, 0, 8) . $hyphen
        . substr($charid, 8, 4) . $hyphen
        . substr($charid, 12, 4) . $hyphen
        . substr($charid, 16, 4) . $hyphen
        . substr($charid, 20, 12)
        . chr(125); // "}";
    }
    return str_replace("{", "", str_replace("}", "", $vGUID));
  }

}

if (!function_exists('getRequestHeaders')) {

  function getRequestHeaders() {
    $headers = array();
    foreach ($_SERVER as $key => $value) {
      if (substr($key, 0, 5) === 'HTTP_') {
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
      }
    }
    return $headers;
  }

}

if (!function_exists('ph_EncodePassword')) {

  function ph_EncodePassword($sPass) {
    $vRet = md5(ph_Clean_Password($sPass));
    return $vRet;
  }

}

if (!function_exists('writeFile')) {

  function writeFile($base64_string, $output_file, $fileExtension, $folderName = ".") {
    $vFileName = $output_file . "_" . date("ymd_His") . '.' . $fileExtension;
    try {
      if (!file_exists($folderName)) {
        mkdir($folderName);
      }
      file_put_contents($folderName . '/' . $vFileName, base64_decode($base64_string));
    } catch (Exception $ex) {
      $vFileName = '';
    }
    return $vFileName;
  }

}

if (!function_exists('base64_to_file')) {

  function base64_to_file($base64_string, $output_file, $fileExtension, $folderName = ".") {
    $vFileName = $output_file . "_" . date("ymd_His") . '.' . $fileExtension;
    $data = explode(',', $base64_string);
    try {
      if (!file_exists($folderName)) {
        mkdir($folderName);
      }
      file_put_contents($folderName . '/' . $vFileName, base64_decode($data[1]));
    } catch (Exception $ex) {
      $vFileName = '';
    }
    return $vFileName;
  }

}

if (!function_exists('file_to_base64')) {

  function file_to_base64($fileName, $folderName = ".") {
    $base64_string = '';
    if (file_exists($folderName . '/' . $fileName)) {
      $base64_string = base64_encode(file_get_contents($folderName . '/' . $fileName));
    }
    return $base64_string;
  }

}

if (!function_exists('file_to_fullbase64')) {

  function file_to_fullbase64($fileName, $folderName = ".") {
    $nPos = strpos($fileName, '.', -1);
    $base64_string = 'data:image/' . substr($fileName, $nPos) . ';base64,' . file_to_base64($fileName, $folderName);
    return $base64_string;
  }

}

if (!function_exists('ph_CurrentUserIP')) {

// Get user IP
  function ph_CurrentUserIP() {
    return ph_ServerVar("REMOTE_ADDR");
  }

}

if (!function_exists('ph_Clean_String')) {

  function ph_Clean_String($sString) {
    $aKeyWords = array('"', '?', "'", '(', ')', '<', '=', '>', '[', '\\', ']', '`', '{', '|', '}', ";", "--", "\0",
      '#', '&', ' ', '!', '$', '%', '*', '+', ',', '-', '.', '/', ':', '^', '_', '`', '~',
      "select", "update", "delete", "union", "from", "concat", "usrnam", "passwod", "cmslog", "drop");
    foreach ($aKeyWords as $keyWord) {
      $sString = str_ireplace($keyWord, '', $sString);
    }
    return strip_tags(htmlspecialchars($sString));
  }

}

if (!function_exists('ph_Clean_EMail')) {

  function ph_Clean_EMail($sString) {
    $aKeyWords = array('"', '?', "'", '(', ')', '<', '=', '>', '[', '\\', ']', '`', '{', '|', '}', ";", "--", "\0",
      '#', '&', ' ', '!', '$', '%', '*', '+', ',', '-', '/', ':', '^', '_', '`', '~',
      "select", "update", "delete", "union", "from", "concat", "usrnam", "passwod", "cmslog", "drop");
    foreach ($aKeyWords as $keyWord) {
      $sString = str_ireplace($keyWord, '', $sString);
    }
    return strip_tags(htmlspecialchars($sString));
  }

}

if (!function_exists('ph_Clean_Password')) {

  function ph_Clean_Password($sString) {
    $vRet = $sString;
    if ($sString) {
      $aKeyWords = array('"', '?', "'", '(', ')', '<', '=', '>', '[', '\\', ']', '`', '{', '|', '}', ";", "--", "\0",
        "select", "update", "delete", "union", "from", "concat", "usrnam", "passwod", "cmslog", "drop");
      foreach ($aKeyWords as $keyWord) {
        $sString = str_ireplace($keyWord, '', $sString);
      }
      $vRet = strip_tags(htmlspecialchars($sString));
    }
    return $vRet;
  }

}

if (!function_exists('ph_CheckEmail')) {

// Check email
  function ph_CheckEmail($value) {
    $retVar = TRUE;
    if (strval($value) == "") {
      $retVar = TRUE;
    } else {
      $retVar = preg_match('/^[\w.%+-]+@[\w.-]+\.[A-Z]{2,6}$/i', trim($value));
    }
    return $retVar;
  }

}

if (!function_exists('getAddress')) {

  function getAddress() {
    $protocol = 'http';
    if (isset($_SERVER['HTTPS'])) {
      $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
    }
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }

}

if (!function_exists('getRequestPage')) {

  function getRequestPage($nStartIdx) {
    $requestPage = '';
    $slash = '';
    $vURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $aURI = array_values(array_filter(explode('/', $vURI)));
    for ($index = $nStartIdx; $index < count($aURI); $index++) {
      $requestPage .= $slash . $aURI[$index];
      $slash = '/';
    }
    return $requestPage;
  }

}

if (!function_exists('getURIArray')) {

  function getURIArray() {
    $vURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $aURI = explode('/', $vURI);
    return array_values(array_filter($aURI));
  }

}

if (!function_exists('getURIAsArray')) {

  function getURIAsArray($nRootLen = 0, $vCopy = 'nscc', $vLang = 'en') {
    $aReturn = array();
    $vURL = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $nRootLen);
    $vParams = '';
    $nPos = strpos($vURL, '#');
    if ($nPos !== false) {
      $vParams = substr($vURL, $nPos + 1);
      $vURL = substr($vURL, 0, $nPos);
    }
    $aURI = explode('/', $vURL);
    $aReturn['Copy'] = (count($aURI) >= 1 && $aURI[0] != '') ? $aURI[0] : $vCopy;
    $aReturn['Lang'] = (count($aURI) >= 2 && $aURI[1] != '') ? $aURI[1] : $vLang;
    $aReturn['Page'] = (count($aURI) >= 3 && $aURI[2] != '') ? $aURI[2] : '';
    $aReturn['Action'] = (count($aURI) >= 4 && $aURI[3] != '') ? $aURI[3] : '';
    $aReturn['QId'] = (count($aURI) >= 5 && $aURI[4] != '') ? $aURI[4] : 0;
    $aReturn['Params'] = $vParams;
    return $aReturn;
  }

}

if (!function_exists('getURLArray')) {

  function getURLArray($nRootLen = 0) {
    $aReturn = array();
    $vURL = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $nRootLen);
    $vParams = '';
    $nPos = strpos($vURL, '#');
    if ($nPos !== false) {
      $vParams = substr($vURL, $nPos + 1);
      $vURL = substr($vURL, 0, $nPos);
    }
    $aURI = explode('/', $vURL);
    $aReturn['Lang'] = (count($aURI) >= 1 && $aURI[0] != '') ? $aURI[0] : 'nscc';
    $aReturn['Page'] = (count($aURI) >= 2 && $aURI[1] != '') ? $aURI[1] : 'en';
    $aReturn['Action'] = (count($aURI) >= 3 && $aURI[2] != '') ? $aURI[2] : '';
    $aReturn['QId'] = (count($aURI) >= 4 && $aURI[3] != '') ? $aURI[3] : '';
    $aReturn['Params'] = $vParams;
    return $aReturn;
  }

}

if (!function_exists('ph_ServerVar')) {

  function ph_ServerVar($Name) {
    $str = $_SERVER[$Name];
    if (empty($str)) {
      $str = $_ENV[$Name];
    }
    return $str;
  }

}

if (!function_exists('ph_PrepareGets')) {

  function ph_PrepareGets() {
    foreach ($_GET as $key => $value) {
      if (!is_array($key) && (gettype($value) === 'string')) {
        $_GET[$key] = htmlspecialchars(stripslashes(trim(strip_tags($value))));
      }
    }
  }

}

if (!function_exists('ph_PreparePosts')) {

  function ph_PreparePosts() {
    foreach ($_POST as $key => $value) {
      if (!is_array($key) && (gettype($value) === 'string')) {
        $_POST[$key] = htmlspecialchars(stripslashes(trim(strip_tags($value))));
      }
    }
  }

}

if (!function_exists('ph_PrepareRequests')) {

  function ph_PrepareRequests() {
    foreach ($_REQUEST as $key => $value) {
      if (!is_array($key) && (gettype($value) == 'string')) {
        $_REQUEST[$key] = htmlspecialchars(stripslashes(trim(strip_tags($value))));
      }
    }
  }

}

if (!function_exists('ph_RemoveGet')) {

  function ph_RemoveGet($key, $value = null) {
    if (isset($_GET[$key])) {
      $_GET[$key] = $value;
    }
  }

}

if (!function_exists('ph_Get')) {

  function ph_Get($key = null, $filter = null, $fillWithEmptyString = false) {
    $retVar = null;
    if (!$key) {
      if (function_exists('filter_input_array')) {
        $retVar = $filter ? filter_input_array(INPUT_GET, $filter) : $_GET;
      } else {
        $retVar = $_GET;
      }
    } else {
      if (isset($_GET[$key])) {
        if (function_exists('filter_input')) {
          $retVar = $filter ? filter_input(INPUT_GET, $key, $filter) : $_GET[$key];
        } else {
          $retVar = $_GET[$key];
        }
      } else if ($fillWithEmptyString == true) {
        $retVar = '';
      }
    }
    return $retVar;
  }

}

if (!function_exists('ph_Post')) {

  function ph_Post($key = null, $filter = null, $fillWithEmptyString = false) {
    $retVar = null;
    if (!$key) {
      if (function_exists('filter_input_array')) {
        $retVar = $filter ? filter_input_array(INPUT_POST, $filter) : $_POST;
      } else {
        $retVar = $_POST;
      }
    } else {
      if (isset($_POST[$key])) {
        if (function_exists('filter_input')) {
          $retVar = $filter ? filter_input(INPUT_POST, $key, $filter) : $_POST[$key];
        } else {
          $retVar = $_POST[$key];
        }
      } else if ($fillWithEmptyString == true) {
        $retVar = '';
      }
    }
    return $retVar;
  }

}

if (!function_exists('ph_Get_Post')) {

  function ph_Get_Post($key = null, $filter = null, $fillWithEmptyString = false) {
    $retVar = null;
    if (!isset($GLOBALS['_GET_POST'])) {
      $GLOBALS['_GET_POST'] = array_merge($_GET, $_POST);
    }
    if (!$key) {
      if (function_exists('filter_var_array')) {
        $retVar = $filter ? filter_var_array($GLOBALS['_GET_POST'], $filter) : $GLOBALS['_GET_POST'];
      } else {
        $retVar = $GLOBALS['_GET_POST'];
      }
    } else {
      if (isset($GLOBALS['_GET_POST'][$key])) {
        if (function_exists('filter_var')) {
          $retVar = $filter ? filter_var($GLOBALS['_GET_POST'][$key], $filter) : $GLOBALS['_GET_POST'][$key];
        } else {
          $retVar = $GLOBALS['_GET_POST'][$key];
        }
      } else if ($fillWithEmptyString == true) {
        $retVar = '';
      }
    }
    return $retVar;
  }

}

if (!function_exists('ph_Request')) {

  function ph_Request($key = null) {
    $retVar = null;
    if ($key) {
      if (isset($_REQUEST[$key])) {
        $retVar = $_REQUEST[$key];
      }
    }
    return $retVar;
  }

}

if (!function_exists('ph_Cookie')) {

  function ph_Cookie($key = null) {
    $retVar = '';
    if (!$key) {
      if (isset($_COOKIE[$key])) {
        $retVar = $_COOKIE[$key];
      }
    }
    return $retVar;
  }

}

if (!function_exists('ph_SetCookie')) {

  function ph_SetCookie($key, $value = '', $time = -1) {
    if ($value != '') {
      if ($time < 0) {
        $time = time() + 10 * 365 * 24 * 60 * 60;
      }
      setcookie($key, $value, time() + $time, "/");
    } else {
      ph_DeleteCookie($key);
    }
  }

}

if (!function_exists('ph_DeleteCookie')) {

  function ph_DeleteCookie($key) {
    unset($_COOKIE[$key]);
    setcookie($key, '', -1, "/");
  }

}

if (!function_exists('ph_Session')) {

  function ph_Session($key = null, $filter = null, $fillWithEmptyString = false) {
    $retVar = null;
    if (!$key) {
      if (function_exists('filter_var_array')) {
        $retVar = $filter ? filter_var_array($_SESSION, $filter) : $_SESSION;
      } else {
        $retVar = $_SESSION;
      }
    } else {
      if (isset($_SESSION[$key])) {
        if (function_exists('filter_var')) {
          $retVar = $filter ? filter_var($_SESSION[$key], $filter) : $_SESSION[$key];
        } else {
          $retVar = $_SESSION[$key];
        }
      } else if ($fillWithEmptyString == true) {
        $retVar = '';
      }
    }
    return $retVar;
  }

}

if (!function_exists('ph_SetSession')) {

  function ph_SetSession($key, $value = '') {
    if (isset($key)) {
      if ($value === '') {
        unset($_SESSION[$key]);
      } else {
        $_SESSION[$key] = $value;
      }
    }
  }

}

if (!function_exists('ph_UploadFile')) {

  function ph_UploadFile($srcFilename, $target_dir = 'uploads/', $newFileName = '') {

    $uploadOk = 0;
    if ($newFileName == '') {
      $newFileName = $srcFilename;
    }
    $distFilename = $target_dir . $newFileName . date("ymdHis") . '.' . pathinfo(basename($_FILES[$srcFilename]["name"]), PATHINFO_EXTENSION);
    $imageFileType = pathinfo(basename($_FILES[$srcFilename]["name"]), PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES[$srcFilename]["tmp_name"]);
    if ($check !== false) {
      //echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 0;
    } else {
      //echo "File is not an image.";
      $uploadOk = 1;
    }

// Check if file already exists
    if (file_exists($distFilename)) {
      //echo "Sorry, file already exists.";
      $uploadOk = 2;
    }
// Check file size
    if ($_FILES[$srcFilename]["size"] > 200000) {
      //echo "Sorry, your file is too large.";
      $uploadOk = 3;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 4;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk != 0) {
      //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES[$srcFilename]["tmp_name"], $distFilename)) {
        //echo "The file " . basename($_FILES["idImage1"]["name"]) . " has been uploaded.";
      } else {
        //echo "Sorry, there was an error uploading your file.";
        $uploadOk = 2;
      }
    }
    return array("Status" => $uploadOk, "NewFileName" => $distFilename);
  }

}
