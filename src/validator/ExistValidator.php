<?php

namespace Janice\Validator;

use Janice\Library\JaniceMessage;
use Janice\Validation;

/**
 * @author ambi
 * @date 2018/8/1
 */
class ExistValidator extends Validator
{
    protected $defaultCode = 10000;
    protected $defaultMessage = ':field is not exists';

    /**
     * @param Validation $validation
     * @param $field
     * @return bool|JaniceMessage
     */
    public function validator(Validation $validation, $field)
    {
        if ($validation->getValue($field) !== null) {
            return true;
        }

        $code = $this->getCode();

        $message = $this->getMessage($field);
        return new JaniceMessage($code, $message);
    }

}