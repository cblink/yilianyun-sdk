<?php

namespace Cblink\YilianyunSdk;

use Cblink\YilianyunSdk\Kernel\AbstractClient;
use Cblink\YilianyunSdk\Kernel\Contracts\ApiContract;
use Cblink\YilianyunSdk\Exceptions\YilianyunApiException;
use Ramsey\Uuid\Uuid;

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

    public function request(string $method, string $uri, array $options = [])
    {
        try {
            $rsp = $this->getClient()->request($method, $uri, $options);
        } catch (\Throwable $e) {
            $this->app->log->error("请求出现错误 code: {$e->getCode()} message: {$e->getMessage()}");
            throw new YilianyunApiException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }

        return $this->castResponseToType($rsp);
    }

    public function castResponseToType($rsp)
    {
        $data = $rsp->toArray();

        if (isset($data['error']) && intval($data['error']) !== 0) {
            $this->app->log->error("转换响应信息出现错误 error: {$data['error']} error_description: {$data['error_description']}");

            throw new YilianyunApiException($data['error_description'], $data['error']);
        }

        $this->app->log->info('响应信息', $data);

        return $data['body'];
    }
}