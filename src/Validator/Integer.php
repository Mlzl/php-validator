<?php
/**
 * 验证一个值是否是整数
 * @author ambi
 * @date 2018/8/2
 */

namespace Janice\Validator;


use Janice\Library\JaniceMessage;
use Janice\Validation;

class Integer extends Validator
{
    protected $defaultMessage = ':field 必须是整数';

    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        if ($this->isAllowEmpty() && ($value === '' || $value === null)) {
            return true;
        }
        if (is_numeric($value) && intval($value) == $value) {
            return true;
        }
        $code = $this->getCode();
        $message = $this->getMessage($field);
        $validation->appendMessage(new JaniceMessage($code, $message));
        return false;
    }
}