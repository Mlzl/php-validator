<?php

namespace Janice;

use Janice\Exception\LoveException;
use Janice\Library\JaniceMessage;
use Janice\Library\MessageBox;
use Janice\Validator\Validator;
use function DeepCopy\deep_copy;

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
     * @throws LoveException
     */
    public function add($fields, $validator)
    {
        if (!($validator instanceof Validator)) {
            throw new LoveException('the validator must extends Validation');
        }
        if (!is_string($fields) && !is_array($fields)) {
            throw new LoveException('the field type must string or array');
        }
        $this->vQueue->push([$fields, deep_copy($validator)]);
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
                $success = $validator->validator($this, $field);
                if (!$success) {
                    if ($validator->isFinish()) {//停止检测
                        break;
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

    public function appendMessage(JaniceMessage $message)
    {
        $this->vMessageBox->push($message);
    }

    public function getData()
    {
        return $this->vData;
    }
}