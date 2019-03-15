<?php
/**
 * Created by PhpStorm.
 * User: 11706
 * Date: 2019/3/12
 * Time: 20:42
 */

namespace app\index\validate;
use think\Validate;

class Register extends Validate
{
    protected $rule = [
        'pwd'  =>  'require|min:6',
    ];

    protected $message = [
        'pwd.require'  =>  '密码必须',
        'pwd.min'=>'密码不能少于6位',
    ];
}