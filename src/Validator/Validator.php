<?php

namespace Janice\Validator;

/**
 * @author ambi
 * @date 2018/8/1
 */

namespace Janice\Validator;


use Janice\Exception\LoveException;
use Janice\Validation;

abstract class Validator
{
    protected $options = [];

    protected $defaultCode = 520;
    protected $defaultMessage = ':field 未知错误!';

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
        return isset($this->options['interruptOnFail']) ? boolval($this->options['interruptOnFail']) : false;
    }

    /**
     * @param $field
     * @return mixed
     * @throws LoveException
     */
    public function getMessage($field)
    {
        if (isset($this->options['message'])) {
            $message = $this->options['message'];
        } elseif (isset($this->options["{$field}Message"])) {
            $message = $this->options["{$field}Message"];
        } else {
            $message = $this->defaultMessage;
        }
        if (!is_string($message)) {
            throw new LoveException('message必须是字符串类型');
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

    public function getOption($field, $default = null)
    {
        return isset($this->options[$field]) ? $this->options[$field] : $default;
    }

    /**
     * @return bool
     */
    public function isAllowEmpty()
    {
        $allowEmpty = $this->getOption('allowEmpty', true);
        return boolval($allowEmpty);
    }

    public abstract function validator(Validation $validation, $field);
}