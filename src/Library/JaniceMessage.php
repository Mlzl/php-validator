<?php
/**
 * @author ambi
 * @date 2018/8/1
 */

namespace Janice\Library;


class JaniceMessage
{
    private $code;
    private $message;

    public function __construct($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function __toString()
    {
        return "[code:{$this->code}][message:{$this->message}]";
    }
}