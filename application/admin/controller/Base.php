<?php
namespace app\admin\controller;

use think\Loader;
use think\Session;
use think\Controller;

class Base extends Controller
{
	public function _initialize()
    {
    	$name = Session::get('name');
        if(!Session::get('name') || !Session::get('uid')){
        	$data['name'] = 'admin';
			$data['password'] = 'password';
			$login = Loader::model('Login','logic');
			$user = $login->index($data);
			dump($user);
            $loginUrl = url('login/index');
            if(request()->isAjax()){
                return msg(111, $loginUrl, '登录超时');
            }
            $this->redirect($loginUrl);
        }
        $this->name = session::get('name');
        $this->uid = session::get('uid');
        // 检查缓存
        // $this->cacheCheck();
        // $this->assign([
        //     'head'     => session('head'),
        //     'username' => session('username'),
        //     'id' => session('uid')
        // ]);
    }
}