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
        $min = $this->getOption('min', 0);
        if (!is_integer($min) || $min < 0) {
            throw new LoveException('min参数必须为正整数!');
        }
        $valueStr = mb_strlen($value);
        $success = true;

        if ($valueStr < $min) {
            $messageMin = $this->getOption('messageMin');
            (!$messageMin || !is_string($messageMin)) && $messageMin = ":field 最小长度为{$min}";

            $messageMin = str_replace(':field', $field, $messageMin);
            $validation->appendMessage(new JaniceMessage($this->getCode(), $messageMin));
            $success = false;
        }

        $max = $this->getOption('max');
        if($max!==null){
            if(!is_integer($max) || $max < $min){
                throw new LoveException('请填写max参数，必须为正整数，并且大于min参数值或大于0');
            }
            if ($valueStr > $max) {
                $messageMax = $this->getOption('messageMax');
                (!$messageMax || !is_string($messageMax)) && $messageMax = ":field 最大长度为{$max}";
                $messageMax = str_replace(':field', $field, $messageMax);
                $validation->appendMessage(new JaniceMessage($this->getCode(), $messageMax));
                $success = false;
            }
        }

        return $success;
    }
}