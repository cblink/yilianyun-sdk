<?php

namespace Cblink\Yilianyun\Test;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Assert;

class TestResponse extends Response
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var array
     */
    protected $options;

    /**
     * Request arguments.
     *
     * @return \Closure
     */
    public function setExpectedArguments()
    {
        return function () {
            list($this->method, $this->uri, $this->options) = func_get_args();

            return true;
        };
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     *
     * @param string $method
     *
     * @return $this
     */
    public function assertMethod($method)
    {
        Assert::assertSame($this->method, $method);

        return $this;
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     *
     * @param string $uri
     *
     * @return $this
     */
    public function assertUri($uri)
    {
        Assert::assertSame($this->uri, $uri);

        return $this;
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     *
     * @param string $uri
     *
     * @return $this
     */
    public function assertGetUri($uri)
    {
        return $this->assertMethod('GET')->assertUri($uri);
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     *
     * @param string $uri
     *
     * @return $this
     */
    public function assertPostUri($uri)
    {
        return $this->assertMethod('POST')->assertUri($uri);
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     *
     * @param array $query
     *
     * @return $this
     */
    public function assertQuery($query)
    {
        Assert::assertSame($this->options['query'], $query);

        return $this;
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     *
     * @return $this
     */
    public function assertEmptyQuery()
    {
        return $this->assertQuery([]);
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     *
     * @param array $json
     *
     * @return $this
     */
    public function assertPostJson($json)
    {
        $this->assertSignature('json');

        Assert::assertSame($this->options['json'], $json);

        return $this;
    }

    /**
     * @param array $params
     *
     * @return $this
     */
    public function assertPostFormParams($params)
    {
        $this->assertSignature('form_params');

        Assert::assertSame($this->options['form_params'], $params);

        return $this;
    }

    public function assertSignature($key)
    {
        $signatureKey = [
            'client_id',
            'access_token',
            'timestamp',
            'sign',
            'id',
        ];

        foreach ($signatureKey as $field) {
            Assert::assertArrayHasKey($field, $this->options[$key]);
            unset($this->options[$key][$field]);
        }
    }
}