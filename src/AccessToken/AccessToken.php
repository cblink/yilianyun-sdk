<?php

namespace Cblink\YilianyunSdk\AccessToken;

use Cblink\YilianyunSdk\Client;
use Cblink\YilianyunSdk\Kernel\AbstractClient;
use Cblink\YilianyunSdk\Kernel\AbstractAccessToken;

class AccessToken extends AbstractAccessToken
{
    protected $expire_in_key = 'expires_in';

    public function getClient(): AbstractClient
    {
        return new Client($this->app);
    }

    public function applyAccessTokenToRequest(array $data = [])
    {
        $data['access_token'] = $this->getToken();

        return $data;
    }

    public function getTokenFromServer()
    {
        return $this->getClient()->post('/oauth/oauth', [
            'grant_type' => 'client_credentials',
            'scope' => 'all',
        ]);
    }

    public function refreshToken()
    {
        return $this->getClient()->post('/oauth/oauth', [
            'grant_type' => 'refresh_token',
            'scope' => 'all',
            'refresh_token' => $this->getRefreshToken(),
        ]);
    }

    public function credential()
    {
        return [
            'client_id' => $this->app['options']['client_id'],
            'client_secret' => $this->app['options']['client_secret'],
        ];
    }
}