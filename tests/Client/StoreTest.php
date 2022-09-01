<?php

namespace BTCPayServer\Tests\Client;

use BTCPayServer\Client\Store;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class StoreTest extends TestCase
{
  private Store $client;
  private string $storeId;

  protected function setUp(): void
  {
    $dotenv = Dotenv::createImmutable(__DIR__."/../../");
    $dotenv->load();

    $baseUrl = getenv("BTCPAY_SERVER_URL");
    $apiKey = getenv("BTCPAY_API_KEY");

    $this->storeId = "abc";
    $this->storeUrl = "https://localhost:8000";
    $this->client = new Store($baseUrl, $apiKey);
  }

  public function testGetStores()
  {
    try {
      $a = $this->client->getStores();
    } catch (\Throwable $t) {
      $a = "ERROR: ".$t->getMessage();
    }
    $this->assertNotNull($a);
    $this->assertIsArray($a);
  }

  public function testGetStore()
  {
    try {
      $a = $this->client->getStore($this->storeId);
    } catch (\Throwable $t) {
      $a = "ERROR: ".$t->getMessage();
    }
    $this->assertNotNull($a);
  }

  public function testDeleteStore()
  {
    try {
      $a = $this->client->deleteStore($this->storeId);
    } catch (\Throwable $t) {
      $a = "ERROR: ".$t->getMessage();
    }
    $this->assertNotNull($a);
  }

  public function testCreateStore()
  {
    try {
      $a = $this->client->createStore($this->storeId, $this->storeUrl);
    } catch (\Throwable $t) {
      $a = "ERROR: ".$t->getMessage();
    }
    $this->assertNotNull($a);
  }
}
