<?php
/**
 * @author ambi
 * @date 2018/8/4
 */

namespace Janice\Validator;


use Janice\Exception\LoveException;
use Janice\Library\JaniceMessage;
use Janice\Validation;

class Between extends Validator
{
    protected $defaultMessage = ':field 不在限定的区域内';

    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        if ($this->isAllowEmpty() && ($value === '' || $value === null)) {
            return true;
        }
        $min = $this->getOption('min');
        if (!is_numeric($min)) {
            throw new LoveException('min选项必须为数字');
        }
        $max = $this->getOption('max');
        if (!is_numeric($max)) {
            throw new LoveException('max选项必须为数字');
        }
        $this->defaultMessage = ":field 不在限定的区域内[{$min}~{$max}]";
        if (!is_numeric($value) || $value < $min || $value > $max) {
            $message = $this->getMessage($field);
            $code = $this->getCode();
            $validation->appendMessage(new JaniceMessage($code, $message));
            return false;
        }
        return true;
    }

}