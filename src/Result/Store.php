<?php

declare(strict_types=1);

namespace BTCPayServer\Result;

/**
 * Stores
 *
 * https://docs.btcpayserver.org/API/Greenfield/v1/#tag/Stores
 *
 * [{
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
 * "receipt": {
 * "enabled": true,
 * "showQR": null,
 * "showPayments": null
 * },
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
 * "defaultPaymentMethod": "BTC",
 * "id": "string"
 * }]
 *
 */
class Store extends AbstractResult
{
  /**
   * @return string
   */
  public function getName(): string
  {
    $data = $this->getData();
    return $data['name'];
  }

  /**
   * @return string
   */
  public function getWebsite(): string
  {
    $data = $this->getData();
    return $data['website'];
  }

  /**
   * @return string
   */
  public function getDefaultCurrency(): string
  {
    $data = $this->getData();
    return $data['defaultCurrency'];
  }

  /**
   * @return int
   */
  public function getInvoiceExpiration(): int
  {
    $data = $this->getData();
    return $data['invoiceExpiration'];
  }

  /**
   * @return int
   */
  public function getMonitoringExpiration(): int
  {
    $data = $this->getData();
    return $data['monitoringExpiration'];
  }

  /**
   * @return string
   */
  public function getSpeedPolicy(): string
  {
    $data = $this->getData();
    return $data['speedPolicy'];
  }

  /**
   * @return string
   */
  public function getLightningDescriptionTemplate(): string
  {
    $data = $this->getData();
    return $data['lightningDescriptionTemplate'];
  }

  /**
   * @return int
   */
  public function getPaymentTolerance(): int
  {
    $data = $this->getData();
    return $data['paymentTolerance'];
  }

  /**
   * @return bool
   */
  public function anyoneCanCreateInvoice(): bool
  {
    $data = $this->getData();
    return $data['anyoneCanCreateInvoice'];
  }

  /**
   * @return bool
   */
  public function requiresRefundEmail(): bool
  {
    $data = $this->getData();
    return $data['requiresRefundEmail'];
  }

  /**
   * @return bool
   */
  public function lightningAmountInSatoshi(): bool
  {
    $data = $this->getData();
    return $data['lightningAmountInSatoshi'];
  }

  /**
   * @return bool
   */
  public function lightningPrivateRouteHints(): bool
  {
    $data = $this->getData();
    return $data['lightningPrivateRouteHints'];
  }

  /**
   * @return bool
   */
  public function onChainWithLnInvoiceFallback(): bool
  {
    $data = $this->getData();
    return $data['onChainWithLnInvoiceFallback'];
  }

  /**
   * @return bool
   */
  public function redirectAutomatically(): bool
  {
    $data = $this->getData();
    return $data['redirectAutomatically'];
  }

  /**
   * @return bool
   */
  public function showRecommendedFee(): bool
  {
    $data = $this->getData();
    return $data['showRecommendedFee'];
  }

  /**
   * @return int
   */
  public function getRecommendedFeeBlockTarget(): int
  {
    $data = $this->getData();
    return $data['recommendedFeeBlockTarget'];
  }

  /**
   * @return string
   */
  public function getDefaultLang(): string
  {
    $data = $this->getData();
    return $data['defaultLang'];
  }

  /**
   * @return string
   */
  public function getCustomLogo(): string
  {
    $data = $this->getData();
    return $data['customLogo'];
  }

  /**
   * @return string
   */
  public function getCustomCSS(): string
  {
    $data = $this->getData();
    return $data['customCSS'];
  }

  /**
   * @return string
   */
  public function getHtmlTitle(): string
  {
    $data = $this->getData();
    return $data['htmlTitle'];
  }

  /**
   * @return string
   */
  public function getNetworkFeeMode(): string
  {
    $data = $this->getData();
    return $data['networkFeeMode'];
  }

  /**
   * @return bool
   */
  public function payJoinEnabled(): bool
  {
    $data = $this->getData();
    return $data['payJoinEnabled'];
  }

  /**
   * @return bool
   */
  public function lazyPaymentMethods(): bool
  {
    $data = $this->getData();
    return $data['lazyPaymentMethods'];
  }

  /**
   * @return string
   */
  public function getDefaultPaymentMethod(): string
  {
    $data = $this->getData();
    return $data['defaultPaymentMethod'];
  }

  /**
   * @return string
   */
  public function getId(): string
  {
    $data = $this->getData();
    return $data['id'];
  }
}
