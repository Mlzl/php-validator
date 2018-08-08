<?php

namespace Janice\Validator;

use Janice\Exception\LoveException;
use Janice\Library\JaniceMessage;
use Janice\Validation;

/**
 * 验证值是否存在
 * @author ambi
 * @date 2018/8/1
 */
class NotEmpty extends Validator
{
    protected $defaultMessage = ':field 不存在';

    /**
     * @param Validation $validation
     * @param $field
     * @return bool
     * @throws LoveException
     */
    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        if ($value !== null && $value !== '') {
            return true;
        }

        $code = $this->getCode();

        $message = $this->getMessage($field);

        $validation->appendMessage(new JaniceMessage($code, $message));
        return false;
    }

}