<?php

declare(strict_types=1);

namespace BTCPayServer\Result;

use BTCPayServer\Util\PreciseNumber;

// RESULT:
// {
//     "id": "3ki4jsAkN4u9rv1PUzj1odX4Nx7s",
//     "name": "my test app",
//     "storeId": "9CiNzKoANXxmk5ayZngSXrHTiVvvgCrwrpFQd4m2K776",
//     "created": 1651554744,
//     "appType": "PointOfSale",
//     "title": "My crowdfund app",
//     "description": "My crowdfund description",
//     "enabled": true,
//     "enforceTargetAmount": false,
//     "startDate": 768658369,
//     "endDate": 771336769,
//     "targetCurrency": "BTC",
//     "targetAmount": 420.69,
//     "customCSSLink": "string",
//     "mainImageUrl": "string",
//     "embeddedCSS": "string",
//     "perks": [
//       {
//         "description": null,
//         "id": "test perk",
//         "image": null,
//         "price": {
//           "type": 2,
//           "formatted": "$100.00",
//           "value": 100
//         },
//         "title": "test perk",
//         "buyButtonText": null,
//         "inventory": null,
//         "paymentMethods": null,
//         "disabled": false
//       },
//       {
//         "description": "this is an amazing perk",
//         "id": "test test",
//         "image": "https://mainnet.demo.btcpayserver.org/img/errorpages/404_nicolas.jpg",
//         "price": {
//           "type": 1,
//           "formatted": "$69.42",
//           "value": 69.42
//         },
//         "title": "test test",
//         "buyButtonText": null,
//         "inventory": 5,
//         "paymentMethods": null,
//         "disabled": false
//       },
//       {
//         "description": null,
//         "id": "f$t45hj764325",
//         "image": null,
//         "price": {
//           "type": 0,
//           "formatted": null,
//           "value": null
//         },
//         "title": "amazing perk",
//         "buyButtonText": "button text",
//         "inventory": null,
//         "paymentMethods": null,
//         "disabled": true
//       }
//     ],
//     "notificationUrl": "string",
//     "tagline": "I can't believe it's not butter",
//     "disqusEnabled": true,
//     "disqusShortname": "string",
//     "soundsEnabled": false,
//     "animationsEnabled": true,
//     "resetEveryAmount": 1,
//     "resetEvery": "Day",
//     "displayPerksValue": false,
//     "sortPerksByPopularity": true,
//     "sounds": [
//       "https://github.com/ClaudiuHKS/AdvancedQuakeSounds/raw/master/sound/AQS/doublekill.wav"
//     ],
//     "animationColors": [
//       "#FF0000",
//       "#00FF00",
//       "#0000FF"
//     ]
//   }

class Crowdfund extends AbstractResult
{
    public function getId(): string
    {
        return $this->getData()["id"];
    }

    public function getName(): string
    {
        return $this->getData()["name"];
    }
    // TODO: ...
}
