<?php
/**
 * Created by PhpStorm.
 * User: 11706
 * Date: 2019/2/26
 * Time: 21:04
 */

namespace app\index\controller;
use think\Controller;
use app\index\model\Employee;
use app\index\model\Principal;
use app\index\model\Time;
use app\index\model\Message;
use app\index\model\Thing;

class Admin extends Controller
{
//    初始化
    public function _initialize()
    {
        if (!session('?Uname')) {
            $this->error('请先登录！', 'index/Admin_login');
        }
    }
    //    主页
    public function index()
    {
        $this->assign(
            ['title' => '计算机中心-首页']
        );
        return view();
    }

    //    管理模块
    public function work()
    {
        $this->assign(['title' => '计算机中心-管理模块']);
        return view();
    }



    //    密码
    public function pwd()
    {
        $this->assign(['title' => '计算机中心-修改密码']);
        return view();
    }

    //    修改密码
    public function change()
    {
        $old_password = trim(input('old_password'));
        $new_password = trim(input('new_password'));
        $con_password = trim(input('con_password'));
        if ($new_password != $con_password) {
            $this->error('新密码不一致，请重试');
        }
        $uname = trim(input('uname'));
        // 验证旧密码对不对
        $data = Principal::get($uname);
        // dump($data['Password']);exit;
        if ($old_password != $data['Password']) {
            $this->error('原密码错误，请确认后再重试！');
        }
        $data['Password'] = $new_password;
        $status = $data->save();
        // dump($status);
        ($status == 1) ? $this->success('恭喜您！修改成功！', 'index') : $this->error('修改失败或一次修改了多条！');
    }

    //    员工
    public function employee()
    {
        $this->assign(['title' => '计算机中心-员工信息管理']);
        return view();
    }

    //    添加员工
    public function add()
    {
        //$ato = Ato::all();
        $data = [
            'title' => '计算机中心-员工信息注册',
            //'ato'   => $ato
        ];
        // dump($ato);exit;
        $this->assign($data);
        return view();
    }

    // 员工信息注册验证
    public function add_check()
    {
        $data=input('post.');
        $status = Employee::create($data);
        // dump($status);exit;
        $status ? $this->success('恭喜您，添加成功！', 'employee') : $this->error('添加失败，请重试！');
    }

    //    员工更新
    public function update()
    {
        $num=input('num');
        $condition['num']=['=',$num];
        $employee = Employee::where($condition)->find();
        $data = [
            'title' => '计算机中心-员工信息更新',
            'employee' => $employee,
        ];
        $this->assign($data);
        return view();
    }
    // 员工信息更新验证
    public function update_check()
    {
        $condition['id']=['=',input('id')];
        $employee =Employee::where($condition)->find();
        $data = [
            'num' => input('num'),
            'name' => input('name'),
            'phone' => input('phone'),
            'grade' => input('grade'),
            'major' => input('major'),
            'origin' => input('origin'),
            'sex' => input('sex'),
            'birthday' => input('birthday'),
        ];
        $status = Employee::where($condition)->update($data);
        if ($status) {
        $this->success('更新成功', 'admin/search_employee');
        }
        else{
            $this->error('更新失败','admin/update');
        }
// post数组中只有name和email字段会写入
    }

    // 员工信息删除
    public function del()
    {
        $condition['admin']=['=',0];
        $employee = Employee::where($condition)->select();
        $data = [
            'title' => '计算机中心-员工信息删除',
            'employee' => $employee
        ];
        $this->assign($data);
        return view();
    }

    // 员工信息删除验证
    public function del_check()
    {
        $user = new Employee();
// 查询单个数据
        $employee=$user->where('num', '2016052402')->find();
        echo $employee;
// 软删除
        $status= $employee->delete();
//        $status = Employee::destroy(input('num'));
        ($status == 1) ? $this->success('恭喜您，删除成功！', 'employee') : $this->error('删除失败，请重试！');
    }

    //查询
    public function search()
    {
        $this->assign(['title' => '计算中心管理系统-信息查询服务']);
        return view();
    }

    public function search_employee()
    {
        $condition['admin']=['=',0];
        $employee = Employee::where($condition)->select();
        $this->assign([
            'title' => '员工信息查询',
            'employee' => $employee
        ]);
        return $this->fetch();
    }

    public function search_time()
    {
        $employee = Employee::all();
        $this->assign([
            'title' => '工时查询',
            'employee' => $employee,
        ]);
        return view();
    }

