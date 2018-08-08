<?php
/**
 * @author ambi
 * @date 2018/8/8
 */

class ExclusionInTestCase extends \PHPUnit\Framework\TestCase
{

    public function testExclusionIn()
    {
        $data = [
            'domain'=>1,
            'domain1'=>'sd',
            'domain2'=>3,
            'domain3'=>'.1',
            'domain4'=>'0.1',
        ];
        $validation = new \Janice\Validation();

        $validation->add(array_keys($data), new \Janice\Validator\ExclusionIn([
            'domain'=>[1,2,3,4,5]
        ]));

        $validation->validate($data);
        $this->assertTrue(count($validation->getMessages()) == 2);
    }

}