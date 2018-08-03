<?php

namespace Janice\Validator;

use Janice\Exception\DislikeException;
use Janice\Validation;

/**
 * 验证值是否存在
 * @author ambi
 * @date 2018/8/1
 */
class NotEmpty extends Validator
{
    protected $defaultMessage = ':field is not exists';

    /**
     * @param Validation $validation
     * @param $field
     * @return bool
     * @throws DislikeException
     */
    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        if ($value !== null || $value !== '') {
            return true;
        }

        $code = $this->getCode();

        $message = $this->getMessage($field);

        throw new DislikeException($message, $code);
    }

}