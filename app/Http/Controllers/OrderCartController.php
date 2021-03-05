<?php

namespace App\Http\Controllers;


use App\Order;
use App\Product;
use App\OrderCart;
use Validator;//新增自訂驗證時須加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers; //需login驗證時一定要加這行

//引用綠界SDK
use ECPay_PaymentMethod as ECPayMethod;
use ECPay_AllInOne as ECPay;

class OrderCartController extends Controller
{   
    //顯示購物車商品
    public function index(){
        $user_id=Auth::guard('user_account')->user()->user_id;
        $OrderCarts=OrderCart::WHERE('user_id',$user_id)->WHERE('session_id',">",0)->get();
        
        return view('front.cart',compact('OrderCarts'));
    }

    //購物車修改商品數量
    public function edit(Request $request){
        $cart_id=$request->cart_id;
        $new_quantity=$request->new_quantity;
        
        $order_cart=OrderCart::WHERE('cart_id',$cart_id)->get();
        //dd($order_cart);
        $p_id=$order_cart[0]->p_id;
        $product=Product::WHERE('p_id',$p_id)->get();
        $p_name=$product[0]->name; 
        $unit_price=$product[0]->price; 
        $stock=$product[0]->stock;   
        if($new_quantity>$stock){
            return 'stock_fail'; 
        }else{
            $cart_price=$unit_price*$new_quantity;
            OrderCart::WHERE('cart_id',$cart_id)
                        ->update([
                            'unit_price'=>$unit_price,
                            'cart_price'=>$cart_price,
                            'quantity'=>$new_quantity,
                            'p_name'=>$p_name,
                            'cart_id'=>$cart_id
                        ]);


            return 'success';    
        }
        

    }

    //購物車刪除商品
    public function destroy(OrderCart  $OrderCart){
        //dd($OrderCart);
        
        $OrderCart->delete();
        return 1;
    }

    //訂單付款
    public function checkout_order(Request $request){
        $input=$request->all();

        $rule=['first_name'=>'required','last_name'=>'required','address'=>'required','phone'=>'required|digits:10'];
        $msg=['required'=>'請輸入 :attribute','phone.digits'=>"需為10碼電話"];

        $validator=Validator::make($input,$rule,$msg);

        if($validator->passes()){
            $user_id=Auth::guard('user_account')->user()->user_id;
            $OrderCarts=OrderCart::WHERE('user_id',$user_id)->WHERE('session_id',">",0)->get();     

            if(Auth::guard('user_account')->user()){
                if($OrderCarts->count()==0){
                    return redirect('/cart');
                }

                if ($this->productsStockCheck($OrderCarts)) {
                    return back()->with('stock_msg','抱歉你購買的項目內，有庫存不足的商品');
                }
                $input['user_id']=$user_id;
                $input['order_no']='T'.time();
                $order=Order::create($input);
                //dd($order);
                foreach($OrderCarts as $OrderCart){
                    OrderCart::WHERE('cart_id',$OrderCart->cart_id)
                        ->update([
                            'session_id'=>0,
                            'order_id'=>$order->order_id,
                        ]);
                    $product=Product::WHERE('p_id',$OrderCart->p_id)->get();
                    $stock=$product[0]->stock;
                    $new_stock=$stock-$OrderCart->quantity;  
                    
                    $product=Product::WHERE('p_id',$OrderCart->p_id)
                                        ->update(['stock'=>$new_stock]);
                }

                $order_id=$order->order_id;
                $OrderCarts=OrderCart::WHERE('order_id',$order_id)->get();
                
                /**
                *    Credit信用卡付款產生訂單範例
                */
                    
                    //載入SDK(路徑可依系統規劃自行調整)
                    try {
                        
                        $obj = new \ECPay_AllInOne(); //記得要再new前加斜線，因為namespace
                
                        //服務參數
                        $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5";   //服務位置
                        $obj->HashKey     = env('ECPAY_HASHKEY','5294y06JbISpM5x9');                                    //測試用Hashkey，請自行帶入ECPay提供的HashKey
                        $obj->HashIV      = env('ECPAY_HASHIV','v77hoKGq4kWxNNIS');                                
                        //測試用HashIV，請自行帶入ECPay提供的HashIV
                        $obj->MerchantID  = '2000132';                                                      
                        //測試用MerchantID，請自行帶入ECPay提供的MerchantID =>合作特店編號
                        $obj->EncryptType = '1';                                                          
                        //CheckMacValue加密類型，請固定填入1，使用SHA256加密
                        //基本參數(請依系統規劃自行調整)
                        $MerchantTradeNo = $order->order_no; //特店交易編號 我們這的訂單號碼
                        $obj->Send['ReturnURL']         =  env('ECPAY_RETURN_URL');    //付款完成通知回傳的網址
                        $obj->Send['OrderResultURL']    = env('ECPAY_RETURN_URL');
                        $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;                          //訂單編號
                        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                       //交易時間
                        $obj->Send['TotalAmount']       = $order->order_total;                       //交易金額
                        $obj->Send['TradeDesc']         = $order->order_no;                          //交易描述
                        $obj->Send['ChoosePayment']     = \ECPay_PaymentMethod::Credit ;              //付款方式:Credit
                        $obj->Send['IgnorePayment']     = \ECPay_PaymentMethod::GooglePay ;           //不使用付款方式:GooglePay
                        //訂單的商品資料
                        foreach($OrderCarts as $OrderCart){
                            array_push($obj->Send['Items'], array('Name' => $OrderCart->p_name, 'Price' => (int)$OrderCart->unit_price,
                            'Currency' => "元", 'Quantity' => (int) $OrderCart->quantity, 'URL' => ""));
                        }
                        array_push($obj->Send['Items'], array('Name' => '運費', 'Price' => (int)"300",
                            'Currency' => "元", 'Quantity' => (int)"1", 'URL' => ""));
                        /*array_push($obj->Send['Items'], array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000",
                                'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));*/
                        
                                //Credit信用卡分期付款延伸參數(可依系統需求選擇是否代入)
                        //以下參數不可以跟信用卡定期定額參數一起設定
                        $obj->SendExtend['CreditInstallment'] = '' ;    //分期期數，預設0(不分期)，信用卡分期可用參數為:3,6,12,18,24
                        $obj->SendExtend['InstallmentAmount'] = 0 ;    //使用刷卡分期的付款金額，預設0(不分期)
                        $obj->SendExtend['Redeem'] = false ;           //是否使用紅利折抵，預設false
                        $obj->SendExtend['UnionPay'] = false;          //是否為聯營卡，預設false;
                        //Credit信用卡定期定額付款延伸參數(可依系統需求選擇是否代入)
                        //以下參數不可以跟信用卡分期付款參數一起設定
                        // $obj->SendExtend['PeriodAmount'] = '' ;    //每次授權金額，預設空字串
                        // $obj->SendExtend['PeriodType']   = '' ;    //週期種類，預設空字串
                        // $obj->SendExtend['Frequency']    = '' ;    //執行頻率，預設空字串
                        // $obj->SendExtend['ExecTimes']    = '' ;    //執行次數，預設空字串
                        
                        # 電子發票參數
                        /*
                        $obj->Send['InvoiceMark'] = ECPay_InvoiceState::Yes;
                        $obj->SendExtend['RelateNumber'] = "Test".time();
                        $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
                        $obj->SendExtend['CustomerPhone'] = '0911222333';
                        $obj->SendExtend['TaxType'] = ECPay_TaxType::Dutiable;
                        $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
                        $obj->SendExtend['InvoiceItems'] = array();
                        // 將商品加入電子發票商品列表陣列
                        foreach ($obj->Send['Items'] as $info)
                        {
                            array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
                                $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => ECPay_TaxType::Dutiable));
                        }
                        $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
                        $obj->SendExtend['DelayDay'] = '0';
                        $obj->SendExtend['InvType'] = ECPay_InvType::General;
                        */
                        //產生訂單(auto submit至ECPay)
                        //dd($obj);
                        $obj->CheckOut();
                        //$Response =$obj->CheckOutString();
                        
                       // dd($Response);
                    
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    } 


               
            }else{
                return redirect('/login');
            }

           
        }else{
            //dd('error');
            return redirect('/checkout')
                            ->withErrors($validator) //傳送驗證error
                            ->withInput(); //傳送原本填寫表單的值   
                           
        }
    }

