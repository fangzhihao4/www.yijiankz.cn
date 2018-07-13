<?php
// +----------------------------------------------------------------------
// | yijiankz
// +----------------------------------------------------------------------
// | Author: fangzhihao4 <454114407@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\validate;

use think\Validate;

class Index extends Validate
{
	protected $rule = [
        ['username', 'require|max:30', '用户名不能为空|用户名不能超过30个字符'],
        ['password', 'require|between:6,15', '密码不能为空|密码长度在6-15个字符'],
    ];
}
