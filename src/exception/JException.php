<?php

namespace Janice\Exception;

use Throwable;

/**
 * @author ambi
 * @date 2018/8/1
 */
class JException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}