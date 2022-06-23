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
   * Create a new Store
   *
   * @throws JsonException
   */
  public function createStore(
    string $name,
    string $website = null,
    string $defaultCurrency = "BTC",
    int $invoiceExpiration = 90,
    int $monitoringExpiration = 90,
    string $speedPolicy = "HighSpeed",
    string $lightningDescriptionTemplate = null,
    int $paymentTolerance = 0,
    bool $anyoneCanCreateInvoice = false,
    bool $requiresRefundEmail = false,
    bool $lightningAmountInSatoshi = false,
    bool $lightningPrivateRouteHints = false,
    bool $onChainWithLnInvoiceFallback = false,
    bool $redirectAutomatically = false,
    bool $showRecommendedFee = true,
    string $defaultLang = "en",
    string $customLogo = "",
    string $customCSS = "",
    string $htmlTitle = "",
    string $networkFeeMode = "MultiplePaymentsOnly",
    bool $payJoinEnabled = false,
    bool $lazyPaymentMethods = false,
    string $defaultPaymentMethod = "BTC"
  ): \BTCPayServer\Result\ApiKey {
    $url = $this->getApiUrl()."stores";

    $headers = $this->getRequestHeaders();
    $method = "POST";

    $body = json_encode(
      [
        "name" => $name,
        "website" => $website,
        "defaultCurrency" => $defaultCurrency,
        "invoiceExpiration" => $invoiceExpiration,
        "monitoringExpiration" => $monitoringExpiration,
        "speedPolicy" => $speedPolicy,
        "lightningDescriptionTemplate" => $lightningDescriptionTemplate,
        "paymentTolerance" => $paymentTolerance,
        "anyoneCanCreateInvoice" => $anyoneCanCreateInvoice,
        "requiresRefundEmail" => $requiresRefundEmail,
        "lightningAmountInSatoshi" => $lightningAmountInSatoshi,
        "lightningPrivateRouteHints" => $lightningPrivateRouteHints,
        "onChainWithLnInvoiceFallback" => $onChainWithLnInvoiceFallback,
        "redirectAutomatically" => $redirectAutomatically,
        "showRecommendedFee" => $showRecommendedFee,
        "defaultLang" => $defaultLang,
        "customLogo" => $customLogo,
        "customCSS" => $customCSS,
        "htmlTitle" => $htmlTitle,
        "networkFeeMode" => $networkFeeMode,
        "payJoinEnabled" => $payJoinEnabled,
        "lazyPaymentMethods" => $lazyPaymentMethods,
        "defaultPaymentMethod" => $defaultPaymentMethod
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
