<?php

namespace App\Http\Controllers;

use App\ECPay;
use Illuminate\Http\Request;

class ECPayController extends Controller
{   
    public function callback(Request $request){
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
       
        $input=$request->all();
        $get_data=json_encode($input);
        $order_no=$request->MerchantTradeNo;
        $RtnCode=$request->RtnCode;
        $RtnMsg=$request->RtnMsg;
 
        $data=ECPay::create(['order_no'=>$order_no,'RtnCode'=>$RtnCode,'RtnMsg'=>$RtnMsg,'get_data'=>$get_data]);

        return '1|OK';
    }


}
