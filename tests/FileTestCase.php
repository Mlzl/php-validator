<?php
/**
 * @author ambi
 * @date 2018/8/8
 */

class FileTestCase extends \PHPUnit\Framework\TestCase
{

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

}