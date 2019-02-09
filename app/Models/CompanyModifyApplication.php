<?php
/**
 * --------------------------------------
 * Desc: 申请修改公司信息
 * User: Jiafang.Wang
 * Date: 2017/5/11 9:53
 * File: CompanyModifyApplication.php
 * --------------------------------------
 */


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CompanyModifyApplication extends Model
{

    protected $fillable = ['user_id', 'company_id', 'reason'];

    /**
     * @desc
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author Jiafang.wang
     * @since 2017/5/11 9:55
     */
    public function companyInfo()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }


    /**
     * @desc
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author Jiafang.wang
     * @since 2017/5/11 9:55
     */
    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}