<?php
/**
 * @author ambi
 * @date 2018/8/8
 */

class InclusionInTestCase extends \PHPUnit\Framework\TestCase
{
    public function testInclusionIn()
    {
        $validation = new \Janice\Validation();
        $data = [
            'domain'=>1,
            'domain1'=>'sd',
            'domain2'=>3,
            'domain3'=>'.1',
            'domain4'=>'0.1',
        ];
        $validation->add(array_keys($data), new \Janice\Validator\InclusionIn([
            'domain'=>[1,2,3,4,5]
        ]));

        $validation->validate($data);
        $this->assertTrue(count($validation->getMessages()) == 3);
    }
}