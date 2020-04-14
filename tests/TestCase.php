<?php

namespace Cblink\Yilianyun\Test;

use Mockery;
use Cblink\Yilianyun\Application;
use GuzzleHttp\ClientInterface;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function make($client)
    {
        $app = $this->newApplication([
            'http' => ['response_type' => 'raw'],
        ]);

        $response = new TestResponse(200, [], '{"mock": "test"}');

        $app->extend('http', function () use ($response) {
            return Mockery::mock(ClientInterface::class, function ($mock) use ($response) {
                $mock->shouldReceive('request')->withArgs($response->setExpectedArguments())->andReturn($response);
            });
        });

        return new $client($app);
    }


    protected function newApplication(array $config = [])
    {
        return new Application(array_merge([
            'open_user_id' => 'test-open_user_id',
            'open_user_secret' => 'test-open_user_secret',
        ], $config));
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}