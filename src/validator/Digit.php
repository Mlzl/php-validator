<?php
/**
 * 验证一个值是否是数字
 * @author ambi
 * @date 2018/8/2
 */

namespace Janice\Validator;

use Janice\Library\JaniceMessage;
use Janice\Validation;

class Digit extends Validator
{
    protected $defaultMessage = ':field 不是数字';

    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        if ($this->isAllowEmpty() && ($value === '' || $value === null)) {
            return true;
        }
        if (is_numeric($value)) {
            return true;
        }
        $code = $this->getCode();
        $message = $this->getMessage($field);
        $validation->appendMessage(new JaniceMessage($code, $message));
    }
}