<?php

declare(strict_types=1);

namespace BTCPayServer\Client;

use BTCPayServer\Exception\BadRequestException;
use BTCPayServer\Exception\ForbiddenException;
use BTCPayServer\Exception\RequestException;
use BTCPayServer\Http\ClientInterface;
use BTCPayServer\Http\CurlClient;
use BTCPayServer\Http\Response;

class AbstractClient
{
  /** @var string */
  private string $apiKey;
  /** @var string */
  private string $baseUrl;
  /** @var string */
  private string $apiPath = '/api/v1/';
  /** @var ClientInterface */
  private ClientInterface $httpClient;

  public function __construct(string $baseUrl, string $apiKey, ClientInterface $client = null)
  {
    $this->baseUrl = rtrim($baseUrl, '/');
    $this->apiKey = $apiKey;

    // Use the $client parameter to use a custom cURL client,
    // for example if you need to disable CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER
    if ($client === null) {
      $client = new CurlClient();
    }
    $this->httpClient = $client;
    $this->testConnection();
  }

  protected function getBaseUrl(): string
  {
    return $this->baseUrl;
  }

  protected function getApiUrl(): string
  {
    return $this->baseUrl.$this->apiPath;
  }

  protected function getFullUrl(string $remaining): string
  {
    return sprintf("%s/%s/%s", $this->baseUrl, $this->apiPath, $remaining);
  }

  protected function getApiKey(): string
  {
    return $this->apiKey;
  }

  protected function getHttpClient(): ClientInterface
  {
    return $this->httpClient;
  }

  protected function testConnection(): void
  {
    $this->httpClient->request('GET', $this->getApiUrl());
  }

  protected function getRequestHeaders(): array
  {
    return [
      'Accept' => 'application/json',
      'Content-Type' => 'application/json',
      'Authorization' => 'token '.$this->getApiKey()
    ];
  }

  protected function getExceptionByStatusCode(
    string $method,
    string $url,
    Response $response
  ): RequestException {
    $exceptions = [
      ForbiddenException::STATUS => ForbiddenException::class,
      BadRequestException::STATUS => BadRequestException::class,
    ];

    $class = $exceptions[$response->getStatus()] ?? RequestException::class;
    return new $class($method, $url, $response);
  }
}
