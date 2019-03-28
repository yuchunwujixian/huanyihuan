<?php
/**
 *基础配置项
 */
return [
    'site_name' => '换一换',
    //幻灯片类型
    'sides_type' => [
        0 => '首页',
        1 => '专题',
        2 => '关于我们',
    ],
    //商品状态
    'goods_status' => [
        -2 => '已删除',
        -1 => '被禁止',
        0 => '待审核',
        1 => '正常',
        2 => '已完成',
    ],
    //价格区间
    'prices' => [
        0 => '0~100',
        1 => '101~200',
        2 => '201~300',
        3 => '301~500',
        4 => '501~700',
        5 => '701~1000',
        6 => '1001~10000',
        7 => '10001~以上',
    ],
    //用户积分类型
    'integral_type' => [
        1 => [
            'name' => '注册送',//名称
            'frequency_type' => 'one',//频率类型 one一次性 day 相隔天数
        ],
        2 => [
            'name' => '登录送',
            'frequency_type' => 'day',//频率类型 one一次性 day 相隔天数
            'frequency_num' => 1,//相隔值
        ],
        3 => [
            'name' => '意见反馈送',
            'frequency_type' => 'day',//频率类型 one一次性 day 相隔天数
            'frequency_num' => 1,//相隔值
        ],
    ],
    'email_rule' => '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/i',

    'mobile_rule' => '/^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|17[13678]|18\d)\d{8}|170[059]\d{7})$/',
];