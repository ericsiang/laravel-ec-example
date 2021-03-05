<?php

namespace App\Http\Controllers;

use App\Product;
use App\Submenu;
use App\Mainmenu;
use Validator;//新增自訂驗證時須加
use App\ProductMultipleImg;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; //Intervention Image套件


class ProductController extends Controller
{

    public function index(){
        $products=Product::where('status', '!=','2')
                            ->orderBy('created_at','desc')
                            ->paginate(15);//分頁
                            //->get();

        return view('manager.products.index',compact('products'));
    }

    
    public function create()
    {
        $product=new Product();
        $mainmenus=Mainmenu::WHERE('status',1)->get();
        return view('manager.products.create',compact('product','mainmenus'));
    }

   
    public function store(Request $request)
    {   
       
        //dd($request);
        $input=$request->all();
        //dd($input);
        $input['content']=e($input['content']); //htmlentities  
        
        $validator=$this->validatorRequest($input,'store');
       
        if($validator->passes()){
            //dd($input);
            $new_input=$input;
            unset($new_input['multiple_img']);
            $product= Product::create($new_input);
           
            if(array_key_exists('upload_img',$input)){ //判斷input是否有帶upload_img
                //上傳圖片
                $this->upload_img($product,'single');
            }

            if(array_key_exists('multiple_img',$input)){ //判斷input是否有帶upload_img
                //上傳多圖片
                $this->upload_img($product,'multiple');
            }

            return redirect('/manager/products/');
        }else{
            
           return  redirect('/manager/products/create')
                                ->withErrors($validator)
                                ->withInput();
                                //->with('validator_fail','請確認所有欄位填寫正確!');
        }
     
    }

    
    //查詢
    public function search(Request $request,Product $product)
    {   
        $input=$request->all();
     
        //WHEN 是用來判斷search條件是否有值
        $products =Product::WHERE('status','!=',2)
                            ->when($request->search, function($query) use ($request){
                                $query->WHERE('name', 'like', '%' . $request->search . '%');
                            })
                            ->when($request->date, function($query) use ($request){
                                $date_range=explode("-",$request->date);
                                $date_start=trim($date_range[0]);
                                $date_end=trim($date_range[1]);
                                $query->where('created_at', '>=', $date_start);
                                $query->where('created_at', '<=', $date_end);
                            })
                            ->orderBy('created_at','desc')
                            ->paginate(15)//分頁
                            ->appends($request->except(['page','_token'])); //分頁會帶查詢條件
                            //->toSql(); //看sql時用
                            //dd($products);
                           // ->paginate(1);
                            //->get();
                  

         return view('manager.products.index',compact('products','input'));
        
    }

    
    public function edit(Product $product)
    {
        //dd($product);
        $mainmenus=Mainmenu::WHERE('status',1)->get();
        $choose_menu_id=$product->menu_id;
        $choose_sub_id=$product->sub_id;
        $submenus=Mainmenu::find($choose_menu_id)->submenus->toArray();
        $multiple_imgs=ProductMultipleImg::WHERE('p_id',$product->p_id)->WHERE('type',1)->get();

        return view('manager.products.edit',compact('product','mainmenus','submenus','choose_menu_id','choose_sub_id','multiple_imgs'));
    }

    
    public function update(Request $request, Product $product)
    {
        
        $input=$request->all();
        //dd($input);
        $input['content']=e($input['content']); //htmlentities  
        
        $validator=$this->validatorRequest($input,'update');
        
        //dd($validator);
        if($validator->passes()){
            
            $remove_multiple=$input;
            unset($remove_multiple['multiple_img']);
            
            $product->update($remove_multiple);
            
            /*if(array_key_exists('multiple_img',$input)){ //判斷input是否有帶upload_img
                $ProductMultipleImg_id_arr=[];
                foreach($input['multiple_img'] as $multiple_img){
                    $upload_path=$multiple_img->path();

                    $ProductMultipleImg=ProductMultipleImg::create([
                        'p_id'=>$product->p_id,
                        'upload_img'=>$upload_path
                    ]);

                    $ProductMultipleImg_id_arr[]=$ProductMultipleImg->id;
                    
                }
            }*/

            //dd($ProductMultipleImg_id_arr);
            if(array_key_exists('upload_img',$input)){ //判斷input是否有帶upload_img
                //上傳圖片
                $this->upload_img($product,'single');
            }

            if(array_key_exists('multiple_img',$input)){ //判斷input是否有帶upload_img
                //上傳多圖片
                $this->upload_img($product,'multiple');
            }
            //dd($product);
            

            return  back();
        }else{    
           // dd($validator->failed());
           //$ErrorMessagesArray = $validator->messages()->get('*');//取得錯誤message
           //dd($ErrorMessagesArray);

            return  back()
                        ->withErrors($validator)
                        ->withInput();
                        //->with('validator_fail','請確認所有欄位填寫正確!');
        }
    }

   
    public function destroy(Product $product)
    {
        //已設定軟刪除
        $product->delete();
        return  back();
        
    }

    //子類別連動
    public function ChangeSubmenu(Mainmenu $Mainmenu,Request $request){
        $menu_id=$request->menu_id;

        $submenus=Mainmenu::find($menu_id)->submenus->toArray();
        //dd($submenus);

        $select_option='<option value="">請選擇</option>';
        foreach($submenus as $submenu){
            $select_option.='<option value="'.$submenu["sub_id"].'">'.$submenu["name"].'</option>';
        }

        return $select_option;
    }

