<?php
/**
 * @author ambi
 * @date 2018/8/1
 */

class NotNullTestCase extends \PHPUnit\Framework\TestCase
{
    public function testNotNull()
    {
        $validation = new \Janice\Validation();
        $validation->add('key', new \Janice\Validator\ExistValidator(
            [
                'message' => ':field 不存在',
                'code' => '119'
            ]
        ));
        $validation->validate([]);
        $this->assertTrue(count($validation->getMessages()) == 1);

    }
}
