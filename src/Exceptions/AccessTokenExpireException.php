<?php

namespace Cblink\Yilianyun\Exceptions;

class AccessTokenExpireException extends Exception
{
    protected $code = 18;

    const CODE = 18;
}