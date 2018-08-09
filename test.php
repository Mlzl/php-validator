<?php
/**
 * @author ambi
 * @date 2018/8/8
 */


require "vendor/autoload.php";

$data = [
    'name' => 'ambi',
    'age' => 18,
    'sex' => 'fs',
    'profession' => '程序员1',
    'mail' => 'liuzhilang@3k.com',
    'introduce' => 's',
    'height'=>180,
    'wife'=>null,
];
$validation = new \Janice\Validation();

$validation->add(array_keys($data), new \Janice\Validator\NotEmpty(
    [
        'nameMessage'=>'名字不能为空',
        'deptMessage'=>'部门不能为空',
        'groupMessage'=>'部门组不能为空',
        'userMessage'=>'用户不能为空',
    ]
));

$validation->add('sex', new \Janice\Validator\InclusionIn([
    'domain' => ['f', 'm']
]));

$validation->add('age', new \Janice\Validator\Between(
    [
        'min' => 18,
        'max' => 25
    ]
));
$validation->add('mail', new \Janice\Validator\Regex(
    [
        'pattern' => '/^.*?@.*?\.[a-zA-Z]+$/'
    ]
));

$validation->add('profession', new \Janice\Validator\Callback(
    [
        'callback' => function ($data) {
            if ($data['profession'] == '程序员') {
                return true;
            }
            return false;
        },
        'message' => ':field 不是程序员',
    ]
));

$validation->add('introduce', new \Janice\Validator\StringLength(
    [
        'min' => 5,
        'max' => 50,
    ]
));

$validation->validate($data);
foreach ($validation->getMessages() as $message) {
    var_dump($message->getMessage());
}