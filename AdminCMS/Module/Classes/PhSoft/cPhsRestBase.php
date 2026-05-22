<?php

/**
 * Description of PhsRestVase
 * RESTful web services base class
 * Version 1.0.1
 *
 * @author Haytham
 */
class cPhsRestBase {

  public const RESPONSE_TYPE_JSON = 0;
  public const RESPONSE_TYPE_XML = 1;
  public const RESPONSE_TYPE_HTML = 2;
  //
  public const HTTP_CODE_CONTINUE = 100;
  public const HTTP_CODE_SWITCHING_PROTOCOLS = 101;
  public const HTTP_CODE_OK = 200;
  public const HTTP_CODE_CREATED = 201;
  public const HTTP_CODE_ACCEPTED = 202;
  public const HTTP_CODE_NON_AUTHORITATIVE_INFORMATION = 203;
  public const HTTP_CODE_NO_CONTENT = 204;
  public const HTTP_CODE_RESET_CONTENT = 205;
  public const HTTP_CODE_PARTIAL_CONTENT = 206;
  public const HTTP_CODE_MULTIPLE_CHOICES = 300;
  public const HTTP_CODE_MOVED_PERMANENTLY = 301;
  public const HTTP_CODE_FOUND = 302;
  public const HTTP_CODE_SEE_OTHER = 303;
  public const HTTP_CODE_NOT_MODIFIED = 304;
  public const HTTP_CODE_USE_PROXY = 305;
  public const HTTP_CODE_UNUSED = 306;
  public const HTTP_CODE_TEMPORARY_REDIRECT = 307;
  public const HTTP_CODE_BAD_REQUEST = 400;
  public const HTTP_CODE_UNAUTHORIZED = 401;
  public const HTTP_CODE_PAYMENT_REQUIRED = 402;
  public const HTTP_CODE_FORBIDDEN = 403;
  public const HTTP_CODE_NOT_FOUND = 404;
  public const HTTP_CODE_METHOD_NOT_ALLOWED = 405;
  public const HTTP_CODE_NOT_ACCEPTABLE = 406;
  public const HTTP_CODE_PROXY_AUTHENTICATION_REQUIRED = 407;
  public const HTTP_CODE_REQUEST_TIMEOUT = 408;
  public const HTTP_CODE_CONFLICT = 409;
  public const HTTP_CODE_GONE = 410;
  public const HTTP_CODE_LENGTH_REQUIRED = 411;
  public const HTTP_CODE_PRECONDITION_FAILED = 412;
  public const HTTP_CODE_REQUEST_ENTITY_TOO_LARGE = 413;
  public const HTTP_CODE_REQUEST_URI_TOO_LONG = 414;
  public const HTTP_CODE_UNSUPPORTED_MEDIA_TYPE = 415;
  public const HTTP_CODE_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
  public const HTTP_CODE_EXPECTATION_FAILED = 417;
  public const HTTP_CODE_INTERNAL_SERVER_ERROR = 500;
  public const HTTP_CODE_NOT_IMPLEMENTED = 501;
  public const HTTP_CODE_BAD_GATEWAY = 502;
  public const HTTP_CODE_SERVICE_UNAVAILABLE = 503;
  public const HTTP_CODE_GATEWAY_TIMEOUT = 504;
  public const HTTP_CODE_HTTP_VERSION_NOT_SUPPORTED = 505;

  private $aContentType = array(
    0 => 'application/json; charset = UTF-8',
    1 => 'application/xml; charset = UTF-8',
    2 => 'application/html; charset = UTF-8'
  );
  private $httpVersion = "HTTP/1.1";
  private $httpStatusCode = '404';
  private $httpStatusMessage = 'Not Found';
  private static $aHttpStatus = array(
    100 => 'Continue',
    101 => 'Switching Protocols',
    200 => 'OK',
    201 => 'Created',
    202 => 'Accepted',
    203 => 'Non-Authoritative Information',
    204 => 'No Content',
    205 => 'Reset Content',
    206 => 'Partial Content',
    300 => 'Multiple Choices',
    301 => 'Moved Permanently',
    302 => 'Found',
    303 => 'See Other',
    304 => 'Not Modified',
    305 => 'Use Proxy',
    306 => '(Unused)',
    307 => 'Temporary Redirect',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Request Entity Too Large',
    414 => 'Request-URI Too Long',
    415 => 'Unsupported Media Type',
    416 => 'Requested Range Not Satisfiable',
    417 => 'Expectation Failed',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout',
    505 => 'HTTP Version Not Supported'
  );

  public function getHttpVersion() {
    return $this->httpVersion;
  }

  public function setHttpVersion($httpVersion) {
    $this->httpVersion = $httpVersion;
  }

  public function getHttpStatusCode() {
    return $this->httpStatusCode;
  }

  public function setHttpStatus($statusCode) {
    $this->httpStatusCode = $statusCode;
    $this->httpStatusMessage = self::statusMessage($statusCode);
  }

  public function getHttpStatusMessage() {
    return $this->httpStatusMessage;
  }

  public function getHttpStatusCodeMessage($statusCode) {
    return self::statusMessage($statusCode);
  }

  public function setHttpHeaders($statusCode) {
    $this->setHttpStatus($statusCode);
    header($this->httpVersion . " " . $statusCode . " " . $this->httpStatusMessage);
    header("Content-Type:" . $this->getContentType());
  }

  public function getContentType($contentType = 0) {
    return ($this->aContentType[$contentType] ? $this->aContentType[$contentType] : $this->aContentType[0]);
  }

  public function encodeHtml($aResponseData) {

    $htmlResponse = "<table border='1'>";
    foreach ($aResponseData as $key => $value) {
      $htmlResponse .= "<tr><td>" . $key . "</td><td>" . $value . "</td></tr>";
    }
    $htmlResponse .= "</table>";
    return $htmlResponse;
  }

  public function encodeJson($aResponseData) {
    $jsonResponse = json_encode($aResponseData);
    return $jsonResponse;
  }

  public function encodeXml($aResponseData) {
    // creating object of SimpleXMLElement
    $xml = new SimpleXMLElement('<?xml version = "1.0"?><webservice></webservice>');
    foreach ($aResponseData as $key => $value) {
      $xml->addChild($key, $value);
    }
    return $xml->asXML();
  }

  public static function statusMessage($statusCode) {
    return (self::$aHttpStatus[$statusCode]) ? self::$aHttpStatus[$statusCode] : self::$aHttpStatus[404];
  }

}
