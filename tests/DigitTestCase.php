<?php
/**
 * @author ambi
 * @date 2018/8/8
 */

class DigitTestCase extends \PHPUnit\Framework\TestCase
{
    public function testDigital()
    {
        $data = [
            'domain'=>1,
            'domain1'=>'sd',
            'domain2'=>3,
            'domain3'=>'.1',
            'domain4'=>'0.1',
        ];
        $validation = new \Janice\Validation();
        $digitalValidator = new \Janice\Validator\Digit(
            [
                'message' => ':field 必须是数字',
                'code' => 200
            ]
        );
        $validation->add(array_keys($data), $digitalValidator);

        $validation->validate($data);
        $this->assertTrue(count($validation->getMessages()) == 1);
    }
}