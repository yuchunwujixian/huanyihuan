<?php
/**
 * -----------------------------------------
 * Desc:
 * User: Jiafang.Wang
 * Date: 2017/4/18
 * Time: 22:26
 * File: AddressService.php
 * Project: JiongMIGame
 * -----------------------------------------
 */

namespace App\Service;

use DB;

class AddressService
{
    /**
     * @name getProvince
     * @desc 获取省级的数据
     * @author Jiafang.Wang
     * @since 2017.4.18
     * @return mixed
     */
    public static function getProvince()
    {
        return DB::table('province')->get(['id','code','name']);
    }

    /**
     * @desc
     * @param $id
     * @since date
     * @author Jiafang.Wang
     * @return mixed
     */
    public function getCity($id)
    {
        return DB::table('city')->where('provincecode', $id)->get(['id','code','name','provincecode']);
    }

    /**
     * @desc
     * @param $id
     * @since date
     * @author Jiafang.Wang
     * @return mixed
     */
    public function getArea($id)
    {
        return DB::table('area')->where('citycode', $id)->get(['id','code','name','citycode']);
    }
}