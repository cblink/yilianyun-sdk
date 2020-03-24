<?php

namespace Cblink\YilianyunSdk;

use Cblink\YilianyunSdk\Kernel\Foundation;
use Cblink\YilianyunSdk\AccessToken\AccessTokenServiceProvider;

/**
 * Class Application
 * @package Cblink\YilianyunSdk
 *
 * @property-read Kernel\Log $log
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
    ];
}