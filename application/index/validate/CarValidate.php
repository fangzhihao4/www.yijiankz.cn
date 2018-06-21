<?php

namespace app\index\validate;
use think\Validate;
class CarValidate extends Validate
{
    protected $rule = [
        ['class_id', 'require', '用户id不能为空'],
        ['name', 'require|max:50', '必填|字符长度不超过50'],
        ['frist', 'float', '字段值不符法'],
        ['month', 'float', '字段值不符法'],
    ];
}