    //表單驗證
    private function validatorRequest($input,$type){

        
        if($type=='store'){ //新增商品圖片required
            $img_required='required';
        }

        if($type=='update'){ //修改商品圖片sometimes
            $img_required='sometimes';
        }

        $rule=[
            'name'=>'required',
            'title'=>'required',
            'sub_id'=>'required',
            'price'=>'required|integer',
            'stock'=>'required|integer',
            'upload_img'=>''.$img_required.'|file|mimes:jpeg,jpg|max:1024',
            //'multiple_img'=>''.$img_required.'',
            'multiple_img.*'=>'file|mimes:jpeg,jpg|max:1024',//當上傳是多檔時，需加.*
        ];

        $msg=[
           'required'=>'欄位必填',  
           'integer'=>'需為數字',   
           'upload_img.required'=>'需上傳圖片',
           'upload_img.mimes'=>'需為圖片格式(jpg,jpeg)',
           'upload_img.max'=>'圖片大小不超過2M',
           'multiple_img.required'=>'需上傳圖片',//當上傳是多檔時，需加.*
           'multiple_img.*.mimes'=>'需為圖片格式(jpg,jpeg)',//當上傳是多檔時，需加.*
           'multiple_img.*.max'=>'圖片大小不超過2M',//當上傳是多檔時，需加.*
        ];

        

        $validator=Validator::make($input,$rule,$msg);

        return $validator;

    }

    ///Intervention Image套件
    private function upload_img($product,$upload_type=''){
       
       
        switch($upload_type){
            case 'single':
                
                //圖片儲存路徑
                $real_public_path=public_path('storage/'.$product->img);    


                //判斷單圖是否存在，是則刪除圖片，下面重新上傳新的圖片
                if($product->img){
                    if(file_exists($real_public_path)){
                        //dd($real_public_path);
                        unlink($real_public_path);
                    }
                }
                //dd(request()->upload_img->store('upload_img','public'));  
               //儲存到資料表
                $product->update([
                    'img'=>request()->upload_img->store('upload_img','public'),
                ]);
                
                
                //重新上傳新的圖片   
                $img=Image::make(public_path('storage/'.$product->img))->resize(236,325);
                $img->save();       
            break;    

            case 'multiple':

                //刪除舊圖片
                /*
                $ProductMultipleImgs=ProductMultipleImg::WHERE('p_id',$product->p_id)->get();
                foreach($ProductMultipleImgs as $ProductMultipleImg){
                    //圖片儲存路徑
                    $real_public_path=public_path('storage/'.$ProductMultipleImg->img);

                    //判斷單圖是否存在，是則刪除圖片，下面重新上傳新的圖片
                    if($ProductMultipleImg->img){
                        if(file_exists($real_public_path)){
                            //dd($real_public_path);
                            unlink($real_public_path);
                        }
                    }
                }

                //刪除舊圖片資料
                ProductMultipleImg::WHERE('p_id',$product->p_id)->delete();
                */
                $multiple_imgs=request()->multiple_img;
                foreach($multiple_imgs as $multiple_img){
                    $ProductMultipleImg=ProductMultipleImg::create([
                        'p_id'=>$product->p_id,
                        'img'=>$multiple_img->store('upload_img','public'),
                        'type'=>1,
                    ]);

                    $img=Image::make(public_path('storage/'.$ProductMultipleImg->img))->resize(580,800);
                    $img->save();     
                }
               
            break; 
        }

        //dd($real_public_path);
        
    }   

    public function destroyProductMultipleImg(ProductMultipleImg $ProductMultipleImg)
    {
        //dd($ProductMultipleImg);
        //刪除舊圖片
        
        //圖片儲存路徑
        $real_public_path=public_path('storage/'.$ProductMultipleImg->img);

        //判斷單圖是否存在，是則刪除圖片，下面重新上傳新的圖片
        if($ProductMultipleImg->img){
            if(file_exists($real_public_path)){
                //dd($real_public_path);
                unlink($real_public_path);
            }
        }
        
        //刪除舊圖片資料
        $ProductMultipleImg->delete();
        return  1;
        
    }

    

    public function tinymceupload(Request $request, Product $product){
        $input=$request->all();
        //dd($input);
        $ProductMultipleImg=ProductMultipleImg::create([
            'p_id'=>$product->p_id,
            'img'=>$input['file']->store('upload_img','public'),
            'type'=>2,
        ]);

        $img=Image::make(public_path('storage/'.$ProductMultipleImg->img));
        $img->save();     
        
        return json_encode(array('location'=>asset('storage/'.$ProductMultipleImg->img)));        
        
    }

    public function tinymceimg(Product $product){
        $p_id=$product->p_id;
        $ProductMultipleImgs=ProductMultipleImg::WHERE('type',2)->WHERE('p_id',$p_id)->get();
        
        //dd($ProductMultipleImgs);
       return view('manager.products.tinymceupload',compact('product','ProductMultipleImgs'));
        
        
    }
    

    /* 手動對Collection進行分頁( 使用情境 : 需要在分頁輸出前對數據進行一些調整，然后再輸出分頁 )
    protected function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null)
    {
        
        //dd($collection);
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();
        parse_str(request()->getQueryString(), $query);
        unset($query[$pageName]);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
            [
                'pageName' => $pageName,
                'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
                'query' => $query,
                'fragment' => $fragment
            ]
        );

        return $paginator;
    }
    */
}
