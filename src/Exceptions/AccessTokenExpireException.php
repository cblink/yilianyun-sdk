<?php

namespace Cblink\YilianyunSdk\Exceptions;

class AccessTokenExpireException extends Exception
{
    protected $code = 18;

    const CODE = 18;
}