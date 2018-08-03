<?php

namespace Janice\Exception;

use Throwable;

/**
 * @author ambi
 * @date 2018/8/1
 */
class DislikeException extends \Exception
{
    public function __construct($message = "", $code = 520, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}