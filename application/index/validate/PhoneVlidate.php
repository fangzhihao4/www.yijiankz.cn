<?php

namespace app\index\validate;
use think\Validate;
class PhoneValidate extends Validate
{
    protected $rule = [
        ['class_id', 'require', '用户id不能为空'],
        ['phone', 'require', '字段值不能为空'],
    ];
}