<?php

require __DIR__ . '/../vendor/autoload.php';

use BTCPayServer\Client\PullPayment;
use BTCPayServer\Util\PreciseNumber;

class PullPayments
{
  public string $apiKey;
  public string $host;
  public string $storeId;

  public function __construct()
  {
    $this->apiKey = '';
    $this->host = '';
    $this->storeId = '';
  }

  public function getStorePullPayments(): void
  {
    $includeArchived = true;

    try {
      $client = new PullPayment($this->host, $this->apiKey);
      var_dump($client->getStorePullPayments(
        $this->storeId,
        true
      ));
    } catch (\Throwable $e) {
      echo "Error: ".$e->getMessage();
    }
  }

  public function createPullPayment(): void
  {
    $paymentName = 'TestPayout-'.rand(0, 10000000);
    $paymentAmount = PreciseNumber::parseString('0.000001');
    $paymentCurrency = 'BTC';
    $paymentPeriod = null;
    $boltExpiration = 1;
    $autoApproveClaims = false;
    $startsAt = null;
    $expiresAt = null;
    $paymentMethods = ['BTC'];

    try {
      $client = new PullPayment($this->host, $this->apiKey);
      var_dump(
        $client->createPullPayment(
          $this->storeId,
          $paymentName,
          $paymentAmount,
          $paymentCurrency,
          $paymentPeriod,
          $boltExpiration,
          false,
          $startsAt,
          $expiresAt,
          $paymentMethods
        )
      );
    } catch (\Throwable $e) {
      echo "Error: ".$e->getMessage();
    }
  }

  public function archivePullPayment(): void
  {
    $pullPaymentId = '';

    try {
      $client = new PullPayment($this->host, $this->apiKey);
      var_dump($client->archivePullPayment(
        $this->storeId,
        $pullPaymentId
      ));
    } catch (\Throwable $e) {
      echo "Error: ".$e->getMessage();
    }
  }

  public function cancelPayout(): void
  {
    $payoutId = '';

    try {
      $client = new PullPayment($this->host, $this->apiKey);
      var_dump($client->cancelPayout(
        $this->storeId,
        $payoutId
      ));
    } catch (\Throwable $e) {
      echo "Error: ".$e->getMessage();
    }
  }

  public function markPayoutAsPaid(): void
  {
    $payoutId = '';

    try {
      $client = new PullPayment($this->host, $this->apiKey);
      var_dump($client->markPayoutAsPaid(
        $this->storeId,
        $payoutId
      ));
    } catch (\Throwable $e) {
      echo "Error: ".$e->getMessage();
    }
  }

  public function approvePayout(): void
  {
    $payoutId = '';
    try {
      $client = new PullPayment($this->host, $this->apiKey);
      var_dump($client->approvePayout(
        $this->storeId,
        $payoutId,
        0,
        null
      ));
    } catch (\Throwable $e) {
      echo "Error: ".$e->getMessage();
    }
  }

  public function getPullPayment(): void
  {
    $pullPaymentId = '';

    try {
      $client = new PullPayment($this->host, $this->apiKey);
      var_dump($client->getPullPayment(
        $this->storeId,
        $pullPaymentId
      ));
    } catch (\Throwable $e) {
      echo "Error: ".$e->getMessage();
    }
  }

  public function getPayouts(): void
  {
    $pullPaymentId = '';
    $includeCancelled = true;

    try {
      $client = new PullPayment($this->host, $this->apiKey);
      var_dump($client->getPayouts(
        $pullPaymentId,
        true
      ));
    } catch (\Throwable $e) {
      echo "Error: ".$e->getMessage();
    }
  }

  public function createPayout(): void
  {
    $pullPaymentId = '';
    $destination = '';
    $amount = PreciseNumber::parseString('0.000001');
    $paymentMethod = '';

    try {
      $client = new PullPayment($this->host, $this->apiKey);
      var_dump($client->createPayout(
        $pullPaymentId,
        $destination,
        $amount,
        $paymentMethod
      ));
    } catch (\Throwable $e) {
      echo "Error: ".$e->getMessage();
    }
  }

  public function getPayout(): void
  {
    $pullPaymentId = '';
    $payoutId = '';

    try {
      $client = new PullPayment($this->host, $this->apiKey);
      var_dump($client->getPayout(
        $pullPaymentId,
        $payoutId
      ));
    } catch (\Throwable $e) {
      echo "Error: ".$e->getMessage();
    }
  }
}

$pp = new PullPayments();
//$pp->createPullPayment();
//$pp->getStorePullPayments();
//$pp->archivePullPayment();
//$pp->cancelPayout();
//$pp->markPayoutAsPaid();
//$pp->approvePayout();
//$pp->getPullPayment();
//$pp->getPayouts();
//$pp->createPayout();
//$pp->getPayout();
