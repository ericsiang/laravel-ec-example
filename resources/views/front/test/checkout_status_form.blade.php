<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="http://7a4016aa.ngrok.io/checkout_status" method="POST">
 @php   
    $arr=array(
        "CustomField1" => null,
        "CustomField2" => null,
        "CustomField3" => null,
        "CustomField4" => null,
        "MerchantID" => "2000132",
        "MerchantTradeNo" => "T1576824229",
        "PaymentDate" => "2019/12/20 14:44:57",
        "PaymentType" => "Credit_CreditCard",
        "PaymentTypeChargeFee" => "18",
        "RtnCode" => "2",
        "RtnMsg" => "failed",
        "SimulatePaid" => "0",
        "StoreID" => null,
        "TradeAmt" => "900",
        "TradeDate" => "2019/12/20 14:43:52",
        "TradeNo" => "1912201443520341",
        "CheckMacValue" => "C8EF745A91ABDC0F5C58B716A807306D27DE5C37681B9FFB54EE16C2FEB5637C"
    );

    foreach($arr as $k => $v){
        echo '<input name="'.$k.'" value="'.$v.'" /><br><br>';
    }

 @endphp  
 <input type="submit" value="測試ECPAY回傳訂單送出">
 </form> 
</body>
</html>