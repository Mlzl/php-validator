<?php
/**
 * @author ambi
 * @date 2018/8/5
 */

namespace Janice\Validator;


use Janice\Exception\LoveException;
use Janice\Library\JaniceMessage;
use Janice\Validation;

class StringLength extends Validator
{
    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        if ($this->isAllowEmpty() && ($value === '' || $value === null)) {
            return true;
        }
        $min = $this->getOption('min');
        if ($min === null || !is_integer($min) || $min < 0) {
            throw new LoveException('请填写min参数，并且是正整数!');
        }
        $max = $this->getOption('max');
        if ($max !== null && (!is_integer($max) || $max < $min)) {
            throw new LoveException('max参数必须为正整数，并且大于min参数值');
        }

        $messageMax = $this->getOption('messageMax');
        $messageMin = $this->getOption('messageMin');
        !$messageMax || !is_string($messageMax) && $messageMax = ":field 最大长度为{$max}";
        !$messageMin || !is_string($messageMin) && $messageMin = ":field 最小长度为{$min}";
        $messageMax = str_replace(':field', $field, $messageMax);
        $messageMin = str_replace(':field', $field, $messageMin);
        $valueStr = mb_strlen($value);
        $success = true;
        if ($valueStr < $min) {
            $validation->appendMessage(new JaniceMessage($this->getCode(), $messageMin));
            $success = false;
        }
        if ($max !== null && $valueStr > $max) {
            $validation->appendMessage(new JaniceMessage($this->getCode(), $messageMax));
            $success = false;
        }
        return $success;
    }
}