<?php

namespace Cblink\Yilianyun\Test;

use Cblink\Yilianyun\Application;

class ApplicationTest extends TestCase
{
    /** @test */
    public function services()
    {
        $app = new Application();

        $baseServices = [
            'options' => \Mouyong\Foundation\Collection::class,
            'cache' => \Symfony\Component\Cache\Adapter\FilesystemAdapter::class,
            'log' => \Monolog\Logger::class,
            'request' => \Symfony\Component\HttpFoundation\Request::class,
            'http' => \GuzzleHttp\Client::class,
        ];

        $services = array_merge($baseServices, [
            'access_token' => \Cblink\Yilianyun\AccessToken\AccessToken::class,
            'printer' => \Cblink\Yilianyun\Printer\Printer::class,
        ]);

        $this->assertCount(count($services), $app->keys());
        foreach ($services as $name => $service) {
            $this->assertInstanceof($service, $app->{$name});
            $this->assertInstanceof($service, $app[$name]);
        }
    }
}