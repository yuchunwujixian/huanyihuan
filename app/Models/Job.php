<?php
/**
 * -----------------------------------------
 * Desc: 职位模型
 * User: Jiafang.Wang
 * Date: 2017/3/20
 * Time: 15:25
 * File: Job.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Welfare;

class Job extends Model
{
    protected $fillable = [
        'updated_at', 'created_at', 'status', 'work_address',  'job_requirements', 'work_conntent', 'temptation',
        'type', 'education', 'experience',  'salary_end', 'salary_start', 'area_code', 'city_code', 'province_code',
        'title',  'job_category_id', 'company_id', 'user_id'
    ];
    /**
     * @name companyInfo
     * @desc 职位对应的公司信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/3/30 9:24
     * @update 2017/3/30 9:24
     */
    public function companyInfo()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    /**
     * @name userInfo
     * @desc 职位对应的发布者信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/3/30 9:24
     * @update 2017/3/30 9:24
     */
    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * @name categoryInfo
     * @desc 职位对应哪个分类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/3/30 9:25
     * @update 2017/3/30 9:25
     */
    public function categoryInfo()
    {
        return $this->belongsTo('App\Models\JobCategory', 'job_category_id', 'id');
    }

    /**
     * @desc
     * @param string $temptation
     * @since 2017/4/24 9:11
     * @author Jiafang.Wang
     * @return array    
     */
    public function welfareInfo(string $temptation)
    {
        return explode(',', $temptation);
    }

}
