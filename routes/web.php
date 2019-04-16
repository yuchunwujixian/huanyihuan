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

//首页
Route::get('/', 'IndexController@index')->name('index.index');
//商品列表页
Route::get('goods', 'GoodsController@index')->name('goods.index');
//---------------关于我们-------------
Route::get('aboutus/index', 'AboutusController@index')->name('aboutus.index');
//---------------反馈-------------
Route::post('aboutus/feedback', 'AboutusController@feedback')->name('aboutus.feedback');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//---------------注册-----------------
Route::get('/register/policy', 'Auth\RegisterController@policy')->name('register.policy');//注册须知
Route::post('/sms/send', 'SmsController@send')->name('sms.send');//发送验证码
Route::get('/forget/password', 'Auth\ForgetPasswordController@index')->name('forget.index');//忘记密码
Route::post('/forget/password/reset', 'Auth\RegisterController@forget')->name('forget.reset');//忘记密码
//--end

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

    Route::get('/',  'InfoController@index')->name('member.info.index.index');
    //---------------基本资料------------------
    Route::get('info/index', 'InfoController@index')->name('member.info.index');
    Route::post('info/store', 'InfoController@store')->name('member.info.store');
    Route::post('info/bandusername', 'InfoController@bandusername')->name('member.info.bandusername');
    //图片上传
    Route::post('upload/images', 'UploadController@uploadImages')->name('member.upload.images');
    //我的商品
    Route::get('goods/index', 'GoodsController@index')->name('member.goods.index');
    Route::get('goods/create', 'GoodsController@create')->name('member.goods.create');




    //支付宝支付处理
    Route::get('alipay','AlipayController@Alipay')->name('member.alipay');  // 发起支付请求
    Route::any('notify','AlipayController@AliPayNotify'); //服务器异步通知页面路径
    Route::any('return','AlipayController@AliPayReturn');  //页面跳转同步通知页面路径
    Route::get('integral/logs', 'IntegralController@logs')->name('member.integral.logs');//充值

    //---------------充值------------------
    Route::get('payment/index', 'IntegralController@index')->name('member.payment.index');

});