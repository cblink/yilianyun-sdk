<?php

namespace Cblink\YilianyunSdk;

use Cblink\YilianyunSdk\Printer\Printer;
use Cblink\YilianyunSdk\Kernel\Foundation;
use Cblink\YilianyunSdk\Printer\PrinterServiceProvider;
use Cblink\YilianyunSdk\AccessToken\AccessTokenServiceProvider;

/**
 * Class Application
 * @package Cblink\YilianyunSdk
 *
 * @property-read Kernel\Log $log
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