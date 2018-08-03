<?php
/**
 * 验证一个值是否是数字
 * @author ambi
 * @date 2018/8/2
 */

namespace Janice\Validator;


use Janice\Exception\DislikeException;
use Janice\Validation;

class Digit extends Validator
{
    protected $defaultMessage = ':field must be digital';

    public function validator(Validation $validation, $field)
    {
        $allowEmpty = $this->getOption('allowEmpty');
        $value = $validation->getValue($field);
        if ($allowEmpty && ($value === '' || $value === null)) {
            return true;
        }
        if (is_numeric($value)) {
            return true;
        }
        $code = $this->getCode();
        $message = $this->getMessage($field);
        throw new DislikeException($message, $code);
    }
}