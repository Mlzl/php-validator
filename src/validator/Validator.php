<?php

namespace Janice\Validator;

/**
 * @author ambi
 * @date 2018/8/1
 */

namespace Janice\Validator;


use Janice\Exception\JException;
use Janice\Validation;

abstract class Validator
{
    protected $options = [];

    protected $defaultCode = 0;
    protected $defaultMessage = ':field Unknown Error!';

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * 是否结束验证
     * @return bool
     */
    public function isFinish()
    {
        return isset($this->options['finish']) ? boolval($this->options['finish']) : false;
    }

    /**
     * @param $field
     * @return mixed
     * @throws JException
     */
    public function getMessage($field)
    {
        $message = isset($this->options['message']) ? $this->options['message'] : $this->defaultMessage;
        if (!is_string($message)) {
            throw new JException('the type of message in options must be string');
        }
        return str_replace(':field', $field, $message);
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return isset($this->options['code']) ? $this->options['code'] : $this->defaultCode;
    }


    public abstract function validator(Validation $validation, $field);
}