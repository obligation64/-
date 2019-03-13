<?php
/**
 * Created by PhpStorm.
 * User: 11706
 * Date: 2019/2/28
 * Time: 8:13
 */

namespace app\index\controller;
use app\index\model\Employee;
use think\Controller;
use app\index\model\Time;
use app\index\model\Thing;
use app\index\model\Message;

class User extends Controller
{
    public function _initialize()
    {
        if (!session('?Uname')) {
            $this->error('请先登录！', 'index/login');
        }
    }

    public function index()
    {
        return $this->fetch();
    }

    public function pwd()
    {
        $this->assign(['title' => '计算机中心-修改密码']);
        return view();
    }
    public function change()
    {
        $old_password = input('old_password');
        $new_password = input('new_password');
        $con_password = input('con_password');
        if ($new_password != $con_password) {
            $this->error('新密码不一致，请重试');
        }
        $uname = session('User');
        // 验证旧密码对不对
        $data = Employee::get(['name'=>$uname]);
        if (md5($old_password) != $data['password']) {
            $this->error('原密码错误，请确认后再重试！');
        }
        $data['password'] = md5($new_password);
        $status = $data->save();
        // dump($status);
        ($status == 1) ? $this->success('恭喜您！修改成功！', 'index') : $this->error('修改失败或一次修改了多条！');
    }

    public function sign()
    {
        $date = date("Y-m-d");
        $time=date('H');
        $period=0;
        switch ($time)
        {
            case 7:
            case 8:
            case 9:$period=1;break;
            case 10:
            case 11:$period=2;break;
            case 12:
            case 13:$period=3;break;
            case 14:
            case 15:$period=4;break;
            case 16:
            case 17:
            case 18:$period=5;break;
            case 19:case 20:case 21:$period=6;break;
        }


        $this->assign([
            'title' => '计算中心管理系统-签到页面',
            'date' => $date,
            'part1' => '第1,2节(7:30-9:50)',
            'part2' => '第3,4节(9:50-12:15)',
            'part3' => '第5,6节(12:15-14:15)',
            'part4' => '第7,8节(14:15-16:15)',
            'part5' => '第9,10节(16:15-18:45)',
            'part6' => '第11,12,13节(18:45-21:45)',
            'period'=>$period,
        ]);

        return view();
    }
    public function sign_in()
    {
        $name = session('User');
        $period = input('period');
        $working = 0;
        switch ($period) {
            case 1:
            case 2:
                $working = 2.4;
                break;
            case 3:
            case 4:
                $working = 2;
                break;
            case 5:
                $working = 2.5;
                break;
            case 6:
                $working = 3;
                break;
        }
        $data = [
            'name' => $name,
            'date' => date("Y-m-d"),
            'time' => date("H:i:s"),
            'period' => $period,
            'working' => $working,
        ];
        $status = Time::create($data);
        $status ? $this->success('恭喜您，添加成功！', 'index') : $this->error('添加失败，请重试！');
    }
    public function thing()
    {
        $date=date('Y-m-d');
        $this->assign([
            'date'=>$date,
            'title' => '登记丢失物品',
        ]);
        return view();
    }

    public function post_thing()
    {
        $date = input('date');
        $time = date('H:i:s');
        $period = input('period');
        $room = input('room');
        $what = input('what');
        $file = request()->file('img');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if (!$info) {
            $this->error('照片没有上传成功，请重试');
        }
        $jpg = $info->getFilename();
        $data = [
            'date' => $date,
            'time' => $time,
            'period' => $period,
            'room' => $room,
            'what' => $what,
            'jpg' => $jpg,
        ];
        $status = Thing::create($data);
        $status ? $this->success('恭喜您，登记成功！', 'index') : $this->error('添加失败，请重试！');
    }

    public function message()
    {
        $this->assign([
            'title' => '留言',
        ]);
        return view();
    }

    public function leave_message()
    {
        $name = session('User');

        $message = input('message');
        $time = date('Y-m-d H:i:s');
        $data = [
            'name' => $name,
            'mes' => $message,
            'time' => $time,
        ];
        $status = Message::create($data);
        $status ? $this->success('恭喜您，留言成功！', 'index') : $this->error('添加失败，请重试！');
    }
    public function time()
    {
        $date=date('Y-m');
        $this->assign([
            'title' => '工时查询',
            'date'=>$date,
        ]);
        return view();
    }
    public function search_time()
    {
        $name = session('User');
        $month = input('month');
        if ($month) {
            $condition['date'] = ['like', $month . '%'];
        }
        $condition['name'] = ['=', $name];
        $time = Time::where($condition)->select();
        $all=Time::where($condition)->sum('working');
        $all=round($all,2);
        echo $all;
        if (empty($time)) {
            $this->error('暂无签到信息，请重试');
        }
        $this->assign([
            'title' => '工时查询',
            'time' => $time,
            'all' => $all,
        ]);
        return $this->fetch();
    }

    public function info()
    {
        $condition['num']=session('Uname');
        $info=Employee::where($condition)->find();
        $this->assign([
            'title'=>'个人中心',
            'info'=>$info,
        ]);
        return view();
    }
    public function change_info()
    {
        $user = new Employee();
        $id=input('id');
// save方法第二个参数为更新条件
        $status=$user->save([
            'num'=>input('num'),
            'name'=>input('name'),
            'phone'  => input('phone'),
            'grade'  => input('grade'),
            'major'  => input('major'),
            'origin'  => input('origin'),
            'sex'  => input('sex'),
            'birthday'  => input('birthday'),
        ],['id' => $id]);
        if($status==1)
        {
            $this->success('修改成功','index');
        }
        else{
            $this->error('修改失败或无修改');
        }
    }
    public function test()
    {
        $this->assign([
            'title'=>'测试',

        ]);
        return  $this->fetch();
    }

}