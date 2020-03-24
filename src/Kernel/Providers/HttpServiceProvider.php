<?php

namespace Cblink\YilianyunSdk\Kernel\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Psr\Log\LoggerAwareInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['http'] = function ($pimple) {
            $options = $pimple['options']['http'] ?? [
                'timeout' => 10,
            ];

            /** @var HttpClientInterface|LoggerAwareInterface $http */
            $http = HttpClient::create($options);

            $http->setLogger($pimple['log']);

            return $http;
        };

        $pimple->extend('http', function ($http, $pimple) {
            /** @var HttpClientInterface|LoggerAwareInterface $http */
            $http->setLogger($pimple['log']);

            return $http;
        });
    }
}