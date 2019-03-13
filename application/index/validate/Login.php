<?php
/**
 * Created by PhpStorm.
 * User: 11706
 * Date: 2019/3/12
 * Time: 20:42
 */

namespace app\index\validate;
use think\Validate;

class Login extends Validate
{
    protected $rule=[
        ["num","require|length:10"],
    ];
}