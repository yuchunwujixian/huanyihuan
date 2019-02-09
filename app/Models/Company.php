<?php
/**
 * -----------------------------------------
 * Desc: 公司模型
 * User: Jiafang.Wang
 * Date: 2017/3/20
 * Time: 15:24
 * File: Company.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Company extends Model
{

    /**
     * @name publishJobs
     * @desc 该公司发布的职位
     * @author Jiafang.wang
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function publishJobs()
    {
        return $this->hasMany('App\Models\Job', 'company_id', 'id');
    }


    /**
     * @name userInfo
     * @desc 公司所有者
     * @author Jiafang.wange
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * @name contactInfos
     * @desc 公司联系人
     * @author Jiafang.wange
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function CompanyPersonInfo()
    {
        return $this->hasMany('App\Models\CompanyPerson', 'company_id', 'id');
    }

    /**
     * @desc 该公司定位
     * @param string $type_string
     * @since 2017/4/26 20:00
     * @author Jiafang.Wang
     * @return string
     */
    public function CompanyTypes($type_string)
    {
        $job_config = config('job');
        $type_array = explode(',', $type_string);
        $out = '';
        foreach ($type_array as $key => $value) {
            $out .= $job_config['company_type'][$value] .' / ';
        }
        return $out;

    }

    /**
     * @desc 该公司研发榜产品
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Jiafang.wang
     * @since 2017/5/15 12:44
     */
    public function companyProductInfo()
    {
        return $this->hasMany('App\Models\Product', 'company_id', 'id');
    }

    /**
     * @name CompanyPhotos
     * @desc 公司环境
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @since  ${DATE}
     * @update ${DATE}
     */
    public function CompanyPhotos()
    {
        return $this->hasMany('App\Models\CompanyPhoto', 'company_id', 'id');
    }

    /**
     * @name CompanyIssueDemand
     * @desc  公司发布需求
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @since  2017/05/15
     * @update 2017/05/15
     */
    public function CompanyIssueDemand()
    {
        return $this->hasMany('App\Models\IssueDemand', 'company_id', 'id');
    }

    public function CompanyChannelDemand()
    {
        return $this->hasMany('App\Models\ChannelDemand', 'company_id', 'id');
    }

    public function CompanyOutsource()
    {
        return $this->hasMany('App\Models\Outsource', 'company_id', 'id');
    }

    public function CompanyOpenTest()
    {
        return $this->hasMany('App\Models\OpenTest', 'company_id', 'id');
    }
}
