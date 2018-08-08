<?php
/**
 * @author ambi
 * @date 2018/8/3
 */

namespace Janice\Validator;


use Janice\Exception\LoveException;
use Janice\Library\JaniceMessage;
use Janice\Validation;

class Regex extends Validator
{
    protected $defaultMessage = ':field 不满足正则表达式';

    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        if ($this->isAllowEmpty() && ($value === '' || $value === null)) {
            return true;
        }
        $pattern = $this->getOption('pattern');
        $result = @preg_match($pattern, $value, $matches);
        if ($result === false) {
            throw new LoveException('正则表达式有误，请检查!');
        }
        if ($result === 0) {
            $validation->appendMessage(
                new JaniceMessage($this->getMessage($field), $this->getCode())
            );
            return false;
        }
        return true;
    }

}