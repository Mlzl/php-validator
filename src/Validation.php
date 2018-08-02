<?php

namespace Janice;

use function DeepCopy\deep_copy;
use Janice\Exception\JException;
use Janice\Library\JaniceMessage;
use Janice\Library\MessageBox;
use Janice\Validator\Validator;

/**
 * @author ambi
 * @date 2018/8/1
 */
class Validation
{
    /**
     * @var \SplStack
     */
    protected $vQueue;
    /**
     * @var array
     */
    private $vData;

    /**
     * @var MessageBox
     */
    protected $vMessageBox;

    public function __construct()
    {
        $this->vQueue = new \SplStack();
        $this->vMessageBox = new MessageBox();
    }

    /**
     * @param string|array $fields
     * @param $validator
     * @throws JException
     */
    public function add($fields, $validator)
    {
        if (!($validator instanceof Validator)) {
            throw new JException('the validator must extends Validation');
        }
        if (!is_string($fields) && !is_array($fields)) {
            throw new JException('the field type must string or array');
        }
        $this->vQueue->unshift([$fields, deep_copy($validator)]);
    }

    public function validate($data)
    {
        $this->vData = $data;
        foreach ($this->vQueue as $item) {
            /**
             * @var $validator Validator
             */
            list($fields, $validator) = $item;
            if (is_string($fields)) {
                $fields = [$fields];
            }
            foreach ($fields as $field) {
                $result = $validator->validator($this, $field);
                if ($result !== true) {
                    if (!($result instanceof JaniceMessage)) {
                        $result = new JaniceMessage($validator->getMessage($field), $validator->getCode());
                    }
                    $this->vMessageBox->push($result);
                    if ($validator->isFinish()) {
                        return true;
                    }
                }
            }
        }

    }

    public function getValue($field)
    {
        return isset($this->vData[$field]) ? $this->vData[$field] : null;
    }

    /**
     * @return MessageBox
     */
    public function getMessages()
    {
        return $this->vMessageBox;
    }
}