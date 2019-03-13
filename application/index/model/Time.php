<?php
/**
 * Created by PhpStorm.
 * User: 11706
 * Date: 2019/2/28
 * Time: 9:04
 */

namespace app\index\model;
use think\Model;

class Time extends Model
{
    protected $table='working_time';

    public function setPeriodAttr($value)
    {

    }
    public function getPeriodAttr($value)
    {
        switch ($value){
            case 1:$value='第1,2节';break;
            case 2:$value='第3,4节';break;
            case 3:$value='第5,6节';break;
            case 4:$value='第7,8节';break;
            case 5:$value='第9,10节';break;
            case 6:$value='第11,12,13节';break;
        }
        return $value;
    }
}