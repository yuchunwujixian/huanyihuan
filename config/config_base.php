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
    ]
];