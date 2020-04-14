<?php

namespace Cblink\Yilianyun\Test;

use Cblink\Yilianyun\AccessToken\AccessToken;
use Mockery;
use Cblink\Yilianyun\Application;
use GuzzleHttp\ClientInterface;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function make($client, $data)
    {
        $app = $this->newApplication([
            'http' => ['response_type' => 'raw'],
        ]);

        $response = new TestResponse(200, [], '{"mock": "test"}');

        $app->extend('access_token', function () use ($data) {
            return Mockery::mock(AccessToken::class, function ($mock) use ($data) {
                $mock->shouldReceive('getToken')->andReturn('mock-access_token');

                $data['access_token'] = $mock->getToken();
                $mock->shouldReceive('applyAccessTokenToRequest', $data)->andReturn($data);
            });
        });

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
            'client_id' => 'test-client_id',
            'client_secret' => 'test-client_secret',
        ], $config));
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}