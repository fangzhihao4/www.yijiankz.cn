<?php
namespace app\admin\controller;

use think\Loader;
use think\Db;

class Index extends Base
{
    public function index()
    {
    	// 测试
		// $admin = model('Admin');
		// dump($this->uid);exit;
		// $admin = Loader::model('Admin');
		// $name = $admin->getAdmin('1');
		
    	// $name = db('user')->where('id',1)->find();
    	// dump($name);
    	
    	// $data['name'] = 'user';
    	// $data['password'] = 'password';
    	// $register = loader::model('Admin')->insertAdmin($data); 
    	// var_dump($register);exit;
    	
        $sqk = Db::query('select * from kz_user left join kz_order on kz_user.id = kz_order.user_id');
        // $data = Loader::model('user')->query($sqk);
        dump($sqk);exit;
        dump(mktime(0,0,0,date('m'),date('d'),date('Y')));
        dump(strtotime(date("Y-m-d")));exit;
    	
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架11111</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
}
       