<?php

namespace App\Http\Controllers;

use App\account;
use Validator;//新增自訂驗證時須加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts=Account::paginate(15);
        return view('manager.accounts.index',compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account=new Account();

        //dd($account);
        return view('manager.accounts.create',compact('account'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();
        $validator=$this->validateRequest($input);
        
        
        if($validator->passes()){
            //密碼加密
            $input['password']=Hash::make($input['password']);

            $account=Account::create($input);
            return redirect('/manager/accounts');
        }else{
            return redirect('/manager/accounts/create')
                            ->withErrors($validator) //傳送驗證error
                            ->withInput(); //傳送原本填寫表單的值
            //dd($messages = $validator->messages()); 

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function status(account $account)
    {   
        
        if($account->status==1){
            $account->update([
                'status'=>3
            ]);
        }else{
            $account->update([
                'status'=>1
            ]);
        }

        
        return redirect('/manager/accounts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(account $account)
    {
        return view('manager.accounts.edit',compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, account $account)
    {
        $input=$request->all();
        $validator=$this->validateRequest($input);
        $id=$account->id;    

        if($validator->passes()){
            
            $account->update($input);

            return redirect('/manager/accounts/'.$id.'/edit');
        }else{
            return redirect('/manager/accounts/'.$id.'/edit')
                            ->withErrors($validator) //傳送驗證error
                            ->withInput(); //傳送原本填寫表單的值
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(account $account)
    {
        $account->delete();

        return redirect('/manager/accounts');
    }

    private function validateRequest($input){
        
        /*****************自訂驗證*********************/
        $rule=[
            'name'      =>'required|min:3',
            'account'   =>'required|min:3',
            'password'  =>'required|min:8'
        ];

        $msg=[
            'required'=>':attribute 欄位必填',
            'min'=>':attribute 欄位至少:min個字',
        ];

        $validator=Validator::make($input,$rule,$msg);
        /*****************自訂驗證*********************/  
        
        return  $validator;
    }

}
