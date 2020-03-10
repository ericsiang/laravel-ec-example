<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;



class ContactFormController extends Controller
{
    public function create(){
        return view('front.contact');
    }

    public function store(Request $request){
        //dd($request->all());
         /*****************自訂驗證*********************/
         $input=$request->all();
         $rule=[ 
            'name'=>'required',
            'email'  => 'required|email',
            'message'  => 'required',
        ];
        $msg=[
            'required'=>':attribute 欄位必填',
            'email.email'=>':attribute 格式有誤',   
        ];

        $validator=Validator::make($input,$rule,$msg);
        /*****************自訂驗證*********************/  
        
        if($validator->passes()){
            //Send email
            Mail::to('eric6052418@gmail.com')->send(new ContactFormMail($input));
            
            //session()->flash('msg','Thanks for your message');

            return redirect('contact')
                            ->with('msg','Thanks for your message');
        }else{
            return redirect('contact')
                        ->withErrors($validator)
                        ->withInput();
        }

    }
}
