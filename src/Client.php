<?php

namespace Cblink\Yilianyun;

use Ramsey\Uuid\Uuid;
use Mouyong\Foundation\AbstractClient;
use Mouyong\Foundation\Contracts\ApiContract;
use Cblink\Yilianyun\Exceptions\YilianyunApiException;
use Cblink\Yilianyun\Exceptions\AccessTokenExpireException;
use Cblink\Yilianyun\Exceptions\MethodRetryTooManyException;

class Client extends AbstractClient implements ApiContract
{
    public function sign(array $data = []): array
    {
        $data['client_id'] = $this->app['options']['client_id'];
        $data['client_secret'] = $this->app['options']['client_secret'];

        $data['timestamp'] = time();

        $signStr = $data['client_id'].$data['timestamp'].$data['client_secret'];

        $data['sign'] = md5($signStr);
        $data['id'] = strtoupper(Uuid::uuid4()->toString());

        unset($data['client_secret']);

        return $data;
    }

    public function request(string $method, string $uri, array $options = [], $retry = 1)
    {
        if ($retry === -1) {
            throw new MethodRetryTooManyException("In SDK: uri: {$uri} 重试次数过多", AccessTokenExpireException::CODE);
        }

        try {
            $rsp = $this->getClient()->request($method, $uri, $options);
        } catch (\Throwable $e) {
            $this->app->log->info('request', [
                'method' => $method,
                'uri' => $uri,
                'options' => $options,
                'retry' => $retry,
            ]);
            $this->app->log->error("请求出现错误 code: {$e->getCode()} message: {$e->getMessage()}");
            throw new YilianyunApiException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }

        try {
            return $this->castResponseToType($rsp);
        } catch (AccessTokenExpireException $e) {
            $this->app->log->error("access_token 过期 code: {$e->getCode()} message: {$e->getMessage()}");

            $this->app->access_token->token(true);
            return $this->request($method, $uri, $options, --$retry);
        } catch (\Throwable $e) {
            $this->app->log->error("转换响应信息出现错误 error: {$e->getCode()} error_description: {$e->getMessage()} , request data ", $options);

            throw $e;
        }
    }

    public function castResponseToType($rsp)
    {
        $data = json_decode($rsp->getBody()->getContents(), true);

        if (empty($data)) {
            $this->app->log->error('响应数据为空');

            throw new YilianyunApiException('响应数据为空', 500);
        }

        if (isset($data['error']) && intval($data['error']) === AccessTokenExpireException::CODE) {
            $this->app->log->error("转换响应信息出现错误 error: {$data['error']} error_description: {$data['error_description']}");

            throw new AccessTokenExpireException($data['error_description'], $data['error']);
        }

        if (isset($data['error']) && intval($data['error']) !== 0) {

            throw new YilianyunApiException($data['error_description'], $data['error']);
        }

        $this->app->log->info('响应信息', $data);


        return $data['body'] ?? $data;
    }
}