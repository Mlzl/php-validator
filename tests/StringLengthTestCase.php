<?php
/**
 * @author ambi
 * @date 2018/8/8
 */

class StringLengthTestCase extends \PHPUnit\Framework\TestCase
{
    public function testStringLength()
    {
        $validation = new \Janice\Validation();

        $data = [
            'domain'=>1,
            'domain1'=>'sdsad',
            'domain2'=>3,
            'domain3'=>'.1',
            'domain4'=>'0.1',
        ];

        $validation->add(array_keys($data), new \Janice\Validator\StringLength([
            'min'=>2,
            'max'=>3,
            'messageMin'=>':field 太短',
            'messageMax'=>':field 太长',
        ]));
        $validation->validate($data);

        $this->assertTrue(count($validation->getMessages()) == 3);
    }
}