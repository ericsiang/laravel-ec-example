<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orderLists=Order::where('order_list.order_id', '>','0')
                            ->leftjoin('user_account','user_account.user_id','=','order_list.user_id')
                            ->orderBy('order_list.created_at','desc')
                            //->toSql();
                            ->paginate(15);//分頁;

        //dd($orderLists);
        return view('manager.orders.index',compact('orderLists'));
    }

    public function search(Request $request){
        $input=$request->all();
    
        $orderLists=Order::when($request->search, function($query) use ($request){
                                $query->WHERE('order_no','like','%'.$request->search.'%');
                            })
                            ->when($request->date, function($query) use ($request){
                                $date_arr=explode('-',$request->date);
                                $date_start=trim($date_arr[0]);
                                $date_end=trim($date_arr[1]);
                                $query->WHERE('created_at','>=',$date_start);
                                $query->WHERE('created_at','<=',$date_end);        
                            })
                            ->orderBy('created_at','desc')
                            //->toSql();
                            ->paginate(15)//分頁
                            ->appends($request->except(['page','_token'])); //分頁會帶查詢條件
            //dd($orderLists);

        return view('manager.orders.index',compact('orderLists','input'));
    }

    public function show(Order $order){
        //dd($order);
        $orderInfo=Order::with('ordercarts')
                            ->WHERE('order_id','=',$order->order_id)
                            ->leftjoin('user_account','user_account.user_id','=','order_list.user_id')
                            ->get();
        return view('manager.orders.orderDetial',compact('orderInfo'));
    }

}