    public function search_time_view()
    {
        $name = input('name');
        $month = input('month');
        if ($month) {
            $condition['date'] = ['like', $month . '%'];
        }
        $condition['name'] = ['=', $name];
        $condition['admin']=['=',0];
//        $time=Time::where($condition)->select();
        $time = Time::where($condition)->select();
        $count = Time::where($condition)->count();
        $all = 0;
        for ($i = 0; $i < $count; $i++) {

            $all += $time[$i]['working'];
            switch ($time[$i]['part']) {
                case 1:
                    $time[$i]['part'] = '第1，2节';
                    break;
                case 2:
                    $time[$i]['part'] = '第3，4节';
                    break;
                case 3:
                    $time[$i]['part'] = '第5，6节';
                    break;
                case 4:
                    $time[$i]['part'] = '第7，8节';
                    break;
                case 5:
                    $time[$i]['part'] = '第9，10节';
                    break;
                case 6:
                    $time[$i]['part'] = '第11，12,13节';
                    break;
            }
        }

        if (empty($time)) {
            $this->error('查询出现错误，请重试');
        }

        $this->assign([
            'title' => '工时查询-' . input('name'),
            'time' => $time,
            'all' => $all,
        ]);
        return $this->fetch();
    }

    public function thing()
    {
        $this->assign([
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
        $status ? $this->success('恭喜您，登记成功！', 'work') : $this->error('添加失败，请重试！');

//        $file = request()->file('img');
//        // 用Controller类的validate方法指定过滤
//        $info = $file->validate(['ext'=>'jpg,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
//        // 还可以指定文件大小 'size'=>15678
//        if($info){
//            // 成功上传后 获取上传信息
//            echo 'success';
//        }else{
//            // 上传失败获取错误信息
//            echo $file->getError();
//        }
    }

    public function search_thing()
    {
        $this->assign([
            'title' => '查询遗失物品',
        ]);
        return view();
    }

    public function search_thing_view()
    {
        $date = input('date');
        $room = input('room');
        if ($date) {
            $condition['date'] = ['=', $date];
        }
        $condition['room'] = ['=', $room];
        $condition['status'] = ['=', 0];

        $thing = Thing::where($condition)->select();
        $count = Thing::where($condition)->count();
        for ($i = 0; $i < $count; $i++) {
            switch ($thing[$i]['period']) {
                case 1:$thing[$i]['period'] = '第1，2节';break;
                case 2:$thing[$i]['period'] = '第3，4节';break;
                case 3:$thing[$i]['period'] = '第5，6节';break;
                case 4:$thing[$i]['period'] = '第7，8节';break;
                case 5:$thing[$i]['period'] = '第9，10节';break;
                case 6:$thing[$i]['period'] = '第11，12,13节';break;
            }
        }

        $this->assign([
            'title' => '失物查询',
            'thing' => $thing,
        ]);
        return view();
    }

    public function search_message()
    {
        $message = Message::all();
        $this->assign([
            'title' => '留言',
            'message' => $message,
        ]);
        return view();
    }

    public function mes()
    {
        $this->assign([
            'title' => '留言',
        ]);
        return view();
    }

    public function leave_mes()
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
        $status ? $this->success('恭喜您，留言成功！', 'mes') : $this->error('添加失败，请重试！');
    }


    public function sign()
    {
        $date = date("Y-m-d");
        $this->assign([
            'title' => '计算中心管理系统-签到页面',
            'date' => $date,
            'part1' => '第1,2节(7:30-9:50)',
            'part2' => '第3,4节(9:50-12:15)',
            'part3' => '第5,6节(12:15-14:15)',
            'part4' => '第7,8节(14:15-16:15)',
            'part5' => '第9,10节(16:15-18:45)',
            'part6' => '第11,12,13节(18:45-21:45)',
        ]);

        return view();
    }

    public function sign_in()
    {
        $name = session('User');
        $part = input('part');
        $working = 0;
        switch ($part) {
            case 1:
                $working = 2.4;
                break;
            case 2:
                $working = 2.4;
                break;
            case 3:
                $working = 2;
                break;
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
            'part' => $part,
            'working' => $working,
        ];
        $status = Time::create($data);
        $status ? $this->success('恭喜您，添加成功！', 'work') : $this->error('添加失败，请重试！');
    }

    public function admin_search_time()
    {
        $name=Employee::where(1)->column('name');
        $month = date('m');
        $condition['date'] = ['like', '%'.$month . '%'];
        $num=Employee::where(1)->count();
        $time=[0];
        for($i=0;$i<$num;$i++)
        {
            $condition['name']=$name[$i];
            $time[$i] =Time::where($condition)->select();
            $time[$i]['all']=Time::where($condition)->sum('working');
            $time[$i]['all']=round($time[$i]['all'],2);
        }
        $this->assign([
            'title'=>'查询工时',
            'name'=>$name,
            'time'=>$time[0],
            'time1'=>$time[1],
            'time2'=>$time[2],
            'time3'=>$time[3],
            'time4'=>$time[4],
            'time5'=>$time[5],
            'time6'=>$time[6],
            'time7'=>$time[7],
            'time8'=>$time[8],
            'time9'=>$time[9],
        ]);

        return view();

    }
}