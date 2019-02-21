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

Auth::routes();

Route::get('/home', 'HomeController@index');

//测试
Route::get('/test/jobs', 'TestController@jobs');
Route::get('/test/job/{id}', 'TestController@show');
Route::get('/test/category/{category_id}', 'TestController@jobsForOneCategory');
Route::get('/test/user/info', 'TestController@userInfo');
Route::get('/test/insert/category', 'TestController@insertCategory');
Route::get('/test/insert/child/node', 'TestController@insertChildNode');
Route::get('/test/build/tree', 'TestController@buildTree');
Route::get('/test/get/siblings', 'TestController@getSiblings');
Route::get('/test/get/all/nodes', 'TestController@allNodes');
Route::get('/test/node/info', 'TestController@info');


//---------------首页-------------
Route::get('/', 'IndexController@index')->name('index.index');
Route::match(['get', 'post'],'/search/index', 'SearchController@index')->name('search.index');
Route::get('/search/no/result', 'SearchController@noresult')->name('search.noresult');

//---------------招聘---------------
Route::get('job/{id}/show', 'JobController@show')->name('job.show');
Route::get('job/index/{province_code?}/{category_id?}/{salary?}/{type?}/{time?}', 'JobController@index2')->name('job.index');

//---------------公司---------------
Route::get('company/index', 'CompanyController@index')->name('company.index');
Route::get('company/{id}/show', 'CompanyController@show')->name('company.show');
Route::get('company/search', 'CompanyController@lists')->name('company.search');



//---------------社区---------------
Route::get('community/index', 'CommunityController@index')->name('community.index');
Route::post('community/post/store', 'CommunityController@storePost')->name('community.post.store');
Route::post('community/comment/store', 'CommunityController@storeCommentAjax')->name('community.comment.store');    //保存评论
Route::post('community/points/store', 'CommunityController@storePoints')->name('community.points.store'); //点赞
Route::post('community/collects/store', 'CommunityController@storeCollects')->name('community.collects.store');  //收藏
Route::get('community/my/posts', 'CommunityController@myReleasePosts')->name('community.posts.my'); //我的发布
Route::get('community/my/collects', 'CommunityController@myCollectsPosts')->name('community.collects.my'); //我的收藏
Route::get('community/my/comments', 'CommunityController@myCommentPosts')->name('community.comments.my'); //我参与的
Route::get('community/post/{id}/destroy', 'CommunityController@destroy')->name('community.post.destroy'); //删除我发布的帖子

//---------------关于我们-------------
Route::get('aboutus/index', 'AboutusController@index')->name('aboutus.index');
//---------------反馈-------------
Route::post('aboutus/feedback', 'AboutusController@feedback')->name('aboutus.feedback');

//---------------游戏详情页---------------
Route::get('game/{id}/show', 'GameController@show')->name('game.show');

//---------------需求页页---------------
Route::get('publishing/product/index/{period?}/{platform?}/{type?}/{game_type?}/{cooperation?}/{area?}/{province?}', 'ProductController@index')->name('publishing.product.index');
Route::get('product/{id}/show', 'ProductController@show')->name('product.show');
Route::get('publishing/issue/demand/index/{platform?}/{type?}/{game_type?}/{cooperation?}/{area?}/{province?}', 'IssueDemandController@index')->name('publishing.issue.demand.index');
Route::get('publishing/channel/demand/index/{platform?}/{type?}/{game_type?}/{cooperation?}/{channel?}/{province?}', 'ChannelDemandController@index')->name('publishing.channel.demand.index');
Route::get('publishing/outsource/index/{outsource?}/{precondition?}', 'OutsourceController@index')->name('publishing.outsource.index');
Route::get('publishing/open/test/index', 'OpenTestController@index')->name('publishing.open.test.index');

//---------------注册获得短信验证码-----------------
Route::post('/laravel/sms/verify/code', 'LaravelSmsController@send')->name('verify.code');
Route::get('/registration/policy', function(){
    return view('auth.registrationPolicy');
})->name('registration.policy');

