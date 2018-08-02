<?php
/**
 * 验证一个值是否是整数
 * @author ambi
 * @date 2018/8/2
 */

namespace Janice\Validator;


use Janice\Library\JaniceMessage;
use Janice\Validation;

class NumberValidator extends Validator
{
    protected $defaultCode = 10002;
    protected $defaultMessage = ':field must be integer';

    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        if (is_integer($value)) {
            return true;
        }
        $code = $this->getCode();
        $message = $this->getMessage($field);
        return new JaniceMessage($code, $message);
    }
}