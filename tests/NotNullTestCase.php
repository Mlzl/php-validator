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
        $validation->add('key', new \Janice\Validator\NotEmpty(
            [
                'message' => ':field 不存在',
                'code' => 119
            ]
        ));
        $validation->validate([]);

        $this->assertTrue(count($validation->getMessages()) == 1);
        /**
         * @var $message \Janice\Library\JaniceMessage
         */
        $message = $validation->getMessages()[0];
        $this->assertTrue($message->getCode() == 119);
        $this->assertTrue($message->getMessage() == 'key 不存在');
    }

    public function testDigital()
    {
        $validation = new \Janice\Validation();
        $digitalValidator = new \Janice\Validator\Digit(
            [
                'message' => ':field 必须是数字',
                'code' => 200
            ]
        );
        $validation->add('digital1', $digitalValidator);
        $validation->add('digital2', $digitalValidator);
        $validation->add('digital3', $digitalValidator);
        $data = [
            'digital1' => 1,
            'digital2' => -1.1,
            'digital3' => 'a',
        ];
        $validation->validate($data);
        $this->assertTrue(count($validation->getMessages()) == 1);
        /**
         * @var $message \Janice\Library\JaniceMessage
         */
        $message = $validation->getMessages()[0];
        $this->assertTrue($message->getCode() == 200);
        $this->assertTrue($message->getMessage() == 'digital3 必须是数字');
    }

    public function testNumber()
    {
        $validation = new \Janice\Validation();
        $numberValidator = new \Janice\Validator\Integer(
            [
                'message' => ':field 必须是整数',
                'code' => 201
            ]
        );
        $validation->add('integer1', $numberValidator);
        $validation->add('integer2', $numberValidator);
        $validation->add('integer3', $numberValidator);
        $data = [
            'integer1' => 1,
            'integer2' => -1,
            'integer3' => 'a',
        ];
        $validation->validate($data);
        $this->assertTrue(count($validation->getMessages()) == 1);
        /**
         * @var $message \Janice\Library\JaniceMessage
         */
        $message = $validation->getMessages()[0];
        $this->assertTrue($message->getCode() == 201);
        $this->assertTrue($message->getMessage() == 'integer3 必须是整数');
    }

    public function testSingleFile()
    {
        $data['fileName'] = [
            'size' => 100,
            'type' => 'text/plain',
            'name' => 'hehe',
            'error' => 0
        ];
        $validation = new \Janice\Validation();
        $validation->add('fileName', new \Janice\Validator\File(
            [
                'maxSize' => '100b',
                'messageSize' => '最大尺寸为 :maxSize',
                'allowType' => 'text/plain',
            ]
        ));
        $validation->validate($data);
        $this->assertTrue(count($validation->getMessages()) == 0);
    }

    public function testMultiFile()
    {
        $data['fileName'] = [
            'name' => [
                'file1',
                'file2',
            ],
            'size' => [
                100,
                200
            ],
            'type' => [
                'text/plain',
                'css/plain',
            ],
            'error' => [
                0,
                0
            ]
        ];
        $validation = new \Janice\Validation();
        $validation->add('fileName', new \Janice\Validator\File(
            [
                'maxSize' => '200b',
                'messageSize' => '最大尺寸为 :maxSize',
                'allowType' => 'text/plain',
            ]
        ));
        $validation->validate($data);
        $this->assertTrue(count($validation->getMessages()) == 1);
    }

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

    public function testBetween()
    {
        $data['fileName'] = 1000;
        $validation = new \Janice\Validation();
        $validation->add('fileName', new \Janice\Validator\Between([
            'min'=>1,
            'max'=>100,
        ]));
        $validation->validate($data);
        $this->assertTrue(count($validation->getMessages()) == 1);
    }

    public function testStringLength()
    {
        $data['fileName'] = 'd';
        $validation = new \Janice\Validation();
        $validation->add('fileName', new \Janice\Validator\StringLength([
            'min'=>2,
            'max'=>2,
            'messageMin'=>'min message',
            'messageMax'=>'max message',
        ]));
        $validation->validate($data);

        $this->assertTrue(count($validation->getMessages()) == 1);
    }
}
