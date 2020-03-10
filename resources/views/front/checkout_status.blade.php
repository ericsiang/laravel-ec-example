@extends('front.extends.layout')


@section('title','Namira | Home')

@section('content')
    @php
        if($msg){
            echo '<script>alert("'.$msg.'");</script>';
        }
       
    @endphp
   
    <!-- Checkout -->
    <section class="section-wrap checkout">
      <div class="container relative">
        <div class="row">

          <div class="ecommerce col">
            <!--    
            <div class="row mb-30">
              <div class="col-md-8">
                <p class="ecommerce-info">
                  Returning Customer? 
                  <a href="#" class="showlogin">Click here to login</a>
                </p>
              </div>
            </div>-->

            <form name="checkout" class="checkout ecommerce-checkout row" action="/checkout/order" method="POST">
               @csrf 
              <div class="col-lg-7" id="customer_details">

              </div> <!-- end col -->

              <!-- Your Order -->
              <div class="col-lg-12">
                <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
                  <h2 class="uppercase">Your Order</h2>
                  <table class="table shop_table ecommerce-checkout-review-order-table">
                    <tbody>
                      @php
                          
                          $total=0;
                      @endphp 
                       <tr class="order-total">
                        <th><strong>Order No</strong></th>
                        <td>
                          <strong><span class="amount">{{ $order[0]->order_no }}</span></strong>
                          <input type="hidden" name="order_total" value="{{ $total+300 }}"/>
                        </td>
                      </tr> 
                      @foreach ($OrderCarts as $OrderCart)
                        @php
                            $total+=$OrderCart->cart_price;
                        @endphp
                        <tr>
                            <th>{{ $OrderCart->p_name }}<span class="count"> x {{ $OrderCart->quantity }}</span></th>
                            <td>
                            <span class="amount">${{ $OrderCart->cart_price }}</span>
                            </td>
                        </tr>
                      @endforeach
   
                      <tr class="shipping">
                        <th>Shipping</th>
                        <td>
                          <span>$300</span>
                          <input type="hidden" name="shipping_fee" value="300"/>
                        </td>
                      </tr>
                      <tr class="order-total">
                        <th><strong>Total Amount</strong></th>
                        <td>
                          <strong><span class="amount">${{ $total+300 }}</span></strong>
                          <input type="hidden" name="order_total" value="{{ $total+300 }}"/>
                        </td>
                      </tr>
                      <tr class="order-total">
                        <th><strong>Order Status</strong></th>
                        <td>
                          <strong>
                            <span class="amount">
                              @switch($order[0]->order_status)
                                @case(1)
                                    {{ '交易成功' }}
                                    @break
                                @case(2)
                                    {{ '交易失敗' }}
                                    @break
                                @default
                                    {{ '待確認' }}
                              @endswitch
                            </span>
                          </strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div> <!-- end order review -->
            </form>

          </div> <!-- end ecommerce -->

        </div> <!-- end row -->
      </div> <!-- end container -->
    </section> <!-- end checkout -->


    @endsection