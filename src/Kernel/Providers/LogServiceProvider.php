<?php

namespace Cblink\YilianyunSdk\Kernel\Providers;

use Pimple\Container;
use Cblink\YilianyunSdk\Kernel\Log;
use Pimple\ServiceProviderInterface;

class LogServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['log'] = function ($pimple) {
            $name = $pimple['options']['log']['name'] ?? 'foundation';

            return Log::getLogger()->withName($name);
        };
    }
}