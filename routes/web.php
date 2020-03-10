<?php


use App\Account;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::get('customers','CustomerController@index');
// Route::get('customers/create','CustomerController@create');
// Route::post('customers','CustomerController@store');
// Route::get('customers/{customer}','CustomerController@show')->middleware('can:view,customer');
// Route::get('customers/{customer}/edit','CustomerController@edit');
// Route::patch('customers/{customer}','CustomerController@update');
// Route::delete('customers/{customer}','CustomerController@destroy');

//Route::resource('customers', 'CustomerController');

//Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/manager/accounts','AccountController@index');
// Route::get('/manager/accounts/create','AccountController@create');
// Route::post('/manager/accounts','AccountController@store');
// Route::get('/manager/accounts/{account}/edit','AccountController@edit');
// Route::patch('/manager/accounts/{account}','AccountController@update');
// Route::patch('/manager/accounts/{account}/status','AccountController@status');
// Route::delete('/manager/accounts/{account}','AccountController@destroy');

/**************************************前台 START*********************************************/

Route::get('/', function (){

    //session()->forget('action_token');
    if(!session()->exists('action_token')){
        session(['action_token' => time()]);
    }
    
    //session()->forget('action_token');
    //session()->flush();
    //session()->pull('action_token', 'default');
    //dd(session()->all());
    return View::make('/front/index');
    //dd('asdsaad');
});
 

Route::get('/login', function (){
    return view('front.login');
});

//不需判斷是否登入的頁面
Route::post('/login','UserAccountLoginController@checklogin')->name('user.login'); //登入頁面，設定name之後可以直接使用route('name') 對應辨識
Route::post('/register','UserAccountLoginController@register')->name('user.register');; //登入欄位驗證

//GOOGLE、FB登入接收位置
Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/{provider}/callback', 'SocialAuthController@callback');

//ECPAY接收位置
Route::post('/callback', 'ECPayController@callback');
Route::post('/ecpay/result', 'ECPayController@result');

//接收回傳結果
Route::post('/checkout_status','OrderCartController@orderstatus');

//測試回傳訂單用
Route::get('/test/checkout_status', function (){
    return view('front.test.checkout_status_form');
});

//contact聯絡我
Route::get('contact','ContactFormController@create');
Route::post('contact','ContactFormController@store');

Route::get('/SingleProduct/{product}','FrontProductController@SingleProduct');
Route::get('/catalog/{type}/{mainmenu}/{submenu}','FrontProductController@catalog');
Route::post('/catalog/{type}/{mainmenu}/{submenu}','FrontProductController@catalog');//FILTER BY PRICE
//Route::get('/quickview/{product}','FrontProductController@quickview');//首頁colorbox

Route::get('/logout','UserAccountLoginController@logout');//登出


/*
Route::get('catalog/{mainmenu}/{submenu}','FrontProductController@catalog_sub');
Route::post('catalog/{mainmenu}/{submenu}','FrontProductController@catalog_sub');//FILTER BY PRICE
*/


//需判斷前台是否登入的頁面
Route::group(['middleware' => ['auth:user_account']], function () {
    
    Route::post('/add_cart','FrontProductController@add_cart');
    Route::get('/cart','OrderCartController@index');
    Route::post('/update_cart','OrderCartController@edit');
    Route::delete('/delete_cart/{OrderCart}','OrderCartController@destroy');
    Route::get('/checkout', function (){
        return view('front.checkout');
    });
    Route::post('/checkout/order','OrderCartController@checkout_order');
    //Route::get('/orderlist','OrderCartController@orderlist');
    Route::get('/orderlist', function (){
        return view('front.orderlist');
    });
    Route::get('/orderdetial/{order}','OrderCartController@orderdetial');

});



/**************************************前台 END*********************************************/




/**************************************後台 START*********************************************/

//需判斷後台是否登入的頁面
Route::group(['middleware' => ['auth:account'], 'prefix' => 'manager'] /*group的路徑*/  , function() {
	Route::get('/logout','ManagerLoginController@logout');//登出


    //後台管理員
	Route::get('/accounts','AccountController@index')->name('account');
    Route::get('/accounts/create','AccountController@create');
    Route::post('/accounts','AccountController@store');
    Route::get('/accounts/{account}/edit','AccountController@edit');
    Route::patch('/accounts/{account}','AccountController@update');
    Route::patch('/accounts/{account}/status','AccountController@status');
    Route::delete('/accounts/{account}','AccountController@destroy');


    //商品管理
    Route::get('/products','ProductController@index');
    Route::post('/products/search','ProductController@search');//搜尋條件
    Route::get('/products/search','ProductController@search');//搜尋條件
    Route::get('/products/create','ProductController@create');
    Route::post('/products','ProductController@store');
    Route::get('/products/{product}/edit','ProductController@edit');
    Route::patch('/products/{product}','ProductController@update');
    Route::delete('/products/{product}','ProductController@destroy');
    //刪除商品單一組圖
    Route::delete('/products/deleteMultipleImg/{ProductMultipleImg}','ProductController@destroyProductMultipleImg');

    //訂單管理
    Route::get('/orders','OrderController@index');
    Route::post('/orders/search','OrderController@search');
    Route::get('/orders/search','OrderController@search');//搜尋條件
    Route::get('/orders/{order}','OrderController@show');

    Route::post('/products/menu','ProductController@ChangeSubmenu');//更換子類別

    Route::post('/products/tinymceupload/{product}','ProductController@tinymceupload');
    Route::get('/products/tinymceimgmanager/{product}','ProductController@tinymceimg');

});


//不需判斷是否登入的頁面
Route::get('/manager/login','ManagerLoginController@index')->name('manager.login'); //登入頁面，設定name之後可以直接使用route('name') 對應辨識
Route::post('/manager/login','ManagerLoginController@checklogin'); //登入欄位驗證

/************************************後台 END***********************************************/