    //確認訂單商品庫存
    protected function productsStockCheck($OrderCarts)
    {
        foreach($OrderCarts as $OrderCart){
            $p_id=$OrderCart->p_id;
            $product=Product::WHERE('p_id',$p_id)->get();

            if ($product[0]->stock < $OrderCart->quantity) {
                return true;
            }
        }
        return false;
    }

    //訂單交易完成回傳
    public function orderstatus(Request $request){
        /* 接收到的回傳陣列
            array(
                "CustomField1" => null,
                "CustomField2" => null,
                "CustomField3" => null,
                "CustomField4" => null,
                "MerchantID" => "2000132",
                "MerchantTradeNo" => "T1576824229",
                "PaymentDate" => "2019/12/20 14:44:57",
                "PaymentType" => "Credit_CreditCard",
                "PaymentTypeChargeFee" => "18",
                "RtnCode" => "1",
                "RtnMsg" => "Succeeded",
                "SimulatePaid" => "0",
                "StoreID" => null,
                "TradeAmt" => "900",
                "TradeDate" => "2019/12/20 14:43:52",
                "TradeNo" => "1912201443520341",
                "CheckMacValue" => "C8EF745A91ABDC0F5C58B716A807306D27DE5C37681B9FFB54EE16C2FEB5637C"
            );
        */ 

        $order_no=$request->MerchantTradeNo;
        if($request->RtnCode==1){
            $order=Order::WHERE('order_no',$order_no)
                            ->update([
                                'order_status'=>1//交易成功
                            ]);
            $msg='訂單交易成功';                
        }else{
            $order=Order::WHERE('order_no',$order_no)
                            ->update([
                                'order_status'=>2//交易失敗
                            ]);
            $msg='訂單交易失敗';     
        }                    
        
        $order=Order::WHERE('order_no',$order_no)->get(); //取得訂單資訊
        //dd($order);
        $order_id=$order[0]->order_id;
        $OrderCarts=OrderCart::WHERE('order_id',$order_id)->get(); //取得訂單內購物車資訊
        //dd($order_id);
        return view('front.checkout_status',compact('order','OrderCarts','msg'));
    }

    //顯示訂單詳細
    public function orderdetial(Order $order){
        $msg="";
        $OrderCarts=OrderCart::WHERE('order_id',$order->order_id)->get();
        $order=Order::WHERE('order_id',$order->order_id)->get();
        //dd($order);
        return view('front.checkout_status',compact('order','OrderCarts','msg'));
        //dd($OrderCarts);
    }

}
