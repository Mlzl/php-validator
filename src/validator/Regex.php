<?php
/**
 * @author ambi
 * @date 2018/8/3
 */

namespace Janice\Validator;


use Janice\Exception\LoveException;
use Janice\Validation;

class Regex extends Validator
{
    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        if ($this->isAllowEmpty() && ($value === '' || $value === null)) {
            return true;
        }
        $pattern = $this->getOption('pattern');
        $result = @preg_match($pattern, $value, $matches);
        if($result === false){
            throw new LoveException('正则表达式有误，请检查!');
        }

    }

}