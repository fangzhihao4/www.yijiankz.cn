<?php
// +----------------------------------------------------------------------
// | yijiankz
// +----------------------------------------------------------------------
// | Author: fangzhihao4 <454114407@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\logic;

use think\Session;
use think\Model;

class Login extends model
{	
	//登录
	public function index($data){
		$data['name'] = 'admin';
		$code = 1;
		$msg = '';
		if ($data) {
			if ($data['name']) {//用户名不为空
				$admin = model('admin')->findAdminByName($data['name']);
				if ($admin) {//有此用户
					if ($admin["password"] = md5($admin['pass_key'].$data['password'])) {//密码正确
						if ($admin['login_type'] == 1 || $admin['is_true'] == 1 && $admin['expire_time'] > time()) {//超级管理员||用户正常
							//获取ip
							$ip = '';
							if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
								$ip=$_SERVER['HTTP_CLIENT_IP'];
							}
							if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
								$ips = explode(', ',$_SERVER['HTTP_X_FORWARDED_FOR']);
								if($ip){ array_unshift($ips, $ip); $ip=FALSE; }
								for ($i=0; $i < count($ips); $i++){
									if(!eregi ('^(10│172.16│192.168).', $ips[$i])){
										$ip=$ips[$i];
										break;
									}
								}
							}
							//更新数据
							$login['login_ip'] = $ip;
							$login['login_time'] = time();
							$retrun = model('admin')->upAdmin($login,$admin['id']);
							if ($retrun) {
								$code = 2;
								$msg = "登录成功";
								//存入session
								Session::set('name',$admin['username']);
								Session::set('uid',$admin['id']);
							}else{
								$msg = '登录失败，请重新登录';
							}
						}else{
							$msg = "该用户已停用或在审核中或时间过期，请联系管理员！";
						}
					}else{
						$msg = "密码错误！";
					}
				}else{
					$msg = "没有该用户哦！";
				}
			}else{
				$msg = "用户名为空！";
			}
		}else{
			$msg = "没有数据哦!";
		}
        return [
            'code' => $code,
            'msg' => $msg,
        ];
	}

	//新增
	public function add($data){
		if (strlen($data['name']) > 50) {
			return [
				'code' => 2,
				'msg'  => '用户名大于50字符串',
			];
		}
		if($data['password'] != $data['onepasswrod']){
			return[
				'code' => 2,
				'msg'  => '两次密码输入不一致',
			];
		}
		if (strlen($data['password']) < 6 || strlen($data['password']) < 19) {
			return[
				'code' => 2,
				'msg'  => '密码小于6位或者大于18位'
			];
		}
		$return = model('admin')->findAdminByName($data['name']);
		if ($return) {
			return[
				'code' => 2,
				'msg'  => '已有此用户，请重新设置',
			];
		}
		$result = model('admin')->insertAdmin($data);
		if (!$result) {
			return[
				'code' => 2,
				'msg'  => '注册失败，请重新注册',
			];
		}else{
			return[
				'code' =>1,
				'msg'  =>'注册成功',
				'url'  =>'login/list',
			];
		}
	}

	//更改
	public function upd($data){
		if (!is_numeric($data['id'])) {
			return[
				'code' => 2,
				'msg'  => 'id出错，请重试',
			];
		}
		if(!$data['username'] || !$data['password']){
			return[
				'code' => 2,
				'msg'  => '用户名或密码为空，请重试',
			];
		}
		$return = model('admin')->findAdminByName($data['username']);
		if (!$return) {
			return[
				'code' => 2,
				'msg'  => '没有此用户或其他原因，请重试',
			];
		}
		$result = model('admin')->upAdmin($data,$data['id']);
		if ($result) {
			return[
				'code' => 1,
				'msg'  => '更新成功',
				'url'  => 'login/list',	
			];
		}else{
			return[
				'code' => 2,
				'msg'  => '更新失败，请重试',
			];
		}

	}

	//删除
	public function  del($id){
		if (is_numeric($id)) {
			return[
				'code' =>2,
				'msg'  =>'数据出错，请重试',
 			];
		}
		$return = model('admin')->delAdmin($id);
		if ($return) {
			return[
				'code' =>1,
				'msg'  =>'删除成功',
				'url'  =>'login/list',
 			];
		}else{
			return[
				'code' =>2,
				'msg'  =>'删除失败，请重试',
 			];
		}
	}
}
