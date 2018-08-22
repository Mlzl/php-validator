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
     * @var array
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
        $this->vQueue = [];
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
            throw new LoveException('field参数应该为字符串或者数组');
        }
        array_push($this->vQueue, [$fields, deep_copy($validator)]);
    }

    public function validate($data)
    {
        $this->vData = $data;
        $endForEach = false;
        foreach ($this->vQueue as $key => $item) {
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
                        $endForEach = true;
                        break;
                    }
                }
            }
            if ($endForEach) {
                break;
            }
        }
        //验证完之后清空验证规则
        $this->vQueue = [];
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