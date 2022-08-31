<?php

declare(strict_types=1);

namespace BTCPayServer\Http;

use BTCPayServer\Exception\ConnectException;
use CurlHandle;

/**
 * HTTP Client using cURL to communicate.
 */
class CurlClient implements ClientInterface
{
  private CurlHandle $ch;
  protected array $curlOptions = [];

  /**
   * Inits curl session adding any additional curl options set.
   * @return false|resource
   */
  protected function initCurl(): false|CurlHandle
  {
    // We cannot set a return type here as it is "resource" for PHP < 8 and CurlHandle for PHP >= 8.
    $this->ch = curl_init();
    if (count($this->curlOptions)) {
      curl_setopt_array($this->ch, $this->curlOptions);
    }
    return $this->ch;
  }

  /**
   * Use this method if you need to set any special parameters
   * like disable CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER.
   *
   * @param  array  $options
   * @return void
   */
  public function setCurlOptions(array $options): void
  {
    $this->curlOptions = $options;
  }

  /**
   * @inheritdoc
   */
  public function request(
    string $method,
    string $url,
    array $headers = [],
    string $body = ''
  ): ResponseInterface {
    $flatHeaders = [];
    foreach ($headers as $key => $value) {
      $flatHeaders[] = $key.': '.$value;
    }

    $this->ch = $this->initCurl();
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($this->ch, CURLOPT_HEADER, 1);
    if ($body !== '') {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);
    }
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $flatHeaders);

    $response = curl_exec($this->ch);

    $status = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
    $headerSize = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);

    $responseHeaders = [];
    $responseBody = '';

    if ($response) {
      $responseString = is_string($response) ? $response : '';
      if ($responseString && $headerSize) {
        $responseBody = substr($responseString, $headerSize);
        $headerPart = substr($responseString, 0, $headerSize);
        $headerParts = explode("\n", $headerPart);
        foreach ($headerParts as $headerLine) {
          $headerLine = trim($headerLine);
          if ($headerLine) {
            $parts = explode(':', $headerLine);
            if (count($parts) === 2) {
              $key = $parts[0];
              $value = $parts[1];
              $responseHeaders[$key] = $value;
            }
          }
        }
      }
    } else {
      $errorMessage = curl_error($this->ch);
      $errorCode = curl_errno($this->ch);
      throw new ConnectException($errorMessage, $errorCode);
    }

    return new Response($status, $responseBody, $responseHeaders);
  }
}
