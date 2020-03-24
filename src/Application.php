<?php

namespace Cblink\YilianyunSdk;

use Mouyong\Foundation\Foundation;
use Cblink\YilianyunSdk\Printer\Printer;
use Cblink\YilianyunSdk\Printer\PrinterServiceProvider;
use Cblink\YilianyunSdk\AccessToken\AccessTokenServiceProvider;

/**
 * Class Application
 * @package Cblink\YilianyunSdk
 *
 * @property-read \Mouyong\Foundation\Log $log
 * @property-read Printer $printer
 */
class Application extends Foundation
{
    protected $config = [
        'log' => [
            'name' => 'yilianyun',
        ],
        'http' => [
            'timeout' => 10,
            'base_uri' => 'https://open-api.10ss.net',
            'headers' => [
                'accept' => 'application/json',
            ],
        ],
        'cache' => [
            'namespace' => 'yilianyun',
        ],
    ];

    protected $providers = [
        AccessTokenServiceProvider::class,
        PrinterServiceProvider::class,
    ];
}