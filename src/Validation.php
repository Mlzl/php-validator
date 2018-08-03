<?php

namespace Janice;

use Janice\Exception\DislikeException;
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
     * @throws DislikeException
     */
    public function add($fields, $validator)
    {
        if (!($validator instanceof Validator)) {
            throw new DislikeException('the validator must extends Validation');
        }
        if (!is_string($fields) && !is_array($fields)) {
            throw new DislikeException('the field type must string or array');
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
                try {
                    $validator->validator($this, $field);
                } catch (DislikeException $dislikeException) {
                    $message = new JaniceMessage($dislikeException->getCode(), $dislikeException->getMessage());
                    $this->vMessageBox->push($message);
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
}