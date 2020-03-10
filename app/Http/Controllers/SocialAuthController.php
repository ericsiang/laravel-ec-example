<?php

namespace App\Http\Controllers;

use App\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        //dd($provider);
        return Socialite::driver($provider)->redirect();   
    }   

    public function callback($provider)
    {
        //dd(Socialite::driver('facebook')->user());
        //$facebook_data=Socialite::driver('facebook')->user();

        $Socialite_data=Socialite::driver($provider)->user();
        //dd($provider);

        $provider_user_id=$Socialite_data->getId();
        $email=$Socialite_data->getEmail();
        $email_check=UserAccount::WHERE('provider_user_id',"!=",$provider_user_id)
                                                    ->WHERE('email',$email)                     
                                                    ->get();
                            
        if($email_check->count()>0){
            $error_provider=$email_check[0]->provider;    
            return redirect('/login')->with('msg','此帳號已用'.$error_provider.'帳號註冊會員!');
        }

        $user_account=UserAccount::WHERE('provider_user_id',$provider_user_id)->get();
       // dd($user_account);
        if($user_account->count()>0){
            Auth::guard('user_account')->login($user_account[0]);
            return redirect('/');   
        }else{
            $user_account=UserAccount::create([
                'email'=> $email,
                'password'=>"",
                'provider_user_id'=>$provider_user_id,
                'provider'=>$provider,
            ]);

           //dd($user_account);
            Auth::guard('user_account')->login($user_account);
            return redirect('/');   
        }
        
    }
}
