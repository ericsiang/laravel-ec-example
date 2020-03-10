@extends('manager.extends.layout')

@section('title','訂單詳細')

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>訂單詳細 <small></small></h3>
    </div>
    <!--
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>-->
</div>
<div class="clearfix"></div>

<!--
<div class='row'>
<div class="x_panel"> 
  <div class="col-md-12 col-sm-12 col-xs-12">
  </div>
  </div>
</div>-->

<div class="clearfix"></div>
<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <!--
            <div class="x_title">
                <h2><small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href='/manager/products/create'><button type="button" class="btn btn-primary">新增商品</button></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>-->
            @php
                //dd($orderInfo);
                $orderStatus=['待確認','交易成功','交易失敗'];   
                $orderInfo=$orderInfo[0];
            @endphp
            <div class="x_content"> 
                <div style="font-size:15px;">
                <label>訂單編號 : </label> {{ $orderInfo->order_no }}<br><br>
                <label>會員信箱 : </label> {{ $orderInfo->email }}<br><br>
                <label>收件人名稱 : </label> {{ $orderInfo->first_name." ".$orderInfo->last_name }}<br><br>
                <label>收件人地址 : </label> {{ $orderInfo->address }}<br><br>
                <label>收件人電話 : </label> {{ $orderInfo->phone }}<br><br>
        
                <label>付款方式 : </label> {{ $orderInfo->pay_way }}<br><br>
                <label>運費 : </label> {{ $orderInfo->shipping_fee }}<br><br>
                <label>訂單總金額 : </label> {{ $orderInfo->order_total }}<br><br>
                <label>訂單狀態 : </label> {{ $orderStatus[$orderInfo->order_status] }}<br><br>
                </div>
                <div class="table-responsive" style="font-size:15px;">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                               <!-- <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>-->
                                <th class="column-title">商品名稱</th>
                                <th class="column-title">商品數量</th>
                                <th class="column-title">商品單價</th>
                                <th class="column-title">商品總金額</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orderInfo->ordercarts as $ordercart)
                                <tr class="even pointer">
                                    <td class=" ">{{ $ordercart->p_name }}</td>
                                    <td class=" ">{{ $ordercart->quantity }}</td>
                                    <td class="a-right a-right ">{{ $ordercart->unit_price }}</td>
                                    <td class=" last">{{ $ordercart->cart_price }}</td>
                                </tr>
                            @endforeach
                           <!--<tr class="even pointer">
                                <td class=" ">121000040</td>
                                <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i></td>
                                <td class="a-right a-right ">$7.45</td>
                                <td class=" last"><a href="#">View</a>
                                </td>
                            </tr>-->
                        </tbody>
                    </table>



                </div>
                <div class="row">
                    <div class="col-12 text-center d-flex justify-content-center">
                       
                        @php
                            //dd($products);
                        @endphp
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection