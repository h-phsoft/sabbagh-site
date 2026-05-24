<?php

/**
 * Description of PhsRest
 * RESTful web services class
 * Version 1.0.1
 *
 * @author Haytham
 */
class cPhsRest extends cPhsRestBase {

  public const METHOD_GET = 'GET';
  public const METHOD_POST = 'POST';
  public const METHOD_PUT = 'PUT';
  public const METHOD_DELETE = 'DELETE';
  public const METHOD_OPTIONS = 'OPTIONS';
  //
  public const RESPONSE_KEY_CODE = 'Code';
  public const RESPONSE_KEY_STATUS = 'Status';
  public const RESPONSE_KEY_MESSAGE = 'Message';
  public const RESPONSE_KEY_DATA = 'Data';
  //
  public const URL_KEY_PATH = 'Path';
  public const URL_KEY_URL = 'URL';
  public const URL_KEY_METHOD = 'Method';
  public const URL_KEY_AUTH = 'needAuthentication';

  private static $aRoutes = Array();
  //

  public $isOK = false;
  public $URL = array();
  private $method = self::METHOD_GET;
  private $Path = '';
  private $aHeaders = array();
  private $responseType = 0;
  private $aRowData = array(
    self::RESPONSE_KEY_CODE => self::HTTP_CODE_BAD_REQUEST,
    self::RESPONSE_KEY_STATUS => false,
    self::RESPONSE_KEY_MESSAGE => 'Bad Request'
  );

  function __construct($nStartIdx = 0) {
    $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
    $this->aHeaders = $this->getHeadersArray();
    $this->isOK = false;
    $this->Path = self::getRequestPage($nStartIdx + 1);
    $this->setCode(cPhsRest::HTTP_CODE_NOT_FOUND);
    $this->setStatus(false);
    $this->setMessage(self::statusMessage(self::HTTP_CODE_NOT_FOUND));
    /* for Debug */
    //$this->addRowDataValue('Method', $this->method);
    //$this->addRowDataValue('Path', $this->Path);
    //$this->addRowDataValue('Routes', self::$aRoutes);
    if (isset(self::$aRoutes[$this->Path])) {
      $this->setCode(cPhsRest::HTTP_CODE_METHOD_NOT_ALLOWED);
      $this->setStatus(false);
      $this->setMessage(self::statusMessage(self::HTTP_CODE_METHOD_NOT_ALLOWED) . ' [' . self::$aRoutes[$this->Path][$this->method][self::URL_KEY_URL] . '] ' . $this->method);
      if (isset(self::$aRoutes[$this->Path][$this->method])) {
        $this->isOK = true;
        $this->setCode(cPhsRest::HTTP_CODE_OK);
        $this->setStatus(true);
        $this->setMessage(self::statusMessage(self::HTTP_CODE_OK));
        $this->URL = self::$aRoutes[$this->Path][$this->method];
      }
    }
    $this->setHttpStatus(self::HTTP_CODE_OK);
  }

  public static function addRoute($path, $page, $method = self::METHOD_POST, $needAuthentication = true) {
    self::$aRoutes[$path][strtoupper($method)] = Array(
      self::URL_KEY_PATH => $path,
      self::URL_KEY_URL => $page,
      self::URL_KEY_METHOD => $method,
      self::URL_KEY_AUTH => $needAuthentication
    );
  }

  public static function addFullRoute($path, $page, $needAuthentication = true) {
    self::addRoute($path, $page . '/List', cPhsRest::METHOD_OPTIONS, $needAuthentication);
    self::addRoute($path, $page . '/Get', cPhsRest::METHOD_GET, $needAuthentication);
    self::addRoute($path, $page . '/Count', cPhsRest::METHOD_PUT, $needAuthentication);
    self::addRoute($path, $page . '/Save', cPhsRest::METHOD_POST, $needAuthentication);
    self::addRoute($path, $page . '/Delete', cPhsRest::METHOD_DELETE, $needAuthentication);
  }

  public static function addOraFullRoute($path, $page, $needAuthentication = true) {
    self::addRoute($path, $page . '/List', cPhsRest::METHOD_OPTIONS, $needAuthentication);
    self::addRoute($path, $page . '/Get', cPhsRest::METHOD_GET, $needAuthentication);
    self::addRoute($path, $page . '/Add', cPhsRest::METHOD_POST, $needAuthentication);
    self::addRoute($path, $page . '/Update', cPhsRest::METHOD_PUT, $needAuthentication);
    self::addRoute($path, $page . '/Delete', cPhsRest::METHOD_DELETE, $needAuthentication);
  }

  public static function getRequestPage($nStartIdx) {
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

  public function getHeadersArray() {
    $arrayHeaders = array();
    foreach (getallheaders() as $key => $value) {
      $arrayHeaders[strtolower($key)] = $value;
    }
    return $arrayHeaders;
  }

  public function getHeader($vKey) {
    $vHeaderValue = '';
    if (isset($this->aHeaders[strtolower($vKey)])) {
      $vHeaderValue = $this->aHeaders[strtolower($vKey)];
    }
    return $vHeaderValue;
  }

  public function getHeaderParameter($vKey) {
    return $this->getHeader($vKey);
  }

  public function setHeaders($aHeaders) {
    $this->aHeaders = $aHeaders;
  }

  public function getHeaders() {
    return $this->aHeaders;
  }

  public function getMethod() {
    return $this->method;
  }

  public function getParameter($key) {
    $vRetVal = null;
    if ($key) {
      switch ($this->method) {
        case self::METHOD_PUT:
          parse_str(file_get_contents('php://input'), $_PUT);
          if (isset($_PUT[$key])) {
            $vRetVal = $_PUT[$key];
          }
          break;
        case self::METHOD_DELETE:
          parse_str(file_get_contents('php://input'), $_DELETE);
          if (isset($_DELETE[$key])) {
            $vRetVal = $_DELETE[$key];
          }
          break;
        case self::METHOD_OPTIONS:
          parse_str(file_get_contents('php://input'), $_OPTIONS);
          if (isset($_OPTIONS[$key])) {
            $vRetVal = $_OPTIONS[$key];
          }
          break;
        case self::METHOD_POST:
        case self::METHOD_GET:
        default:
          if (!isset($GLOBALS['_GET_POST'])) {
            $GLOBALS['_GET_POST'] = array_merge($_GET, $_POST);
          }
          if (isset($GLOBALS['_GET_POST'][$key])) {
            $vRetVal = $GLOBALS['_GET_POST'][$key];
          }
          break;
      }
      if ($vRetVal && !is_array($vRetVal)) {
        $vRetVal = htmlspecialchars(stripslashes(trim(strip_tags($vRetVal))));
      }
    }
    return $vRetVal;
  }

  public function getRequestHeaders() {
    $headers = array();
    foreach ($_SERVER as $key => $value) {
      if (substr($key, 0, 5) <> 'HTTP_') {
        continue;
      }
      $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
      $headers[$header] = $value;
    }
    return $headers;
  }

  public function setMethod($method) {
    $this->method = $method;
  }

  public function getResponeType() {
    return $this->responseType;
  }

  public function setResponeType($responseType) {
    $this->responseType = $responseType;
  }

  public function addRowDataValue($vKey, $vValue) {
    $this->aRowData[$vKey] = $vValue;
  }

  public function removeRowDataValue($vKey) {
    if (isset($this->aRowData[$vKey])) {
      unset($this->aRowData[$vKey]);
    }
  }

  public function getCode() {
    return $this->aRowData[self::RESPONSE_KEY_CODE];
  }

  public function setCode($bStatus) {
    $this->aRowData[self::RESPONSE_KEY_CODE] = $bStatus;
  }

  public function getStatus() {
    return $this->aRowData[self::RESPONSE_KEY_STATUS];
  }

  public function setStatus($bStatus) {
    $this->aRowData[self::RESPONSE_KEY_STATUS] = $bStatus;
  }

  public function getMessage() {
    return $this->aRowData[self::RESPONSE_KEY_MESSAGE];
  }

  public function setMessage($vMessage) {
    $this->aRowData[self::RESPONSE_KEY_MESSAGE] = $vMessage;
  }

  public function addToMessage($vMessage) {
    $this->aRowData[self::RESPONSE_KEY_MESSAGE] .= '<br>' . $vMessage;
  }

  public function getRowData() {
    return $this->aRowData;
  }

  public function setRowData($aRowData) {
    $this->aRowData = $aRowData;
  }

  public function htmlResponse() {

    return $this->encodeHtml($this->aRowData);
  }

  public function jsonResponse() {
    return $this->encodeJson($this->aRowData);
  }

  public function xmlResponse() {
    return $this->encodeXml($this->aRowData);
  }

  public function getResponse() {
    $vResponse = '';
    switch ($this->responseType) {
      case self::RESPONSE_TYPE_JSON:
        $vResponse = $this->jsonResponse();
        break;

      case self::RESPONSE_TYPE_XML:
        $vResponse = $this->xmlResponse();
        break;

      case self::RESPONSE_TYPE_HTML:
        $vResponse = $this->htmlResponse();
        break;
      default :
        $vResponse = $this->jsonResponse();
    }
    return $vResponse;
  }

  public function returnResponse() {
    //header($this->getHttpVersion() . " " . $this->getHttpStatusCode() . " " . $this->getHttpStatusMessage());
    //header("Content-Type:" . $this->getContentType());
    echo $this->getResponse();
  }
}
