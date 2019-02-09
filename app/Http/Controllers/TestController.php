<?php
/**
 * -----------------------------------------
 * Desc:
 * User: Jiafang.Wang
 * Date: 2017/3/20
 * Time: 16:19
 * File: TestController.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Http\Controllers;

use Auth;
use App\Models\JobCategory as Category;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use Symfony\Component\HttpFoundation\Request;
use App\Notifications\InvoicePaid;
use Socialite;

class TestController extends Model
{
    //所有职位信息
    public function jobs()
    {
        $jobs = Job::get();
        foreach($jobs AS $job) {
            //职位的基本信息
            // ......
            var_dump( $job->companyInfo->title );
            var_dump( $job->userInfo->name );
            var_dump($job->welfareInfo($job->temptation)->toArray());
            var_dump( $job->companyImages->toArray());
        }

    }

    //显示某个职位信息
    public function show($id)
    {
        $job = Job::find($id);
        print_r($job->toArray());
        var_dump( $job->companyInfo->title );
    }

    //某个分类下的所有职位
    public function jobsForOneCategory($category_id)
    {
        $job_category = JobCategory::find($category_id);
        $jobs = $job_category->jobs->toArray();
        print_r($jobs);
    }

    public function userInfo(Request $request)
    {
//        $user = $request->user();
        $user = Auth::user();
        print_r($user);
        echo $user->id;

        $is_login = Auth::check();
        var_dump($is_login);
    }

    public function insertCategory()
    {
        $root = Category::create(['title' => 'Root category 3']);
        var_dump($root);
    }

    public function insertChildNode()
    {
        $root = Category::find(4);

        $child1 = $root->children()->create(['title' => 'Child 1-1-1']);
        var_dump($child1);
    }

    public function getSiblings()
    {
        $node = Category::find(1);
        $ret = $node->children();
        print_r($ret);
    }
    public function getAllChildNodeByPid($pid)
    {

    }

    public function buildTree()
    {
        $categories = Category::get();
        $ret = Category::buildTree($categories);
        var_dump($ret);
    }

    public function allNodes()
    {
        $nodes = Category::all();
//        print_r($nodes);
        $ret = Category::buildTree($nodes->toArray());
        print_r($ret);
    }

    public function info()
    {
//        $node = Category::find(1);
//        $a = $node->getLevel();
//        var_dump($a);
//        $b = $node->isRoot();
//        $b = $node->isChild();
//        $b = $node->parent()->get();
//        $node = Category::find(1);
//        $b = $node->children()->get()->toArray();
//        var_dump($b);

//        $c = Category::roots()->get()->toArray();
//        $c = Category::allLeaves()->get()->toArray();
//        print_r($c);r
//        $d = Category::getNestedList('title');
//        var_dump($d);
//        $e = Category::rebuild(1);
//        print_r($e);
//        $f = Category::buildTree($c);
//        var_dump($f);

//        $g = Category::where(['parent_id' =>  '0'])->get()->toArray();
//        $g =  Category::roots()->select('id', 'parent_id', 'title')->get()->toArray();
//        foreach($g as $key => $val)
//        {
//            $g[$key]['child'] = Category::find($val['id'])->children()->select('id', 'parent_id', 'title')->get()->toArray();
//        }
//        print_r($g);
        $h = Category::orderBy('lft', 'asc')->get()->toArray();
//        print_r($h);
        foreach($h as $k => $v) {
            $sp = '|';
            for($i=0;$i<$v['depth']+1;$i++) {
                $sp .= '—';
            }
            echo $sp. $v['title'];
            echo "<br />";
        }
    }

    public function notify_1()
    {

    }
    public function qq(){
        $clientId = "101406573";
        $clientSecret = "7edaf0bd99747ef019543ee9fdf7d3c6";
        $redirectUrl = "http://www.jiongmiyou.com/qqlogin";
        $additionalProviderConfig = ['site' => 'meta.stackoverflow.com'];
        $config = new \SocialiteProviders\Manager\Config($clientId, $clientSecret, $redirectUrl, $additionalProviderConfig);
        return Socialite::with('qq')->setConfig($config)->redirect();
    }
    public function qqlogin(){
        $user = Socialite::driver('qq')->user();
        var_dump($user->getId());
        var_dump($user->getNickname());
        var_dump($user->getName());
        var_dump($user->getEmail());
        var_dump($user->getAvatar());
    }
}