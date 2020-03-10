<?php

namespace App\Http\Controllers;

use App\Product;
use App\Submenu;
use App\Mainmenu;
use App\OrderCart;
use App\ProductMultipleImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontProductController extends Controller
{

    //商品colorbox內容 隱藏
    /*public function quickview(Product $product){
        //dd($product->p_id);
        $ProductMultipleImgs=ProductMultipleImg::WHERE('p_id',$product->p_id)   
                                                    ->WHERE('type',1)
                                                    //->toSql();
                                                    ->get();
        //dd($ProductMultipleImgs);
        return view('front.quickview',compact('product','ProductMultipleImgs'));
    }*/

    public function add_cart(Request $request){
        $input=$request->all();
       

        $p_id=$input['p_id'];
        $quantity=$input['quantity'];
        
 
        $product=Product::WHERE('p_id',$p_id)
                            ->WHERE('status',1)
                            ->get();
                            
        if($product->count()>0){
            $stock=$product[0]->stock;
            if($quantity>$stock){
                return back()->with('msg','超過庫存數量');
            }
            $p_name=$product[0]->name;
            $unit_price=$product[0]->price;
            $user_id=Auth::guard('user_account')->user()->user_id;
            $insert_array=[
                'session_id'=>time(),
                'user_id'=>$user_id,
                'p_id'=>$p_id,
                'p_name'=>$p_name,
                'quantity'=>$quantity,
                'cart_price'=>$unit_price*$quantity,
                'unit_price'=>$unit_price,
            ];

            $OrderCart=OrderCart::create($insert_array);
           
            return back()->with('msg','已加入購物車');    
           

        }else{
            return redirect('/')->with('msg','商品已下架');
        }                
       
        //dd($product->count());
       
        
    }

    //商品內容
    public function SingleProduct(Product $product){
        $check_product=Product::WHERE('p_id',$product->p_id)
                            ->WHERE('status',1)
                            ->get();
        if($check_product->count()==0){
            return redirect('/')->with('msg','商品已下架');
        }         
        //主子選單
        $mainmenus=Mainmenu::with('submenus')->WHERE('status',1)
                                                ->WHERE('menu_id',$product->menu_id)
                                                ->get();
        //type 1 多圖，
        $ProductMultipleImgs=ProductMultipleImg::WHERE('p_id',$product->p_id)   
                                                ->WHERE('type',1)
                                                //->toSql();
                                                ->get();                                          
        //dd($ProductMultipleImgs);
        return view('front.SingleProduct',compact('product','mainmenus','ProductMultipleImgs'));
    }

    //依類別顯示商品內容
    public function catalog($type,Mainmenu $mainmenu,Submenu $submenu,Request $request){
        //type=>選單類別
        

        $search_sort='';    

        $search_amount=0;
        $values_min=0;
        $values_max=5000;

        $sort='p_id';
        $sort_a='desc';

            
        if($request->has('search_amount')){
            $search_amount=$request->search_amount;
            $range_arr=explode("-",str_replace([" ","$"],["",""],$search_amount));

            $values_min=min($range_arr);
            $values_max=max($range_arr);
        }

        if($request->has('search_sort')){
            switch($request->search_sort){
                case 'price-h':
                    $sort='price';
                    $sort_a='desc';
                break;

                case 'price-l':
                    $sort='price';
                    $sort_a='asc';
                break;

                default :
                    $sort='p_id';
                    $sort_a='desc';
            }
        }

        $query=Product::query();
        $query->WHERE('status',1)
                    ->WHERE('menu_id',$mainmenu->menu_id);
        $query->when($type=='sub', function ($q) use ($submenu){
            return $q->WHERE('sub_id',$submenu->sub_id);
        });
        $query->WHERE('price',">=",$values_min)
                        ->WHERE('price',"<=",$values_max)
                        ->orderBy($sort, $sort_a);
        //dd($query->toSql());
        //dd($query->getBindings());            
        $products=$query->paginate(4);
       
        
     

        switch($type){
            case 'main':
                $mainmenus=Mainmenu::with('submenus')->WHERE('status',1)
                                                    ->WHERE('menu_id',$mainmenu->menu_id)
                                                    ->get();
            break;

            case 'sub':
                $mainmenus=Mainmenu::WHERE('status',1)
                                        ->WHERE('menu_id',$mainmenu->menu_id)
                                        ->with(['submenus'=>function($query) use ($submenu) { 
                                            $query->WHERE('sub_id',$submenu->sub_id); 
                                        }])
                                        ->get();
            break;
        }

      
        //dd($products);

        return view('front.catalog',compact('mainmenus','products','type','values_min','values_max','search_amount','search_sort'));    

    }
    /*先隱藏，已將main跟sub，合併到catalog function
    public function catalog_sub(Mainmenu $mainmenu,Submenu $submenu ,Request $request){
        
        //dd($request);

        //選單類別
        $type='sub';
        $search_sort='';

        $search_amount=0;
        $values_min=0;
        $values_max=5000;
        
        $sort='p_id';
        $sort_a='desc';


        if($request->has('search_amount')){
            $search_amount=$request->search_amount;
            $range_arr=explode("-",str_replace([" ","$"],["",""],$search_amount));

            $values_min=min($range_arr);
            $values_max=max($range_arr);
        }

        if($request->has('search_sort')){
            switch($search_sort){
                case 'price-h':
                    $sort='price';
                    $sort_a='desc';
                break;

                case 'price-l':
                    $sort='price';
                    $sort_a='asc';
                break;

                default :
                    $sort='p_id';
                    $sort_a='desc';
            }
        }
        
        $products=Product::WHERE('status',1)
                            ->WHERE('menu_id',$mainmenu->menu_id)
                            ->WHERE('sub_id',$submenu->sub_id)
                            ->WHERE('price',">=",$values_min)
                            ->WHERE('price',"<=",$values_max)
                            ->orderBy($sort, $sort_a)
                            ->paginate(4); 
                            //->toSql();
                            //->getBindings();                 
                            //->get();
                            //dd($products);
    
  

        $mainmenus=Mainmenu::WHERE('status',1)
                                ->WHERE('menu_id',$mainmenu->menu_id)
                                ->with(['submenus'=>function($query) use ($submenu) { 
                                    $query->WHERE('sub_id',$submenu->sub_id); 
                                }])
                                ->get();
                                    

        return view('front.catalog',compact('mainmenus','products','type','values_min','values_max','search_amount','search_sort'));  

    }
    */


}