//---------------邮箱注册-----------------
Route::post('/email/send', 'EmailCodeController@send')->name('email.send');//发送注册验证码
Route::get('/forgot/password', 'Auth\ForgotPasswordController@forgot')->name('forgot.password');//忘记密码
Route::post('/forgot/password/send', 'EmailCodeController@forgot')->name('forgot.password.send');//发送忘记密码的验证码
Route::post('/forgot/password/reset', 'Auth\RegisterController@forgot')->name('forgot.password.reset');//忘记密码

//---------------第三方登陆---------------
Route::get('/login/qqlogin','LoginBandController@qqlogin');//qq回掉地址
Route::get('/login/qq','LoginBandController@qq')->name('login.qq');
Route::get('/login/weixinlogin','LoginBandController@weixinlogin');//微信回掉地址
Route::get('/login/weixin','LoginBandController@weixin')->name('login.weixin');
Route::get('/login/weibologin','LoginBandController@weibologin');//微博回掉地址
Route::get('/login/weibo','LoginBandController@weibo')->name('login.weibo');
Route::post('/login/login','LoginBandController@login')->name('login.login');

//---------------用户中心-----------------
Route::group(['namespace' => 'Member', 'prefix' => 'member', 'middleware' => ['auth']], function () {

    Route::get('/', function(){
    return redirect('/member/info/index');
})->name('member.index.index');
    //---------------招聘-----------------
    Route::get('job/index', 'JobController@index')->name('member.job.index');
    Route::get('job/create', 'JobController@create')->name('member.job.create');
    Route::get('job/{id}/update/', 'JobController@update')->name('member.job.update');
    Route::post('job/store', 'JobController@store')->name('member.job.store');
    Route::get('job/{id}/destroy', 'JobController@destroy')->name('member.job.destroy');


    //---------------公司---------------
    Route::get('company/index', 'CompanyController@index')->name('member.company.index');
    Route::get('company/create', 'CompanyController@create')->name('member.company.create');
    Route::post('company/store', 'CompanyController@store')->name('member.company.store');
    Route::post('company/store/company/person', 'CompanyController@storeCompanyPerson')->name('member.company.store_company_pserson');
    Route::post('company/store/company/environment', 'CompanyController@storeCompanyEnvironment')->name('member.company.store_company_environment');
    Route::get('company/apply/modify/info', 'CompanyController@applyModifyCompanyInfo')->name('member.company.apply.modify.info');
    Route::post('company/store/apply/modify/info', 'CompanyController@storeModifyCompanyInfo')->name('member.company.store.apply.modify.info');
    Route::post('company/destroy/company/environment', 'CompanyController@destroyCompanyEnvironment')->name('member.company.destroy_company_environment');
    //---------------基本资料------------------
    Route::get('info/index', 'InfoController@index')->name('member.info.index');
    Route::post('info/store', 'InfoController@store')->name('member.info.store');
    Route::post('info/company', 'InfoController@company')->name('member.info.company');

    //---------------积分----------------
    Route::get('integral/index', 'IntegralController@index')->name('member.integral.index');
    Route::post('integral/store', 'IntegralController@store')->name('member.integral.store');
    Route::get('integral/lists', 'IntegralController@lists')->name('member.integral.lists');//他人寻求帮助列表
    Route::get('integral/{id}/show', 'IntegralController@show')->name('member.integral.show');
    Route::post('integral/feedback', 'IntegralController@feedback')->name('member.integral.feedback');
    Route::get('integral/answer', 'IntegralController@answer')->name('member.integral.answer');
    Route::get('integral/question', 'IntegralController@question')->name('member.integral.question');
    Route::get('integral/{id}/view', 'IntegralController@view')->name('member.integral.view');
    Route::post('integral/sure', 'IntegralController@sure')->name('member.integral.sure');
    Route::post('integral/refuse', 'IntegralController@refuse')->name('member.integral.refuse');
    Route::get('integral/payment', 'IntegralController@payment')->name('member.integral.payment');//充值
    Route::post('integral/pay', 'IntegralController@pay')->name('member.integral.pay');//充值
    //支付宝支付处理
    Route::get('alipay','AlipayController@Alipay')->name('member.alipay');  // 发起支付请求
    Route::any('notify','AlipayController@AliPayNotify'); //服务器异步通知页面路径
    Route::any('return','AlipayController@AliPayReturn');  //页面跳转同步通知页面路径
    Route::get('integral/logs', 'IntegralController@logs')->name('member.integral.logs');//充值


    //---------------充值------------------
    Route::get('payment/index', 'IntegralController@index')->name('member.payment.index');

    //---------------产品研发榜-----------------
    Route::get('publishing/product/index', 'ProductController@index')->name('member.publishing.product.index');
    Route::get('publishing/product/create', 'ProductController@create')->name('member.publishing.product.create');
    Route::post('publishing/product/store', 'ProductController@store')->name('member.publishing.product.store');
    Route::get('publishing/product/{id}/update/', 'ProductController@update')->name('member.publishing.product.update');
    Route::post('publishing/product/destroy', 'ProductController@destroy')->name('member.publishing.product.destroy');
    Route::post('publishing/product/store/product/person', 'ProductController@storeProductPerson')->name('member.publishing.product.store_product_person');

//---------------发布需求榜-----------------
    Route::get('publishing/issue/demand/index', 'IssueDemandController@index')->name('member.publishing.issueDemand.index');
    Route::get('publishing/issue/demand/create', 'IssueDemandController@create')->name('member.publishing.issueDemand.create');
    Route::post('publishing/issue/demand/store', 'IssueDemandController@store')->name('member.publishing.issueDemand.store');
    Route::get('publishing/issue/demand/{id}/update/', 'IssueDemandController@update')->name('member.publishing.issueDemand.update');
    Route::post('publishing/issue/demand/destroy', 'IssueDemandController@destroy')->name('member.publishing.issueDemand.destroy');


//---------------渠道需求榜-----------------
    Route::get('publishing/channel/demand/index', 'ChannelDemandController@index')->name('member.publishing.channelDemand.index');
    Route::get('publishing/channel/demand/create', 'ChannelDemandController@create')->name('member.publishing.channelDemand.create');
    Route::post('publishing/channel/demand/store', 'ChannelDemandController@store')->name('member.publishing.channelDemand.store');
    Route::get('publishing/channel/demand/{id}/update/', 'ChannelDemandController@update')->name('member.publishing.channelDemand.update');
    Route::post('publishing/channel/demand/destroy', 'ChannelDemandController@destroy')->name('member.publishing.channelDemand.destroy');


    //---------------外包供需榜-----------------
    Route::get('publishing/outsource/index', 'OutsourceController@index')->name('member.publishing.outsource.index');
    Route::get('publishing/outsource/create', 'OutsourceController@create')->name('member.publishing.outsource.create');
    Route::post('publishing/outsource/store', 'OutsourceController@store')->name('member.publishing.outsource.store');
    Route::get('publishing/outsource/{id}/update/', 'OutsourceController@update')->name('member.publishing.outsource.update');
    Route::post('publishing/outsource/destroy', 'OutsourceController@destroy')->name('member.publishing.outsource.destroy');

    //---------------游戏开测榜-----------------
    Route::get('publishing/open/test/index', 'OpenTestController@index')->name('member.publishing.openTest.index');
    Route::get('publishing/open/test/create', 'OpenTestController@create')->name('member.publishing.openTest.create');
    Route::post('publishing/open/test/store', 'OpenTestController@store')->name('member.publishing.openTest.store');
    Route::get('publishing/open/test/{id}/update/', 'OpenTestController@update')->name('member.publishing.openTest.update');
    Route::post('publishing/open/test/destroy', 'OpenTestController@destroy')->name('member.publishing.openTest.destroy');
    Route::post('publishing/open/test/product/info', 'OpenTestController@productInfo')->name('member.publishing.openTest.productInfo');

});


Route::post('upload/images', 'UploadController@uploadImages')->name('upload.images');