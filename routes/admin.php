<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::post('logout', 'LoginController@logout');

Route::get('/', 'IndexController@index');


//Route::get('index', ['as' => 'admin.index.index', 'uses' => function () {
//    return redirect('/admin/log-viewer');
//}]);


Route::group(['middleware' => ['auth:admin', 'menu', 'authAdmin']], function () {


    //管理员用户管理路由
    Route::get('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);  //用户管理
    Route::post('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    Route::resource('user', 'UserController', ['names' => ['update' => 'admin.role.edit', 'store' => 'admin.role.create']]);

    //职位管理
    Route::get('job/index', ['as' => 'admin.job.index', 'uses' => 'JobController@index']);
    Route::get('job/{id}/update', ['as' => 'admin.job.update', 'uses' => 'JobController@update']);
    Route::put('job/store', ['as' => 'admin.job.store', 'uses' => 'JobController@store']);

    //公司管理
    Route::get('company/index', ['as' => 'admin.company.index', 'uses' => 'CompanyController@index']);
    Route::get('company/{id}/update', ['as' => 'admin.company.update', 'uses' => 'CompanyController@update']);
    Route::put('company/store', ['as' => 'admin.company.store', 'uses' => 'CompanyController@store']);
    Route::get('company/{id}/persons', ['as' => 'admin.company.persons', 'uses' => 'CompanyController@persons']);
    Route::get('company/apply/modify/index', ['as' => 'admin.company_apply_modify.index', 'uses' => 'CompanyController@applyModifyInfo']);
    Route::get('company/tianyancha/{id}', ['as' => 'admin.company.tianyancha', 'uses' => 'CompanyController@tianyancha']);

    //反馈管理
    Route::get('feedback/index', ['as' => 'admin.feedback.index', 'uses' => 'FeedbackController@index']);

    //游戏管理
    Route::get('game/index', ['as' => 'admin.game.index', 'uses' => 'GameController@index']);
    Route::get('game/edit/{id}', ['as' => 'admin.game.edit', 'uses' => 'GameController@edit']);
    Route::put('game/update', ['as' => 'admin.game.update', 'uses' => 'GameController@update']);


    //社区管理
    Route::get('community/index', ['as' => 'admin.community.index', 'uses' => 'CommunityController@index']);
    Route::get('community/{id}/update', ['as' => 'admin.community.update', 'uses' => 'CommunityController@update']);
    Route::post('community/destroy', ['as' => 'admin.community.destroy', 'uses' => 'CommunityController@destroy']);
    Route::put('community/store', ['as' => 'admin.community.store', 'uses' => 'CommunityController@store']);
    Route::get('community/{id}/comments', ['as' => 'admin.community.comments', 'uses' => 'CommunityController@comments']);
    Route::get('community/comments/destroy', ['as' => 'admin.community.comments.destroy', 'uses' => 'CommunityController@commentsDestroyAjax']);

    //产品研发榜管理
    Route::get('product/index', ['as' => 'admin.product.index', 'uses' => 'ProductController@index']);
    Route::get('product/{id}/update', ['as' => 'admin.product.update', 'uses' => 'ProductController@update']);
    Route::put('product/store', ['as' => 'admin.product.store', 'uses' => 'ProductController@store']);
    Route::post('product/destroy', ['as' => 'admin.product.destroy', 'uses' => 'ProductController@destroy']);

    //发布需求榜管理
    Route::get('issue/demand/index', ['as' => 'admin.issue.demand.index', 'uses' => 'IssueDemandController@index']);
    Route::get('issue/demand/{id}/update', ['as' => 'admin.issue.demand.update', 'uses' => 'IssueDemandController@update']);
    Route::put('issue/demand/store', ['as' => 'admin.issue.demand.store', 'uses' => 'IssueDemandController@store']);
    Route::post('issue/demand/destroy', ['as' => 'admin.issue.demand.destroy', 'uses' => 'IssueDemandController@destroy']);

    //渠道需求榜管理
    Route::get('channel/demand/index', ['as' => 'admin.channel.demand.index', 'uses' => 'ChannelDemandController@index']);
    Route::get('channel/demand/{id}/update', ['as' => 'admin.channel.demand.update', 'uses' => 'ChannelDemandController@update']);
    Route::put('channel/demand/store', ['as' => 'admin.channel.demand.store', 'uses' => 'ChannelDemandController@store']);
    Route::post('channel/demand/destroy', ['as' => 'admin.channel.demand.destroy', 'uses' => 'ChannelDemandController@destroy']);

    //外包供需榜管理
    Route::get('outsource/index', ['as' => 'admin.outsource.index', 'uses' => 'OutsourceController@index']);
    Route::get('outsource/{id}/update', ['as' => 'admin.outsource.update', 'uses' => 'OutsourceController@update']);
    Route::put('outsource/store', ['as' => 'admin.outsource.store', 'uses' => 'OutsourceController@store']);
    Route::post('outsource/destroy', ['as' => 'admin.outsource.destroy', 'uses' => 'OutsourceController@destroy']);

    //游戏开测榜管理
    Route::get('open/test/index', ['as' => 'admin.open.test.index', 'uses' => 'OpenTestController@index']);
    Route::get('open/test/{id}/update', ['as' => 'admin.open.test.update', 'uses' => 'OpenTestController@update']);
    Route::put('open/test/store', ['as' => 'admin.open.test.store', 'uses' => 'OpenTestController@store']);
    Route::post('open/test/destroy', ['as' => 'admin.open.test.destroy', 'uses' => 'OpenTestController@destroy']);

    //普通用户管理
    Route::get('member/index', ['as' => 'admin.member.index', 'uses' => 'MemberController@index']);
    Route::get('member/{id}/show', ['as' => 'admin.member.show', 'uses' => 'MemberController@show']);

    //充值管理
    Route::get('payment/log/index', ['as' => 'admin.payment.log.index', 'uses' => 'PaymentLogController@index']);

    //短信验证
    Route::get('sms/log/index', ['as' => 'admin.sms.index', 'uses' => 'LaravelSmsController@index']);

    //start
    Route::get('index', ['as' => 'admin.index.index', 'uses' => 'IndexController@index']);
    //权限管理路由
    Route::get('permission/{cid}/create', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@create']);
    Route::get('permission/manage', ['as' => 'admin.permission.manage', 'uses' => 'PermissionController@index']);
    Route::get('permission/{cid?}', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);
    Route::post('permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']); //查询
    Route::resource('permission', 'PermissionController', ['names' => ['update' => 'admin.permission.edit', 'store' => 'admin.permission.create']]);
    //角色管理路由
    Route::get('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::post('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::resource('role', 'RoleController', ['names' => ['update' => 'admin.role.edit', 'store' => 'admin.role.create']]);
    //提示消息
    Route::get('tipnews/index', 'TipNewsController@index')->name('admin.tipnews.index');
    Route::get('tipnews/{id}/update', 'TipNewsController@update')->name('admin.tipnews.update');
    Route::post('tipnews/save', 'TipNewsController@save')->name('admin.tipnews.save');
    Route::get('tipnews/create', 'TipNewsController@create')->name('admin.tipnews.create');
    Route::get('tipnews/del/{id}', 'TipNewsController@del')->name('admin.tipnews.del');
    //专题
    Route::get('topic/index', 'TopicController@index')->name('admin.topic.index');
    Route::get('topic/{id}/update', 'TopicController@update')->name('admin.topic.update');
    Route::post('topic/save', 'TopicController@save')->name('admin.topic.save');
    Route::get('topic/create', 'TopicController@create')->name('admin.topic.create');
    Route::get('topic/del/{id}', 'TopicController@del')->name('admin.topic.del');
    //幻灯片
    Route::get('sides/index', 'SidesController@index')->name('admin.sides.index');
    Route::get('sides/{id}/update', 'SidesController@update')->name('admin.sides.update');
    Route::post('sides/save', 'SidesController@save')->name('admin.sides.save');
    Route::get('sides/create', 'SidesController@create')->name('admin.sides.create');
    Route::get('sides/del/{id}', 'SidesController@del')->name('admin.sides.del');
    Route::get('getsidestype', 'SidesController@getSidesType')->name('admin.sides.sides_type');
    //杂项-系统设置
    //联系我们
    Route::get('aboutus/index', ['as' => 'admin.system.aboutus_index', 'uses' => 'SystemController@aboutUsIndex']);
    Route::post('aboutus/store', ['as' => 'admin.system.aboutus_store', 'uses' => 'SystemController@aboutUsStore']);
    //图片上传地址
    Route::post('system/upload', ['as' => 'admin.system.upload', 'uses' => 'SystemController@upload']);
    //商品管理
    Route::get('goods/index', ['as' => 'admin.goods.index', 'uses' => 'GoodsController@index']);
    Route::get('goods/{id}/update', ['as' => 'admin.goods.update', 'uses' => 'GoodsController@update']);
    Route::post('goods/save', ['as' => 'admin.goods.save', 'uses' => 'GoodsController@save']);
    //商品分类管理路由
    Route::get('category/index', ['as' => 'admin.category.index', 'uses' => 'GoodsController@categoryIndex']);
    Route::get('category/create', ['as' => 'admin.category.create', 'uses' => 'GoodsController@categoryCreate']);
    Route::get('category/{id}/update', ['as' => 'admin.category.update', 'uses' => 'GoodsController@categoryUpdate']);
    Route::post('category/save', ['as' => 'admin.category.save', 'uses' => 'GoodsController@categorySave']);
    Route::get('category/del/{id}', 'GoodsController@categoryDel')->name('admin.category.del');

});

// 获取city
Route::get('/address/city/{id}',function (\App\Service\AddressService $areaService, $id){
    return $areaService->getCity($id);
});
// 获取area
Route::get('/address/area/{id}',function (\App\Service\AddressService $areaService, $id){
    return $areaService->getArea($id);
});

Route::get('/', function () {
    return redirect('/admin/index');
});

