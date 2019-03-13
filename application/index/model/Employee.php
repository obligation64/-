<?php
namespace app\index\model;
use think\Model;
use traits\model\SoftDelete;


class Employee extends Model
{
    protected $table = 'employee';
    protected $autoWriteTimestamp = 'datetime';
    use SoftDelete;
    protected $deleteTime='delete_time';
}