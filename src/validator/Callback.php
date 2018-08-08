<?php
/**
 * @author ambi
 * @date 2018/8/3
 */

namespace Janice\Validator;


use Janice\Exception\LoveException;
use Janice\Library\JaniceMessage;
use Janice\Validation;

class Callback extends Validator
{
    protected $defaultMessage = ':field 不满足回调函数规则';

    public function validator(Validation $validation, $field)
    {
        $callback = $this->getOption('callback');
        if (!is_callable($callback)) {
            throw new LoveException('Callback验证器的callback参数必须是可回调的！');
        }

        $result = $callback($validation->getData());
        if ($result === false) {
            $code = $this->getCode();
            $message = $this->getMessage($field);
            $validation->appendMessage(new JaniceMessage($code, $message));
        }
        return true;
    }
}