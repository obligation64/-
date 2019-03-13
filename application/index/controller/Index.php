<?php
namespace app\index\controller;
use app\index\validate\Login;
use think\Controller;
use app\index\model\Principal;
use app\index\model\Employee;
use think\Validate;

class Index extends Controller
{
    public function index()
    {
        $this->assign([
            'title'=>'机房管理系统-登录'
        ]);
        return view();
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }
//    public function Admin_login()
//    {
//        $this->assign([
//            'title'=>'机房管理系统-登录'
//        ]);
//        return view();
//    }
    public function login_out()
    {
        session(null);
        $this->success('注销成功！', 'index/index');
    }

    public function show_captcha(){
        ob_clean();
        $captcha = new \think\captcha\Captcha();
//         $captcha->useZH=true;
//        $captcha->zhSet="能看见是否尽快发你说可能是快捷方式开发爱仕达纷纷捐款农村老家";
        $captcha->fontSize = 30;
        $captcha->length   = 4;
        $captcha->useNoise = false;
        return $captcha->entry();
    }
//    public function Admin_login_check()
//    {
//            // 接收学号和密码
//        $num = input('num');
//        $password = input('password');
//        // 学号和密码不能为空
//        if (empty($num) || empty($password)) {
//            $this->error('学号或密码不能为空！');
//        }
//        if( !captcha_check(input('captcha')) )
//        {
//            $this->error('验证码错误');
//        }
//        // 进行账号验证
//        $data = Principal::get(['num' => $num]);
//        // dump($data);
//        if (!$data) {
//            $this->error('学号不存在，请验证后输入！');
//        }
//        // 进行密码验证
//        if (md5($password) !=  $data['password']) {
//            $this->error('学号和密码不匹配！');
//        }
//        // 如果学号和密码匹配，则登录成功
//        session('Uname',$num);
//        session('User',$data['name']);
//        $this->success('登录成功！','admin/index');
//    }
    public function login_check()
    {

        // 接收学号和密码
        $num = input('num');
        $password = input('password');
        // 学号和密码不能为空
        if (empty($num) || empty($password)) {
            $this->error('学号或密码不能为空！');
        }
//        if( !captcha_check(input('captcha')) )
//        {
//            $this->error('验证码错误');
//        }
        // 进行账号验证
        $data = Employee::where('num', $num)->find();
        if (!$data) {
            $this->error('学号不存在，请验证后输入！');
        }
        // 进行密码验证
        if (md5($password) !=  $data['password']) {
            $this->error('学号和密码不匹配！');
        }
        // 如果学号和密码匹配，则登录成功
        session('Uname', $num);
        session('User', $data['name']);
        if ($data['admin'] == 0) {
        $this->success('员工登录成功！', 'User/index');
        }
        else
        {
            $this->success('负责人登录成功','Admin/index');
        }
    }


}
