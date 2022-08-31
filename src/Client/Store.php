<?php

namespace BTCPayServer\Client;

use BTCPayServer\Http\ResponseInterface;
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
   * Create a new store
   *
   * https://docs.btcpayserver.org/API/Greenfield/v1/#operation/Stores_CreateStore
   *
   * @param  string  $name
   * @param  string  $website
   * @param  string  $defaultCurrency
   * @param  int  $invoiceExpiration
   * @param  int  $monitoringExpiration
   * @param  string  $speedPolicy
   * @param  int  $paymentTolerance
   * @param  bool  $anyoneCanCreateInvoice
   * @param  bool  $requiresRefundEmail
   * @param  bool  $lightningAmountInSatoshi
   * @param  bool  $lightningPrivateRouteHints
   * @param  bool  $onChainWithLnInvoiceFallback
   * @param  bool  $redirectAutomatically
   * @param  bool  $showRecommendedFee
   * @param  int  $recommendedFeeBlockTarget
   * @param  string  $defaultLang
   * @param  string  $networkFeeMode
   * @param  bool  $payJoinEnabled
   * @param  bool  $lazyPaymentMethods
   * @param  string  $defaultPaymentMethod
   * @param  string|null  $lightningDescriptionTemplate
   * @param  string|null  $customLogo
   * @param  string|null  $customCSS
   * @param  string|null  $htmlTitle
   * @return Store
   * @throws JsonException
   */
  public function createStore(
    string $name,
    string $website,
    string $defaultCurrency = "USD",
    int $invoiceExpiration = 90,
    int $monitoringExpiration = 90,
    string $speedPolicy = "HighSpeed",
    int $paymentTolerance = 0,
    bool $anyoneCanCreateInvoice = false,
    bool $requiresRefundEmail = false,
    bool $lightningAmountInSatoshi = false,
    bool $lightningPrivateRouteHints = false,
    bool $onChainWithLnInvoiceFallback = false,
    bool $redirectAutomatically = false,
    bool $showRecommendedFee = true,
    int $recommendedFeeBlockTarget = 1,
    string $defaultLang = "en",
    string $networkFeeMode = "MultiplePaymentsOnly",
    bool $payJoinEnabled = false,
    bool $lazyPaymentMethods = false,
    string $defaultPaymentMethod = "BTC",
    string $lightningDescriptionTemplate = null,
    string $customLogo = null,
    string $customCSS = null,
    string $htmlTitle = null,
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
        "paymentTolerance" => $paymentTolerance,
        "anyoneCanCreateInvoice" => $anyoneCanCreateInvoice,
        "requiresRefundEmail" => $requiresRefundEmail,
        "lightningAmountInSatoshi" => $lightningAmountInSatoshi,
        "lightningPrivateRouteHints" => $lightningPrivateRouteHints,
        "onChainWithLnInvoiceFallback" => $onChainWithLnInvoiceFallback,
        "redirectAutomatically" => $redirectAutomatically,
        "showRecommendedFee" => $showRecommendedFee,
        "recommendedFeeBlockTarget" => $recommendedFeeBlockTarget,
        "defaultLang" => $defaultLang,
        "networkFeeMode" => $networkFeeMode,
        "payJoinEnabled" => $payJoinEnabled,
        "lazyPaymentMethods" => $lazyPaymentMethods,
        "defaultPaymentMethod" => $defaultPaymentMethod,
        "lightningDescriptionTemplate" => $lightningDescriptionTemplate,
        "customLogo" => $customLogo,
        "customCSS" => $customCSS,
        "htmlTitle" => $htmlTitle,
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
   * Delete Store
   *
   * Removes the specified store. If there is another user with access, only your access will be removed.
   *
   * https://docs.btcpayserver.org/API/Greenfield/v1/#operation/Stores_DeleteStore
   *
   * @param  string  $storeId
   * @return ResponseInterface
   */
  public function deleteStore(string $storeId): ResponseInterface
  {
    $url = $this->getApiUrl()."stores/".urlencode($storeId);

    $headers = $this->getRequestHeaders();
    $method = "DELETE";

    return $this->getHttpClient()->request($method, $url, $headers);
  }
}
