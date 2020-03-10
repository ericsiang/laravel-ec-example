<?php

namespace App\Http\Controllers;

use App\UserAccount;
use Validator;//新增自訂驗證時須加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers; //需login驗證時一定要加這行

class UserAccountLoginController extends Controller
{
    use AuthenticatesUsers; //需login驗證時一定要加這行
   
    //登入後導向的頁面
    protected $redirectTo = '/manager/login';


    //建構子=>middleware
	public function __construct() {
		$this->middleware('guest:user_account', ['except' => 'logout']);
	}

    //修改驗證時使用的 guard
    protected function guard() {
        return \Auth::guard('user_account');
    }

    public function logout(Request $request) {
		$this->guard()->logout();
		$request->session()->flush();
        $request->session()->regenerate();

        Auth::logout();
		return redirect('/');
	}

    public function register(Request $request){
        //dd($request->all());
        $input=$request->all();
       /*
        unique >輸入值必須是唯一值
        exists >輸入值必須存在
       */ 
        $rule=[
            'email'=>'required|email|unique:user_account,email',
            'password'=>'required|min:8',
            're_password'=>'required|same:password',
        ];

        $msg=[
            'email'=>'email格式有誤',
            'email.unique'=>'email已存在',
            'password.min'=>'最少8個',
            'required'=>':attribute欄位必填',
            're_password.required'=>'repeat password欄位必填',
            're_password.same'=>'確認密碼不一致',
        ];

        $validator=Validator::make($input,$rule,$msg);
        

        if($validator->passes()){
           
            //密碼加密
            $input['password']=Hash::make($input['password']);

            unset($input["re_password"]);
            $UserAccount=UserAccount::create($input);
            return redirect('/login');

        }else{
            //dd('error');
            return redirect('/login')
                            ->withErrors($validator) //傳送驗證error
                            ->withInput() //傳送原本填寫表單的值   
                            ->with('type','register'); //回傳一次性session  
        }

    }
    
    //判斷欄位
    public function checklogin(Request $request){
        $input=$request->all();

        $rule=['email'=>'required','password'=>'required',];
        $msg=['required'=>'請輸入 :attribute'];

        $validator=Validator::make($input,$rule,$msg);

        if($validator->passes()){
                
            
            if (Auth::guard('user_account')->attempt(['email' => $input['email'], 'password' => $input['password']]))//驗證成功後，要進行的動作
            {  

                return redirect('/'); 
            }else{ //驗證失敗後，要進行的動作
                return redirect('/login')
                            ->withInput()  //傳送原本填寫表單的值
                            ->with('type','login') //回傳一次性session  
                            ->with('msg','登入失敗，請確認帳號密碼是否正確'); //回傳一次性session
            }
        }else{
            return redirect('/login')
                            ->withErrors($validator) //傳送欄位錯誤的error
                            ->withInput()  //傳送原本填寫表單的值
                            ->with('type','login'); //回傳一次性session  
        }

        
    }


}
