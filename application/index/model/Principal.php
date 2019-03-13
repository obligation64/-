<?php
namespace app\index\model;
use think\Model;


class Principal extends Model
{
    protected $table = 'principal';

    protected function setPasswordAttr($value)
    {
        return md5($value);
    }
}