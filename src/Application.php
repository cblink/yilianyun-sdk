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
        // 登录后打开 https://dev.10ss.net/admin/listapp ，点击具体的应用进行查看
        'client_id' => 'your-client-id',
        'client_secret' => 'your-client-secret',

        'log' => [
            'name' => 'yilianyun',
        ],
        'http' => [
            'timeout' => 3,
            'base_uri' => 'https://open-api.10ss.net',
            'http_errors' => false,
            'headers' => [
                'content-type' => 'application/x-www-form-urlencode',
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