<?php

namespace app\index\validate;
use think\Validate;
class AddressValidate extends Validate
{
    protected $rule = [
        ['class_id', 'require', '用户id不能为空'],
        ['total', 'float', '字段值不符法'],
        ['frist', 'float', '字段值不符法'],
        ['month', 'float', '字段值不符法'],
        ['decorate', 'float', '字段值不符法'],
    ];
}