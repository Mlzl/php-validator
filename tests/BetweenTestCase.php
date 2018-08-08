<?php
/**
 * @author ambi
 * @date 2018/8/8
 */

class BetweenTestCase extends \PHPUnit\Framework\TestCase
{
    public function testBetween()
    {
        $data = [
            'domain'=>1,
            'domain1'=>'sd',
            'domain2'=>300,
        ];

        $validation = new \Janice\Validation();
        $validation->add(array_keys($data), new \Janice\Validator\Between([
            'min'=>1,
            'max'=>100,
        ]));
        $validation->validate($data);
        $this->assertTrue(count($validation->getMessages()) == 2);
    }

}