<?php

namespace App\Http\Controllers;

use App\Company;
use App\Customer;
use App\Mail\NewUserMail;
use Validator;//新增自訂驗證時須加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use App\Events\NewUserRegisteredEvent;

class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $activecustomer=Customer::active()->get();
        $inactivecustomer=Customer::inactive()->get();
        $companies=Company::all();*/
        $customers=Customer::with('company')->paginate(15);

        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::all();
        $customer=new Customer;

        return view('customers.create',compact('companies','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->authorize('create',Customer::class);

        //自訂驗證
        $input=$request->all();
        $validator=$this->validateRequest($input);
        
        //dd($validator);

        /*
         //內建驗證 
         $data=request()->validate([
            'name'  => 'required|min:3',
            'email'  => 'required|email',
            'active'  => 'required',
        ]);*/
         
        /*
        當 $validator->passes() 為 true 時，表示通過驗證，這時候才進行資料庫新增的動作。
        相反地，如果 $validator->fails() 為 true，表示驗證失敗，不做任何動作並返回表單頁面。*/ 

        if($validator->passes()){
            $customer=Customer::create($input);
            
            if(array_key_exists('image',$input)){
                $this->storeImg($customer);
            }

            event(new NewUserRegisteredEvent($customer));
           
           
            return redirect('customers');
        }else{
            return redirect('customers/create')
                            ->withErrors($validator) //傳送驗證error
                            ->withInput(); //傳送原本填寫表單的值
            //dd($messages = $validator->messages()); 

        }
        
       
        
       

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //dd($customer);
       // $customer=Customer::WHERE('id',$customer)->firstOrFail();
       
        return view('customers.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $companies=Company::all();
    
        return view('customers.edit',compact('customer','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //自訂驗證
        $input=$request->all();
        $validator=$this->validateRequest($input);

    
        $id=$customer->id;
       
        if($validator->passes()){
           $customer->update($input);
           if(array_key_exists('image',$input)){
                 $this->storeImg($customer);
            }

           return redirect('customers/'.$id.'');
        }else{
            return redirect('customers/'.$id.'/edit')
                            ->withErrors($validator) //傳送驗證error
                            ->withInput(); //傳送原本填寫表單的值
            //dd($messages = $validator->messages()); 

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('delete',$customer);

        $customer->delete();

        return redirect('/customers');
    }


    private function validateRequest($input){


        /*****************自訂驗證*********************/


        
        $rule=[ 
            'name'=>'required|min:3',
            'email'  => 'required|email|min:5',
            'active'  => 'required',
            'company_id'  => 'required',
            'image' =>  'sometimes|file|image',
        ];
        
    
        $msg=[
            'required'=>':attribute 欄位必填',
            'name.min'=>':attribute 欄位必需超過3個字',
            'email.email'=>':attribute 格式有誤',
            'email.min'=>':attribute 欄位必需超過:min個字',
            'active.required'=>':attribute 欄位必選',
            'company_id.required'=>'company 欄位必選', 
            'image.image'=>'需為圖檔',   
        ];

        $validator=Validator::make($input,$rule,$msg);
        /*****************自訂驗證*********************/  
        
        return  $validator;
    }

    private function storeImg($customer){
        $customer->update([
            'image'=>request()->image->store('uploads','public'),
         ]);

       $img=Image::make(public_path('storage/'.$customer->image))->resize(300,300 );
       $img->save();     
    }

}


