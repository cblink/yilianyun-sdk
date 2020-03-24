<?php

namespace Cblink\Yilianyun;

use Mouyong\Foundation\Foundation;
use Cblink\Yilianyun\Printer\Printer;
use Cblink\Yilianyun\Printer\PrinterServiceProvider;
use Cblink\Yilianyun\AccessToken\AccessTokenServiceProvider;

/**
 * Class Application
 * @package Cblink\Yilianyun
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