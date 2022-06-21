<?php

namespace BTCPayServer\Client;

use JsonException;

class Store extends AbstractClient
{
  /**
   * @throws JsonException
   */
  public function getStore($storeId): \BTCPayServer\Result\Store
  {
    $url = $this->getApiUrl()."stores/".urlencode($storeId);
    $headers = $this->getRequestHeaders();
    $method = "GET";
    $response = $this->getHttpClient()->request($method, $url, $headers);

    if ($response->getStatus() === 200) {
      return new \BTCPayServer\Result\Store(json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR));
    } else {
      throw $this->getExceptionByStatusCode($method, $url, $response);
    }
  }

  /**
   * @return \BTCPayServer\Result\Store[]
   */
  public function getStores(): array
  {
    $url = $this->getApiUrl()."stores";
    $headers = $this->getRequestHeaders();
    $method = "GET";
    $response = $this->getHttpClient()->request($method, $url, $headers);

    if ($response->getStatus() === 200) {
      $r = [];
      $data = json_decode($response->getBody(), true);
      foreach ($data as $item) {
        $item = new \BTCPayServer\Result\Store($item);
        $r[] = $item;
      }
      return $r;
    } else {
      throw $this->getExceptionByStatusCode($method, $url, $response);
    }
  }


  /**
   *
   * TODO:
   *
   * {
   * "name": "string",
   * "website": "string",
   * "defaultCurrency": "USD",
   * "invoiceExpiration": 90,
   * "monitoringExpiration": 90,
   * "speedPolicy": "HighSpeed",
   * "lightningDescriptionTemplate": "string",
   * "paymentTolerance": 0,
   * "anyoneCanCreateInvoice": false,
   * "requiresRefundEmail": false,
   * "lightningAmountInSatoshi": false,
   * "lightningPrivateRouteHints": false,
   * "onChainWithLnInvoiceFallback": false,
   * "redirectAutomatically": false,
   * "showRecommendedFee": true,
   * "recommendedFeeBlockTarget": 1,
   * "defaultLang": "en",
   * "customLogo": "string",
   * "customCSS": "string",
   * "htmlTitle": "string",
   * "networkFeeMode": "MultiplePaymentsOnly",
   * "payJoinEnabled": false,
   * "lazyPaymentMethods": false,
   * "defaultPaymentMethod": "BTC"
   * }
   *
   * @throws JsonException
   */
  public function createStore(
    string $name,
    string $website,
    string $defaultCurrency,
    string $invoiceExpiration,
    string $monitoringExpiration,
    string $speedPolicy,
    string $lightningDescriptionTemplate,
    string $paymentTolerance
  ): \BTCPayServer\Result\ApiKey {
    $url = $this->getApiUrl()."stores";

    $headers = $this->getRequestHeaders();
    $method = "POST";

    $body = json_encode(
      [
        "name" => $name,
        "website" => $website,
        // ...
        // TODO:
      ],
      JSON_THROW_ON_ERROR
    );

    $response = $this->getHttpClient()->request($method, $url, $headers, $body);

    if ($response->getStatus() === 200) {
      return new \BTCPayServer\Result\ApiKey(
        json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR)
      );
    } else {
      throw $this->getExceptionByStatusCode($method, $url, $response);
    }
  }
}
