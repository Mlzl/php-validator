<?php
/**
 * @author ambi
 * @date 2018/8/8
 */

class IntegerTestCase extends \PHPUnit\Framework\TestCase
{
    public function testBetween()
    {
        $data = [
            'domain'=>1,
            'domain1'=>'sd',
            'domain2'=>3,
            'domain3'=>'.1',
            'domain4'=>'0.1',
        ];

        $validation = new \Janice\Validation();
        $validation->add(array_keys($data), new \Janice\Validator\Integer([
        ]));
        $validation->validate($data);
        $this->assertTrue(count($validation->getMessages()) == 3);
    }

}