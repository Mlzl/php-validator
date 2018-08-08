<?php
/**
 * @author ambi
 * @date 2018/8/8
 */

class CallbackTestCase extends \PHPUnit\Framework\TestCase
{
    public function testCallback()
    {
        $validation = new \Janice\Validation();
        $validation->add('fieldName', new \Janice\Validator\Callback([
            'callback' => function ($data) {
                if (isset($data['fieldName']) && $data['fieldName'] == 'janice') {
                    return true;
                }
                return false;
            },
            'message' => ':field failed'
        ]));
        $validation->validate(['fieldName' => 'janice']);
        $this->assertTrue(count($validation->getMessages()) == 0);
    }

}