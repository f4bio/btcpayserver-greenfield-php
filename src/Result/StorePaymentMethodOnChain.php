<?php

declare(strict_types=1);

namespace BTCPayServer\Result;



/**
 *
 * https://docs.btcpayserver.org/API/Greenfield/v1/#tag/Store-Payment-Methods-(On-Chain)
 *
 * [{
 * "enabled": true,
 * "paymentMethod": "string",
 * "derivationScheme": "xpub...",
 * "label": "string",
 * "accountKeyPath": "abcd82a1/84'/0'/0'",
 * "cryptoCode": "string"
 * }]
 *
 */
class StorePaymentMethodOnChain extends AbstractStorePaymentMethodResult
{
  /**
   * @return bool
   */
  public function getEnabled(): bool
  {
    $data = $this->getData();
    return $data["enabled"];
  }

  /**
   * @return string
   */
  public function getPaymentMethod(): string
  {
    $data = $this->getData();
    return $data["paymentMethod"];
  }

  /**
   * @return string
   */
  public function getDerivationScheme(): string
  {
    $data = $this->getData();
    return $data["derivationScheme"];
  }

  /**
   * @return string
   */
  public function getLabel(): string
  {
    $data = $this->getData();
    return $data["label"];
  }

  /**
   * @return string
   */
  public function getAccountKeyPath(): string
  {
    $data = $this->getData();
    return $data["accountKeyPath"];
  }

  /**
   * @return string
   */
  public function getCryptoCode(): string
  {
    $data = $this->getData();
    return $data["cryptoCode"];
  }
}
