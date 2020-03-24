<?php

namespace Cblink\YilianyunSdk\Kernel;

use Monolog\Logger;
use Pimple\Container;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Cblink\YilianyunSdk\Kernel\Providers\LogServiceProvider;
use Cblink\YilianyunSdk\Kernel\Providers\HttpServiceProvider;
use Cblink\YilianyunSdk\Kernel\Providers\CacheServiceProvider;
use Cblink\YilianyunSdk\Kernel\Providers\RequestServiceProvider;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Foundation
 * @package Cblink\YilianyunSdk\Kernel
 *
 * @property-read AbstractAccessToken $access_token
 * @property-read FilesystemAdapter $cache
 * @property-read Logger $log
 * @property-read AbstractClient|CurlHttpClient|NativeHttpClient $http
 * @property-read Request $request
 */
class Foundation extends Container
{
    private $baseProviders = [
        CacheServiceProvider::class,
        LogServiceProvider::class,
        RequestServiceProvider::class,
        HttpServiceProvider::class,
    ];

    protected $providers = [];

    protected $config = [];

    public function __construct(array $options = [])
    {
        parent::__construct();

        $this['options'] = function () use ($options) {
            return new Collection(array_merge($this->config, $options));
        };

        foreach ($this->providers() as $provider) {
            $this->register(new $provider);
        }
    }

    public function providers()
    {
        return array_merge($this->baseProviders, $this->providers);
    }

    public function __get($name)
    {
        return $this[$name];
    }
}