<?php

declare(strict_types=1);

namespace BTCPayServer\Client;

use BTCPayServer\Result\Crowdfund as ResultCrowdfund;

class Crowdfund extends AbstractClient
{
    // {
    //     "appName": "Kukkstarter",
    //     "title": "My crowdfund app",
    //     "description": "My app description",
    //     "enabled": true,
    //     "enforceTargetAmount": false,
    //     "startDate": 768658369,
    //     "endDate": 771336769,
    //     "targetCurrency": "BTC",
    //     "targetAmount": 420,
    //     "customCSSLink": "string",
    //     "mainImageUrl": "string",
    //     "embeddedCSS": "string",
    //     "perksTemplate": "test_perk:\r\n  price: 100\r\n  title: test perk\r\n  price_type: \"fixed\" \r\n  disabled: false",
    //     "notificationUrl": "string",
    //     "tagline": "I can"t believe it"s not butter",
    //     "disqusShortname": "string",
    //     "soundsEnabled": false,
    //     "animationsEnabled": false,
    //     "resetEveryAmount": 1,
    //     "resetEvery": "Never",
    //     "displayPerksValue": false,
    //     "sortPerksByPopularity": false,
    //     "sounds": [
    //       "https://github.com/ClaudiuHKS/AdvancedQuakeSounds/raw/master/sound/AQS/doublekill.wav"
    //     ],
    //     "animationColors": [
    //       "#0000FF",
    //       "#00FF00",
    //       "#FF0000"
    //     ]
    //   }
    public function createCrowdfund(
        string $storeId,
        ?string $appName,
        ?array $metaData = null,
    ): ResultCrowdfund {
        // https://docs.btcpayserver.org/api/v1/stores/{storeId}/apps/crowdfund

        $url = $this->getApiUrl() . "stores/" . urlencode(
            $storeId
        ) . "/apps/crowdfund";
        $headers = $this->getRequestHeaders();
        $method = "POST";

        // Prepare metadata.
        $metaDataMerged = [];

        // Set metaData if any.
        if ($metaData) {
            $metaDataMerged = $metaData;
        }

        $body = json_encode(
            [
                "appName" => $appName ?? "Demo App Name",
                "metadata" => !empty($metaDataMerged) ? $metaDataMerged : null,
            ],
            JSON_THROW_ON_ERROR
        );

        $response = $this->getHttpClient()->request($method, $url, $headers, $body);

        if ($response->getStatus() === 200) {
            return new ResultCrowdfund(
                json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR)
            );
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }

    public function getCrowdfund(
        string $appId
    ): ResultCrowdfund {
        $url = $this->getApiUrl() . "apps/crowdfund/" . urlencode($appId);
        $headers = $this->getRequestHeaders();
        $method = "GET";
        $response = $this->getHttpClient()->request($method, $url, $headers);

        if ($response->getStatus() === 200) {
            return new ResultCrowdfund(json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR));
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }
}
