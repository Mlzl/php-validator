<?php
/**
 * 验证一个值是否是整数
 * @author ambi
 * @date 2018/8/2
 */

namespace Janice\Validator;


use Janice\Exception\DislikeException;
use Janice\Validation;

class Integer extends Validator
{
    protected $defaultMessage = ':field must be integer';

    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        $allowEmpty = $this->getOption('allowEmpty');
        if ($allowEmpty && ($value === '' || $value === null)) {
            return true;
        }
        if (is_integer($value)) {
            return true;
        }
        $code = $this->getCode();
        $message = $this->getMessage($field);

        throw new DislikeException($message, $code);
    }
}