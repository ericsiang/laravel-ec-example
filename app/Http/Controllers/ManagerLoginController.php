<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;//欄位驗證要加這行
use Illuminate\Foundation\Auth\AuthenticatesUsers; //需login驗證時一定要加這行

class ManagerLoginController extends Controller
{
    use AuthenticatesUsers; //需login驗證時一定要加這行

    /**
	 * Where to redirect users after login.
	 * 登入後導向的頁面
	 * @var string
	 */
    protected $redirectTo = '/manager/login';
    


    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
    //建構子=>middleware
	public function __construct() {
		$this->middleware('guest:account', ['except' => 'logout']);
	}

    //載入的 login 頁面
    public function index(){
        return view('manager.login');
    }


    /**
     * 定義登入時須輸入的table對應欄位，這邊我們在table內輸入的是account。
     * @return string
     */
    public function username()
    {
        return 'account';
    }


    /**
	 * 修改驗證時使用的 guard
	 */
	protected function guard() {
		return \Auth::guard('account');
	}

    /**
	 * 登出後的轉址路徑
	 */
	public function logout(Request $request) {
		$this->guard()->logout();
		$request->session()->flush();
        $request->session()->regenerate();

        Auth::logout();
		return redirect('/manager/login');
	}


    //判斷欄位
    public function checklogin(Request $request){
        $input=$request->all();

        $rule=['account'=>'required','password'=>'required',];
        $msg=['required'=>'請輸入 :attribute'];

        $validator=Validator::make($input,$rule,$msg);

        if($validator->passes()){
                
            
            if (Auth::guard('account')->attempt(['account' => $input['account'], 'password' => $input['password']],true))//驗證成功後，要進行的動作
            {  
                return redirect('/manager/accounts'); 
            }else{ //驗證失敗後，要進行的動作
                return redirect('/manager/login')
                            ->with('msg','登入失敗，請確認帳號密碼是否正確'); //回傳一次性session
            }
        }else{
            return redirect('/manager/login')
                            ->withErrors($validator) //傳送欄位錯誤的error
                            ->withInput();  //傳送原本填寫表單的值
        }

       
    }



}
