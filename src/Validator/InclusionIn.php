<?php
/**
 * @author ambi
 * @date 2018/8/5
 */

namespace Janice\Validator;


use Janice\Exception\LoveException;
use Janice\Library\JaniceMessage;
use Janice\Validation;

class InclusionIn extends Validator
{
    protected $defaultMessage = ':field字段值 必须是domain内的任何一个值';

    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        if ($this->isAllowEmpty() && ($value === '' || $value === null)) {
            return true;
        }
        $domain = $this->getOption('domain');
        if (!is_array($domain)) {
            throw new LoveException('domain参数值必须是数组');
        }
        if (!in_array($value, $domain)) {
            $validation->appendMessage(new JaniceMessage($this->getCode(), $this->getMessage($field)));
            return false;
        }
        return true;
    }
}