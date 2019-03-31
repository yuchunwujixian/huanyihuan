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


Route::group(['middleware' => ['auth:admin', 'menu', 'authAdmin']], function () {

    //反馈管理
    Route::get('feedback/index', ['as' => 'admin.feedback.index', 'uses' => 'FeedbackController@index']);



    //充值管理
    Route::get('payment/log/index', ['as' => 'admin.payment.log.index', 'uses' => 'PaymentLogController@index']);


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
    //管理员用户管理路由
    Route::get('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);  //用户管理
    Route::post('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    Route::resource('user', 'UserController', ['names' => ['update' => 'admin.role.edit', 'store' => 'admin.role.create']]);
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
    Route::get('topic/{id}/goods', 'TopicController@goods')->name('admin.topic.goods');
    Route::post('topic/{id}/savegoods', 'TopicController@saveGoods')->name('admin.topic.savegoods');
    Route::post('topic/{id}/delgoods', 'TopicController@delGoods')->name('admin.topic.delgoods');
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
    //普通用户管理
    Route::get('member/index', ['as' => 'admin.member.index', 'uses' => 'MemberController@index']);
    Route::get('member/changestatus', 'MemberController@changeStatus')->name('admin.member.changestatus');
    Route::get('member/{id}/edit', ['as' => 'admin.member.edit', 'uses' => 'MemberController@edit']);
    Route::post('member/store', 'MemberController@store')->name('admin.member.store');
    //短信验证
    Route::get('member/sms', 'MemberController@sms')->name('admin.member.sms');
    //用户回馈
    Route::get('member/feedback', 'MemberController@feedback')->name('admin.member.feedback');
    Route::post('member/feedbackstatus', 'MemberController@feedbackStatus')->name('admin.member.feedbackstatus');

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

