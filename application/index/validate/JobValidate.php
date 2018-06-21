<?php

namespace app\index\validate;
use think\Validate;
class JobValidate extends Validate
{
    protected $rule = [
        ['class_id', 'require', '用户id不能为空'],
        ['name', 'require', '字段值不能为空'],
    ];
}