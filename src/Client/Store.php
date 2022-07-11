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
   * https://docs.btcpayserver.org/API/Greenfield/v1/#tag/Stores/paths/~1api~1v1~1stores/post
   *
   * @param  string  $name  The name of the store
   * @param  string|null  $website  The absolute url of the store
   * @param  string  $defaultCurrency
   * @param  int  $invoiceExpiration
   * @param  int  $monitoringExpiration
   * @param  string  $speedPolicy
   * @param  string|null  $lightningDescriptionTemplate
   * @param  int  $paymentTolerance
   * @param  bool  $anyoneCanCreateInvoice
   * @param  bool  $requiresRefundEmail
   * @param  bool  $lightningAmountInSatoshi
   * @param  bool  $lightningPrivateRouteHints
   * @param  bool  $onChainWithLnInvoiceFallback
   * @param  bool  $redirectAutomatically
   * @param  bool  $showRecommendedFee
   * @param  string  $defaultLang
   * @param  string|null  $customLogo
   * @param  string|null  $customCSS
   * @param  string|null  $htmlTitle
   * @param  string  $networkFeeMode
   * @param  bool  $payJoinEnabled
   * @param  bool  $lazyPaymentMethods
   * @param  string  $defaultPaymentMethod
   * @return \BTCPayServer\Result\Store
   * @throws JsonException
   */
  public function createStore(
    string $name,
    string $website = null,
    string $defaultCurrency = "USD",
    int $invoiceExpiration = 900,
    int $monitoringExpiration = 3600,
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
    string $customLogo = null,
    string $customCSS = null,
    string $htmlTitle = null,
    string $networkFeeMode = "MultiplePaymentsOnly",
    bool $payJoinEnabled = false,
    bool $lazyPaymentMethods = false,
    string $defaultPaymentMethod = "USD"
  ): \BTCPayServer\Result\Store {
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
      return new \BTCPayServer\Result\Store(
        json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR)
      );
    } else {
      throw $this->getExceptionByStatusCode($method, $url, $response);
    }
  }

  /**
   *
   * Remove store
   * Removes the specified store. If there is another user with access, only your access will be removed.
   *
   * https://docs.btcpayserver.org/API/Greenfield/v1/#tag/Stores/paths/~1api~1v1~1stores~1{storeId}/delete
   *
   * @param  string  $storeId
   * @return bool
   */
  public function removeStore(string $storeId): bool
  {
    $url = $this->getApiUrl()."stores".$storeId;

    $headers = $this->getRequestHeaders();
    $method = "DELETE";

    $response = $this->getHttpClient()->request($method, $url, $headers);

    if ($response->getStatus() === 200) {
      return true;
    } else {
      throw $this->getExceptionByStatusCode($method, $url, $response);
    }
  }
}
